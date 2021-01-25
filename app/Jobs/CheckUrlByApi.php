<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Models\Estate;
class CheckUrlByApi implements ShouldQueue
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
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response_get = Http::get('http://iagent.uz/api/getposttocheck');
        if($response_get->status()==200){
            if(count($response_get['estate'])>0){
                foreach ($response_get['estate'] as $key => $estate) {
                    if($estate['ad_site']==1){
                        $response = Http::get($estate['url']);
                        
                        var_dump($response->status());
                        if($response->status()==200){
                            $str = $response->body();
                            $contains = Str::contains($str, 'Простите, но данное объявление больше не доступно');
                            if($contains){
                                $sendId = Http::withHeaders([
                                    'token' => '2HixxqWaeJ6hJKGw3XxZcCaHSXo0XEHIZhdIPOb6zNMPpna84uRN4IRYzDid28Ck2XegJkInTsXs7dCNXE2HQlgD1ijuviUy9NCMbbC2sX9re2EIF5GeMD3VhnGcAn4fhrYrdiiTF6a0xOzko7Ef2m',
                                ])->post('http://iagent.uz/api/setStatusEstate', [
                                    'id' => $estate['id'],
                                ]);
                                if($sendId->status()==200){
                                    var_dump('Простите, но данное объявление');
                                }else{
                                    var_dump('Простите, ERROR но данное объявление');
                                }
                                
                            }
                           
                            $contains = Str::contains($str, 'Нам жаль, но мы не нашли эту страницу');
                            if($contains){
                               
                                $sendId = Http::withHeaders([
                                    'token' => '2HixxqWaeJ6hJKGw3XxZcCaHSXo0XEHIZhdIPOb6zNMPpna84uRN4IRYzDid28Ck2XegJkInTsXs7dCNXE2HQlgD1ijuviUy9NCMbbC2sX9re2EIF5GeMD3VhnGcAn4fhrYrdiiTF6a0xOzko7Ef2m',
                                ])->post('http://iagent.uz/api/setStatusEstate', [
                                    'id' => $estate['id'],
                                ]);
                                if($sendId->status()==200){
                                    var_dump('Нам жаль, но мы не нашли');
                                }else{
                                    var_dump('Нам жаль, ERROR но мы не нашли');
                                }
                                
                            }
                           
                            
                            $contains = Str::contains($str, 'Объявление не активно');
                            if($contains){
                               
                                $sendId = Http::withHeaders([
                                    'token' => '2HixxqWaeJ6hJKGw3XxZcCaHSXo0XEHIZhdIPOb6zNMPpna84uRN4IRYzDid28Ck2XegJkInTsXs7dCNXE2HQlgD1ijuviUy9NCMbbC2sX9re2EIF5GeMD3VhnGcAn4fhrYrdiiTF6a0xOzko7Ef2m',
                                ])->post('http://iagent.uz/api/setStatusEstate', [
                                    'id' => $estate['id'],
                                ]);
                                if($sendId->status()==200){
                                    var_dump('Объявление не активно');
                                }else{
                                    var_dump('Объявление ERROR не активно');
                                }
                                
                            }
                           
                            
                        }
                        if($response->status()==404){
                            
                            $sendId = Http::withHeaders([
                                'token' => '2HixxqWaeJ6hJKGw3XxZcCaHSXo0XEHIZhdIPOb6zNMPpna84uRN4IRYzDid28Ck2XegJkInTsXs7dCNXE2HQlgD1ijuviUy9NCMbbC2sX9re2EIF5GeMD3VhnGcAn4fhrYrdiiTF6a0xOzko7Ef2m',
                            ])->post('http://iagent.uz/api/setStatusEstate', [
                                'id' => $estate['id'],
                            ]);
                            if($sendId->status()==200){
                                var_dump('Объявление 404');
                            }else{
                                var_dump('Объявление ERROR 404');
                            }
                        }
                        var_dump($estate['url']);
                    }else{
                        $response = Http::get('https://uybor.uz/api/v2/listing/view/'.$estate['ad_id']);
                        if($response->status()==404){
                          
                            $sendId = Http::withHeaders([
                                'token' => '2HixxqWaeJ6hJKGw3XxZcCaHSXo0XEHIZhdIPOb6zNMPpna84uRN4IRYzDid28Ck2XegJkInTsXs7dCNXE2HQlgD1ijuviUy9NCMbbC2sX9re2EIF5GeMD3VhnGcAn4fhrYrdiiTF6a0xOzko7Ef2m',
                            ])->post('http://iagent.uz/api/setStatusEstate', [
                                'id' => $estate['id'],
                            ]);
                            if($sendId->status()==200){
                                var_dump('Uybor 404');
                            }else{
                                var_dump('Uybor ERROR 404 ');
                            }
                        }
                    }
                    sleep(3);
                }
            }
           
        }
    }
}
