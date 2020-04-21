@extends('layouts.user')

@section('content')
<!DOCTYPE html>
<html>
<head>
	<title>Онлайн трансляция</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{asset('css/profile.css')}}">
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
    <div style="padding:2%">
        <button onclick="startStream()">Начать трансляцию</button>
      </div>
    <video playsinline autoplay></video>

    <div id="courseId" style="display:none;">{{ $course->id }}</div>
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
</html>
@endsection