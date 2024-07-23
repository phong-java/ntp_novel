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

                                    <div class="btn-group d-flex flex-wrap" id="pills-tab" role="tablist">
                                        <div class="btn-group ntp_dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa-solid fa-layer-group"></i> Quản lý thể loại truyện
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                                <li>
                                                    <button class="dropdown-item" id="them_theoloai-tab" data-bs-toggle="pill"
                                                        data-bs-target="#them_theoloai" type="button" role="tab"
                                                        aria-controls="them_theoloai" aria-selected="false"><i
                                                            class="fa-solid fa-folder-plus"></i> Thêm thể loại</button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item active" id="danh_sach_theloai-tab"
                                                        data-bs-toggle="pill" data-bs-target="#danh_sach_theloai" type="button"
                                                        role="tab" aria-controls="danh_sach_theloai"
                                                        data-link="{{ route('Categories.index') }}" aria-selected="true"><i
                                                            class="fa-solid fa-list-ol"></i> Danh sách thể loại</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="btn-group ntp_dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fa-solid fa-users-gear"></i> Quản lý nguời dùng
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                                <li>
                                                    <button class="dropdown-item" id="xet_duyet_tacgia-tab" data-bs-toggle="pill"
                                                        data-bs-target="#xet_duyet_tacgia" type="button" role="tab"
                                                        aria-controls="xet_duyet_tacgia" aria-selected="false"
                                                        data-link="{{ route('Author.danhsach_xetduyet') }}"><i
                                                            class="fa-solid fa-users-line"></i> Danh sách tác giả</button>

                                                    <button class="dropdown-item" id="danh_sach_nguoi_dung-tab"
                                                        data-bs-toggle="pill" data-bs-target="#danh_sach_nguoi_dung" type="button"
                                                        role="tab" aria-controls="danh_sach_nguoi_dung" aria-selected="false"
                                                        data-link="{{ route('User.danh_sach_user') }}"><i
                                                            class="fa-solid fa-people-group"></i> Danh sách người dùng</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="btn-group ntp_dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa-solid fa-book"></i> Quản lý tác phẩm
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                                <li>
                                                    <button class="dropdown-item" id="xet_duyet_tacpham-tab" data-bs-toggle="pill"
                                                        data-bs-target="#xet_duyet_tacpham" type="button" role="tab"
                                                        aria-controls="xet_duyet_tacpham" aria-selected="false"
                                                        data-link="{{ route('Novel.danhsach_xetduyet') }}"><i
                                                            class="fa-solid fa-check-to-slot"></i> Xét duyệt tác phẩm</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="btn-group ntp_dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa-solid fa-flag"></i> Quản lý tố cáo
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                                <li>
                                                    <button class="dropdown-item xu_ly_bao_cao_tab" id="xu_ly_bao_cao_0-tab" data-bs-toggle="pill"
                                                        data-bs-target="#xu_ly_bao_cao_0" type="button" role="tab"
                                                        aria-controls="xu_ly_bao_cao_0" aria-selected="false"
                                                        data-link="{{ route('Report.bao_cao_list_admin', [0]) }}"><i class="fa-solid fa-circle-minus"></i> tố cáo chưa xử lý</button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item xu_ly_bao_cao_tab" id="xu_ly_bao_cao_3-tab" data-bs-toggle="pill"
                                                        data-bs-target="#xu_ly_bao_cao_3" type="button" role="tab"
                                                        aria-controls="xu_ly_bao_cao_3" aria-selected="false"
                                                        data-link="{{ route('Report.bao_cao_list_admin', [3]) }}"><i class="fa-solid fa-circle-xmark"></i> tố cáo từ chối xử lý</button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item xu_ly_bao_cao_tab" id="xu_ly_bao_cao_1-tab" data-bs-toggle="pill"
                                                        data-bs-target="#xu_ly_bao_cao_1" type="button" role="tab"
                                                        aria-controls="xu_ly_bao_cao_1" aria-selected="false"
                                                        data-link="{{ route('Report.bao_cao_list_admin', [1]) }}"><i class="fa-solid fa-circle-check"></i> tố cáo đã xử lý</button>
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
                                        <div class="tab-pane fade" id="danh_sach_nguoi_dung" role="tabpanel"
                                            aria-labelledby="danh_sach_nguoi_dung-tab">
                                            ôkok
                                            {{-- @include('admincp.admin_page.admin_xetduyet_tacgia') --}}
                                        </div>
                                        <div class="tab-pane fade" id="xet_duyet_tacpham" role="tabpanel"
                                            aria-labelledby="xet_duyet_tacpham-tab">
                                            {{-- @include('admincp.admin_page.admin_xetduyet_tacpham') --}}
                                        </div>
                                        <div class="tab-pane fade" id="xu_ly_bao_cao_0" role="tabpanel"
                                            aria-labelledby="xu_ly_bao_cao_0-tab">
                                            {{-- @include('admincp.admin_page.admin_xetduyet_tacpham') --}}
                                        </div>
                                        <div class="tab-pane fade" id="xu_ly_bao_cao_1" role="tabpanel"
                                            aria-labelledby="xu_ly_bao_cao_1-tab">
                                            {{-- @include('admincp.admin_page.admin_xetduyet_tacpham') --}}
                                        </div>
                                        <div class="tab-pane fade" id="xu_ly_bao_cao_3" role="tabpanel"
                                            aria-labelledby="xu_ly_bao_cao_3-tab">
                                            {{-- @include('admincp.admin_page.admin_xetduyet_tacpham') --}}
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade ntp_edit_cat_ppoup" id="ntp_edit_cat_ppoup" data-bs-keyboard="false"
                                        tabindex="-1" aria-labelledby="ntp_edit_cat_ppoupLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ntp_edit_cat_ppoupLabel">Chỉnh sửa thể loại</h5>
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

                                    <div class="modal fade ntp_author_detail" id="ntp_author_detail" data-bs-keyboard="false"
                                        tabindex="-1" aria-labelledby="ntp_author_detailLabel" aria-hidden="true">
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

                                    <div class="modal fade ntp_edit_novel_poup" id="ntp_edit_novel_poup" data-bs-keyboard="false"
                                        tabindex="-1" aria-labelledby="ntp_edit_novel_poupLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ntp_edit_novel_poupLabel">Chỉnh sửa tiểu thuyết
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body pb-0">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="button" class="btn btn-primary ntp_admin_btn_update_novel">Xác
                                                        thực</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade ntp_report_detail admin_update" id="ntp_report_detail" data-bs-keyboard="false"
                                        tabindex="-1" aria-labelledby="ntp_report_detailLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ntp_report_detailLabel">Chi tiết tố cáo</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Hủy</button>
                                                    <button type="button" class="btn btn-primary ntp_report_admin_detail_update"><i
                                                            class="fa-solid fa-paper-plane"></i> Cập nhật</button>
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
