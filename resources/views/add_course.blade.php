@extends('layouts.user')
@section('content')
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{asset('css/section.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset('css/respons.css')}}">
</head>
<body>
	<div class="container">

		<div class="col-lg-12">
			<h5>ВЫБЕРИТЕ РАЗДЕЛ</h5>
			<div class="choice">
				<div class="course">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
					  <img src="{{asset('images/chel.svg')}}" alt="">
					  <p>Добавить<br> новый курс</p>
					  </button>
				</div>
				<div class="play">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
					  <img src="{{asset('images/pplay.svg')}}" alt="">
					  <p>Добавить<br> публикацию</p>
					</button>
				</div>
			</div>
		</div>
        <div class="modal fade modaler" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ДОБАВИТЬ НОВЫЙ КУРС</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('PrivateCourse')}}" method="post" enctype="multipart/form-data" >
                        <div class="modal-body">

                                {{csrf_field()}}
                                <div class="numpy">
                                    <div class="on">
                                        <input type="checkbox" name="course_type" value="online">
                                        <p>Онлайн</p>
                                    </div>
                                    <div class="of">
                                        <input type="checkbox" name="course_type" value="offline">
                                        <p>Офлайн</p>
                                    </div>
                                </div>
                                <label for="">Выберите название курса</label>
                                <input type="text"  class="form-control" name="title">
                                <label for="">Выберите категорию курса</label>
                                <select name="category" id="" class="form-control" >
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                                <label for="">Адрес</label>
                                <input type="text" class="form-control" name="address">
                                <label for="">Дата начала и окончания курса</label>
                                <div class="d-flex">
                                    <input type="date" class="form-control w-50" name="start_date">
                                    <input type="date" class="form-control w-50" name="end_date">
                                </div>
                                <label for="">Описание курса</label>
                                <textarea id="summernote" class="form-control" name="description"></textarea>
                                <label for="">Цена</label>
                                <div class="d-flex">
                                    <input type="number" class="form-control w-75" style="border-radius:5px 0px 0px 5px;" name="price">
                                    <select name="currency" id="" class="form-control w-25" style="border-radius:0px 5px 5px 0px;" name="currency">
                                        <option value="KZT">KZT</option>

                                        <option value="RUB">RUB</option>
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



        <!-- Modal2 -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('FreeCourse')}}" enctype="multipart/form-data" method="post">
                        {{csrf_field()}}
                    <div class="modal-body2">


                            <h5>Загрузите видео</h5>
                            <span>Видео не должен превышать 450 мб<br>Формат:MP4,WMV,MOV<br>Размер фона: 988 x 649 или 900 х 1023</span>
                            <input type="text" placeholder="Заголовок видео" name="title">
                            <label class="label">
                                <i class="material-icons" id="new">Видео</i>
                                <span class="title" > Добавить видео</span>
                                <input type="file" class="kot" id="free_image" name="video">
                            </label>
                            <label class="label">
                                <i class="material-icons" id="new_video">Фоновая картина</i>
                                <span class="title">Выбрать картинку</span>
                                <input type="file" class="kot" id="free_video" name="img">
                            </label>

                    </div>
                    <div class="modal-footer">

                        <button type="submit" data-loading-text="Отправляется..." class="btn btn-primary">Загрузить видео</button>
                    </div>
                    </form>

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

    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>


    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
</body>
<script>
    $(".btn").on('click', function () {
        var dataLoadingText = $(this).attr("data-loading-text");
        if (typeof dataLoadingText !== typeof undefined && dataLoadingText !== false) {
            console.log(dataLoadingText);
            $('#exampleModal2').modal('toggle');
            $('#myModal').modal('show');



        }
    });
    $('#summernote').summernote({
        airMode: true
    });
    $('#myModal1').modal('show');
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

    .lds-dual-ring {
        display: inline-block;
        width: 32px;
        height: 32px;
    }
    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 32px;
        height: 32px;
        margin: 8px;
        border-radius: 50%;
        border: 6px solid #cef;
        border-color: #cef transparent #cef transparent;
        animation: lds-dual-ring 1.2s linear infinite;
    }
    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
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


</style>
    @endsection


<!-- Modal1 -->






