<?php

namespace App\Jobs;

use App\Models\Estate;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
class CheckUrl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $url;
    protected $site_id;
    protected $page_id;
    protected $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $urls = Estate::where('status',1)->where(function ($query){
            $query->where('checked_at', null)
            ->orwhere('checked_at','<', Carbon::today()->subWeek());
        })->orderby('updated_at','asc')->take(10)->get();
        $statuserror = [];
        $statusgood = [];
        if(count($urls)>0){
            
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
            var_dump('start to update');
            $bad = DB::table('estates')->whereIn('id', $statuserror)
                ->update(['status' => 2, 'checked_at'=>Carbon::now()],  ['timestamps' => false]);
            $good =  DB::table('estates')->whereIn('id', $statusgood)
                ->update(['checked_at'=>Carbon::now()],  ['timestamps' => false]);
            var_dump('updated finished');
        }
         // $url->timestamps = false;
                        // $url->checked_at = Carbon::now();
                        // $url->status = 2;
                        // $url->save();
        
    }
}

