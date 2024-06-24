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
                            <div class="card">
                                <div class="card-header fw-bold">

                                    <div class="btn-group">
                                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Quản lý thể loại truyện
                                        </button>
                                        <ul class="dropdown-menu" id="pills-tab" role="tablist">
                                            <li>
                                                <button class="dropdown-item" id="them_theoloai-tab" data-bs-toggle="pill"
                                                    data-bs-target="#them_theoloai" type="button" role="tab"
                                                    aria-controls="them_theoloai" aria-selected="false">Thêm thể loại</button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item active" id="danh_sach_theloai-tab"
                                                    data-bs-toggle="pill" data-bs-target="#danh_sach_theloai" type="button"
                                                    role="tab" aria-controls="danh_sach_theloai"
                                                    data-link="{{ route('Categories.index') }}" aria-selected="true">Danh sách thể
                                                    loại</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade" id="them_theoloai" role="tabpanel"
                                            aria-labelledby="them_theoloai-tab">
                                            @include('admincp.Categories.create')
                                        </div>
                                        <div class="tab-pane fade active show" id="danh_sach_theloai" role="tabpanel"
                                            aria-labelledby="danh_sach_theloai-tab">
                                            @include('admincp.Categories.index')
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade ntp_edit_cat_ppoup" id="staticBackdrop" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="button" class="btn btn-primary ntp_btn_update_cat">Sửa</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
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
