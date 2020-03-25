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
    <div class="col-lg-12 pt-5 pb-5">
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

                    @if($loop->index == 0 || $loop->index == 10 )
                        <div class="wrapper">
                            <video  style="" data-toggle="modal" data-target="#modal_{{$video->id}}">
                                <source src="{!! $video->video_path !!}" type='video/ogg; codecs="theora, vorbis"'>
                            </video>
                            <div class="modal fade" id="modal_{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <video controls="controls" controlsList="nodownload" style="width: 100%;height: 400px;">
                                                <source src="{!! $video->video_path !!}" type='video/ogg; codecs="theora, vorbis"'>
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
                                            <div class="">
                                                {{$video->name}}
                                                <br>
                                                {{$video->login}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @elseif($loop->index == 9 || $loop->index ==11)
                        <div class="wrapper wrapper1">
                            <video  style="" data-toggle="modal" data-target="#modal_{{$video->id}}">
                                <source src="{!! $video->video_path !!}" type='video/ogg; codecs="theora, vorbis"'>
                            </video>
                            <div class="modal fade" id="modal_{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <video controls="controls" controlsList="nodownload" style="width: 100%;height: 400px;">
                                                <source src="{!! $video->video_path !!}" type='video/ogg; codecs="theora, vorbis"'>
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
                                            <div class="">
                                                {{$video->name}}
                                                <br>
                                                {{$video->login}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    @elseif($loop->index == 1  )


                        <div class="image-wrapper image-wrapper0">
                            <img src="{!! $video->img_path !!}" class="player_{{$video->id}}  active" alt="" height="200" width="100%"  data-toggle="modal" data-target="#modal_{{$video->id}}" >

                            <div class="modal fade" id="modal_{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <video controls="controls" controlsList="nodownload" style="width: 100%;height: 400px;">
                                                <source src="{!! $video->video_path !!}" type='video/ogg; codecs="theora, vorbis"'>
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
                                            <div class="">
                                                {{$video->name}}
                                                <br>
                                                {{$video->login}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($loop->index == 5  )


                        <div class="image-wrapper image-wrapper01">
                            <img src="{!! $video->img_path !!}" class="player_{{$video->id}}  active" alt="" height="200" width="100%"  data-toggle="modal" data-target="#modal_{{$video->id}}" >

                            <div class="modal fade" id="modal_{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <video controls="controls" controlsList="nodownload" style="width: 100%;height: 400px;">
                                                <source src="{!! $video->video_path !!}" type='video/ogg; codecs="theora, vorbis"'>
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
                                            <div class="">
                                                {{$video->name}}
                                                <br>
                                                {{$video->login}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($loop->index == 2 )



                        <div class="image-wrapper image-wrapper1">
                            <img src="{!! $video->img_path !!}" class="player_{{$video->id}}  active" alt="" height="200" width="100%"  data-toggle="modal" data-target="#modal_{{$video->id}}" >

                            <div class="modal fade" id="modal_{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <video controls="controls" controlsList="nodownload" style="width: 100%;height: 400px;">
                                                <source src="{!! $video->video_path !!}" type='video/ogg; codecs="theora, vorbis"'>
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
                                            <div class="">
                                                {{$video->name}}
                                                <br>
                                                {{$video->login}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($loop->index == 6 )



                        <div class="image-wrapper image-wrapper11">
                            <img src="{!! $video->img_path !!}" class="player_{{$video->id}}  active" alt="" height="200" width="100%"  data-toggle="modal" data-target="#modal_{{$video->id}}" >

                            <div class="modal fade" id="modal_{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <video controls="controls" controlsList="nodownload" style="width: 100%;height: 400px;">
                                                <source src="{!! $video->video_path !!}" type='video/ogg; codecs="theora, vorbis"'>
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
                                            <div class="">
                                                {{$video->name}}
                                                <br>
                                                {{$video->login}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($loop->index == 3 )



                        <div class="image-wrapper image-wrapper2">
                            <img src="{!! $video->img_path !!}" class="player_{{$video->id}}  active" alt="" height="200" width="100%"  data-toggle="modal" data-target="#modal_{{$video->id}}" >

                            <div class="modal fade" id="modal_{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <video controls="controls" controlsList="nodownload" style="width: 100%;height: 400px;">
                                                <source src="{!! $video->video_path !!}" type='video/ogg; codecs="theora, vorbis"'>
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
                                            <div class="">
                                                {{$video->name}}
                                                <br>
                                                {{$video->login}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($loop->index == 7 )



                        <div class="image-wrapper image-wrapper21">
                            <img src="{!! $video->img_path !!}" class="player_{{$video->id}}  active" alt="" height="200" width="100%"  data-toggle="modal" data-target="#modal_{{$video->id}}" >

                            <div class="modal fade" id="modal_{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <video controls="controls" controlsList="nodownload" style="width: 100%;height: 400px;">
                                                <source src="{!! $video->video_path !!}" type='video/ogg; codecs="theora, vorbis"'>
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
                                            <div class="">
                                                {{$video->name}}
                                                <br>
                                                {{$video->login}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($loop->index == 4 )



                        <div class="image-wrapper image-wrapper3 ">
                            <img src="{!! $video->img_path !!}" class="player_{{$video->id}}  active" alt="" height="200" width="100%"  data-toggle="modal" data-target="#modal_{{$video->id}}" >

                            <div class="modal fade" id="modal_{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <video controls="controls" controlsList="nodownload" style="width: 100%;height: 400px;">
                                                <source src="{!! $video->video_path !!}" type='video/ogg; codecs="theora, vorbis"'>
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
                                            <div class="">
                                                {{$video->name}}
                                                <br>
                                                {{$video->login}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($loop->index == 8 )



                        <div class="image-wrapper image-wrapper31 ">
                            <img src="{!! $video->img_path !!}" class="player_{{$video->id}}  active" alt="" height="200" width="100%"  data-toggle="modal" data-target="#modal_{{$video->id}}" >

                            <div class="modal fade" id="modal_{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <video controls="controls" controlsList="nodownload" style="width: 100%;height: 400px;">
                                                <source src="{!! $video->video_path !!}" type='video/ogg; codecs="theora, vorbis"'>
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
                                            <div class="">
                                                {{$video->name}}
                                                <br>
                                                {{$video->login}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                @endforeach



			</div>



	  </div>
          <div class="col-lg-12">
              {{$videos->links()}}
          </div>


	  </div>
    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <style>
        .col-lg-12.left{
            display: grid;


            grid-template-rows: 250px 250px;
            grid-auto-flow: column;
            margin-bottom: 120px;


        }
        .image_wrapper{
            height: 200px;
            margin: 5px !important;



        }
        .image-wrapper0 {


            margin: 5px;

            grid-column: 2;
            grid-row: 1;

        }
        .image-wrapper2 {


            margin: 5px;

            grid-column: 3;
            grid-row: 1;

        }
        .image-wrapper11.image-wrapper{
            grid-column: 2;
            grid-row: 3;
            margin: 5px !important;
        }
        .image-wrapper3 {


            margin: 5px;

            grid-column: 3;
            grid-row: 2;

        }
        .image-wrapper1{


            margin: 5px;

            grid-column: 2;
            grid-row: 2;

        }

        .wrapper{
            margin: 5px;
            grid-row: 1/3;
        }
        .image-wrapper.image-wrapper01{
            grid-row: 3;
            grid-column: 1;
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

        .col-lg-12.left img:nth-child(odd) {
            padding-left:5px;

        }

        .col-lg-12.left video{
            width: 100% !important;
            grid-column-start: 1;
            grid-column-end: 2;
            grid-row-start: row1-start;
            grid-row-end: 2;



        }
        .image-wrapper21.image-wrapper{
            grid-column: 1;
            grid-row: 4;
            margin: 5px !important;
        }
        .image-wrapper31.image-wrapper{
            grid-column: 2;
            grid-row: 4;
            margin: 5px !important;
        }
        .wrapper.wrapper1{
            grid-column: 3 !important;
            grid-row: 3/5 !important;
        }
        @media (max-width: 720px) {
            .col-lg-12.left{
                grid-template-rows: auto;
            }



        }

    </style>
    <script>

        $(document).ready(function() {
            $(" video").on("mouseover", function(event) {
                this.play();

            }).on('mouseout', function(event) {
                this.pause();

            });
        })
    </script>
@endsection
