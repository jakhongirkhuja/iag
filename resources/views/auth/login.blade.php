<!doctype html>
<html lang="ru-Ru">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход в Аккаунт Iagent </title>
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
            <div class="title">Вход в сервис</div>
            <div class="under_title">Не зарегистрированы ? <a href="{{ route('register') }}">Зарегистрироваться.</a></div>
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
                <form action="{{ route('auth_login') }}" method="post">
                    @csrf
                    <div>
                        <input type="email" name="email" class="form-control"  required placeholder="Ваш email">
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" required  placeholder="Ваш пароль">
                    </div>
                    <div class="inner_title">
                        Войти через
                    </div>
                    <div class="socials">
                        <a id="myBtn" title="Telegram"><img src="{{ asset('img/telegram.svg') }}"></a>
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
    <style>

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  margin: auto;
  padding: 0;
  max-width: 350px;
  
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
    margin-top: -25px;
   
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {    text-align: center;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}
    </style>

<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
     
        <span class="close">&times;</span>
       
      
      <div class="modal-body">
        <script async src="https://telegram.org/js/telegram-widget.js" data-telegram-login="mydkabot" data-size="large" data-userpic="false" data-auth-url="http://localhost:8500/auth/telegram/callback" data-request-access="write"></script>
      </div>
      
    </div>
  
  </div>

  <script>
    // Get the modal
    var modal = document.getElementById("myModal");
    
    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");
    
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    
    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }
    
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
    </script>
    
  </body>
</html>