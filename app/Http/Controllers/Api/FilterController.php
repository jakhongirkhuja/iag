<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estate;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function table($id=null, Request $request)
    {

        if($id==1){
            $estate = Estate::where('ad_site',$id);
        }elseif($id==2){
            
            $estate = Estate::where('ad_site',$id);
        }else{
            $estate = Estate::where('ad_site',1)->orwhere('ad_site',2); 
        }
        if($request->room == '1'){
            $estate->orderby('num_rooms','desc');
            // dd('room down');
        }
        if($request->room == '2'){
            $estate->orderby('num_rooms','asc');
        }
        if($request->price == '1'){
            $estate->orderby('price','desc');
        }
        if($request->price == '2'){
            $estate->orderby('price','asc');
        }
        $estate = $estate->paginate(25);
       
        foreach($estate as $es){
            $es['i'] =$es->owner()->first();
            $check_price= Price::where('estate_id', $es->id)->where('price', (int)$es->price)->first();
            if ($check_price) {
               $es['price'] = $check_price->price;
               $es['price_cur'] =  $check_price->currency;
            }else{
                $es['price'] = '0';
                $es['price_cur'] =  'у.е';
            }
            // $es['price_cur'] = json_decode($es->price)->currency;
            // $es['price'] = json_decode($es->price)->price;
            if($es->getHouseType()->name == 'Вторичный рынок'){
                $es['housingtype'] = 'вр';
            }elseif($es->getHouseType()->name == 'Новостройки'){
                $es['housingtype'] = 'нв';
            }
            // $es['remont'] = ' ';
            if($es->getRemont()){
                $es['remont'] = $es->getRemont()->name;
            }
           
            if($es->getCity()){
                $es['city'] = $es->getCity()->name;
            }
            if($es->getRegion()){
                $es['region'] = $es->getRegion()->name;
            }
            $es['update_time'] = Carbon::parse($es->updated_at)->locale('ru_RU')->diffForHumans();
            $es['created_time'] = Carbon::parse($es->created_at)->locale('ru_RU')->diffForHumans();
        }
        
        return response()->json([
            'status' => true,
            'estate' =>$estate,
        ]);
    }
}
