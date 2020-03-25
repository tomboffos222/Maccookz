
@extends('layouts.user')


    @section('content')
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{asset('css/addcourse.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset('css/respons.css')}}">
</head>
<body>
	<div class="container">
		<div class="col-lg-12 top">
			<h5>ДОБАВИТЬ НОВЫЙ КУРС</h5>
			<div class="dfd">
				<p>Ваш запрос обрабатывается. Наш модератор проверить<br> данные и откроеть доступ к добавление курсов</p>
				<img src="{{asset('images/vertu.svg')}}" alt="">
			</div>
			<span>Обычно это займет 2-3 часа</span>
		</div>
		@endsection

</body>
</html>
