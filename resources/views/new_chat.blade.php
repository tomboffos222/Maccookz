@extends('layouts.user')
@section('content')
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{asset('css/section.css')}}">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("css/owl.carousel.min.css")}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/respons.css')}}">
</head>
<body>
    <div class="header">
        <div class="container ">
            <div class="row header_row">
                <div class="col-lg-5 col-12">
                    <div class="d-flex ">

                        <div class="arrow_left" onclick="window.location.href='{{route('Profile')}}'">
                            <i class="material-icons medium " >
                                keyboard_arrow_left
                            </i>

                        </div>
                        <div class="back_text" onclick="window.location.href='{{route('Profile')}}'">
                            Назад
                        </div>
                        <div class="society">
                            <i class="material-icons medium">
                                people
                            </i>
                        </div>
                        <div class="arrow_down"><i class="material-icons medium">keyboard_arrow_down</i></div>
                    </div>

                </div>
                <div class="col-lg-7 avatar_name col-12 d-flex align-items-center" >
                    <div class="d-md-none d-block" id="openList">
                        <i class="material-icons medium " >
                            keyboard_arrow_left
                        </i>

                    </div>

                    @if(!is_null($chatData))
                        @if($chatData->avatar == null)
                            <img onclick="window.location.href='{{route('AccountView',$chatData->id)}}'" src="{{asset('images/image_avatar.svg')}}" alt="" class="chat_face">
                        @else
                            <img onclick="window.location.href='{{route('AccountView',$chatData->id)}}'" src="{!! $chatData->avatar !!}" alt="" class="profile-avatar search-avatar chat_face">

                        @endif
                        <span onclick="window.location.href='{{route('AccountView',$chatData->id)}}'">
                            {{$chatData->name}}
                        </span>
                    @endif
                </div>

            </div>
        </div>
    </div>
    <div class="container ">
        <div class="row chat">
            <div class="col-lg-5 col-12">
                <div class="search_form">
                    <form id="friend-autocomplete">
                        <input type="search" id="friend-text-autocomplete" class="form-control" placeholder="Поиск пользователя:">
                        <i class="material-icons global-search-icon">&#xE8B6;</i>
                    </form>
                </div>

                    @foreach($chatList as $chat)


                    <div class="user_frame d-flex justify-content-start" onclick="window.location.href='{{route('ChatList',$chat->chat_id)}}'">
                        @if($chat->avatar == null)
                            <img src="{{asset('images/image_avatar.svg')}}" alt="" class="chat_face">
                        @else
                            <img src="{!! $chat->avatar !!}" alt="" class="profile-avatar search-avatar chat_face">

                        @endif
                        <div class="info-frame">
                            <h5>
                                {{$chat->name}}
                            </h5>
                            <span class="trimMsg"></span>
                        </div>
                    </div>
                    @endforeach
            </div>
            <div class="col-lg-7 col-12">
                <div class="inner_scroll" id="chat_page">
                    <div class="chat_page d-flex  ">
                        @for($i=count($msgList); $i > 0; $i--)
                        <?php $msg = json_decode($msgList[($i-1)], true) ?>
                        @if($msg['sendId'] != $composeUserId)
                        <div class="d-flex message_frame">
                            <div class="message from">{{ $msg['msg'] }}</div>
                        </div>
                        @else
                        <div class="d-flex message_frame justify-content-end">
                            <div class="message from">{{ $msg['msg'] }}</div>
                        </div>
                        @endif
                        @endfor
                    </div>
                </div>
                <div class="d-flex form_page " style="margin-top:auto;">
                    <form id="sendMsg">
                        <input type="text" id="msg" placeholder="Напишите сообщение...." class="form-control w-75">
                        <input type="submit"  value="Отправить"  class="btn btn-primary  w-25">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="chatNotView" style="display:none">
    @if(!is_null($chatData))
        <div id="isChatPage"></div>
        <div id="chatId" chatId="{{ $chatId ?? 0 }}"></div>
        <div id="recId" recId="{{ $chatData->id }}"></div>
    @endif
        <div id="friendList">
            <li name=""></li>
        </div>
    </div>
    <style>
        #menu{
            display: none;
        }
        #notView{
            display: none;
        }
        .chat_page{


            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            min-height: 100%;

        }
        .inner_scroll{
            height: 645px;
            overflow-y: auto;

        }
        .chat_page .fix{
            flex: 1 1 auto;
            width: 100%;
        }
        .col-lg-7{
            padding-top: 0px !important;
        }
        .form_page form{
            display: flex;
            width: 100%;
        }
        input[type='submit']{
            background-color: #fff !important;
            color: #0075E1;
            margin-right: -5px;
            border-radius: 0px 5px 5px 0px;
        }
        .message{
            clip-path: polygon(0% 0%, 100% 0%, 100% 75%, 75% 75%, 53% 75%, 7% 75%, 0 100%);
            margin-left: 15px;
            border-radius: 5px;


        }
        .message_frame{

        }
        .d-flex.message_frame.justify-content-end .message.from{
            clip-path: polygon(0% 0%, 100% 0%, 100% 75%, 100% 100%, 90% 75%, 50% 75%, 0% 75%);

            margin-right: 15px;
        }
        input.class{
            width: 10%;

        }
        input.form-control{

            border: none;
            border-radius: 5px 0px 0px 5px;

        }

        .form_page{
            justify-self:flex-end;

        }
        .form_page{

            background: #EEEEEE;
            border: 1px solid #D2D2D2;
            box-sizing: border-box;
            margin-left: -15px;
            margin-right: -15px;
            padding: 22px 25px;

        }
        .row.chat{
            height: 90vh;

        }
        .d-flex.message_frame.justify-content-end .message.from{
            background: #C7E4FF;
        }
        .message{
            padding: 12px 20px;
            background: #E9E9E9;
            margin-bottom: 50px;
            padding-bottom: 25px;
            max-width: 70% !important;
        }
        .d-flex.message_frame{
            height: 100%;
        }
        .chat .col-lg-5{
            border-right: 1px solid #C1C1C1;
        }
        .user_frame{
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .user_frame img{
            margin-right: 21px;
        }
        .info-frame h5{
            font-family: Roboto;
            font-style: normal;
            font-weight: bold;
            font-size: 20px;
            line-height: 23px;
            letter-spacing: 0.05em;
            text-transform: uppercase;

            color: #000000;
        }
        .info-frame span{
            font-family: Roboto;
            font-style: normal;
            font-weight: normal;
            font-size: 18px;
            line-height: 21px;
            /* identical to box height */

            letter-spacing: 0.05em;

            color: #757575
        }
        .header .container{
            padding-top:25px;
        }
        .container{
            padding-top: 0px;
        }
        .container .row.chat .col-lg-5, .container .row.chat  .col-lg-7{
            padding-top: 50px;

        }
        .chat_page{
            flex-direction: column;
        }
        .search_form i{
            position: absolute;
            top: 57px;
            color:  #ACACAC;
            left: 25px;


        }
        .search_form input{
            padding-left: 45px;
        }
        .avatar_name span{
            font-family: Roboto;
            font-style: normal;
            font-weight: bold;
            font-size: 20px;
            line-height: 23px;
            letter-spacing: 0.05em;
            text-transform: uppercase;

            color: #000000;
            margin-left: 50px;

        }

        .avatar_name img{
            margin-left: 50px;
        }
        .header_row{
            padding-bottom: 9px;
        }
        .back_text{
            padding: 5px;
            font-family: Roboto;
            font-style: normal;
            font-weight: normal;
            font-size: 20px;
            line-height: 23px;
            text-align: center;

            color: #939393;
            margin-left: 10px;
        }
        .chat_face{
            width: 60px;
            height: 60px;
        }

        .society{
            border-radius: 50px;
            padding: 5px;
            width: 35px;
            color: #C7E4FF;
            justify-self: flex-end;
            margin-left: auto;
        }
        .arrow_down{
            border-radius: 50px;
            padding: 5px;
            width: 35px;
            color: #C7E4FF;

        }
        .arrow_left{
            border: 1px solid #0075E1 !important;
            border-radius: 50px;
            color:#C7E4FF;
            padding: 5px;
            width: 35px;
            height: 35px;
        }
        .header{
            border: 1px solid #C1C1C1;
        }
        .back_text:hover , .arrow_left:hover{
            cursor:pointer;
        }
        pre{
            display: none;
        }
        .form-control:focus{
            outline: none !important;
            border:none;
            box-shadow: none;
        }
        @media (max-width: 720px) {
            .container{
                padding-left: 15px;
                padding-right: 15px;
                max-width: 100% !important;
                overflow: hidden;


            }
            .container .row.chat .col-lg-5{
                padding-top: 20px;
            }
            .search_form i {
                top:27px;
            }
            .chat_page{

            }
            .inner_scroll{
                height: 65vh;
                width: 100%;
            }


            .row.chat{
                flex-wrap: nowrap;
                height: 75vh;

            }
            .header .container .row{
                flex-wrap: nowrap;
            }

            .message{
                padding-bottom: 10px;
                margin-bottom: 10px;
            }
            .message_frame{
                max-width: 100% !important;
            }


            .row.chat .col-lg-5.active, .header_row .col-lg-5.active{
                margin-left: 0%;
            }

            input.w-75{
                width: 60% !important;
            }
            input.w-25{
                width: 40% !important;
            }
            .form_page{
                height: auto;
            }
            .avatar_name span{
                font-size: 14px !important;
                margin-left: 10px;
                align-self: center;
            }
            .message{
                margin-left: 0px;
                max-width: 70% !important;
                overflow: scroll;
            }
            .d-flex.message_frame.justify-content-end .message{
                margin-right: 0px;
                margin-right: 0 !important;
            }
            .avatar_name img{
                margin-left: 10px;
            }



        }
        .user_frame:hover{
            cursor: pointer;
        }
    </style>

    @if( url()->previous() != route('Profile'))
    <style>
        @media (max-width: 720px) {
            .row.chat .col-lg-5, .header_row .col-lg-5{
                position: relative;
                overflow: scroll;
                margin-left: -100%;

            }


        }
    </style>
    @endif
    <script>
        var objDiv = document.getElementById("chat_page");
        objDiv.scrollTop = objDiv.scrollHeight;
        function fromSubmit() {
            var objDiv = document.getElementById("chat_page");
            objDiv.scrollTop = objDiv.scrollHeight;

        }



    </script>

</body>
</html>
