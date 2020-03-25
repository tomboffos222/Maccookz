@extends('layouts.admin')



@section('content')


    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>

                <th>Имя</th>
                <th>Логин</th>
                <th>Почта</th>
                <th>Пароль</th>
                <th>Телефон</th>
                <th>Статус</th>

            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>

                <td>{{$user->name}}</td>
                <td>{{$user->login}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->password}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->status}}</td>

            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        {{$users->links()}}
    </div>
    <style>
        .btn.btn-danger{
            margin-top: 10px;
        }
    </style>



@endsection
