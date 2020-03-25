@extends('layouts.user')

    @section('content')

<!DOCTYPE html>
<html>
<head>
	<title>Модерация</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/moderation.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="css/respons.css">
</head>
<body>
	<div class="container">
		<div class="col-lg-12" id="fluid">

			<h5>ПРОЙТИ МОДЕРАЦИЮ</h5>
                <form action="{{route('StoreModeration')}}" method="get">
                    <div class="type">
                        <div class="ip">
                            <input type="radio" name="organization_type" value="IP">
                            <p>ИП</p>
                        </div>
                        <div class="too">
                            <input type="radio" name="organization_type" value="TOO">
                            <p>ТОО</p>
                        </div>
                    </div>

                    <div class="intypes">
                      <input type="text"  placeholder="Название компаний" name="organization_name">
                      <input type="text" placeholder="instagram" name="instagram">
                      <input type="text" placeholder="ИИН/БИН" name="bill">
                      <input type="text" placeholder="ИИК" name="id_company">
                      <input type="text" placeholder="Имя"  name="name">
                      <input type="text" placeholder="Фамилия"  name="last_name">
                      <input type="text" placeholder="Электронная почта" name="email">
                      <input type="text" placeholder="+7 (_ _ _)  _ _ _   _ _   _ _"  name="phone">
                      <p>Нажимая Зарегистрировать компанию<br> вы потверждаете, что ознакомлены<br> и полносьтю согласгы<br> с <a href=""> условиями использования сайта.</a></p>
                      <button type="submit" class="btn btn-primary" >Отправить на модерацию</button>
                    </div>
                </form>
		</div>
		<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h1>СПАСИБО ЗАЯВКА<br> ПРИНЯТО!!!</h1>
        <img src="images/galoch.svg" alt="">
        <p>ЗАЯВКА ОБРАВАТЫВАЕТСЯ В ТЕЧЕНИЕ 1-2 ДНЯ<br> ОТВЕТ ПРИХОДИТЬ В УКАЗАННЫЙ<br> ВАШ ЭЛЕКТРОННЫЙ АДРЕС</p>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>


  <script src="js/owl.carousel.min.js"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endsection
</body>
</html>
