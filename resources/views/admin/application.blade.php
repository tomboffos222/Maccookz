@extends('layouts.admin')



@section('content')


    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Статус</th>
                <th>Тип</th>
                <th>Имя орг</th>
                <th>Инстаграм</th>
                <th>ИИН</th>
                <th>БИК</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Почта</th>
                <th>Телефон</th>


            </tr>
            </thead>
            <tbody>
            @foreach($speakers as $speaker)
            <tr>
                <td>{{$speaker->status}}</td>
                <td>{{$speaker->organization_type}}</td>
                <td>{{$speaker->organization_name}}</td>
                <td>{{$speaker->instagram}}</td>
                <td>{{$speaker->bill}}</td>
                <td>{{$speaker->id_company}}</td>
                <td>{{$speaker->name}}</td>
                <td>{{$speaker->last_name}}</td>
                <td>{{$speaker->email}}</td>
                <td>{{$speaker->phone}}</td>
                @if($speaker->status == 'wait')
                <td>
                    <a href="{{route('admin.SpeakerApprove',$speaker->id)}}" class="btn btn-success">Одобрить</a>
                    <br>
                    <a href="" class="btn btn-danger">Отклонить</a>

                </td>
                    @endif
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        {{$speakers->links()}}
    </div>
    <style>
        .btn.btn-danger{
            margin-top: 10px;
        }
    </style>



@endsection
