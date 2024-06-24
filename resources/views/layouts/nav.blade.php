<nav class="ntp_nav navbar navbar-expand-lg  bg-body shadow-sm mb-4">
    <div class="container col-md-11">
        @guest
            <a class="navbar-brand" href="{{ url('/') }}"><img class="ntp_logo me-2" src="{{ asset('uploads\logo\Logo.pn') }}" alt="">NTP Novel</a>
        @else
            @auth
                @if (Auth::user()->sRole == 'admin')
                    <a class="navbar-brand" href="{{ url('/') }}"><img class="ntp_logo me-2" src="{{ asset('uploads\logo\Logo.jpg') }}" alt="">NTP Novel - Admin</a>
                @elseif (Auth::user()->sRole == 'author')
                    <a class="navbar-brand" href="{{ url('/') }}"><img class="ntp_logo me-2" src="{{ asset('uploads\logo\Logo.jpg') }}" alt="">NTP Novel - Author</a>
                @else
                    <a class="navbar-brand" href="{{ url('/') }}"><img class="ntp_logo me-2" src="{{ asset('uploads\logo\Logo.jpg') }}" alt="">NTP Novel</a>
                @endif
            @endauth
        @endguest
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    @if (Auth::user()->sRole == 'admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Quản lý thể loại
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('Categories.create')}}">Thêm thể loại</a></li>
                                <li><a class="dropdown-item" href="{{route('Categories.index')}}">Danh sách thể loại</a></li>
                                <!-- <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                            </ul>
                        </li>
                    @endif
                @endauth
            </ul>
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
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('User.show',[Auth::user()->id]) }}">Trang cá nhân</a>

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