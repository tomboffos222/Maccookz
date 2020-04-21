

@php


@endphp
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @yield('content')
    <div class="col-lg-12" id="menu">
        @php $user = session()->get('user');  @endphp


        <div class="row">

            <div>

                <div class="lik">
                    @if( isset($isSearch) )
                        <a href="{{route('SearchPage')}}" class="clr" style="display: flex;flex-flow: column;align-items: center;">
                            <img src="{{asset('images/Vector.svg')}}">
                            <span class="kok">
                                    Поиск
                                </span>

                        </a>
                        @else
                        <a href="{{route('SearchPage')}}" class="clr" style="display: flex;flex-flow: column;align-items: center;">
                            <img src="{{asset('images/sery.svg')}}">
                            <span>
								Поиск
							</span>

                        </a>
                        @endif
                </div>
            </div>
            <div>
                <div class="lik">
                    @if(isset($isEvent))
                            <a href="{{route('Events')}}" class="clr" style="display: flex;flex-flow: column;align-items: center;">
                                <img src="{{asset('images/sluis.svg')}}" alt="">
                                <span class="kok">
                                            Что нового
                                        </span>
                            </a>

                        @else

                            <a href="{{route('Events')}}" class="clr" style="display: flex;flex-flow: column;align-items: center;">
                                <img src="{{asset('images/Vector1.svg')}}" alt="">
                                <span>
                                        Что нового
                                    </span>
                            </a>
                        @endif
                </div>
            </div>
            <div>
                <div class="lik">

                    <a href="{{route('Main')}}" class="clr" style="display: flex;flex-flow: column;align-items: center;">
                        @if(isset($isMenu))
                        <img src="{{asset('images/Vectorgl.svg')}}" alt="">
                            <span class="kok">
								Главный
							</span>
                        @else
                            <img src="{{asset('images/Vector2.svg')}}" alt="">
                            <span >
								Главный
							</span>
                        @endif

                    </a>
                </div>
            </div>
            <div>

                <div class="lik">
                    @if($user['status'] == 'registered')
                    <a href="{{route('Add')}}" class="clr" style="display: flex;flex-flow: column;align-items: center;">
                        @elseif($user['status'] == 'partner')
                            <a href="{{route('AddCourse')}}" class="clr" style="display: flex;flex-flow: column;align-items: center;">
                                @endif
                                @if(isset($isAdd))
                                    <img src="{{asset('images/Vectord.svg')}}" alt="">
                                    <span class="kok">
                                            Добавить
                                    </span>
                                    @else
                                    <img src="{{asset('images/Vector3.svg')}}" alt="">
                                    <span >
                                            Добавить
                                    </span>

                                @endif

                    </a>



                </div>
            </div>
            <div>
                <div class="lik">

                    <a href="{{route('Profile')}}" class="clr" style="display: flex;flex-flow: column;align-items: center;">
                        @if(isset($isProfile))
                            @if($user['avatar'] == null)
                                <img src="{{asset('images/image_avatar.svg')}}" alt="">
                            @else
                                <img src="{!! $user->avatar !!}" alt="" class="profile-avatar">
                            @endif

                        <span class="kok">
								Профиль
                        </span>
                        @else
                            @if($user['avatar'] == null)
                                <img src="{{asset('images/image_avatar.svg')}}" alt="">
                            @else
                                <img src="{!! $user->avatar !!}" alt="" class="profile-avatar">
                            @endif

                            <span >
								Профиль
							</span>
                        @endif

                    </a>
                </div>
            </div>
        </div>
    </div>
<div id="notView" class="display:none">
    <div id="composeUserId">{{ $composeUserId }}</div>
    <div id="chatLists">
        @foreach($composeChatList as $chat)
            <li chatId="{{$chat->chat_id}}"></li>
        @endforeach
    </div>
</div>
<style>
    a:hover{
        text-decoration: none !important;
    }
    @media (max-width: 720px) {
        #suck .text h6{
            font-size: 12px;
        }


    }
</style>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="{{asset('js/socket.io.js')}}"></script>
<script src="{{asset('js/chat.js')}}"></script>
<script>

    $('#openList').on('click',function(){
        $('.row .col-lg-5').addClass('active')
    })


</script>
</body>
</html>
