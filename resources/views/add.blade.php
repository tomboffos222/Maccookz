
@extends('layouts.user')

    @section('content')
<!DOCTYPE html>
<html>
<head>
	<title>Добавить</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/add.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/respons.css')}}">
</head>
</head>
<body>
	<div class="container">
		<div class="col-lg-12" id="title">
		   <h3>ДОБАВИТЬ НОВЫЙ КУРС</h3>
		   <div>
		      <p>У вас нету доступа что бы добавить курсы<br> Пройдите модерацию чтобы открыть доступ к данным</p>
		      <img src="images/error.svg" alt="">
		   </div>
		   <button onclick="window.location.href='{{route('Moderation')}}'">Получить доступ</button>
	    </div>

    </div>

    <style>
        @media (max-width: 720px) {
            #title h3{
                width: auto;
                margin-bottom: 20px;
            }
            button{
                margin-top: 50px;
                margin-left: 10%;

            }
            #title div{
                flex-direction: column;
            }
            #title div p{
                width: auto;
                margin-bottom: 150px;
                margin-top: 20px;
                text-align: center;
            }
            #title div img{
                margin-left: 0px;
            }


        }
    </style>

@endsection
