@extends('layouts.user')
    @section('content')
<!DOCTYPE html>
<html>
<head>
	<title>Лайк</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{asset('css/luis.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset('css/respons.css')}}">
</head>
<body>
	<div class="container">
		<div class="col-lg-12" id="title">
			<h1>НА ЭТОЙ НЕДЕЛЕ</h1>
		</div>
        @foreach($friendships as $friendship)
		<div class="col-lg-12" id="suck">
			<div class="face">
                @if($friendship['avatar'] == null)
                    <img src="{{asset('images/image_avatar.svg')}}" alt="" class="face">
                @else
                    <img src="{!! $friendship->avatar !!}" alt="" class="profile-avatar face">
                @endif
			</div>
			<div class="text">
				<h6>{{$friendship->name}}</h6>
				<p>Заявка на дружбу <span>({{$friendship->created_at}})</span></p>
			</div>
			<div class="kenopka">
				<button onclick="window.location.href='{{route('AccountView',$friendship['id'])}}'">Посмотреть</button>
			</div>
		</div>
        @endforeach
        @foreach($purchases as $purchase)
            <div class="col-lg-12" id="suck">
                <div class="face">
                    @if($purchase['avatar'] == null)
                        <img src="{{asset('images/image_avatar.svg')}}" alt="" class="face">
                    @else
                        <img src="{!! $purchase->avatar !!}" alt="" class="profile-avatar face">
                    @endif
                </div>
                <div class="text">
                    <h6>{{$purchase->name}}</h6>
                    <p>Покупка курса {{$purchase->title}} за {{$purchase->price}}  <span>({{$purchase->created_at}})</span> </p>
                </div>
                <div class="kenopka">
                    <button onclick="window.location.href='{{route('AccountView',$purchase['id'])}}'">Посмотреть</button>
                </div>
            </div>
        @endforeach

    </div>
    <style>
        .text h6{
            width: auto;
        }
    </style>
@endsection
</body>
</html>
