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

                                    <div class="btn-group" id="pills-tab" role="tablist">
                                        <div class="btn-group">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Quản lý thể loại truyện
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <button class="dropdown-item" id="them_theoloai-tab" data-bs-toggle="pill"
                                                        data-bs-target="#them_theoloai" type="button" role="tab"
                                                        aria-controls="them_theoloai" aria-selected="false">Thêm thể loại</button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item active" id="danh_sach_theloai-tab"
                                                        data-bs-toggle="pill" data-bs-target="#danh_sach_theloai" type="button"
                                                        role="tab" aria-controls="danh_sach_theloai"
                                                        data-link="{{ route('Categories.index') }}" aria-selected="true">Danh sách
                                                        thể
                                                        loại</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Quản lý tác giả
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <button class="dropdown-item" id="xet_duyet_tacgia-tab" data-bs-toggle="pill"
                                                        data-bs-target="#xet_duyet_tacgia" type="button" role="tab"
                                                        aria-controls="xet_duyet_tacgia" aria-selected="false"
                                                        data-link="{{ route('Author.danhsach_xetduyet', [0]) }}">Danh sách tác giả</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Quản lý tác phẩm
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <button class="dropdown-item" id="xet_duyet_tacpham-tab" data-bs-toggle="pill"
                                                        data-bs-target="#xet_duyet_tacpham" type="button" role="tab"
                                                        aria-controls="xet_duyet_tacpham" aria-selected="false"
                                                        data-link="{{ route('Novel.danhsach_xetduyet') }}">Xét duyệt tác phẩm</button>
                                                </li>
                                            </ul>
                                        </div>
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
                                        </div>
                                        <div class="tab-pane fade" id="xet_duyet_tacgia" role="tabpanel"
                                            aria-labelledby="xet_duyet_tacgia-tab">
                                            @include('admincp.admin_page.admin_xetduyet_tacgia')
                                        </div>
                                        <div class="tab-pane fade" id="xet_duyet_tacpham" role="tabpanel"
                                            aria-labelledby="xet_duyet_tacpham-tab">
                                            {{-- @include('admincp.admin_page.admin_xetduyet_tacpham') --}}
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade ntp_edit_cat_ppoup" id="ntp_edit_cat_ppoup"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="ntp_edit_cat_ppoupLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ntp_edit_cat_ppoupLabel">Modal title</h5>
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

                                    <div class="modal fade ntp_author_detail" id="ntp_author_detail"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="ntp_author_detailLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ntp_author_detailLabel">Đơn xin xét duyệt quyền
                                                        tác giả của <span id="ntp_name"></span></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body pb-0">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Hủy</button>
                                                    <button type="button" class="btn btn-primary ntp_author_detail_update">Cập
                                                        nhật</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade ntp_edit_novel_poup" id="ntp_edit_novel_poup"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="ntp_edit_novel_poupLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ntp_edit_novel_poupLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body pb-0">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <button type="button" class="btn btn-primary ntp_admin_btn_update_novel">Xác thực</button>
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
