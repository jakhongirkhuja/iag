<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estate;
use App\Imports\EstateImport;
use App\Jobs\CheckUrl;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Models\Owner;
use App\Models\Remont;
use App\Models\Region;
use App\Models\City;
use App\Models\ParsingPage;
use App\Models\Price;
use Carbon\Carbon;

class IndexController extends Controller
{
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
        
       
        $owner = Owner::orderby('id', 'desc')->paginate(25);
        $estate= Estate::orderby('id', 'desc')->paginate(25);
       
        
        return view('welcome', [
            'owner'=>$owner,
            'estate'=>$estate,
            'counto' => count(Owner::all()),
            'count'=>count(Estate::all()),
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
    public function admin()
    {
        // $estates = Estate::all();
        // foreach ($estates as $key => $estate) {
        //     $items =json_decode($estate->price, true); 
        //     if(count($items)>3){
        //         $price_last =  last($items)['price'];
        //         // dd($items);
        //         foreach ($items as $keys => $item) {
                    
                   
        //             if(is_array($item)){
        //                 $price = Price::where('estate_id', $estate->id)->where('price',$item['price'])->first();
        //                 if(!$price){
        //                     $new_price = new Price();
        //                     $new_price->estate_id = $estate->id;
        //                     $new_price->price = $item['price'];
        //                     $new_price->currency = $item['currency'];
        //                     $new_price->updated_at = Str::of($item['time'])->replace('"','');
        //                     // dd($item['time']);
        //                     $new_price->save();
        //                 }
        //                 // $arrs[]=$item['price'];
        //                 // $arr_cur[] = $item['currency'];  
        //             //    dd($item['price']);
        //             }else{
                       
        //                 // if(is_string($item)){
        //                 //     $arrs[] =$item; 
        //                 // }else{
        //                 //     $arrs[] =$item; 
                            
        //                 // }
        //                 // dd($arrs);
                        
        //             }
        //         }
        //         // dd($arrs, $arr_cur);
        //         // $es['price'] = last($items)['price'];
        //         // $es['price_cur'] = last($items)['currency'];
        //     }else{
        //         $price_last =$items['price'];
        //         // dd($items['price']);
        //         // $es['price_cur'] = $items['currency'];
        //         // $es['price'] = $items['price'];
        //         $price = Price::where('estate_id', $estate->id)->where('price',$items['price'])->first();
        //         if(!$price){
        //             $new_price = new Price();
        //             $new_price->estate_id = $estate->id;
        //             $new_price->price = $items['price'];
        //             $new_price->currency = $items['currency'];
                    
        //             $new_price->updated_at = Str::of($items['time'])->replace('"','');
                   
        //             $new_price->save();
        //         }
        //     }
        //     $estate->price = $price_last;
        //     $estate->save();
        // }
        // dd(count(Estate::all()->take(15)));
    //      User::query()
    // ->addSelect(['last_login_at' => Login::select('created_at')
    //     ->whereColumn('user_id', 'users.id')
    //     ->latest()
    //     ->take(1)
    // ])Price::where('estate_id', $estate_id)->where('price', (int)$price_notchanged)->first();

      
        $slug = '245-ulucs-panel-cilanzar-20-61m2-balkon-26';
        dd(Carbon::now(), Price::orderby('created_at','desc')->where('estate_id',Estate::where('slug', $slug)->first()->id)->get(), 
            Estate::where('slug', $slug)->first());
       
        $estate = Estate::where('slug', $slug)->first();
         $time_change = json_decode($estate->ad_update_at, true);
         if(count($time_change)==1){
               $ok =  end($time_change);
            }else{
                $ok =end($time_change)['time'];
            }
             // dd($ok, $estate);
        // $estate = Estate::where('slug','prodam-dvuxurovnevuyu-kvartiru-489-v-zk-parisien-1603015869')->first();
        // dd($estate);
        // dd(Owner::where('number','+998909728881')->first()->estates()->where('ad_site','1')->get());
        return view('admin/index');
    }
}
