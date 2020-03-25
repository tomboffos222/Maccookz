@extends('layouts.admin')



@section('content')


    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>

                <th>Тип</th>

                <th>Название</th>
                <th>Начало</th>
                <th>Конец даты</th>
                <th>Описание</th>
                <th>Цена</th>
                <th>Покупки</th>
                <th>Просмотры</th>
                <th>Счет</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($courses as $course)
            <tr>

                <td>{{$course->course_type}}</td>
                <td>{{$course->title}}</td>
                <td>{{$course->start_date}}</td>
                <td>{{$course->end_date}}</td>
                <td>{{mb_strimwidth($course->description,0,20)}}</td>
                <td>{{$course->price}} {{$course->currency}}</td>
                <td>{{$course->purchases}}</td>

                <td>{{$course->views}}</td>
                <td>{{$course->bill}} {{$course->currency}}</td>
                <td>


                    <a href="" class="btn btn-danger">Заблокировать</a>

                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        {{$courses->links()}}
    </div>
    <style>
        .btn.btn-danger{

        }
    </style>



@endsection
