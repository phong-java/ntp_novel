<div class="ntp_footer py-3 mt-4 border-top">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Trang chủ</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Tìm kiếm</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Liên hệ</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Tố cáo</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Trang cá nhân</a></li>
    </ul>
    <p class="text-center text-muted">© 2025 NTP_Novel - Đồ án</p>
</div>

@guest
    <div class="modal fade" id="ntp_login_register_modal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="ntp_login_register_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body">
                    <div id="carouselExampleControls" class="carousel slide" data-interval="false">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                @if (Route::has('login'))
                                    @include('auth.login')
                                @endif
                            </div>
                            <div class="carousel-item">

                                @if (Route::has('register'))
                                    @include('auth.register')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endguest
