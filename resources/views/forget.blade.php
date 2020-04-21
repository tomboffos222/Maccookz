<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Войти</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/vxod.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Playball&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pragati+Narrow|Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
</head>
<body>
<div class="container backgrounder">
    <div class="col-lg-12 d-phone text-center pt-5">
        <img src="{{asset('images/Maccoo.svg')}}" alt="">
    </div>
    <div class="col-lg-6 col-12" id="fluid">
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
        <form action="{{route('ForgetPassword')}}" method="get">

            <div class="regis">

                <h1 class="desktop">Maccoo</h1>
                <h1 class="d-phone">Введите электронный адрес</h1>
                <input type="text" name="email" placeholder="эл. адрес">

                <button>Отправить</button>

            </div>
        </form>
        <div class="stakk">
            <p>У вас еще нет аккаунта? <a href="{{route('Welcome')}}">Зарегистрироваться</a> </p>
        </div>
        <div class="links">
            <a href="#">О НАС</a>
            <a href="#">ПОМОЩЬ</a>
            <a href="#">ВАКАНСИИ</a>
            <a href="#">КОНФИДЕНЦИАЛЬНОСТЬ</a>
            <a href="#">УСЛОВИЯ</a>
            <a href="#">ЯЗЫК</a>
        </div>
    </div>
    <div class="col-lg-6" id="fluid2">
        <div class="obolochka">
            <div class="nzt"></div>
        </div>
    </div>
</div>

</body>
</html>
