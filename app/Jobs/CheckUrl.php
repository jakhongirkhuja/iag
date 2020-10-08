<?php

namespace App\Jobs;

use App\Models\Estate;
use Carbon\Carbon;

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
        $urls = Estate::where('status', 1)->get();
        if(count($urls)>0){
            foreach ($urls as $url) {
                if($url->ad_site==1){
                    $response = Http::get($url->url);
                    var_dump($response->status());
                    if($response->status()==200){
                        $str = $response->body();
                        $contains = Str::contains($str, 'Простите, но данное объявление больше не доступно');
                        if($contains){
                            $estate = Estate::find($url->id);
                            $estate->status = 2;
                            $estate->save();
                        }
                        var_dump($contains, $url->url);
                        $contains = Str::contains($str, 'Нам жаль, но мы не нашли эту страницу');
                        if($contains){
                            $estate = Estate::find($url->id);
                            $estate->status = 2;
                            $estate->save();
                        }
                        var_dump($contains);
                        
                        $contains = Str::contains($str, 'Объявление не активно');
                        if($contains){
                            $estate = Estate::find($url->id);
                            $estate->status = 2;
                            $estate->save();
                        }
                        var_dump($contains);
                        
                    }
                    if($response->status()==404){
                        $estate = Estate::find($url->id);
                        $estate->status = 2;
                        $estate->save();
                    }
                }else{
                    $response = Http::get('https://uybor.uz/api/v2/listing/view/'.$url->ad_id);
                    if($response->status()==404){
                        $estate = Estate::find($this->id);
                        $estate->status = 2;
                        $estate->save();
                    }
                }
                sleep(5);
            }
        }
    }
}

