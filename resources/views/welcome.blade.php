<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Iagent</title>
        <link rel="icon" type="image/ico" href="{{ asset('img/icon.ico') }}" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
    </head>
    <body >
        <div id="app" style="
        overflow-x: hidden;
    ">
            <app/>
           {{-- @include('include') --}}
        </div>
        <footer >
            <div class="footer">
                <div class="container">
                   
                    <div class="footer-body fx vertical_center ">
                        <div class="footer__each">
                            <h2>Остались вопросы?</h2>
                        </div>
                        <div class="footer__each">
                            <h3>Звоните или Пишите</h3>
                            <p class="fx vertical_center"><a href="tel:+998946121812" style="margin-right:1rem">+998 ( 94 ) 612-18-12</a> <a href="https://t.me/Bakers_Dozen"><img src="{{ asset('img/telegram.png') }}" width="32"></a> </p>
                        </div>
                       
                    </div>
                </div>
            </div>
            
        </footer>
        <div class="call call_third notactive">
            <a href="tel:+998946121812"><img src="{{ asset('img/phone-call.svg') }}" width="25"></a>
        </div>
        <div class="call call_second notactive">
            <a href="https://t.me/Bakers_Dozen"><img src="{{ asset('img/t_white.svg') }}" width="25"></a>
        </div>
        <div class="call call_first notactive">
            <a href="emailto:jakhongirkhuja.kholkhujaev@gmail.com"><img src="{{ asset('img/at.svg') }}" width="25"></a>
        </div>
        <div class="call" onclick="callClick()">
            <img class="call_img " src="{{ asset('img/phone-call.svg') }}" width="25">
            <div class="call_close notactive">&#10005;</div>
        </div>
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
        <script src="{{ asset('js/app.js') }}"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-7CY9YCM3HK"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-7CY9YCM3HK');
        </script>
    </body>
</html>
