
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
	<link rel="stylesheet" href="css/responsive.css">
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



@endsection
