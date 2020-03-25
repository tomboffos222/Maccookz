@extends('layouts.user')



    @section('content')


<!DOCTYPE html>
<html>
<head>
	<title>Редактировать профиль</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{asset('css/editprofile.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playball&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/respons.css')}}">
</head>

<body class="editer">

	<div class="container">
        <form action="{{route('EditAccount')}}" method="post" enctype="multipart/form-data">
		<div class="col-lg-12" id="face">
            @if($user['avatar'] == null)
			<img src="{{asset('images/image_avatar.svg')}}" alt="">
            @else
                <img src="{!! $user->avatar !!}" alt="" class="profile-avatar">
            @endif
			<label class="label">
      <span class="title">Сменить фото</span>
      <input type="file" class="kot" name="avatar">
    </label>
		</div>

            {{csrf_field()}}
            <div class="row">
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <div class="col-lg-5 col-5">
                    <p>Имя и фамилия</p>
                </div>
                <div class="col-lg-7 col-7">
                    <textarea name="name">{{$user->name}}</textarea>
                </div>
                <div class="col-lg-5 col-5">
                    <p>Имя пользователя</p>
                </div>
                <div class="col-lg-7 col-7">
                    <textarea name="login">{{$user->login}}</textarea>
                </div>
                <div class="col-lg-5 col-5">
                    <p>Instagram</p>
                </div>
                <div class="col-lg-7 col-7">
                    <textarea name="instagram">{{$user->instagram}}</textarea>
                </div>
                <div class="col-lg-5 col-5">
                    <p>О себе</p>
                </div>
                <div class="col-lg-7 col-7">
                    <textarea maxlength="125" class="thf" name="about">{{$user->about}}</textarea>
                </div>
                <div class="col-lg-5 col-5">
                    <p>Эл.адрес</p>
                </div>
                <div class="col-lg-7 col-7">
                    <textarea name="email">{{$user->email}}</textarea>
                </div>
                <div class="col-lg-5 col-5">
                    <p>Телефон</p>
                </div>
                <div class="col-lg-7 col-7">
                    <textarea name="phone">{{$user->phone}}</textarea>
                </div>
                <div class="col-lg-5 col-5">
                    <p>Пол</p>
                </div>
                <div class="col-lg-7 col-7">
                    <select name="gender" class="form-control" id="">
                        <option value="null"></option>
                        <option value="male">Мужской</option>
                        <option value="female">Женский</option>
                    </select>
                </div>
                <div class="col-lg-5 col-5">
                    <p>Юр.информация</p>
                </div>
                <div class="col-lg-7 col-7">
                    <a href="">Изменить</a>
                </div>
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
</form>
		@endsection

</body>
</html>
