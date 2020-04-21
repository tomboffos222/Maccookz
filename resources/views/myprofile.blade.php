
@extends('layouts.user')

    @section('content')
<!DOCTYPE html>
<html>
<head>
	<title>Профиль</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('css/section.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/myprofile.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playball&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="{{asset("css/respons.css")}}">
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
                    <button onclick="window.location.href='{{route('ChatList',$chat_id['id'])}}'" class="btn btn-primary">Написать </button>

				</div>
				<div class="infosub">
					<div class="friends" data-target="#friends" data-toggle="modal" >
						<span>{{$friend_counter}}</span>
						<p>Друзей</p>
					</div>
					<div class="courses">
						<span>{{$courses_counter}}</span>
						<p>Добавленные курсы</p>
					</div>
					<div class="purch">
						<span>{{$course_counter}}</span>
						<p>Мои курсы</p>
					</div>
				</div>
			</div>
		</div>
		<div class="lessons">
			<div class="col-lg-12" id="choche">
				<h2>Добавленные курсы</h2>
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
				<a href="" class="tabs_control"><h3>Мои курсы</h3></a>
			</div>
			<div class="row tabs_page active">
                @foreach($free_courses as $free_course)
                    <div class="col-lg-4">
                        <div class="col-lg-12 col-12 videoMainer" style="display: block;background-image: url('{!! $free_course->img_path !!}');"  data-toggle="modal" data-target="#modalVideo_{{$free_course->id}}">
                            <div>

                                <a  style="font-size: 25px;color:#000;">{{$free_course->title}}</a>


                            </div>
                        </div>
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
                                    <video preload="yes" playsinline controls="true" style="width: 100%;height: 400px;">
                                        <source src="{!! $free_course->video_path !!}" type='video/mp4'>
                                    </video>
                                </div>
                                <div class="modal-footer"  style="justify-content: flex-start !important;">

                                    <div class=" course_author">
                                        @if($user['avatar'] == null)
                                            <img src="{{asset('images/image_avatar.svg')}}" alt="" class="face">
                                        @else
                                            <img src="{!! $user->avatar !!}" alt="" class="profile-avatar face">
                                        @endif
                                    </div>
                                    <div class="">
                                        {{$free_course->name}}
                                        <br>
                                        {{$free_course->login}}
                                    </div>
                                    <a class="more" href="#" role="button" id="dropdownMenuLink_{{$free_course->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons medium " >drag_indicator</i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink_{{$free_course->id}}">
                                        <a class="dropdown-item" href="#"  data-dismiss="modal" data-toggle="modal" data-target="#setting_modal_{{$free_course->id}}">
                                            <i class="material-icons small ">settings</i>
                                            <span>Изменить</span>
                                        </a>
                                        <a class="dropdown-item" href="{{route('DeleteFreeCourse',$free_course->id)}}">
                                            <i class="material-icons small ">close</i>
                                            <span>Удалить</span>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="setting_modal_{{$free_course->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('EditFreeCourse')}}" enctype="multipart/form-data" method="post">
                                    {{csrf_field()}}
                                    <div class="modal-body2">



                                        <input type="hidden" name="video_id" value="{{$free_course->id}}">

                                        <input type="text" value="{{$free_course->title}}" placeholder="Заголовок видео" name="title">
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

		    </div>
            <div class="row tabs_page new">
                @foreach($purchased_courses as $purchased_course)
                    <div class="col-lg-4 col-12 videoMainer" style="display: block;" >
                        <div class="seven col-lg-12" style="background-image: url('{!! $purchased_course->image_of_course !!}');background-size: cover;">
                            <div class="seven_div" style="background-color: rgba(0,0,0,0.3)">
                                <span>{{$purchased_course->title}}</span>
                                <p>{{mb_strimwidth($purchased_course->description,0,100)}}..</p>
                                <button onclick="window.location.href='{{route('ViewCourse',$purchased_course->id)}}'">
                                    Подробнее
                                </button>
                                <div class="eye">
                                    <img src="images/eye.svg" width="12px " height="12px">
                                    <p>{{$purchased_course->views}}</p>
                                    <img src="images/team.svg" width="12px" height="12px">
                                    <p>{{$purchased_course->purchases}}</p>
                                </div>
                            </div>
                        </div>



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
    <div class="modal fade" id="friends" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>
                        Мои друзья
                    </h2>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">

                        <tbody>
                        @foreach($friends as $friend)
                        <tr>
                            <td>
                                @if($friend['avatar'] == null)
                                    <a href="{{route('AccountView',$friend->id)}}">
                                        <img src="{{asset('images/image_avatar.svg')}}" alt="" class="profile-avatar">
                                    </a>
                                    @else

                                <a href="{{route('AccountView',$friend->id)}}">
                                    <img src="{!! $friend->avatar !!}" alt="" class="profile-avatar">
                                </a>
                                    @endif

                            </td>

                            <td>
                                <a href="{{route('AccountView',$friend->id)}}">{{$friend->login}}</a>
                            </td>
                            <td>

                                <a href="{{route('DeleteFriend',$friend->id)}}" class="btn btn-danger">Удалить</a>

                            </td>
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
        td{
            vertical-align: middle !important;

        }
        td a{
            color: inherit;
        }
        .tabs_page.active{
            display: flex;

        }
        .tabs_control.active h3{
            background: #0075e1;
            color:#fff;
        }
        .header-area{
            height:100%;
        }


        .profile-avatar{
            width: 40px;
            height: 40px;
        }
        .videoMainer{
            margin-bottom: 40px;
        }
        .eye img{
            width: 12px !important;
            height: 12px !important;
        }
        .public .row .col-lg-4 .seven_div button{
            left: 40px ;
        }
        .more{
            position: absolute;
            right: 25px;
        }
        .public .row .col-lg-4 .seven_div .eye{
            right: 20px ;
        }
        .tabs_page:nth-child(2) .col-lg-4.col-12.videoMainer{

        }
        .seven>.seven_div{
            width: 100%;
        }
        .new .videoMainer{
            height: 100%;
        }
        @media (max-width: 720px) {
            .public .row{
                padding-right: 15px;

            }
            .new .videoMainer{
                height: 240px;
            }
            .col-lg-4.col-12 >.seven{
                height: 100% !important;
            }
            .videoMainer{

                height: 240px;
            }

            .videoMainer{
                border-radius: 15px;
                margin-top: 0px;
            }
            .videoMainer>div{
                border-radius: 15px;
            }


        }
        .videoMainer{
            margin-left: 0px;
            margin-right: 0px;

        }
        .row.tabs_page.active{
            padding-right: 0px;

        }
        .new .seven{
            width: 100% !important;

            margin-right: 15px;
            min-height: 100%;
        }
        .new .col-lg-4{
            padding-left: 15px;
            padding-right: 15px;
            height: 300px;
        }
        @media (max-width: 720px) {
            .container{
                height: 100% !important;
            }
            .public .row .col-lg-4{
                padding-right: 0px;
                height: 260px !important;
            }
            .videoMainer{
                height: 240px !important;
            }
            .info button{
                margin-bottom: 10px;
            }


        }
        .info button{
            display:inline;

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
