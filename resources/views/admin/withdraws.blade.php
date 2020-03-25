@extends('layouts.admin')



@section('content')


    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id пользователя</th>
                <th>Id курса</th>
                <th>Сумма</th>
                <th>Банк счет</th>
                <th>Каспи голд</th>
                <th>Дата</th>
                <th>Статус</th>
                <th>Действия</th>



            </tr>
            </thead>
            <tbody>
            @foreach($withdraws as $withdraw)
                <tr>
                    <td>{{$withdraw->user_id}}</td>
                    <td>{{$withdraw->course_id}}</td>
                    <td>{{$withdraw->amount}}</td>
                    <td>{{$withdraw->bill}}</td>
                    <td>{{$withdraw->kaspy_number}}</td>
                    <td>{{$withdraw->created_at}}</td>
                    <td>{{$withdraw->status}}</td>
                    <td>
                        <a href="{{route('admin.ApproveWithdraw',$withdraw->id)}}" class="btn btn-success">Одобрить</a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        {{$withdraws->links()}}
    </div>
    <style>
        .btn.btn-danger{
            margin-top: 10px;
        }
    </style>



@endsection
