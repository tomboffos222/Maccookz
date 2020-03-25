

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
</div>

</body>
</html>
