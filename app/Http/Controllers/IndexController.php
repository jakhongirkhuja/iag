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
}
