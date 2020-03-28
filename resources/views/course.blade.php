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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset("css/owl.carousel.min.css")}}">
	<link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/respons.css')}}">
</head>
<body>
	<div class="container container_course">
		<div class="profile">
			<div class="col-lg-4">
				<div class="">
                    @if($user['avatar'] == null)
                        <img src="{{asset('images/image_avatar.svg')}}" alt="" class="face">
                    @else
                        <img src="{!! $user->avatar !!}" alt="" class="profile-avatar search-avatar face">
                    @endif
                    <div class="text-center ml-auto">
                        <h2 class="mt-2">{{$user->name}}</h2>
                        <h5 class="text-dark">
                            {{$user->login}}
                        </h5>

                    </div>
                </div>
			</div>
			<div class="col-lg-8" id="i8">
				<div class="info">
					<h1>{{$course->title}}</h1>
					<span>{{$course->description}}</span>

                    <div class="text-center w-50 online_translation_one p-3 mt-3 mb-3" style="background: #3B3B3B;">
                        <img src="{{asset('images/tube.svg')}}" alt="" class="mb-4">
                        <h5 class="text-white text-center">
                            Онлайн трансляция <br>
                            скоро!
                        </h5>
                    </div>

				</div>

			</div>
		</div>


	</div>
    <div class="container container_course">
        <div class="row">
            <div class="col-lg-12" id="i8">
                <div class="tabs">
                    <div class="mainer">
                        <div class="tabs_panel">
                            @foreach($categories as $category)
                                <div class="tabs_control ">{{$category->name}}</div>
                            @endforeach









                        </div>

                        @foreach($categories as $category)
                         <div class="tabs_page ">
                            <div class="row">
                                @foreach($videos as $video)
                                    @if($video['category_id'] == $category['id'])
                                        <div class="col-lg-4 course_video col-12" style="display: block;"  data-toggle="modal" data-target="#modalVideo">

                                            <img src="{{$video->image_path}}" class="image_of_video" alt="" height="200" width="100%" style="width: 100%;height: 250px;    ">



                                            <div class="modal fade" id="modalVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <video controls="controls" style="width: 100%;height: 400px;">
                                                                <source src="{{$video->video_path}}" type='video/ogg; codecs="theora, vorbis"'>
                                                            </video>
                                                        </div>
                                                        <div class="modal-footer"  style="justify-content: flex-start !important;">

                                                            <div class=" course_author">
                                                                <img src="{{asset('images/profile.svg')}}" alt="">
                                                            </div>
                                                            <div class="">
                                                                {{$user->name}}
                                                                <br>
                                                                {{$user->login}}

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @endforeach



                                <div class="col-lg-12">

                                </div>



                            </div>

                        </div>
                        @endforeach


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

<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>


  <script src="{{asset('js/owl.carousel.min.js')}}"></script>
  <script src="{{asset("js/script.js")}}"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        $('.tabs_control').on('click',function(e){
            e.preventDefault()
            $('.tabs_control.active').removeClass('active');
            $('.tabs_page.active').removeClass('active');
            $(this).addClass('active');

            $('.tabs').find('.tabs_page').eq($(this).index()).addClass('active');


        })


        $(function() {
            $( ".tabs_page" ).eq(0).addClass('active');
            $('.tabs_control').eq(0).addClass('active');

        });


    </script>
    <style>
        .container_course:nth-child(2){
            margin-bottom: 50px;
        }
        .image_of_video{
            filter: brightness(50%);
        }
        .tabs_control {
            cursor: pointer;
        }
        .play{

            height: 250px;
            margin-left: 0px;
        }
        .tabs_panel{
            width: 100%;
            margin-right: 50px;
            justify-content: space-around;

        }
        .tabs_panel .tabs_control{
            white-space: pre;
            font-weight: 400;
            width: auto;
        }
        .tabs_control{
            margin-right: 0px;
        }
        .tabs_control.active{
            text-decoration: underline;

        }
    </style>
@endsection
</body>
</html>
