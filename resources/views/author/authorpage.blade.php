@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">


                @guest
                    <div class="card-body">
                        @include('layouts.404_traiphep')
                    </div>
                @else
                    @auth
                        @if (Auth::user()->id == $user->id)
                            @if ($user->sRole == 'user')
                                <div class="card">
                                    <div class="card-header fw-bold">Bạn chưa là tác giả bạn cần đăng ký tác giả trước</div>

                                    <div class="card-body">
                                        @include('author.authorpage_infor_create')
                                    </div>

                                </div>
                            @else
                                <div class="card">
                                    <div class="card-header fw-bold">

                                        <div class="btn-group" id="pills-tab" role="tablist">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Quản lý thông tin
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <button class="active dropdown-item" id="author_infor-tab" data-bs-toggle="pill"
                                                        data-bs-target="#author_infor" type="button" role="tab"
                                                        aria-controls="author_infor" aria-selected="true">Thông
                                                        tin tác giả</button>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="rut_tien-tab" data-bs-toggle="pill"
                                                        data-bs-target="#rut_tien" type="button" role="tab"
                                                        aria-controls="rut_tien" aria-selected="false">Rút
                                                        tiền</a>
                                                </li>
                                            </ul>

                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Quản lý truyện
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <button class="dropdown-item" id="danhsach_truyen-tab" data-bs-toggle="pill"
                                                        data-bs-target="#danhsach_truyen" type="button" role="tab"
                                                        aria-controls="danhsach_truyen" aria-selected="false"
                                                        data-link="{{ route('Novel.Danh_sachtruyen_tacgia') }}">Tuyện của tôi</button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item" id="thongke_baocao-tab" data-bs-toggle="pill"
                                                        data-bs-target="#thongke_baocao" type="button" role="tab"
                                                        aria-controls="thongke_baocao" aria-selected="false">Thống kê báo
                                                        cáo</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="author_infor" role="tabpanel"
                                                aria-labelledby="author_infor-tab">
                                                <div class="card">
                                                    <div class="card-header fw-bold">Thông tin tác giả</div>

                                                    <div class="card-body">
                                                        @include('author.authorpage_infor')
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="thongke_baocao" role="tabpanel"
                                                aria-labelledby="thongke_baocao-tab">
                                                {{-- @include('user.thongke_baocao') --}}
                                            </div>
                                            <div class="tab-pane fade" id="rut_tien" role="tabpanel"
                                                aria-labelledby="rut_tien-tab">
                                                {{-- @include('user.rut_tien') --}}
                                            </div>
                                            <div class="tab-pane fade" id="danhsach_truyen" role="tabpanel"
                                                aria-labelledby="danhsach_truyen-tab">
                                                @include('author.novel.novel_infor')
                                                <div id="ntp_novel_list_wrap"></div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            @endif
                        @else
                            <div class="card-body">
                                @include('layouts.404_traiphep')
                            </div>
                        @endif


                    @endauth
                @endguest
            </div>
        </div>
    </div>
@endsection
