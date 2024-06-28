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
                                    Quản lý thông tin cá nhân
                                </button>
                                <ul class="dropdown-menu" id="pills-tab" role="tablist">
                                    <li>
                                        <button class="active dropdown-item" id="user_infor-tab" data-bs-toggle="pill"
                                            data-bs-target="#user_infor" type="button" role="tab"
                                            aria-controls="user_infor" aria-selected="true">Thông tin cá nhân</button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" id="user_purchase_history-tab" data-bs-toggle="pill"
                                            data-bs-target="#user_purchase_history" type="button" role="tab"
                                            aria-controls="user_purchase_history" aria-selected="false">Lịch sử mua
                                            chương</button>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-item" id="user_read_history-tab" data-bs-toggle="pill"
                                            data-bs-target="#user_read_history" type="button" role="tab"
                                            aria-controls="user_read_history" aria-selected="false">Lịch sử đọc</a>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" id="user_bill-tab" data-bs-toggle="pill"
                                            data-bs-target="#user_bill" type="button" role="tab" aria-controls="user_bill"
                                            aria-selected="false">Ví tiền và hóa đơn</button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" id="user_bookmark-tab" data-bs-toggle="pill"
                                            data-bs-target="#user_bookmark" type="button" role="tab"
                                            aria-controls="user_bookmark" aria-selected="false">Dấu trang</button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item" id="user_report-tab" data-bs-toggle="pill"
                                            data-bs-target="#user_report" type="button" role="tab"
                                            aria-controls="user_report" aria-selected="false">Báo cáo</button>
                                    </li>
                                    {{-- <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Separated link</a></li> --}}
                                </ul>
                            </div>
                        </div>
    
                        <div class="card-body">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="user_infor" role="tabpanel"
                                    aria-labelledby="user_infor-tab">
                                    @include('user.user_infor')
                                </div>
                                <div class="tab-pane fade" id="user_purchase_history" role="tabpanel"
                                    aria-labelledby="user_purchase_history-tab">
                                    @include('user.user_purchase_history')
                                </div>
                                <div class="tab-pane fade" id="user_read_history" role="tabpanel"
                                    aria-labelledby="user_read_history-tab">
                                    @include('user.user_read_history')
                                </div>
                                <div class="tab-pane fade" id="user_bill" role="tabpanel" aria-labelledby="user_bill-tab">
                                    @include('user.user_bill')
                                </div>
                                <div class="tab-pane fade" id="user_bookmark" role="tabpanel"
                                    aria-labelledby="user_bookmark-tab">
                                    @include('user.user_bookmark')
                                </div>
                                <div class="tab-pane fade" id="user_report" role="tabpanel" aria-labelledby="user_report-tab">
                                    @include('user.user_report')
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
