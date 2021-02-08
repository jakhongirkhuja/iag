<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\Request;
use App\Models\Estate;
use Illuminate\Database\Eloquent\Builder;
use App\Imports\EstateImport;
use App\Jobs\CheckUrl;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Owner;
use App\Models\Remont;
use App\Models\Region;
use App\Models\City;
use App\Models\ParsingPage;
use App\Models\Price;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    private $token;
    public function getRightNumberFormat($number)
    {
        $s = Str::of($number)->replace(' ', '')
        ->replace('+', '')
        ->replace('-', '');
        $length  = Str::length($s);
        if($length == 9){
            $s = '+998'.$s;
        }
        if($length==12){
            $s = '+'.$s;
        }
        return $s;
    }
    public function index()
    {
        
        // $urls = Estate::where('status', 1)->get();
        // if(count($urls)>0){
        //     $k = Carbon::now();
        //     foreach ($urls as $url) {
        //         CheckUrl::dispatch()->delay($k);
        //         $k = Carbon::parse($k)->addSeconds(10);
        //     }
        // }   
        
       
        
       
        
        return view('welcome', [
           
            //  'pars'=>ParsingPage::all()
        ]);
    }
    public function import(Request $request) 
    {
        if ($request->hasFile('excel')) {
            Excel::import(new EstateImport($request->site), $request->file('excel'));
            return back()->with('success', 'Uploaded Successfully!');
         } else {
           return back()->with('success', "Error");
         }
        
    }
    public function getToken(){
        $client = new GuzzleClient([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);
        $response = $client->post('notify.eskiz.uz/api/auth/login',
            ['body' => json_encode(
                [
                    'email' => 'erkin0717@gmail.com',
                    'password'=> 'QOq649bKjSo5DfqqjvRexnqyYiLNQcni7a80GWd0',
                ]
            )]
        );
        if($response->getStatusCode()==200){
            return json_decode($response->getBody()->getContents())->data->token;
        }else{
            return '';
        }
        
    }
    public function updateToken($token)
    {
        $headers = [
            'Authorization' => 'Bearer '.$token,
        ];
        $client = new GuzzleClient([
            'headers' => [ 
                'Content-Type' => 'application/json',
                'headers' => $headers,
                ]
        ]);
        $response = $client->patch('notify.eskiz.uz/api/auth/refresh');
        if($response->getStatusCode()==200){
            return json_decode($response->getBody()->getContents())->data->token;
        }else{
            return '';
        }
    }
    public function admin()
    {

        
       $good = Estate::where('status', 1)->count();
       $new = Estate::whereDate('created_at', Carbon::today())->count();
       $owner = Estate::where('announcement',2)->whereDate('created_at', Carbon::today())->count();
       $update = Estate::whereDate('updated_at', Carbon::today())->count();
       $closed =  Estate::where('status', 2)->count();
       $archive = Estate::count();
       $newbuilding = Estate::where('house_type', 2)->count();
     return view('admin/index',[
        'good' => $good,
        'new' => $new,
        'owner'=>$owner,
        'update'=>$update,
        'closed'=>$closed,
        'archive'=>$archive,
        'newbuilding'=>$newbuilding
     ]);
    }
    public function pdf($id)
    {
        $estate = Estate::find($id);
        if($estate){
            $city = $estate->getCity();
            if ($city) {
                $estate['city'] = $city->name;
            }
            $region = $estate->getRegion();
            if ($region) {
                $estate['region'] = $region->name;
            }
            $all_prices = Price::select('price', 'created_at')->where('estate_id', $estate->id)->get();
            foreach ($all_prices as $key => $all_price) {

                $all_price[Carbon::parse($all_price->created_at)->format('Y-m-d H:i')] = $all_price->price;
                $all_price->makeHidden('created_at');
                $all_price->makeHidden('price');
            }
            $estate['update_at']= $estate->updated_at->format('d.m.Y H:i');
            $estate['create_at']= $estate->created_at->format('d.m.Y H:i');
            // $estate['update_time'] = Carbon::parse($estate->updated_at)->locale('ru_RU')->isoFormat('LLLL');
            $map = explode(',', Str::of($estate->map)->replace('{', '')->replace('}', '')->replace(' ', ''));
            $lat = Str::of(explode(':', $map[0])[1])->replace("'", "");
            $lon = Str::of(explode(':', $map[1])[1])->replace("'", "");

            $d = 'https://www.google.com/maps/embed/v1/place?q=' . $lat . ',' . $lon . '&key=AIzaSyC63KzZYIxs4DNt5X_Avua9a_HgSyyVXMw&language=ru';
            $estate['map'] = $d;
            if (Str::contains($estate->img, 'https')) {
                $estate['imgs'] = explode(",", Str::of($estate->img)->replace('[', '')->replace(']', '')->replace("'", '')->replace(' ', ''));
            }
            $owner = $estate->owner()->first();
            if ($owner) {
                $estate['owner'] = $owner;
                // $estate['owner']['number'] = null;
                // dd($estate);

                $estate['owner']['update_at'] = $owner->created_at->format('m d Y H:i');;
            } else {
                $estate['owner'] = null;
            }
            $announcement = $owner->type;
            if($announcement){
                $estate['announcement'] =$announcement->name;
            }
            
            
            $owner_estate = $owner->estates()->where('estates.id', '!=', $estate->id)->orderby('estates.updated_at','desc')->get()->take(3);
            if ($owner && count($owner_estate) > 0) {

                $estate['owner_estates'] = $owner_estate;
                foreach ($estate['owner_estates'] as $own) {
                    $own_city = $own->getCity();
                    if ($own_city) {
                        $own['city'] = $own_city->name;
                    }
                    $own_region  = $own->getRegion();
                    if ($own_region) {
                        $own['region'] = $own_region->name;
                    }
                    $own['update_at'] = Carbon::parse($own->updated_at)->format('d.m.Y H:i');
                }
            }

            
            $estate['apartment_has'] = '' . Str::of($estate->apartment_has)->replace(', ', '<br>')->replace("\n", "<br>");
            $estate['near_has'] = '' . Str::of($estate->near_has)->replace('Средняя', '<br>Средняя')->replace("\n", "<br>")->replace(",", "<br>");
            $estate['body'] = '' . Str::of($estate->body)->replace('- показать телефон -', '');
            $pdf = PDF::loadView('pdf.pdf', [
                'estate'=>$estate,
            ]);
            $pdf->setPaper('A4', 'landscape');
            return $pdf->download('invoice.pdf');
        }
        
    }
    public function pdfShow($id)
    {       
        $estate = Estate::find($id);
        if($estate){
            $city = $estate->getCity();
            if ($city) {
                $estate['city'] = $city->name;
            }
            $region = $estate->getRegion();
            if ($region) {
                $estate['region'] = $region->name;
            }
            $all_prices = Price::select('price', 'created_at')->where('estate_id', $estate->id)->get();
            foreach ($all_prices as $key => $all_price) {

                $all_price[Carbon::parse($all_price->created_at)->format('Y-m-d H:i')] = $all_price->price;
                $all_price->makeHidden('created_at');
                $all_price->makeHidden('price');
            }
            $estate['update_at']= $estate->updated_at->format('d.m.Y H:i');
            $estate['create_at']= $estate->created_at->format('d.m.Y H:i');
            // $estate['update_time'] = Carbon::parse($estate->updated_at)->locale('ru_RU')->isoFormat('LLLL');
            $map = explode(',', Str::of($estate->map)->replace('{', '')->replace('}', '')->replace(' ', ''));
            $lat = Str::of(explode(':', $map[0])[1])->replace("'", "");
            $lon = Str::of(explode(':', $map[1])[1])->replace("'", "");

            $d = 'https://www.google.com/maps/embed/v1/place?q=' . $lat . ',' . $lon . '&key=AIzaSyC63KzZYIxs4DNt5X_Avua9a_HgSyyVXMw&language=ru';
            $estate['map'] = $d;
            if (Str::contains($estate->img, 'https')) {
                $estate['imgs'] = explode(",", Str::of($estate->img)->replace('[', '')->replace(']', '')->replace("'", '')->replace(' ', ''));
            }
            $owner = $estate->owner()->first();
            if ($owner) {
                $estate['owner'] = $owner;
                // $estate['owner']['number'] = null;
                // dd($estate);

                $estate['owner']['update_at'] = $owner->created_at->format('m d Y H:i');;
            } else {
                $estate['owner'] = null;
            }
            $announcement = $owner->type;
            if($announcement){
                $estate['announcement'] =$announcement->name;
            }
            
            
            $owner_estate = $owner->estates()->where('estates.id', '!=', $estate->id)->orderby('estates.updated_at','desc')->get()->take(3);
            if ($owner && count($owner_estate) > 0) {

                $estate['owner_estates'] = $owner_estate;
                foreach ($estate['owner_estates'] as $own) {
                    $own_city = $own->getCity();
                    if ($own_city) {
                        $own['city'] = $own_city->name;
                    }
                    $own_region  = $own->getRegion();
                    if ($own_region) {
                        $own['region'] = $own_region->name;
                    }
                    $own['update_at'] = Carbon::parse($own->updated_at)->format('d.m.Y H:i');
                }
            }

            
            $estate['apartment_has'] = '' . Str::of($estate->apartment_has)->replace(', ', '<br>')->replace("\n", "<br>");
            $estate['near_has'] = '' . Str::of($estate->near_has)->replace('Средняя', '<br>Средняя')->replace("\n", "<br>")->replace(",", "<br>");
            $estate['body'] = '' . Str::of($estate->body)->replace('- показать телефон -', '');
            return view('pdf.pdf',[
                'estate'=>$estate
            ]);
        }
            
       
    }
}
