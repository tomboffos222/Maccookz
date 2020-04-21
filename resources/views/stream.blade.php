
<!DOCTYPE html>
<html>
<head>
	<title>Онлайн трансляция</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{asset('css/profile.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playball&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
	<link rel="stylesheet" href="{{asset("css/respons.css")}}">
    <style>
        video {
            width: 60%;
            height: auto;
            /* position: absolute; */
            display: block;
            top: 0;
            left: 0;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container new">
        <div class="row">
            <div class="col-lg-12">
                <div class="arrow_left">
                    <i class="material-icons medium " onclick="window.location.href='{{route('Main')}}'">
                        keyboard_arrow_left
                    </i>

                </div>

                <img src="{{asset('/images/MaccooBlack.svg')}}" alt="">
                <div class="bg-danger h-75 pl-2 pr-2 pt-1 ml-2 live_text" >
                    LIVE
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="d-flex justify-content-start position-absolute mt-3 ml-4 info_stream">
                    <div class="bg-danger text-white p-2">
                        В эфире
                    </div>
                    <div class="bg-dark text-white p-2" >
                        0:13
                    </div>
                    <div class="d-flex align-items-center text-white ml-3">
                        <i class="material-icons mr-1 text-primary">people</i>
                        0

                    </div>
                </div>
                <video playsinline autoplay>


                </video>
                <div class="stream_panel" style="padding-bottom:2%;margin-top:2%;" >

                        <i class="material-icons medium">settings_voice</i>
                    <img src="{{asset('images/microphone_red.png')}}" alt="">

                    <button onclick="startStream()" class="btn btn-primary stream_button">Начать трансляцию</button>
                </div>
                <div id="courseId" style="display:none;">{{ $course->id }}</div>
            </div>
            <div class="col-lg-4">
                <div class="chat_header">
                    Чат

                </div>
                <div class="message">
                    <div class="message_main">
                        @if($user['avatar'] == null)
                            <img src="{{asset('images/image_avatar.svg')}}" alt="" class="face">
                        @else
                            <img src="{!! $user->avatar !!}" alt="" class="profile-avatar face">
                        @endif
                        <div class="messages msg_sent">
                            qwdwqd


                        </div>

                    </div>
                    <div class="message_main from">

                        <div class="messages msg_sent msg_from">
                            qwdwqd


                        </div>
                        @if($user['avatar'] == null)
                            <img src="{{asset('images/image_avatar.svg')}}" alt="" class="face">
                        @else
                            <img src="{!! $user->avatar !!}" alt="" class="profile-avatar face">
                        @endif

                    </div>

                </div>
                <div class="send_message_form">
                    <div class="icon_name">
                        @if($user['avatar'] == null)
                            <img src="{{asset('images/image_avatar.svg')}}" alt="" class="face">
                        @else
                            <img src="{!! $user->avatar !!}" alt="" class="profile-avatar face">
                        @endif

                        {{$user->name}}
                    </div>
                    <div class="chat_form">
                        <div class="add_button">
                            +
                        </div>
                        <div class="form">
                            <form action="">
                                <input type="text" class="form-control ">

                                <button type="submit" class="bg-transparent border-0 text-white">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </button>




                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

<script src="{{asset('js/socket.io.js')}}"></script>
<script type="text/javascript">

function startStream() {



    let courseId = document.getElementById('courseId').innerText;
    const peerConnections = {};
    const config = {
    iceServers: [
        {
        urls: ["stun:stun.l.google.com:19302"]
        }
    ]
    };

    const socket = io('https://maccoo.kz:4000');
    const video = document.querySelector("video");

    // Media contrains
    const constraints = {
        video: true,
        audio: true,
    };
    navigator.mediaDevices
        .getUserMedia(constraints)
        .then(stream => {
            video.srcObject = stream;
            socket.emit("broadcaster", courseId);
        })
        .catch(error => console.error(error));

    // P2P
    socket.on("watcher", id => {
        console.log('Stream watcher - '+id);

        const peerConnection = new RTCPeerConnection(config);
        peerConnections[id] = peerConnection;

        let stream = video.srcObject;
        stream.getTracks().forEach(track => peerConnection.addTrack(track, stream));

        peerConnection.onicecandidate = event => {
            if (event.candidate) {
                socket.emit("candidate", id, event.candidate);
            }
        };

        peerConnection
            .createOffer()
            .then(sdp => peerConnection.setLocalDescription(sdp))
            .then(() => {
            socket.emit("offer", id, peerConnection.localDescription);
        });
    });

    socket.on("answer", (id, description) => {
        console.log('Stream answer - '+id);
        peerConnections[id].setRemoteDescription(description);
    });

    socket.on("candidate", (id, candidate) => {
        console.log('Stream candidate - '+id);
        peerConnections[id].addIceCandidate(new RTCIceCandidate(candidate));
    });

    // Disconnect
    socket.on("disconnectPeer", id => {
        console.log('Stream disconnect - '+id);
        peerConnections[id].close();
        delete peerConnections[id];
    });
}


</script>
<style>
    .msg_from.msg_sent{
        background: #C7E4FF;
        border-radius: 3px;


    }

    .from{
        justify-content: flex-end;
    }
    .message_main{
        display: flex;
        padding: 10px;
    }
    .message_main.from .profile-avatar{
        margin-right: 0px!important;
        margin-left: 10px !important;
    }
    .message_main .profile-avatar{
        margin-right: 10px !important;
    }
    .msg_receive{
        padding-left:0;
        margin-left:0;
    }

    .msg_sent{
        padding-bottom:20px !important;
        margin-right:0;
        width: 50%;
    }
    .messages {
        background: white;
        padding: 10px;
        border-radius: 2px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        max-width:100%;
    }
    .chat_form{
        display: flex;
        width: 100%;
    }
    .form{
        margin-left: 50px;
        width: 100%;
    }
    .form form{
        display: flex;
    }
    .form input.form-control{
        background-color: transparent;
        border:none;
        width: 80%;
        margin-right: 10px;
        border-bottom: 1px solid #EFEFEF;
        border-radius: 0px;

    }
    .icon_name{
        display: flex;
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 20px;
        line-height: 23px;
        text-align: center;
        letter-spacing: 0.04em;

        color: #FFFFFF;
    }
    .chat_form{
        padding-top: 10px;
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 40px;
        line-height: 47px;
        /* identical to box height */


        letter-spacing: 0.04em;

        color: #FFFFFF;
    }
    .live_text{

        font-style: normal;
        font-weight: bold;
        font-size: 25px;
        line-height: 28px;
        text-align: center;

        color: #FFFFFF;



    }
    .col-lg-4 .profile-avatar ,.face{
        width: 40px ;
        margin-right: 22px;
        height: 40px;
    }
    .send_message_form{
        padding-top: 22px;
        padding-bottom: 4px;
        height: 126px;
        background: #3D3D3D;
        padding-left: 20px;
    }
    .message{
        background: #EAEFF4;
        height:85%;
        overflow-y: auto;

    }
    .chat_header{
        background: #3D3D3D;
        padding: 12px 19px;

        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 25px;
        line-height: 29px;



        color: #FFFFFF;
    }
    .info_stream .bg-danger{
        background: #D60000 !important;
        border-radius: 4px 0px 0px 4px !important;
        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 20px;
        line-height: 29px;
        text-align: center;

        color: #FFFFFF;

    }
    .info_stream .bg-dark{

        font-family: Roboto;
        font-style: normal;
        font-weight: normal;
        font-size: 20px;
        line-height: 29px;
        text-align: center;
    }
    .col-lg-4{
        display: block;
        margin-left: -30px;
    }
    .container{
        padding-left: 5% !important;
        padding-top: 5% !important;
        padding-right: 5% !important;
    }
    .container .col-lg-8 video{
        width: 100%;
        height:500px;
    }
    video{
        width: 100%;
        height: 100%;
        background-color:#000;
    }
    .stream_panel{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .stream_panel i:nth-child(1){
        margin-right: 13px;
        color: #007bff;
    }
    .stream_panel img{
        margin-right: 13px;
        margin-top: -2px;
        width: 25px;
        height: 25px;
    }
    .stream_panel> img:hover, .stream_panel> i:hover{
        cursor: pointer;
    }
</style>
<style>
    .container.new{
        padding-bottom: 0px !important;
    }
    .container{
        padding-left: 5% !important;
        padding-top: 50px !important;
        padding-right: 5% !important;
    }
    .container .col-lg-8 video{
        width: 100%;
        height: 100%;
    }
    .new .col-lg-12{
        display: flex;

    }
    .arrow_left{
        border: 1px solid #0075E1 !important;
        border-radius: 50px;
        color:#0075E1;
        margin-right: 15px;
        padding: 5px;
        width: 35px;
        height: 35px;
        cursor: pointer;
    }
    @media (max-width: 720px) {
        .col-lg-4{
            margin-left: 0px;
            margin-bottom: 150px;
        }
        .container.new{
            padding-left: 5% !important;
            padding-right: 5% !important;
        }
        .container{
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
        .live_text{
            font-size: 15px;
        }



    }
</style>
</html>
