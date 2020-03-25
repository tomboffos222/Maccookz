@extends('layouts.user')

    @section('content')

<!DOCTYPE html>
<html>
<head>
	<title>Профиль</title>
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
	<div class="container ">
		<div class="profile">
			<div class="col-lg-4">
                @if($user['avatar'] == null)
                    <img src="{{asset('images/image_avatar.svg')}}" alt="" class="face">
                @else
                    <img src="{!! $user->avatar !!}" alt="" class="profile-avatar search-avatar face">
                @endif
			</div>
			<div class="col-lg-8" id="i8">
				<div class="info">
					<h1>{{$user['name']}}</h1>
					<span>{{$user['login']}}</span>
					<p>
                        @if($user->about == null)

                            @else
                        {{$user->about}}
                            @endif
                    </p>
                    @if(!isset($friendship))
                        <button onclick="window.location.href='{{route('AddFriend',$user['id'])}}'">Добавить в друзья</button>

                    @elseif($friendship['status'] == 'wait')
                        @php $account = session()->get('user'); @endphp
                        @if($friendship['friend_id'] == $account['id'])
                            <button onclick="window.location.href='{{route('FriendProve',$friendship['id'])}}'">Одобрить</button>
                            @else
                            <button class="btn-danger" style="background-color: grey;">Отменить заявку</button>
                        @endif
                    @elseif($friendship['status'] == 'ok')
                        <button class="btn-danger" onclick="window.location.href='{{route('DeleteFriend',$friendship['id'])}}'" style="background-color: red">Удалить с друзей</button>
                    @endif

				</div>
				<div class="infosub desktop">
					<div class="friends">
						<span>{{$friendship_counter}}</span>
						<p>Друзья</p>
					</div>
					<div class="courses">
						<span>{{$course_counter}}</span>
						<p>Добавленные курсы</p>
					</div>
				</div>
			</div>
		</div>
		<div class="lessons">
			<div class="col-lg-12" id="choche">
				<h2>Курсы {{$user->name}}</h2>
			</div>
			<div class="owl-carousel">
                @foreach($courses as $course)

                    <div class="seven" style="background-image: url('{!! $course->image_of_course !!}');background-size: cover;">
                            <div class="seven_div" style="background-color: rgba(0,0,0,0.3)">
                               <span>{{$course->title}}</span>
                               <p>{{mb_strimwidth($course->description,0,100)}}...</p>
                               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#courseModal_{{$course->id}}">
                                   Купить
                               </button>
                               <div class="eye">
                                   <img src="{{asset('images/eye.svg')}}" width="12px" height="12px">
                                   <p>{{$course->views}}</p>
                                   <img src="{{asset('images/team.svg')}}" width="12px" height="12px">
                                   <p>{{$course->purchases}}</p>
                               </div>
                           </div>

                    </div>




                @endforeach



            </div>
		</div>
		<div class="public">
			<div class="col-lg-12">
				<h2>Публикации</h2>
			</div>
			<div class="linia"></div>
			<div class="row">
                @foreach($free_courses as $free_course)
		        	<div class="col-lg-4 col-12" style="display: block;"  data-toggle="modal" data-target="#modalVideo_{{$free_course->id}}">

                    <img src="{!! $free_course->img_path !!}" class="player_{{$free_course->id}} active" alt="" height="200" width="100%" style="width: 100%;height: 250px;    ">
                    <a href="" style="font-size: 25px;color:#000;">{{$free_course->title}}</a>



			</div>
                    <div class="modal fade" id="modalVideo_{{$free_course->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                               <div class="modal-body">
                                   <video controls="controls" style="width: 100%;height: 400px;">
                                       <source src="{!! $free_course->video_path !!}" type='video/ogg; codecs="theora, vorbis"'>
                                   </video>
                               </div>
                                <div class="modal-footer"  style="justify-content: flex-start">

                                        <div class=" course_author">
                                            <img src="{{asset('images/profile.svg')}}" alt="">
                                        </div>
                                        <div class="">
                                            {{$free_course->name}}
                                            <br>
                                            {{$free_course->login}}
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

		</div>
		</div>
        @foreach($courses as $course)
            <div class="modal fade" id="courseModal_{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <img src="{!! $course->image_of_course !!}">
                        </div>
                        <div class="modal-body">
                            <h1>{{$course->title}}</h1>
                            <p>{{$course->description}}</p>
                        </div>
                        <div class="modal-footer">
                            <h1>{{$course->price}} {{$course->currency}}</h1>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                            <button type="button" onclick="window.location.href='{{route('BuyCourse',$course->id)}}'" class="btn btn-primary">Купить</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
	</div>
	<!-- Button trigger modal -->

<!-- Modal -->



<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>


  <script src="{{asset('js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('js/script.js')}}"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

@endsection
    <style>
        .modal-header img{
            width: 100% !important;
            height: auto;
        }
        .seven{
            height: auto !important;
        }
        .seven_div{
            border-radius: 15px;
        }
        .face{
            background-image: none !important;
        }
    </style>
</body>
</html>
