<!doctype html>
<html lang="ru-Ru">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Зарегистрироваться - Iagent </title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 16px;
            font-family: 'Open Sans',Arial,sans-serif;
        }
        a{
            color:rgba(40, 136, 229, 0.8);
        }
        .main_section{
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .main_section_body{
            color: #676e7b;
            width: 320px;
        }
        .socials{
            display: flex;
            justify-content: space-between;
            text-align: center;
        }
        .socials img{
            width: 35px;
            transition: all 0.2s ease-in-out;
        }
        .socials img:hover{
            transform: scale(1.1);
        }
        .title{
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        .form{
            margin-top: 1rem;
        }
        .form input{
            margin-bottom: 1rem;
            outline: none;
        }
        .form-control{
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 2rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .inner_title{
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        .btn-primary{
            margin: 1rem 1rem;
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.5rem 3rem;
            font-size: 1rem;
            border-radius: 2rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            color: #fff;
            background-color: rgba(40, 136, 229, 0.8);
            border-color: rgba(40, 136, 229, 0.8);
            outline: none;
        }
        .btn-primary:hover{
            background-color: rgba(40, 136, 229, 1);
            border-color: rgba(40, 136, 229, 1);
            box-shadow: 0px 0px 15px #0000006e;
        }
        .under_title{
            font-size: 0.8rem;
        }
        .under_title a{
            font-size: 0.8rem;
        }
        .alert{
            padding-bottom: 1rem;
        }
        .alert ul{
            list-style: none;
            text-align: left;
            padding-left: 1rem;
        }
    </style>
  </head>
  <body>
    <div style="position:fixed; top:1rem; left:1rem"><a style="color:initial" href="http://localhost:8500/">Iagent</a></div>
    <div class="main_section">
        <div class="main_section_body">
            <div class="title">Регистрация</div>
            <div class="under_title">Уже есть аккаунт ? <a href="{{ route('login') }}">Войти.</a></div>
            <div class="form">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>- {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('auth_register') }}" method="post">
                    @csrf
                    <div>
                        <input type="name" name="name" class="form-control" required placeholder="Имя">
                    </div>
                    <div>
                        <input type="email" name="email" class="form-control" required placeholder="Ваш email">
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" required placeholder="Ваш пароль">
                    </div>
                    <div class="inner_title">
                        Войти через
                    </div>
                    <div class="socials">
                        <a href="{{ route('redirectauth',['name'=>'telegram']) }}" title="Telegram"><img src="{{ asset('img/telegram.svg') }}"></a>
                        <a href="{{ route('redirectauth',['name'=>'google']) }}" title="Google"><img src="{{ asset('img/google.svg') }}"></a>
                        <a href="{{ route('redirectauth',['name'=>'facebook']) }}" title="Facebook"><img src="{{ asset('img/facebook.svg') }}"></a>
                        <a href="{{ route('redirectauth',['name'=>'github']) }}" title="Github"><img src="{{ asset('img/github.svg') }}"></a>
                    </div>
                    <div class="submit_btn">
                        <button type="submit" class="btn-primary" >Войти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

  </body>
</html>