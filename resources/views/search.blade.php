@extends('layouts.user')


    @section('content')

<!DOCTYPE html>
<html>
<head>
	<title>Поиск</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{asset('css/poisk.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playball&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset('css/respons.css')}}">
</head>
<body>
	<div class="container">
		<div class="col-lg-12 mb-4 pt-4" id="title">
			<img src="{{asset('images/MaccooBlack.svg')}}" alt="">
		</div>
		<div class="col-lg-12" id="search">
            <form action="{{route('Search')}}" method="get">
			    <input type="text" placeholder="Поиск пользователя:" name="search" >
            </form>
		</div>
		<div class="row">
            @foreach($accounts as $account)
            <div class="col-lg-3 col-6">
                @if($account['avatar'] == null)
                    <img src="{{asset('images/image_avatar.svg')}}" alt="" class="search-avatar">
                @else
                    <img src="{!! $account->avatar !!}" alt="" class="profile-avatar search-avatar face">
                @endif
                <p>{{mb_strimwidth($account->login,0,10)}}</p>
                <span>{{mb_strimwidth($account->name,0,12)}}</span>
                <button onclick="window.location.href='{{route('AccountView',$account['id'])}}'">Посмотреть</button>
            </div>
            @endforeach





        </div>

        <style>
            .search-avatar{
                width: 75px;
                height: 75px;
            }
            @media (max-width: 720px) {
                .col-lg-12 input{
                    width: 300px    ;
                }


            }
        </style>
    @endsection


</body>
</html>
