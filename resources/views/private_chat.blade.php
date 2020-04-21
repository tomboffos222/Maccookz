@extends('layouts.user')

@section('content')
<!DOCTYPE html>
<html>
<head>
	<title>Онлайн трансляция</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{asset('css/profile.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playball&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
	<link rel="stylesheet" href="{{asset("css/respons.css")}}">
</head>

<body>
    <div class="container">
		<h3 style="color:green">Вы пишите: {{ $chatData->name }}</h3>
    	<div id="allMess"></div>
		<br>
		<input type="text" name="mess" placeholder="Введите сообщение">
		<br>
		<input type="button" name="sendMess" value="Отправить">
    </div>

	<div id="userId" room="{{ $chatId }}" recId="{{ $chatData->id }}" style="display:none">{{ $user['id'] }}</div>
</body>

<script src="/js/owl.carousel.min.js"></script>
<script src="/js/jquery.js"></script>
<script src="/js/socket.io.js"></script>
<script src="/js/sweetalert.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var socket = io('https://maccoo.kz:4000');
	var userId = $('#userId').text();
	var room = $('#userId').attr('room');
	var allMess = $('#allMess');
	socket.emit('joinChannel', room);

	$('input[name="sendMess"]').click(function() {
		if($('input[name="mess"]').val() != '') {
			let data = {
				room: room,
				recId: $('#userId').attr('recId'),
				sendId: userId,
				msg: $('input[name="mess"]').val(),
			};
			$('input[name="mess"]').val('');
			allMess.append('<div style="color:blue">'+data.msg+'</div>');
			let sendData = JSON.stringify(data);
			socket.emit('privateChat', sendData);
		}
	});

	socket.on('privateChat', (data) => {
		let obj = JSON.parse(data);
		allMess.append('<div style="color:red">'+obj.msg+'</div>');
	});

});
</script>
<?php var_dump($chatData) ?>
@endsection
