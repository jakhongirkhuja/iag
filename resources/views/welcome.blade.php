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
                            <p class="fx vertical_center"><a href="tel:+998946121812" style="margin-right:1rem">+998 ( 94 ) 612-18-12</a> <a href="https://t.me/Bakers_Dozen"><img src="img/telegram.png" width="32"></a> </p>
                        </div>
                       
                    </div>
                </div>
            </div>
            
        </footer>
        <style lang="scss" scoped>
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
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
