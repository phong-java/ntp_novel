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

<!-- Modal trigger button -->
<button type="button" class="btn btn-secondary btn-lg ntp_user_seting position-fixed bottom-0 end-0 translate-middle"
    data-bs-toggle="modal" data-bs-target="#modalId">
    <i class="fa-solid fa-user-gear"></i>
</button>

<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modalId" tabindex="-1" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Cài đặt cá nhân
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (Auth::check())
                    <form action="{{ route('User.save_user_setting', [Auth::user()->id]) }}" id="ntp_form_user_seting" data-setting="{{Auth::user()->sSetup}}">
                @else
                    <form action="" id="ntp_form_user_seting" class="ntp_locall_store">
                @endif
                <div class="alert alert-success ntp_default ntp_hidden" role="alert"></div>
                <div class="alert alert-danger ntp_default ntp_hidden" role="alert"></div>
                <div class="mb-3">
                    <label for="ntp_font_set" class="form-label">Chọn font chữ</label>
                    <select id="ntp_font_set" name="ntp_font_set" class="form-select">
                        <option value="Georgia, serif">Georgia, serif</option>
                        <option value="Gill Sans, sans-serif">Gill Sans, sans-serif</option>
                        <option value="sans-serif">sans-serif</option>
                        <option value="serif">serif</option>
                        <option value="cursive">cursive</option>
                        <option value="system-ui">system-ui</option>
                    </select>
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <label class="form-check-label" for="ntp_dark_mode"> Dark mode </label>
                        <input class="form-check-input" type="checkbox" id="ntp_dark_mode" />
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Đóng
                </button>
                <button type="button" class="btn btn-primary ntp_user_seting_save">Lưu</button>
            </div>
        </div>
    </div>
</div>


@guest
    <div class="modal fade" id="ntp_login_register_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="ntp_login_register_modalLabel" aria-hidden="true">
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
