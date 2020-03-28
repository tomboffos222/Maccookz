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
					  <p>Добавить<br> Бесплатное видео</p>
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
                                    <option value="1">Обучение</option>
                                    <option value="2">Развлечения</option>
                                </select>
                                <label for="">Адрес</label>
                                <input type="text" class="form-control" name="address">
                                <label for="">Дата начала и окончания курса</label>
                                <div class="d-flex">
                                    <input type="date" class="form-control w-50" name="start_date">
                                    <input type="date" class="form-control w-50" name="end_date">
                                </div>
                                <label for="">Описание курса</label>
                                <textarea class="form-control" name="description"></textarea>
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
                            <span>Видео не должен превышать 120 мб<br>Формат:MP4,WMV,MOV<br>Размер фона: 988 x 649 или 900 х 1023</span>
                            <input type="text" placeholder="Заголовок видео" name="title">
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

                        <button type="submit" class="btn btn-primary">Загрузить видео</button>
                    </div>
                    </form>
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
</body>

    @endsection


<!-- Modal1 -->






