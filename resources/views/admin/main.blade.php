@extends('layouts.admin')


@section('content')
    <div class="col-md-3">
        <div class="card bg-primary">
            Сумма покупок : {{$sum}} KZT
        </div>

    </div>
    <div class="col-md-3">
        <div class="card bg-danger">
            Количество пользователей : {{$count}}
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success">
            Количество курсов : {{$course_count}}
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-primary">
            Выводы
        </div>
    </div>
    <style>
        .card{
            padding: 5%;
        }
    </style>

@endsection
