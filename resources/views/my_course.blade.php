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
				<div class="d-flex " style="flex-flow: column;align-items: center;">
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
                        <button class="btn btn-primary">Скопировать ссылку</button>
                    </div>
                </div>
			</div>
			<div class="col-lg-8" id="i8">
				<div class="info">
					<h1>{{$course->title}}</h1>
					<span>{{$course->description}}</span>


                    <div class="flex  course_cards mt-3 mb-5">
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

                        </div>

                    </div>
				</div>

			</div>
		</div>


	</div>
    <div class="container container_course">
        <div class="row">
            <div class="col-lg-4 online_translation">
                <div class="text-center">
                    <img src="{{asset('images/tube.svg')}}" alt="" class="mb-4">
                    <h5 class="text-white text-center">
                        Онлайн трансляция <br>
                        скоро!
                    </h5>
                </div>
            </div>
            <div class="col-lg-8" id="i8">
                <div class="tabs">
                    <div class="mainer">
                        <div class="tabs_panel">
                            @foreach($categories as $category)
                                <div class="tabs_control active">{{$category->name}}</div>
                            @endforeach









                        </div>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#courseCategory">Добавить категорию</button>
                        <div class="modal fade" id="courseCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5>
                                            Добавить категорию для курса {{$course->title}}
                                        </h5>
                                    </div>
                                    <div class="modal-body">

                                        <form action="{{route('CategoryCourseAdd')}}" method="post">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <input class="form-control"  placeholder="Имя курса" name="name" >
                                                <input type="hidden" name="course_id" value="{{$course->id}}">
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


                                <div class=" col-lg-4 play text-center">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_{{$category->id}}">
                                        <img src="{{asset('images/pplay.svg')}}" alt="">
                                        <p>Добавить<br> Бесплатное видео</p>
                                    </button>
                                    <div class="modal fade" id="exampleModal_{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                            <input type="hidden" name="category_id" value="{{$category->id}}">
                                                            <input type="hidden" name="course_id" value="{{$course->id}}">
                                                            <i class="material-icons">Фон видео</i>
                                                            <span class="title">Добавить видео</span>
                                                            <input type="file" class="kot" name="video">
                                                        </label>
                                                        <label class="label">
                                                            <i class="material-icons">Файл не выбран</i>
                                                            <span class="title">Выбрать картинку</span>
                                                            <input type="file" class="kot" name="img">
                                                        </label>

                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="submit" class="btn btn-primary">Загрузить видео</button>
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
            $('.tabs_page.active').removeClass('active');
            $(this).addClass('active');
            $('.tabs').find('.tabs_page').eq($(this).index()).addClass('active');


        })


        $(function() {
            $( ".tabs_page" ).eq(0).addClass('active');
            $('.tabs_control').eq(1).addClass('active');

        });


    </script>
    <style>
        .image_of_video{
            filter: brightness(50%);
        }
        .tabs_control {
            cursor: pointer;
            width: auto;
            white-space: pre;
            font-weight: 400 !important;
            font-size: 15px;
        }
        .play{

            height: 250px;
            margin-left: 0px;
        }
        .mainer button.btn.btn-primary{

        }
    </style>
@endsection
</body>
</html>
