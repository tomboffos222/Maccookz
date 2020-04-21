<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maccoo</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">

    <link href="https://fonts.googleapis.com/css?family=Playball&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pragati+Narrow|Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
</head>
<body style="background-image: url({{asset('images/cab.png')}})">
<div class="obolochka">
    <div class="container new_container" >
        <div class="col-lg-12 desktop text-center pt-5">
            <img src="images/Maccoo.svg" alt="">
        </div>
        <div class="col-lg-12 d-phone text-center pb-3 pt-3">
            <img src="images/Maccoo.svg" alt="">
        </div>
        <div class="content col-lg-12">
            <div class="row">
                <div class="col-lg-6" id="opo">
                    <form action="{{route('Register')}}" method="get">

                        <div class="phone">


                            <h1 class="desktop">Maccoo</h1>
                            <h1 class="d-phone text-center">Регистрация</h1>
                            <p class="regis">Зарегистрируйтесь, чтобы <br> смотреть видео ваших друзей.</p>
                            <input type="tel" name="phone" placeholder="Моб. телефон">
                            <input type="text" name="email" placeholder="Эл. адрес">
                            <input type="text" name="name" placeholder="Имя и фамилия">
                            <input type="text" name="login"  placeholder="Имя пользователя">
                            <input type="password" name="password" placeholder="Пароль">
                            <button>Регистрация</button>
                            <p class="tutu">Регистрируясь, вы принимаете <br> наши Условия, Политику <br> использования данных</p>
                            <p class="akk">Есть аккаунт?<a href="{{route('LoginPage')}}">Вход</a></p>

                        </div>
                    </form>
                </div>
                <div class="col-lg-6" id="pop">
                    <div class="study">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <h1>УЧИСЬ И РАЗВЛЕКАЙСЯ</h1>
                        <p>Создайте онлайн и офлайн курсы <br> Или просто развлекайтесь просмотром <br> полезных видео</p>
                        <button>Узнать подробнее</button>
                    </div>
                    <div class="links">
                        <a href="#">О НАС</a>
                        <a href="#">ПОМОЩЬ</a>
                        <a href="#">ВАКАНСИИ</a>
                        <a href="#">КОНФИДИЦИАЛЬНОСТЬ</a>
                        <a href="#">УСЛОВИЯ</a>
                        <a href="">ЯЗЫК</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

    .content{

    }
    .content .row #opo .phone{

    }
</style>
</body>
</html>
