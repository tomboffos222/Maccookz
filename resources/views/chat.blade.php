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
	<style>
		#canvas-chat-list {width:60%; margin-left: 20%; overflow:hidden;}
		#canvas-chat-nav {overflow:hidden; width: 100%;}
		#canvas-chat-nav > li{overflow:hidden; width: 33.3%; float:left; background-color: silver; cursor:pointer;}
		#canvas-chat-nav > li:hover {background-color: gold;}
	</style>
</head>

<body>
    <div id="canvas-chat-list">
    	<div id="canvas-chat-nav">
			<li class="nav-buttons" navName="chats">Все сообщения</li>
			<li class="nav-buttons" navName="conferences">Конференции</li>
    		<li class="nav-buttons" navName="friends">Мои друзья</li>
    	</div>

		<div id="dynamic-canvas-chat">
			<div id="chats" style="display:none">
				@if(count($chatList) > 0)
				<ul class="list-group">
					@foreach($chatList as $chat)
					<a href="/chat/{{ $chat->chat_id }}"><li class="list-group-item" id="chat_{{ $chat->chat_id }}" rid="{{ $chat->chat_id }}" uid="{{ $chat->user_id }}">{{ $chat->name }}</li></a>
					@endforeach
				</ul>
				@else
				<center>У вас пока нет сообщении</center>
				<center>Для начала общения выберите собеседника из списка ваших друзей</center>
				@endif
			</div>

			<div id="conferences" style="display:none">
				No
			</div>

			<div id="friends" >
				@if(count($friendList) > 0)
				<ul class="list-group">
					@foreach($friendList as $friend)
					<li class="list-group-item" id="friend_{{ $friend->user_id }}" bid="{{ $friend->bind_id }}" uid="{{ $friend->user_id }}">{{ $friend->name }} <span><a></a></span></li>
					@endforeach
				</ul>
				@else
				<center>У вас пока нет друзей</center>
				<center>Отправьте заявку на дружбу</center>
				@endif
			</div>
		</div>
    </div>

	<div id="userId" style="display:none">{{ $user['id'] }}</div>

<script src="/js/owl.carousel.min.js"></script>
<script src="/js/jquery.js"></script>
<script src="/js/sweetalert.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var userId = $('#userId').text();
	var dynamicCanvasList = ['chats', 'conferences', 'friends'];
	var activeCanvas = 'chats';

	$('.nav-buttons').click(function() {
		$('#'+activeCanvas).fadeOut('fast');
		activeCanvas = $(this).attr('navName');
		$('#'+activeCanvas).fadeIn('fast');
	});
});
</script>
