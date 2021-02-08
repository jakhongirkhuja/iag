<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
       
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Iagent</title>
        <link rel="icon" type="image/ico" href="{{ public_path('img/icon.ico') }}" />
        {{-- <link href="{{ public_path('css/app.css') }}" rel="stylesheet"> --}}
        
    </head>
    <body style="font-family:'DejaVu Sans';">
        <div class="nav fx vertical_center">
            <div class="fx-1 nav__logo">
                <img src="{{ public_path('img/iagent.png') }}" width="75">
            </div>
        </div>
        <div>
            <div class="main ">
                <div class="estate container">
                    <div class="estate__mainpart fx" >
                        <div class="estate__mainpart__shortinfo__title" style="clear: both;">
                            <h4>{{ $estate->title }} </h4>
                        </div>
                        <div class="estate__mainpart__shortinfo fx-1" >
                           
                            
                            <div class="estate__mainpart__shortinfo__area__price" style="float: left; width:300px">
                                <div class="estate__mainpart__shortinfo__area__price-a" style="float: left">
                                    <p>Площадь</p>
                                    <p>{{$estate->total_area}} m <sup>2</sup></p>
                                </div>
                                <div class="estate__mainpart__shortinfo__list__items" style="float: right">
                                    <p>Комнат</p>
                                    <p>{{ $estate->num_rooms }}/{{ $estate->floor }}/{{ $estate->floor_house }}</p>
                                </div>
                                <div style="clear: both; margin:50px">

                                </div>
                                <div class="estate__mainpart__shortinfo__area__price-p" style="float: left" >
                                    <p>Цена</p>
                                   @if($estate->price!=0)<p >{{$estate->price}} {{$estate->currency}}</p>
                                   @else<p >Договорная</p>@endif
                               </div>
                               <div class="estate__mainpart__shortinfo__area__price-p" style="float: right" >
                                <p>Цена за <sup>2</sup></p>
                                @if($estate->total_area!=0)<p >{{(int)((int)$estate->price / (int)$estate->total_area)}} {{$estate->currency}}</p>
                                @else<p >0</p>@endif
                                </div>
                                <div style="clear: both; margin:50px">

                                </div>
                           </div>
                            </div>
                            
                            
                            <div style="text-align: right; display:block; clear:bloth; ">
                                <a style="font-size:0.8rem; text-decoration: underline" target="_blank" href="{{ $estate->url }}" >открыть исходник</a>
                                <div class="estate__secondary__owner fx fx-col fx-1">
                                    <div class="estate__secondary__owner__info">
                                        <div class="estate__secondary__owner__info-name" v-if="this.estate.owner">
                                            <h3>{{ $estate->owner->name }}</h3>
                                            <p>  {{ $estate->announcement }}</p>
                                        </div>
                                        <div class="estate__secondary__owner__info-number" v-if="estate.owner" >
                                            {{ $estate->owner->number }}
                                           
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div style="clear: both; margin:50px">

                            </div>
                        </div>
                        
                        
                        
                    </div>
                    
                    <div style="display:block; clear:both; padding-top: 50px;" >
                            
                        <div class="estate__mainpart__imgs__thumbnails" >
                            @if(count($estate->imgs)>0)
                            @foreach ($estate->imgs as $k=>$img)
                                @if($k<5)
                                    <img src={{ $img }} style="width:200px; margin-right:2px">
                                @endif  
                            @endforeach
                            @endif
                           
                        </div>
                    </div>
                    <div style=" page-break-after: always;"></div>
                    <div class="estate__secondary fx" style="clear: both">
                        <div class="estate__secondary__convenience fx-1">
                            <div class="estate__secondary__convenience__has fx">
                                @if($estate->apartment_has)
                                <div class="estate__secondary__convenience__app" style="float: left">
                                    <div class="estate__secondary__convenience__inside" >
                                        <h3>Есть помещение:</h3>
                                        <div >
                                            {!! $estate->apartment_has !!}
                                        </div>
                                        
                                    </div>
                                </div>
                                @endif
                                @if($estate->near_has)
                                <div class="estate__secondary__convenience__near" style="float: left" >
                                    <div class="estate__secondary__convenience__inside" >
                                        <h3>Есть рядом:</h3>
                                        <div >
                                            {!! $estate->near_has !!}
                                        </div>
                                      
                                    </div>
                                </div>
                                @endif
                            </div>
                            @if($estate->body)
                            <div class="estate__secondary__convenience__body pt-1" style="float: left">
                                <h3>Общая информация</h3>
                               
                                <div>{!! $estate->body  !!}</div>
        
                                               
                            </div>
                            @endif
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
        <footer >
            <div class="footer" style="clear: both">
                <div class="container">
                   
                    <div class="footer-body fx vertical_center ">
                        <div class="footer__each" style="float:left">
                            <p>Остались вопросы?</p>
                        </div>
                        <div class="footer__each" style="float:left">
                            <p> Звоните или Пишите</p>
                            <p class="fx vertical_center"><a href="tel:+998946121812" style="margin-right:1rem">+998 ( 94 ) 612-18-12</a> <a href="https://t.me/Bakers_Dozen"><img src="{{ public_path('img/telegram.png') }}" width="32"></a> </p>
                        </div>
                       
                    </div>
                </div>
            </div>
            
        </footer>
        
        <script>
            function callClick(){
               document.querySelector('.call_img').classList.toggle('notactive');
               document.querySelector('.call_close').classList.toggle('notactive') 
               document.querySelector('.call_first').classList.toggle('notactive') 
               document.querySelector('.call_second').classList.toggle('notactive') 
               document.querySelector('.call_third').classList.toggle('notactive')  
            }
        </script>
        <style>
            .call_close{
                font-size: 2rem;
                color: white;
            }
            .call_img.notactive, .call_close.notactive, .call_first.notactive,
            .call_second.notactive, .call_third.notactive{
                display: none;
               
            }
            .call{
                width: 60px;
                background-color: #9cbef1;
                height: 60px;
                position: fixed;
                right: 0;
                cursor: pointer;
                bottom: 12rem;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.5s ease-in-out;
            }
            .call.call_first{
                bottom: 16rem;
               
            }
            .call.call_second{
                bottom: 20rem;
                
            }
            .call.call_third{
                bottom: 24rem;
               
            }
            
            .call img.active{
                animation: shake 0.5s;

                /* When the animation is finished, start again */
                animation-iteration-count: infinite;
            }
            @keyframes shake {
                0% { transform: translate(1px, 1px) rotate(0deg); }
                10% { transform: translate(-1px, -2px) rotate(-1deg); }
                20% { transform: translate(-3px, 0px) rotate(1deg); }
                30% { transform: translate(3px, 2px) rotate(0deg); }
                40% { transform: translate(1px, -1px) rotate(1deg); }
                50% { transform: translate(-1px, 2px) rotate(-1deg); }
                60% { transform: translate(-3px, 1px) rotate(0deg); }
                70% { transform: translate(3px, 1px) rotate(-1deg); }
                80% { transform: translate(-1px, -1px) rotate(1deg); }
                90% { transform: translate(1px, 2px) rotate(0deg); }
                100% { transform: translate(1px, -2px) rotate(-1deg); }
                }
            .footer{
                padding: 3rem 0;
                background: #f1f1f1;
            }
            .footer-body{
                justify-content: space-between;
            }
            .footer h2{
                font-size: 3rem;
                    color: black;
            }
            .footer h3{
                font-size: 1.5rem
            }
            .footer a{
                font-size: 1.2rem;
            }
        </style>
        <script>
            setInterval(function(){
                document.querySelector('.call_img').classList.remove('active');
                setTimeout(function(){
                    document.querySelector('.call_img').classList.add('active');
                }, 3000); 
               
            }, 4000);
           
        </script>
        <script src="{{ public_path('js/app.js') }}"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        
    </body>
</html>
