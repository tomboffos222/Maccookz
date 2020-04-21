@extends('layouts.user')

@section('content')
    <!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Главный</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/look.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playball&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/respons.css">
</head>
<body>
<div class="container">

    <div class="col-lg-12 pt-3 pb-3 ">
        <img src="images/MaccooBlack.svg" alt="">
    </div>
	  <div class="container">
		  <div class="row">
              @php $i = 0; @endphp
			<div class="col-lg-12 col-12 left">

                @foreach($videos as $video)


                    @php
                        $counter = $loop->index*10 ; $counter1 = $loop->iteration * 10 +1;


                    @endphp


                    @if($loop->index == 0  )
                        <div class="wrapper">

                            <video playsinline preloader="yes" poster="{{ $video->img_path }}"  style="" data-toggle="modal" class="video" data-target="#modal_{{$video->course_id}}">
                                <source src="{!! $video->video_path !!}" >

                            </video>
                            <p class="text_on_video">
                                {{mb_strimwidth($video->title,0,40)}}

                            </p>
                            <div class="modal fade" id="modal_{{$video->course_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <video playsinline preloader="yes" controls="controls" controlsList="nodownload" style="width: 100%;height: 400px;">
                                                <source src="{!! $video->video_path !!}" >
                                            </video>
                                        </div>
                                        <div class="modal-footer"  style="justify-content: flex-start">


                                            <div class=" course_author">
                                                @if($video['avatar'] == null)
                                                    <img src="{{asset('images/image_avatar.svg')}}" alt="" class="face">
                                                @else
                                                    <img src="{!! $video->avatar !!}" alt="" class="profile-avatar search-avatar face">
                                                @endif
                                            </div>
                                            <a href="{{route('AccountView',$video->id)}}" class="text_dark">
                                            <div class="text-black-50 text_desc">
                                                <b>{{$video->name}}</b>
                                                <br>
                                                @if(strlen($video->title) > 38)
                                                    {{mb_strimwidth($video->title,0,38)}}..
                                                @else
                                                    {{$video->title}}
                                                @endif
                                            </div>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @elseif($loop->index == 9 )
                        <div class="wrapper wrapper1">

                            <video playsinline preloader="yes" poster="{!! $video->img_path !!}"  style="" data-toggle="modal" data-target="#modal_{{$video->course_id}}">
                                <source src="{!! $video->video_path !!}" >
                            </video>
                            <p class="text_on_video">
                                {{mb_strimwidth($video->title,0,40)}}

                            </p>


                            <div class="modal fade" id="modal_{{$video->course_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <video playsinline preloader="yes" controls="controls" controlsList="nodownload" style="width: 100%;height: 400px;">
                                                <source src="{!! $video->video_path !!}" >
                                            </video>

                                        </div>
                                        <div class="modal-footer"  style="justify-content: flex-start">

                                            <div class=" course_author">
                                                @if($video['avatar'] == null)
                                                    <img src="{{asset('images/image_avatar.svg')}}" alt="" class="face">
                                                @else
                                                    <img src="{!! $video->avatar !!}" alt="" class="profile-avatar search-avatar face">
                                                @endif
                                            </div>
                                            <a href="{{route('AccountView',$video->id)}}" class="text_dark">
                                            <div class="text_desc">
                                                <b>{{$video->name}}</b>
                                                <br>
                                                @if(strlen($video->title) > 38)
                                                {{mb_strimwidth($video->title,0,38)}}..
                                                @else
                                                {{$video->title}}
                                                @endif
                                            </div>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                    @else



                        <div class="image-wrapper image-wrapper31 ">
                            <div class="videoMainer" style="display: block;background-image: url('{!! $video->img_path !!}');"  data-toggle="modal" data-target="#modal_{{$video->course_id}}">
                                <div>




                                </div>
                            </div>

                            <div class="modal fade" id="modal_{{$video->course_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered  " role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <video playsinline preloader="yes" controls="controls" controlsList="nodownload" style="width: 100%;height: 400px;">
                                                <source src="{!! $video->video_path !!}" >
                                            </video>
                                        </div>
                                        <div class="modal-footer"  style="justify-content: flex-start">

                                            <div class=" course_author">
                                                @if($video['avatar'] == null)
                                                    <img src="{{asset('images/image_avatar.svg')}}" alt="" class="face">
                                                @else
                                                    <img src="{!! $video->avatar !!}" alt="" class="profile-avatar search-avatar face">
                                                @endif
                                            </div>
                                            <a href="{{route('AccountView',$video->id)}}" class="text_dark">
                                            <div class="text_desc">

                                                <b>{{$video->name}}</b>
                                                <br>
                                                @if(strlen($video->title) > 38)
                                                    {{mb_strimwidth($video->title,0,38)}}..
                                                @else
                                                    {{$video->title}}
                                                @endif
                                            </div>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                @endforeach



			</div>



	  </div>


	  </div>
    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <style>
        .videoMainer{
            width: 100%;
            margin-left: 0px;
            height: 100%;
            border-radius: 0px !important;
            background-size: cover;
            background-position: center  left;
            background-repeat: no-repeat;
        }
        .videoMainer> div{
            border-radius: 0px;
        }
        .col-lg-12.left{
            display: grid;




            grid-auto-rows: 300px;



            margin-bottom: 120px;


        }
        .container{
            max-width: 95%;
        }
        .image_wrapper{
            height: 200px;
            margin: 5px !important;



        }

        .wrapper{
            margin: 5px;
            grid-row: 1/3;
        }
        .image-wrapper{

            margin: 5px !important;
        }
         video{
            height: 100%;
            background-color: black !important; /* or whatever you want */
        }
         .modal-footer img{
             width: 50px !important;
             height: 50px !important;
         }

        .image-wrapper img{
            width: 100%;

            height: 100%;
        }



        .col-lg-12.left video{
            width: 100% !important;



        }

        .wrapper.wrapper1{
            grid-column: 3 !important;
            grid-row: 3/5 !important;
        }
        @media (max-width: 720px) {
            .videoMainer{
                width: 100%;
                margin-left: 0px;
                height: 100%;
                border-radius: 0px !important;
                background-size: cover;
                background-position: center  center;
                background-repeat: no-repeat;
            }
            .col-lg-12.left{
                grid-template-columns: repeat(2, 1fr);
                column-count: 2;
                padding-left: 5px;
                padding-right: 5px;


                grid-auto-rows: 150px;
            }
            .wrapper.wrapper1{

                grid-column: 2 !important;
                grid-row: 3/5 !important;
            }
            .wrapper{
                margin:1px;
                position: relative;
                top:25px;
            }
            .image-wrapper{
                margin: 1px !important;
            }
            .wrapper p {
                font-size: 9px ;
            }
            .container{
                max-width: 100%;
                padding-left: 5px;
                padding-right: 5px;
            }

        }
        @media (min-width: 721px) {
            .col-lg-12.left{
                 grid-template-columns: repeat(3, 1fr);
            }


        }
        .text_dark .text-black-50 , .text_dark div{
            color: #000;

        }
        .text_dark:hover{
            text-decoration: none;
        }

        .text_on_video{
            position: relative;

            font-family: 'Roboto';
            font-style: normal;
            font-weight: bold;
            font-size: 19px;
            line-height: 22px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #fff;
            z-index: 10;
            bottom:70px;
            left: 15px;
            width: 100%;

            padding-right: 15%;
        }
        .modal-backdrop{

            background-color: #000;
        }
        .modal-backdrop.show{
            opacity: .7 !important;
        }
        .modal-backdrop.in{
            opacity: 1 !important;
        }
        @media (max-width: 720px) {
            .modal-backdrop{

                background-color: #000;
            }
            .modal-backdrop.in{
                opacity: 1 !important;
            }
            .text_desc{
                font-size: 14px;
            }
            .text_desc b{
                font-size: 1rem;
            }


        }
        .container{
            overflow: hidden;
        }
        .modal-body{
            padding: 0px;
        }
        .modal-footer{
            border-top:none;
        }
    </style>
    <script>

        $(document).ready(function() {



            $("video").on("mouseover", function(event) {
                this.play();

            }).on('mouseout', function(event) {
                this.pause();

            });
        })

    </script>
@endsection
