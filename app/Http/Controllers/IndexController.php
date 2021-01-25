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
        $urls = Estate::where('status',1)->where(function ($query){
            $query->where('checked_at', null)
            ->orwhere('checked_at','<', Carbon::today()->subWeek());
        })->orderby('updated_at','asc')->take(10)->get();;
        if(count($urls)>0){
            $statuserror = [];
            $statusgood = [];
            foreach ($urls as $url) {
                $intered = false;
                echo $url->url;
                var_dump($url->url);
                if($url->ad_site==1){
                    $response = Http::get($url->url);
                    
                    var_dump($response->status());
                    if($response->status()==200){
                        $str = $response->body();
                        $contains = Str::contains($str, 'Простите, но данное объявление больше не доступно');
                        if($contains){
                            $statuserror[]= $url->id;
                            // $url->status = 2;
                            // $url->timestamps = false;
                            // $url->checked_at = Carbon::now();
                            // $url->save();
                            $intered = true;
                            var_dump('Простите, но данное объявление');
                        }
                       
                        $contains = Str::contains($str, 'Нам жаль, но мы не нашли эту страницу');
                        if($contains){
                           
                            // $url->status = 2;
                            $statuserror[]= $url->id;
                            // $url->timestamps = false;
                            // $url->checked_at = Carbon::now();
                            // $url->save();
                            $intered = true;
                            var_dump('Нам жаль, но мы не нашли');
                        }
                       
                        
                        $contains = Str::contains($str, 'Объявление не активно');
                        if($contains){
                           
                            // $url->status = 2;
                            // $url->timestamps = false;
                            // $url->checked_at = Carbon::now();
                            // $url->save();
                            $statuserror[]= $url->id;
                            $intered = true;
                            var_dump('Объявление не активно');
                        }
                       
                        
                    }
                    if($response->status()==404){
                        
                        // $url->status = 2;
                        // $url->timestamps = false;
                        // $url->checked_at = Carbon::now();
                        // $url->save();
                        $statuserror[]= $url->id;
                        $intered = true;
                        var_dump('here it is ');
                    }
                    
                    
                }else{
                    $response = Http::get('https://uybor.uz/api/v2/listing/view/'.$url->ad_id);
                    if($response->status()==404){
                        // $url->timestamps = false;
                        // $url->checked_at = Carbon::now();
                        // $url->status = 2;
                        // $url->save();
                        $statuserror[]= $url->id;
                        $intered = true;
                        var_dump('uybor it is ');
                    }
                }
                if(!$intered){
                    // $url->timestamps = false;
                    // $url->checked_at = Carbon::now();
                    // $url->save();
                    $statusgood[] = $url->id;
                    var_dump('just changed checked_at');
                }
                sleep(2);
            }
        }
         // $url->timestamps = false;
                        // $url->checked_at = Carbon::now();
                        // $url->status = 2;
                        // $url->save();
            $bad = DB::table('estates')->whereIn('id', $statuserror)
              ->update(['status' => 2, 'checked_at'=>Carbon::now()],  ['timestamps' => false]);
              $good =  DB::table('estates')->whereIn('id', $statusgood)
              ->update(['checked_at'=>Carbon::now()],  ['timestamps' => false]);
        dd($urls, $statuserror, $statusgood,$bad, $good);
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
    
    
     return view('admin/index');
    }
}
