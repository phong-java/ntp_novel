<nav class="ntp_nav navbar navbar-expand-lg  bg-body shadow-sm mb-4">
    <div class="container col-md-11 justify-content-between">
        <a class="navbar-brand" href="{{ url('/') }}"><img class="ntp_logo me-2"
            src="{{ asset('uploads/logo/Logo.jpg') }}" alt="">NTP Novel 
            @if (isset($isadmin) && $isadmin)
            - Admin
            @endif
    </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="ntp_user_loged nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                            <div class="ntp_av_nav overflow-hidden rounded-circle">
                                <img class="ntp_av_nav" src="{{ asset('uploads/user_av/phong_av.jpg') }}" alt="">
                            </div>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('User.show', [Auth::user()->id]) }}">Trang cá nhân</a>

                            @if (Auth::user()->sRole == 'admin')
                            <a class="dropdown-item" href="{{ route('User.admin',[Auth::user()->id])}}">Trang quản trị</a>
                            @endif

                            @if (Auth::user()->sRole == 'author' || Auth::user()->sRole == 'admin')
                            <a class="dropdown-item" href="{{ route('User.admin',[Auth::user()->id])}}">Trang quản lý truyện</a>
                            @endif
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                </li>
            </ul>
        </div>
    </div>
</nav>