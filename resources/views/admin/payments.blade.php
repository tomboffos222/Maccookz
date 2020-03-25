@extends('layouts.admin')



@section('content')


    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>

                <th>Id покупателя</th>
                <th>Id курса</th>
                <th>Цена</th>
                <th>Куплено</th>



            </tr>
            </thead>
            <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>
                    {{$payment->user_id}}

                </td>
                <td>
                    {{$payment->course_id}}
                </td>
                <td>
                    {{$payment->price}}
                </td>
                <td>
                    {{$payment->updated_at}}
                </td>

            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        {{$payments->links()}}
    </div>
    <style>
        .btn.btn-danger{
            margin-top: 10px;
        }
    </style>



@endsection
