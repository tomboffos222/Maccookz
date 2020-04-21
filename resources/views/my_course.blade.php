@extends('layouts.user')
    @section('content')
<!DOCTYPE html>
<html>
<head>
	<title>Мои курсы</title>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{asset('css/section.css')}}">

	<link rel="stylesheet" type="text/css" href="{{asset('css/mycourse.css')}}">

	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playball&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset("css/owl.carousel.min.css")}}">
	<link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/respons.css')}}">
</head>
<body>
	<div class="container container_course" style="padding-bottom: 20px !important;">
		<div class="profile">
			<div class="col-lg-4">
				<div class="d-flex " style="flex-flow: column;align-items: center;">
                    @if($user['avatar'] == null)
                        <img src="{{asset('images/image_avatar.svg')}}" alt="" class="face">
                    @else
                        <img src="{!! $user->avatar !!}" alt="" class="profile-avatar search-avatar face">
                    @endif
                        <a href="{{route('Streamer',$course->id)}}" class="play_button_v2" >
                            <img src="{{asset('images/play.png')}}"  alt="">
                        </a>
                    <div class="text-center ml-auto">
                        <h2 class="mt-2">{{$user->name}}</h2>
                        <h5 class="text-dark">
                            {{$user->login}}
                        </h5>
                        <button class="btn btn-primary" id="copyButton" onclick="Copy('copier');">Скопировать ссылку</button>
                    </div>
                </div>
			</div>
			<div class="col-lg-8" id="i8">
				<div class="info">
					<h1>
                        {{$course->title}}
                        <a class="more" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons medium " >drag_indicator</i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#" data-target="#course" data-toggle="modal">
                                <i class="material-icons small ">settings</i>
                                <span>Изменить</span>
                            </a>
                            <a class="dropdown-item" href="" data-target="#delete" data-toggle="modal">
                                <i class="material-icons small ">close</i>
                                <span>Удалить</span>
                            </a>

                        </div>
                    </h1>

                    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Вы точно хотите удалить курс?</h5>



                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn " data-dismiss="modal">Отмена</button>
                                    <button type="button" class="btn btn-primary"  onclick="window.location.href='{{route('DeleteCourse',$course->id)}}'">Удалить</button>
                                </div>
                            </div>
                        </div>
                    </div>

					<span>{!! $course->description !!}</span>


                    <div class="flex   course_cards mt-3 mb-5">
                        <div class="card purchases" >
                            <div class="circle_blue">
                                <img src="{{asset('images/people.svg')}}" alt="">


                            </div>
                            <h4 class="text-white mt-2">
                                Ваши пользователи

                            </h4>
                            <h3  class="text-white mt-1 text-bold">
                                {{$course->purchases}}
                            </h3>
                            <h6 class="text-black"><a href="" data-toggle="modal" data-target="#users" class="">Посмотреть</a></h6>

                        </div>

                        <div class="card purchases" >
                            <div class="circle_blue">
                                <img src="{{asset('images/money.svg')}}" alt="">


                            </div>
                            <h4 class="text-white mt-2">
                                Вы заработали
                            </h4>
                            <h3  class="text-white mt-1 text-bold">
                                {{$course->bill}}
                            </h3>
                            <h6 class="text-black"><a href="" data-toggle="modal" data-target="#userPurchases" class="">Посмотреть</a></h6>

                        </div>
                        <div class="card purchases" >
                            <div class="circle_blue">
                                <img src="{{asset('images/dollar.svg')}}" alt="">


                            </div>
                            <h4 class="text-white mt-2">

                                Вы вывели
                            </h4>
                            <h3  class="text-white mt-1 text-bold">
                                {{$withdraw_sum}}
                            </h3>
                            <h6 class="text-black"><a href="" class="" data-toggle="modal" data-target="#withdraw">Вывести</a></h6>


                        </div>

                    </div>
				</div>

			</div>

		</div>
        <div class="flex  course_cards d-sm-flex d-md-none mt-3">
            <div class="card purchases" >
                <div class="circle_blue">
                    <img src="{{asset('images/people.svg')}}" alt="">


                </div>
                <h4 class="text-white mt-2">
                    Ваши пользователи
                </h4>
                <h3  class="text-white mt-1 text-bold">
                    {{$course->purchases}}
                </h3>
                <h6 class="text-black"><a href="" data-toggle="modal" data-target="#users" class="">Посмотреть</a></h6>
                <div class="modal fade" id="users" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>
                                    История покупок
                                </h5>
                            </div>
                            <div class="modal-body">

                                <table class="table table-striped">
                                    <thead>
                                    <tr>

                                        <td>
                                            Пользователь
                                        </td>
                                        <td>
                                            Дата покупки
                                        </td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($purchases as $purchase)
                                        <tr>
                                            <td>{{$purchase->login}}</td>
                                            <td>{{$purchase->created_at}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer"  style="justify-content: flex-start">


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card purchases" >
                <div class="circle_blue">
                    <img src="{{asset('images/money.svg')}}" alt="">


                </div>
                <h4 class="text-white mt-2">
                    Вы заработали
                </h4>
                <h3  class="text-white mt-1 text-bold">
                    {{$course->bill}}
                </h3>
                <h6 class="text-black"><a href="" data-toggle="modal" data-target="#userPurchases" class="">Посмотреть</a></h6>
                <div class="modal fade" id="userPurchases" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>
                                    История покупок
                                </h5>
                            </div>
                            <div class="modal-body">

                                <table class="table table-striped">
                                    <thead>
                                    <tr>

                                        <td>
                                            Пользователь
                                        </td>
                                        <td>
                                            Дата покупки
                                        </td>
                                        <td>
                                            Сумма
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($purchases as $purchase)
                                        <tr>
                                            <td>{{$purchase->login}}</td>
                                            <td>{{$purchase->created_at}}</td>
                                            <td>{{$course->price}} {{$course->currency}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer"  style="justify-content: flex-start">


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card purchases" >
                <div class="circle_blue">
                    <img src="{{asset('images/dollar.svg')}}" alt="">


                </div>
                <h4 class="text-white mt-2">

                    Вы вывели
                </h4>
                <h3  class="text-white mt-1 text-bold">
                    {{$withdraw_sum}}
                </h3>
                <h6 class="text-black"><a href="" class="" data-toggle="modal" data-target="#withdraw">Посмотреть</a></h6>


            </div>

        </div>


	</div>
    <div class="container container_course">
        <div class="row">







            <div id="courseId" class="col-lg-4" style="display:none;">{{ $courseId }}</div>

            <div class="col-lg-10" id="i8">
                <div class="tabs">
                    <div class="mainer">




                                @foreach($videos as $video)

                                        <div class="col-lg-4 course_video  col-12" style="display: block;"  data-toggle="modal" data-target="#modalVideo_{{$video->id}}">

                                            <div class="seven" style="background-image: url('{!! $video->image_path !!}');background-size: cover;">
                                                <div class="seven_div" style="background-color: rgba(0,0,0,0.3)">
                                                    <span>{{$video->title}}</span>
                                                    <img src="{{asset('images/play.png')}}" class="play_button" alt="">


                                                </div>
                                            </div>



                                            <div class="modal fade" id="modalVideo_{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <video controls="controls" style="width: 100%;height: 400px;">
                                                                <source src="{{$video->video_path}}" type='video/mp4'>
                                                            </video>
                                                        </div>
                                                        <div class="modal-footer"  style="justify-content: flex-start !important;">

                                                            <div class=" course_author">
                                                                @if($user['avatar'] == null)
                                                                    <img src="{{asset('images/image_avatar.svg')}}" alt="" class="face " style="width: 40px;height: 40px;">
                                                                @else
                                                                    <img src="{!! $user->avatar !!}" alt="" class="profile-avatar search-avatar face" style="width: 40px;height: 40px;">
                                                                @endif
                                                            </div>
                                                            <div class="">
                                                                {{$user->name}}
                                                                <br>
                                                                {{$user->login}}

                                                            </div>
                                                            <a class="more" href="#" role="button" id="dropdownMenuLink_{{$video->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="material-icons medium " >drag_indicator</i>
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink_{{$video->id}}">
                                                                <a class="dropdown-item" href="#" data-dismiss="modal" data-toggle="modal" data-target="#setting_modal_{{$video->id}}">
                                                                    <i class="material-icons small ">settings</i>
                                                                    <span>Изменить</span>
                                                                </a>
                                                                <a class="dropdown-item" href="{{route('DeleteVideo',$video->id)}}">
                                                                    <i class="material-icons small ">close</i>
                                                                    <span>Удалить</span>
                                                                </a>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            <div class="modal fade" id="setting_modal_{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{route('EditCourseVideo')}}" enctype="multipart/form-data" method="post">
                                            {{csrf_field()}}
                                            <div class="modal-body2">



                                                <input type="hidden" name="video_id" value="{{$video->id}}">

                                                <input type="text" value="{{$video->title}}" placeholder="Заголовок видео" name="title">
                                                <label class="label">
                                                    <i class="material-icons">Видео</i>
                                                    <span class="title">Добавить видео</span>
                                                    <input type="file" class="kot" name="video">
                                                </label>
                                                <label class="label">
                                                    <i class="material-icons">Фоновая картина</i>
                                                    <span class="title">Выбрать картинку</span>
                                                    <input type="file" class="kot" name="img">
                                                </label>

                                            </div>
                                            <div class="modal-footer">

                                                <button type="submit" class="btn btn-primary">Изменить видео</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                                @endforeach


                                <div class=" col-lg-4  text-center">
                                    <div class="play">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_video111">
                                            <img src="{{asset('images/pplay.svg')}}" alt="">
                                            <p>Добавить видео</p>
                                        </button>
                                    </div>
                                    <div class="modal fade" id="exampleModal_video111" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{route('CourseVideo')}}" enctype="multipart/form-data" method="post">
                                                    {{csrf_field()}}
                                                    <div class="modal-body2">


                                                        <h5>Загрузите видео</h5>
                                                        <span>Видео не должен превышать 120 мб<br>Формат:MP4,WMV,MOV<br>Размер фона: 988 x 649 или 900 х 1023</span>

                                                        <label class="label">
                                                            <input type="hidden" name="category_id" value=null>
                                                            <input type="hidden" name="course_id" value="{{$course->id}}">
                                                            <i class="material-icons" id="new_video">Видео</i>
                                                            <span class="title" >Добавить видео</span>
                                                            <input type="file" class="kot" id="free_video" name="video">
                                                        </label>
                                                        <label class="label">
                                                            <i class="material-icons" id="new">Файл не выбран</i>
                                                            <span class="title">Выбрать картинку</span>
                                                            <input type="file" class="kot" id="free_image" name="img">
                                                        </label>

                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="submit" id="btn" class="btn btn-primary">Загрузить видео</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    {{$videos->links()}}
                                </div>






                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <img src="images/Rectangle.png">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h1>7 ДНЕВНЫЙ КУРС ПРО МАРКЕТИНГ</h1>
        <p>Повысите квалификацию в области управления маркетингом и освоите системный подход к увеличению и контролю потока клиентов.</p>
      </div>

    </div>
  </div>
</div>

    <div id="copier">
        {{route('ViewCourse',$course->id)}}
    </div>
    <div class="modal fade modaler" id="course"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ДОБАВИТЬ НОВЫЙ КУРС</h5>



                </div>
                <form action="{{route('EditCourse')}}" method="post" enctype="multipart/form-data" >

                    <div class="modal-body">
                        <input type="hidden" name="course_id" value="{{$course->id}}">
                        {{csrf_field()}}
                        <div class="numpy">
                            <div class="on">
                                <input type="checkbox" @if($course['course_type'] == 'online') checked="true" @endif name="course_type" value="online">
                                <p>Онлайн</p>
                            </div>
                            <div class="of">
                                <input type="checkbox" @if($course['course_type'] == 'offline') checked="true" @endif name="course_type" value="offline">
                                <p>Офлайн</p>
                            </div>
                        </div>
                        <label for="">Выберите название курса</label>
                        <input type="text"  value="{{$course->title}}" class="form-control" name="title">
                        <label for="">Выберите категорию курса</label>
                        <select name="category" id="" class="form-control" >
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($course['category'] == $category['id']) selected @endif >{{$category->title}}</option>
                            @endforeach
                        </select>
                        <label for="">Адрес</label>
                        <input type="text" class="form-control" name="address" value="{{$course->address}}">
                        <label for="">Дата начала и окончания курса</label>
                        <div class="d-flex">
                            <input type="date" class="form-control w-50" name="start_date" value="{{$course->start_date}}">
                            <input type="date" class="form-control w-50" name="end_date" value="{{$course->end_date}}">
                        </div>
                        <label for="">Описание курса</label>
                        <textarea class="form-control" name="description">{{$course->description}}</textarea>
                        <label for="">Цена</label>
                        <div class="d-flex">
                            <input type="number" value="{{$course->price}}" class="form-control w-75" style="border-radius:5px 0px 0px 5px;" name="price">
                            <select name="currency" id="" class="form-control w-25" style="border-radius:0px 5px 5px 0px;" name="currency">
                                <option value="KZT"@if($course['currency'] == 'KZT') selected @endif>KZT</option>

                                <option value="RUB"@if($course['currency'] == 'RUB') selected @endif>RUB</option>
                            </select>
                        </div>
                        <label for="">Выберите фон курса</label>
                        <input type="file" placeholder="saddasd" name="image_of_course">

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Создать курс</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="userPurchases" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>
                        История покупок
                    </h5>
                </div>
                <div class="modal-body">

                    <table class="table table-striped">
                        <thead>
                        <tr>

                            <td>
                                Пользователь
                            </td>
                            <td>
                                Дата покупки
                            </td>
                            <td>
                                Сумма
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($purchases as $purchase)
                            <tr>
                                <td>{{$purchase->login}}</td>
                                <td>{{$purchase->created_at}}</td>
                                <td>{{$course->price}} {{$course->currency}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer"  style="justify-content: flex-start">


                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="withdraw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>
                        Сделать вывод
                    </h5>
                </div>
                <div class="modal-body">

                    <form action="{{route('CreateWithdraw')}}" method="get">
                        <div class="form-group">
                            <label for="card" >Банковская карта</label>
                            <input type="radio" id="card" name="type_of_withdraw" value="bill">
                            <label for="kaspi">Номер каспи</label>

                            <input type="radio" id="kaspi" name="type_of_withdraw" value="kaspi_number" >
                            <input type="text" class="form-control" name="bill" placeholder="Номер карты или номер каспи gold">


                        </div>
                        <input type="hidden" name="course_id" value="{{$course->id}}">
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <div class="form-group">
                            <input type="number" class="form-control" name="amount" placeholder="Сумма вывода ">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary">
                        </div>

                    </form>
                </div>
                <div class="modal-footer"  style="justify-content: flex-start">


                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="users" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>
                        История покупок
                    </h5>
                </div>
                <div class="modal-body">

                    <table class="table table-striped">
                        <thead>
                        <tr>

                            <td>
                                Пользователь
                            </td>
                            <td>
                                Дата покупки
                            </td>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($purchases as $purchase)
                            <tr>
                                <td>{{$purchase->login}}</td>
                                <td>{{$purchase->created_at}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer"  style="justify-content: flex-start">


                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="withdraw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>
                        Сделать вывод
                    </h5>
                </div>
                <div class="modal-body">

                    <form action="{{route('CreateWithdraw')}}" method="get">
                        <div class="form-group">
                            <label for="card" >Банковская карта</label>
                            <input type="radio" id="card" name="type_of_withdraw" value="bill">
                            <label for="kaspi">Номер каспи</label>

                            <input type="radio" id="kaspi" name="type_of_withdraw" value="kaspi_number" >
                            <input type="text" class="form-control" name="bill" placeholder="Номер карты или номер каспи gold">


                        </div>
                        <input type="hidden" name="course_id" value="{{$course->id}}">
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <div class="form-group">
                            <input type="number" class="form-control" name="amount" placeholder="Сумма вывода ">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary">
                        </div>

                    </form>
                </div>
                <div class="modal-footer"  style="justify-content: flex-start">


                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="myModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="loading-bar-spinner" class="spinner"><div class="spinner-icon"></div></div>
                    <br>

                </div>
                <div class="modal-footer">
                    <h4>Загрузка</h4>
                </div>

            </div>
        </div>
    </div>
    @if(isset($form_success))
        <div class="modal" tabindex="-1" id="myModal1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">


                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    <div class="modal-body">
                        <h5>
                            Спасибо заявка <br> принята!!!
                        </h5>

                        <img src="{{asset('images/success.png')}}" alt="">



                    </div>
                    <div class="modal-footer">
                        <h4>
                            ЗАЯВКА ОБРАБАТЫВАЕТСЯ В ТЕЧЕНИЕ 1-2 ДНЯ <br>
                            ОТВЕТ ПРИХОДИТЬ В УКАЗАННЫЙ <br> ваш электронный адрес</h4>
                    </div>

                </div>
            </div>
        </div>
    @endif
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>


  <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/socket.io.js')}}"></script>

  <script src="{{asset("js/script.js")}}"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        $('.tabs_control').on('click',function(e){
            e.preventDefault()
            $('.tabs_page.active').removeClass('active');
            $(this).addClass('active');
            $('.tabs').find('.tabs_page').eq($(this).index()).addClass('active');


        });
        $('#myModal1').modal('show');


        $(function() {
            $( ".tabs_page" ).eq(0).addClass('active');
            $('.tabs_control').eq(1).addClass('active');

        });

        function Copy(elementId){
            // Create an auxiliary hidden input
            var aux = document.createElement("input");

            // Get the text from the element passed into the input
            aux.setAttribute("value", document.getElementById(elementId).innerHTML);

            // Append the aux input to the body
            document.body.appendChild(aux);

            // Highlight the content
            aux.select();

            // Execute the copy command
            document.execCommand("copy");

            // Remove the input from the body
            document.body.removeChild(aux);
            /* Alert the copied text */

            $('#copyButton').html('Скопировано');
        }
        $("#btn").on('click', function () {
            var dataLoadingText = $(this).attr("data-loading-text");

                $('#exampleModal_video111').modal('toggle');





        });

        $(document).ready(function(){

            $('#free_image').change(function(e){
                var str = e.target.files[0].name;
                if(str.length > 15) str = str.substring(0,10);
                $('#new').html(str)

            });
            $('#free_video').change(function(e){
                var str = e.target.files[0].name;
                if(str.length > 15) str = str.substring(0,10);
                $('#new_video').html(str)

            });
        });
    </script>
    <style>
        .play{
            height: 240px !important;
            width: 100%;
            border-radius: 15px;
        }
        .image_of_video{
            filter: brightness(50%);
        }
        #loading-bar-spinner.spinner {
            left: 50%;
            margin-left: -20px;
            top: 50%;
            margin-top: -20px;
            position: absolute;
            z-index: 19 !important;
            animation: loading-bar-spinner 900ms linear infinite;
        }
        #myModal .modal-body{
            height: 250px;

        }

        #loading-bar-spinner.spinner .spinner-icon {
            width: 60px;
            height: 60px;
            border:  solid 4px transparent;
            border-top-color:  #0075E1 !important;
            border-left-color: #0075E1 !important;
            border-radius: 50%;
        }

        @keyframes loading-bar-spinner {
            0%   { transform: rotate(0deg);   transform: rotate(0deg); }
            100% { transform: rotate(360deg); transform: rotate(360deg); }
        }

        .videMainer{
            height: 250px;
            background-size: cover !important;
            background-position: center !important;


        }

        .play_button_v2{
            width: 40px;
            height: 40px;
            position: relative;
            top:-20px;

        }
        .info h1{
            display: flex;
            justify-content: space-between;
        }

        .profile .text-center.ml-auto{
            margin-top: 20px;
        }
        .profile{
            padding-bottom: 40px;
        }
        .play_button_v2 img{
            width: 40px;
            height: 40px;
        }
        @media (max-width: 720px) {
            .play_button_v2{
                width: 40px;
                height: 40px;
                position: absolute;
                top:65%;
                left:16.5%;


            }
            .course_video{
                height: 250px;
            }
            .profile .text-center.ml-auto{
                margin-left: 15px !important;

                text-align: left!important;
            }
            .profile .text-center.ml-auto h2{
                font-size: 30px;
            }
            .profile{
                padding-top: 0px;
            }
            .course_video{
                margin-top: 30px;
                padding-left: 0px;
                padding-right: 0px;
            }
            .mainer{
                margin-right: 0px;
            }
            .videMainer{
                margin-left: 0px;
                margin-right: 0px;
            }
            .profile{
                flex-direction: column;
            }
            .profile .d-flex{
                flex-direction: row !important;
                justify-content: center;
                flex-flow: row !important;
            }
            .profile .col-lg-4{
                display: flex;
                justify-content: center;
            }



        }
        .tabs_control {
            cursor: pointer;
            width: auto;
            white-space: pre;
            font-weight: 400 !important;
            font-size: 15px;
        }
        .seven{
            width: 100%;
            height: 100% !important;
            margin-top: 0px;
        }
        .seven_div{
            display: flex;
            justify-content: center;
            align-items: center;

        }
        .play_button{
            width: 50px !important;
            height: 50px !important;
            margin-top: -30px;
            margin-left: -25px;
        }
        .seven_div span{
            position: absolute;
            bottom:20px;
            left:40px;
            width: auto;
        }
        .player_div{
            display: none;
        }
        .player_div.active{
            display: block;
            height: 400px;
            margin-bottom: 50px;
        }
        .play{

            height: 250px;
            margin-left: 0px;
        }
        .mainer button.btn.btn-primary{

        }
        #copier{
            display: none;
        }
        .modal.fade.modaler .info p{
            height: auto !important;
        }
        @media (min-width: 720px) {
            .seven{
                height: 240px !important;
                margin-bottom: 10px;
            }


        }

        @media (max-width: 720px) {
            .info{
                padding-bottom: 50px !important;
            }
            .player_div.active{
                margin-left: 15px;
                margin-right: 15px;

            }
            .play_button_v2 img{
                width: 30px;
                height: 30px;
            }

            .play{
                margin:15px 0px !important;
            }
            .course_cards .card.purchases{
                margin-left: 5px;
                margin-right: 5px;
                max-width: 25% !important;

                min-width: 70% !important;
                width: 32%;
            }
            .course_cards .card.purchases:nth-child(1){
                margin-left: 15px;
            }
            .circle_blue{

            }
        }

        .modal-footer .more{
            margin-left: auto;
        }
        .modal-footer .course_author{
            margin-right: 10px;
        }
    </style>

@endsection
</body>
</html>
