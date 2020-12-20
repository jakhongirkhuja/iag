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
use Carbon\Carbon;

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
        $ess = Estate::where('announcement',null)->get()->take(15000);
        // dd(count($ess));
        foreach ($ess as $key => $es) {
            $owners = $es->owner->first();
            if($owners){
                $es->announcement = $owners->announcement;
                $es->timestamps = false;
                // dd($es);
                $es->save();
                // dd($es);
               
            }
           
        }
       
        // dd(Estate::where('img','!=',"['']")->first());
        // $st1 = 'sd';
        // $st2 = 'sd';
        // dd($st1==$st2);
        // $owner = Owner::with('estates')
        // ->withCount('estates')
        // ->orderBy('estates_count', 'asc')
        // ->get()->take(5);
        // dd($owner, Owner::first()->estates->count());
        // dd(Estate::first());
        // $estate = Estate::where('currency', null)->get();
        // dd($estate);
        // foreach($estate as $es){
        //     $check_price= Price::where('estate_id', $es->id)->where('price', $es->price)->first();
        //     if($check_price){
        //         $es->currency = $check_price->currency;
        //         $es->save();
        //     }
        // }
        
		// $content = 'nomer: '.$number.',  summa: '.$price.', zakaz-id: '.$order_id;
		// $body = '{"mobile_phone":"'.$number.'", "message":"'.$content.'"}';
		// $r = $client->request('POST', 'notify.eskiz.uz/api/message/sms/send', [
		// 	'body' => $body
		// ]);
		// $response = $r->getBody()->getContents();
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
    $yesterday = date("Y-m-d", strtotime( '-1 days' ) );
    $countYesterdayOLX = Estate::where('ad_site',1)->whereDate('created_at', $yesterday )->get();
    if(count($countYesterdayOLX)>0){
        echo 'Olx:'.'('.Carbon::parse($countYesterdayOLX[0]->created_at)->format('d-m-Y').' ) '.count($countYesterdayOLX);
    }else{
        echo 'Olx: 0';
    }
    echo '<br>';
    $countYesterdayUybor = Estate::where('ad_site',2)->whereDate('created_at', $yesterday )->get();
    if(count($countYesterdayUybor)>0){
        echo 'Uybor:'.'('.Carbon::parse($countYesterdayUybor[0]->created_at)->format('d-m-Y').' ) '.count($countYesterdayUybor);
    }else{
        echo 'Uybor: 0';
    }
    
    
    // $users = DB::table('estates')
    
    //         ->join('prices', function  ($join){
    //             $join->on('estates.id', '=', 'prices.estate_id');
    //             $join->on('estates.price','=','prices.price');
    //         })
            
    //         ->where('prices.currency','сум')
            
    //         ->get()->take(5);
    // dd($users);
    
                    // $slug = '245-ulucs-panel-cilanzar-20-61m2-balkon-26';
        // dd(Carbon::now(), Price::orderby('created_at','desc')->where('estate_id',Estate::where('slug', $slug)->first()->id)->get(), 
            // Estate::where('slug', $slug)->first());
       
        // $estate = Estate::where('slug', $slug)->first();
        //  $time_change = json_decode($estate->ad_update_at, true);
        //  if(count($time_change)==1){
        //        $ok =  end($time_change);
        //     }else{
        //         $ok =end($time_change)['time'];
        //     }
             // dd($ok, $estate);
        // $estate = Estate::where('slug','prodam-dvuxurovnevuyu-kvartiru-489-v-zk-parisien-1603015869')->first();
        // dd($estate);
        // dd(Owner::where('number','+998909728881')->first()->estates()->where('ad_site','1')->get());
        return view('admin/index');
    }
}
