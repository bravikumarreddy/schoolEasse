<nav class="  bg-white  p-0 border">
    <div class="container d-sm-flex ">
        <div class="d-flex row justify-content-around">

            <a class="navbar-brand align-self-center" href="{{ url('/home') }}" style="color: #000;">
                {{ (Auth::check() && (Auth::user()->role == 'student' || Auth::user()->role == 'teacher' ||
                Auth::user()->role == 'admin' || Auth::user()->role == 'accountant' || Auth::user()->role ==
                'librarian')) ? Auth::user()->school->name:config('app.name') }}
            </a>
        </div>

        <div class="d-flex align-items-center justify-content-between ml-md-auto" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->

            <!-- Right Side Of Navbar -->

                <!-- Authentication Links -->
                @guest
                <a href="{{ route('login') }}" style="color: #000;">@lang('Login')</a>
                @else



                    <a href="{{url('messages')}}" class="nav-link nav-link-align-btn"
                        role="button">

                        <?php
                            $mc = \App\Message::where('user_id',\Auth::user()->id)->where('read',"=",'0')->count();
                        ?>
                        @if($mc > 0)
                                <div class="row">
                                    <div class="col-sm-auto"><i class="material-icons  d-inline text-muted">@lang('email')</i><span
                                            class="badge badge-danger badge-pill d-inline">{{$mc}}</span></div></div>
                        @else
                                <i class="material-icons text-muted">@lang('email')</i>
                        @endif
                    </a>


                <div class="nav-item dropdown ">
                    <a href="#" class="nav-link dropdown-toggle nav-link-align-btn text-dark " id="navbarDropdown" data-toggle="dropdown" role="button"
                        aria-expanded="false" aria-haspopup="true">
                        <span class="badge badge-danger">
                            {{ ucfirst(\Auth::user()->role) }}
                        </span>&nbsp;&nbsp;
                        @if(!empty(Auth::user()->pic_path))
                        <img src="{{asset('01-progress.gif')}}" data-src="{{url(Auth::user()->pic_path)}}" alt="Profile Picture"
                            style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">
                        @else
                        @if(strtolower(Auth::user()->gender) == 'male')
                        <img src="{{asset('01-progress.gif')}}" data-src="https://img.icons8.com/color/48/000000/architect.png"
                            alt="Profile Picture" style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">
                        @else
                        <img src="{{asset('01-progress.gif')}}" data-src="https://img.icons8.com/color/48/000000/architect-female.png"
                            alt="Profile Picture" style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">
                        @endif
                        @endif
                        &nbsp;&nbsp;{{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if(Auth::user()->role != 'master')

                            <a class="dropdown-item" href="{{url('user/'.Auth::user()->student_code)}}">@lang('Profile')</a>

                        @endif

                            <a class="dropdown-item" href="{{url('user/config/change_password')}}">@lang('Change Password')</a>

                        @if(env('APP_ENV') != 'production')

                            <a class="dropdown-item" href="{{url('user/config/impersonate')}}">
                                {{ app('impersonate')->isImpersonating() ? __('Leave Impersonation') : __('Impersonate') }}
                            </a>

                        @endif

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                @lang('Logout')
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                    </div>
                </div>
                @endguest

        </div>
    </div>
</nav>
