<nav class="navbar navbar-expand-lg  bg-light shadow-sm mb-4">
    <div class="container col-md-11">
        @guest
            <a class="navbar-brand" href="{{ url('/') }}">NTP Novel</a>
        @else
            @auth
                @if (Auth::user()->sRole == 'admin')
                    <a class="navbar-brand" href="{{ url('/') }}">NTP Novel - Admin</a>
                @elseif (Auth::user()->sRole == 'author')
                    <a class="navbar-brand" href="{{ url('/') }}">NTP Novel - Author</a>
                @else
                    <a class="navbar-brand" href="{{ url('/') }}">NTP Novel</a>
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

            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
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