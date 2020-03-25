
@extends('layouts.user')

    @section('content')
<!DOCTYPE html>
<html>
<head>
	<title>Профиль</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/myprofile.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playball&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/respons.css">
</head>
<body>
	<div class="container">
		<div class="profile">
			<div class="col-lg-4">
                @if($user['avatar'] == null)
                    <img src="{{asset('images/image_avatar.svg')}}" alt="" class="face">
                @else
                    <img src="{!! $user->avatar !!}" alt="" class="profile-avatar face">
                @endif
			</div>
			<div class="col-lg-8" id="i8">
				<div class="info">

					<h1>
                        {{$user->name}}
                        <a href="{{route('Logout')}}">
                            <svg class="bi bi-box-arrow-in-right" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8.146 11.354a.5.5 0 010-.708L10.793 8 8.146 5.354a.5.5 0 11.708-.708l3 3a.5.5 0 010 .708l-3 3a.5.5 0 01-.708 0z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9A.5.5 0 011 8z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M13.5 14.5A1.5 1.5 0 0015 13V3a1.5 1.5 0 00-1.5-1.5h-8A1.5 1.5 0 004 3v1.5a.5.5 0 001 0V3a.5.5 0 01.5-.5h8a.5.5 0 01.5.5v10a.5.5 0 01-.5.5h-8A.5.5 0 015 13v-1.5a.5.5 0 00-1 0V13a1.5 1.5 0 001.5 1.5h8z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </h1>

					<span>{{$user->login}}</span>
					<p>
                        @if($user->about == null)

                            @else

                            {{$user->about}}
                        @endif
                    </p>
					<button onclick="window.location.href='{{route('EditProfile')}}'"><img src="images/cher.svg" alt=""> Редактировать</button>

				</div>
				<div class="infosub">
					<div class="friends">
						<span>{{$friend_counter}}</span>
						<p>Друзей</p>
					</div>
					<div class="courses">
						<span>{{$courses_counter}}</span>
						<p>Добавленные курсы</p>
					</div>
					<div class="purch">
						<span>{{$course_counter}}</span>
						<p>Купленные курсы</p>
					</div>
				</div>
			</div>
		</div>
		<div class="lessons">
			<div class="col-lg-12" id="choche">
				<h2>Мои курсы</h2>
			</div>

			<div class="owl-carousel">
                @foreach($courses as $course)
				<div class="seven" style="background-image: url('{!! $course->image_of_course !!}');background-size: cover;">
					<div class="seven_div" style="background-color: rgba(0,0,0,0.3)">
                        <span>{{$course->title}}</span>
                        <p>{{mb_strimwidth($course->description,0,100)}}..</p>
                        <button onclick="window.location.href='{{route('MyCourse',$course->id)}}'">
                            Подробнее
                        </button>
                        <div class="eye">
                            <img src="images/eye.svg" width="12px" height="12px">
                            <p>{{$course->views}}</p>
                            <img src="images/team.svg" width="12px" height="12px">
                            <p>{{$course->purchases}}</p>
                        </div>
                    </div>
				</div>
                @endforeach

			</div>
		</div>
		<div class="public">
			<div class="col-lg-12">
				<a href="" class="tabs_control active"><h3>Публикации</h3></a>
				<a href="" class="tabs_control"><h3>Купленные курсы</h3></a>
			</div>
			<div class="row tabs_page active">
                @foreach($free_courses as $free_course)
                    <div class="col-lg-4 col-12" style="display: block;"  data-toggle="modal" data-target="#modalVideo_{{$free_course->id}}">

                        <img src="{!! $free_course->img_path !!}" class="player_{{$free_course->id}} active" alt="" height="200" width="100%" style="width: 100%;height: 250px;    ">
                        <a href="" style="font-size: 25px;color:#000;">{{$free_course->title}}</a>



                    </div>
                    <style>
                        #modalVideo_{{$free_course->id}} .modal-body{
                            padding: 0px;
                        }
                    </style>
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
            <div class="row tabs_page">
                @foreach($purchased_courses as $purchased_course)
                    <div class="col-lg-4 col-12" style="display: block;" >
                        <a href="{{route('ViewCourse',$purchased_course->id)}}" style="font-size: 25px;color:#000;">
                            <img src="{!! $purchased_course->image_of_course !!}" class="player_{{$purchased_course->id}} active" alt="" height="200" width="100%" style="width: 100%;height: 250px;    ">
                            {{$purchased_course->title}}
                        </a>



                    </div>


                @endforeach
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
      </div>
      <div class="modal-body">
        <h1>7 ДНЕВНЫЙ КУРС ПРО МАРКЕТИНГ</h1>
        <p>Повысите квалификацию в области управления маркетингом и освоите системный подход к увеличению и контролю потока клиентов.</p>
      </div>
      <div class="modal-footer">
      	<h1>7 000 тг</h1>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <button type="button" class="btn btn-primary">Купить</button>
      </div>
    </div>
  </div>
</div>


<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>


  <script src="js/owl.carousel.min.js"></script>
  <script src="js/script.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <style>
        .face{
            background-image: none !important;
        }
        .tabs_page.active{
            display: flex;

        }
        .tabs_control.active h3{
            background: #0075e1;
            color:#fff;
        }

    </style>
    <script>
        $('.tabs_control').on('click',function(e){
            e.preventDefault();
            $('.tabs_control.active').removeClass('active');
            $(this).addClass('active');

            $('.tabs_page.active').removeClass('active');
            $('.tabs_page').eq($(this).index()).addClass('active');

        })
    </script>
@endsection
</body>
</html>
