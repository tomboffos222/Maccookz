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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
	<link rel="stylesheet" href="{{asset("css/respons.css")}}">
</head>
<body>
	<div class="container ">
		<div class="profile">
			<div class="col-lg-4">
                @if($account['avatar'] == null)
                    <img src="{{asset('images/image_avatar.svg')}}" alt="" class="face">
                @else
                    <img src="{!! $account->avatar !!}" alt="" class="profile-avatar search-avatar face">
                @endif
			</div>
			<div class="col-lg-8" id="i8">
				<div class="info">
					<h1>{{$account['name']}}</h1>
					<span>{{$account['login']}}</span>
					<p>
                        @if($account->about == null)

                            @else
                        {{$account->about}}
                            @endif
                    </p>
                    @if(!isset($friendship))


                        <button  onclick="window.location.href='{{route('AddFriend',$account['id'])}}'">Добавить в друзья</button>


                    @elseif($friendship['status'] == 'wait')
                        @php $user = session()->get('user'); @endphp
                        @if($friendship['owner_id'] == $account['id'])
                            <button onclick="window.location.href='{{route('FriendProve',$friendship['id'])}}'">Одобрить</button>
                            @elseif($friendship['friend_id'] == $account['id'])
                            <button class="btn-danger" onclick="window.location.href='{{route('DeleteFriend',$friendship['id'])}}'" style="background-color: grey;">Отменить заявку</button>
                        @endif
                    @elseif($friendship['status'] == 'ok')

                        <img class=" icon_add" onclick="window.location.href='{{route('DeleteFriend',$friendship['id'])}}'" src="{{asset('images/icon_add.png')}}">
                        <button class="send_message_button btn-primary" onclick="window.location.href='{{route('ChatList',$chat_id['id'])}}'">
                            <img src="{{asset('images/paper.png')}}" class="paper" alt=""> Написать
                        </button>
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
				<h2>Курсы {{$account->name}}</h2>
			</div>
			<div class="owl-carousel">
                @foreach($courses as $course)

                    <div class="seven" style="background-image: url('{!! $course->image_of_course !!}');background-size: cover;">
                            <div class="seven_div" style="background-color: rgba(0,0,0,0.3)">
                               <span>{{$course->title}}</span>
                               <p>{{mb_strimwidth($course->description,0,100)}}...</p>
                                @if($course['purchased'] == 0)
                               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#courseModal_{{$course->id}}">
                                   Купить
                               </button>
                                    @elseif($course['purchased'] ==1)
                                    <button type="button" class="btn btn-primary" onclick="window.location.href='{{route('ViewCourse',$course->id)}}'">
                                        Подробнее
                                    </button>
                                @endif
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
				<h2 class="tabs_control active">Публикации</h2>
			</div>
			<div class="linia"></div>
			<div class="row">
                @foreach($free_courses as $free_course)
                    <div class="col-lg-4">
                        <div class="col-lg-12 col-12 videoMainer" style="display: block;background-image: url('{!! $free_course->img_path !!}');"  data-toggle="modal" data-target="#modalVideo_{{$free_course->id}}">
                            <div>

                                <a style="font-size: 25px;color:#000;">{{$free_course->title}}</a>


                            </div>
                            <style>
                                #modalVideo_{{$free_course->id}} .modal-body{
                                    padding: 0px;
                                }
                            </style>

                        </div>
                    </div>
                    <div class="modal fade" id="modalVideo_{{$free_course->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <video controls="controls" style="width: 100%;height: 400px;">
                                        <source src="{!! $free_course->video_path !!}" >
                                    </video>
                                </div>
                                <div class="modal-footer"  style="justify-content: flex-start">

                                    <div class=" course_author">
                                        @if($account['avatar'] == null)
                                            <img src="{{asset('images/image_avatar.svg')}}" alt="" class="face">
                                        @else
                                            <img src="{!! $account->avatar !!}" alt="" class="profile-avatar face">
                                        @endif
                                    </div>
                                    <div class="">
                                        <b>{{$account->name}}</b>
                                        <br>



                                        @if(strlen($free_course->title) > 38)
                                                {{mb_strimwidth($free_course->title,0,38)}}..
                                        @else
                                                {{$free_course->title}}
                                        @endif

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

		</div>
		</div>
        @foreach($courses as $course)
            <div class="modal fade" id="courseModal_{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
    <script>
        var $btn = $(this);
        $btn.button('loading');
        // simulating a timeout
        setTimeout(function () {
            $btn.button('reset');
        }, 1000);
    </script>
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
        .videoMainer{
            margin-top: 50px;

        }
        .tabs_control.active{
            background: #0075e1 !important;
            color: #fff !important;
        }
        .container{
            background: #f3f3f3 !important;
            height: 100%;
        }
        video{
            background-color: #000;
        }
        @media (max-width: 720px) {
            .videoMainer{
                margin-left: 0px!important;
                height: 240px !important;
                margin-right: 0px !important;

            }
            .public .row{
                padding-right: 25px !important;
            }
            .public .row .col-lg-4{
                padding-right: 0px;
            }
            .info button{
                margin-bottom: 10px;
            }
            .text_desc b{
                font-size: 1rem;
            }
            .course_author img{
                width: 50px !important;
                height: 50px !important;
            }


        }
    </style>
</body>
</html>
