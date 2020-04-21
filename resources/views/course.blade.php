@extends('layouts.user')
    @section('content')
<!DOCTYPE html>
<html>
<head>
	<title>Мои курсы</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('css/section.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/mycourse.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playball&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset("css/owl.carousel.min.css")}}">
	<link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/respons.css')}}">
</head>
<body>
	<div class="container container_course " style="padding-bottom: 0px !important;">
		<div class="profile">
			<div class="col-lg-4">
                    <div class="">
                        <div class="imager">
                            @if($user['avatar'] == null)
                                <img src="{{asset('images/image_avatar.svg')}}" alt="" class="face">
                            @else
                                <img src="{!! $user->avatar !!}" alt="" class="profile-avatar search-avatar face">

                            @endif
                            <a href="{{route('ViewStream',$course->id)}}" class="play_button_v2" >
                                <img src="{{asset('images/play.png')}}"  alt="">
                            </a>
                        </div>

                        <div class="text-center ml-auto">
                            <h2 class="mt-2">{{$user->name}}</h2>
                            <h5 class="text-dark">
                                {{$user->login}}
                            </h5>

                        </div>
                    </div>

			</div>
			<div class="col-lg-8" id="i8">
				<div class="info">
					<h1>{{$course->title}}</h1>
					<span>{{$course->description}}</span>





				</div>
                <div id="courseId" class="" style="display:none;">{{ $course->id }}</div>
			</div>
		</div>


	</div>
    <div class="container container_course">
        <div class="row">
            <div class="col-lg-12" id="i8">
                <div class="tabs">
                    <div class="mainer">


                         <div class="tabs_page ">
                            <div class="row">
                                <div class="col-lg-10   ">
                                    <div class="row">
                                        @foreach($videos as $video)

                                            <div class="col-lg-4 course_video col-12" style="display: block;"  data-toggle="modal" data-target="#modalVideo_{{$video->id}}">
                                                <div class="seven" style="background-image: url('{!! $video->image_path !!}');background-size: cover;">
                                                    <div class="seven_div" style="background-color: rgba(0,0,0,0.24)">
                                                        <span>{{$video->title}}</span>
                                                        <img src="{{asset('images/play.png')}}" class="play_button" alt="">


                                                    </div>
                                                </div>




                                            </div>
                                            <div class="modal fade" id="modalVideo_{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <video controls="controls" style="width: 100%;height: 400px;">
                                                                <source src="{{$video->video_path}}" type='video/mp4'>
                                                            </video>
                                                        </div>
                                                        <div class="modal-footer"  style="justify-content: flex-start !important;">

                                                            <div class=" course_author">
                                                                <img src="{{asset('images/profile.svg')}}" alt="">
                                                            </div>
                                                            <div class="">
                                                                {{$user->name}}
                                                                <br>
                                                                {{$user->login}}

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        @endforeach
                                    </div>
                                </div>



                                <div class="col-lg-4">

                                </div>


                            </div>

                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <img src="images/Rectangle.png">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h1>7 ДНЕВНЫЙ КУРС ПРО МАРКЕТИНГ</h1>
        <p>Повысите квалификацию в области управления маркетингом и освоите системный подход к увеличению и контролю потока клиентов.</p>
      </div>

    </div>
  </div>
</div>

    <script src="{{asset('js/socket.io.js')}}"></script>
    <script type="text/javascript">
        function viewStream() {
            let courseId = document.getElementById('courseId').innerText;
            let peerConnection;
            const config = {
                iceServers: [
                    {
                        urls: ["stun:stun.l.google.com:19302"]
                    }
                ]
            };
            $('#myModal1').modal('show');

            const socket = io('https://maccoo.kz:4000');
            const video = document.querySelector("video");

            socket.on("offer", (id, description) => {
                console.log('Watcher offer - ' + id);
                peerConnection = new RTCPeerConnection(config);
                peerConnection
                    .setRemoteDescription(description)
                    .then(() => peerConnection.createAnswer())
                    .then(sdp => peerConnection.setLocalDescription(sdp))
                    .then(() => {
                        socket.emit("answer", id, peerConnection.localDescription);
                    });
                peerConnection.ontrack = event => {
                    video.srcObject = event.streams[0];
                };
                peerConnection.onicecandidate = event => {
                    if (event.candidate) {
                        socket.emit("candidate", id, event.candidate);
                    }
                };
            });

            //
            socket.on("candidate", (id, candidate) => {
                console.log('Watcher candidate - ' + id);
                peerConnection
                    .addIceCandidate(new RTCIceCandidate(candidate))
                    .catch(e => console.error(e));
            });

            socket.on("connect", () => {
                socket.emit("watcher", courseId);
            });

            socket.on("broadcaster", () => {
                // console.log(broadcaster);
                socket.emit("watcher", courseId);
            });

            socket.on("disconnectPeer", () => {
                peerConnection.close();
            });

            window.onunload = window.onbeforeunload = () => {
                socket.close();
            };
        }


    </script>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>


  <script src="{{asset('js/owl.carousel.min.js')}}"></script>
  <script src="{{asset("js/script.js")}}"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        $('.tabs_control').on('click',function(e){
            e.preventDefault()
            $('.tabs_control.active').removeClass('active');
            $('.tabs_page.active').removeClass('active');
            $(this).addClass('active');

            $('.tabs').find('.tabs_page').eq($(this).index()).addClass('active');


        })


        $(function() {
            $( ".tabs_page" ).eq(0).addClass('active');
            $('.tabs_control').eq(0).addClass('active');

        });


    </script>
    <style>

        .play_button_v2{
            width: 40px;
            height: 40px;
            position: absolute;
            bottom:32%;
        }
        .play_button_v2 img{
            width: 40px;
            height: 40px;
        }
        .imager{
            margin-bottom: 20px;
        }
        .seven_div span{
            position: absolute;
            bottom:20px;
            left:40px;
            width: auto;
        }
        .container_course:nth-child(2){
            margin-bottom: 50px;
        }
        .image_of_video{
            filter: brightness(50%);
        }
        .tabs_control {
            cursor: pointer;
        }
        .play{

            height: 250px;
            margin-left: 0px;
        }
        .play_button{
            width: 50px !important;
            height: 50px !important;
            margin-top: -30px;
            margin-left: -25px;
        }
        .seven_div{
            display: flex;
            justify-content: center;
            align-items: center;

        }
        .tabs_panel{
            width: 100%;
            margin-right: 50px;
            justify-content: space-around;

        }
        .tabs_panel .tabs_control{
            white-space: pre;
            font-weight: 400;
            width: auto;
        }
        .tabs_control{
            margin-right: 0px;
        }
        .tabs_control.active{
            text-decoration: underline;

        }
        .profile{

        }
        .container.container_new{
            padding-bottom: 20px !important;
        }
        @media (min-width: 721px) {
            .profile .col-lg-4{
                display: flex;
                flex-direction: column;
                justify-content: center;

            }
            .col-lg-4 .text-center.ml-auto{
                margin-left: 0px !important;
                margin-right: 10px;

            }
            .imager{
                display: flex;
                justify-content: center;
                align-items: center;
                flex-flow: column;

            }
            .profile .col-lg-4{
                align-items: flex-end;
            }
            #i8{
                padding-right: 20%;
            }


        }
        .info{
            padding-bottom: 50px !important;
        }
        .seven{
            width: 100% !important;
        }
        @media (max-width: 720px) {

            .play{
                margin:15px 0px !important;
            }
            .mainer .tabs_page .col-lg-4{
                margin-top: 0px;
                padding-right: 0px;
            }
            .mainer .tabs_page .col-lg-4:nth-child(1){
                margin-top:25px;
            }
            .seven{
                margin-right: 0px !important;
                width: 100%;
            }
            .row{

            }
            .mainer{
                padding-bottom: 150px;
            }
            .profile{
                flex-direction: column;
            }
            .profile h2{
                font-size: 1.5rem;
            }
            .profile .col-lg-4{
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
            }
            .profile .col-lg-4 .text-center.ml-auto{
                margin-left: 0px !important;
            }
            .play_button_v2{
                width: 30px;
                height: 30px;
                position:relative;
                top:40px;
                right: 50%;
            }
            .play_button_v2 img{
                width: 30px;
                height: 30px;
            }
            .course_video{
                width: 100%;
            }




        }


    </style>
    <script>

    </script>
@endsection
</body>
</html>
