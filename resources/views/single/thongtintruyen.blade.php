<div class="card ntp_novel_single">
    <div class="card-header fw-bold">Thông tin truyện </div>
    <div class="card-body">
        <div class="ntp_novel_single d-flex gap-4">
            <div class="w-25 ntp_novel_single_img mb-4 mb-md-0">
                {{-- Ảnh bìa --}}
                <div class="bg-image hover-overlay rounded  overflow-hidden ripple" data-mdb-ripple-color="light">
                    <a href="{{ route('Novel.show', [$novel->id]) }}">
                        <img src="{{ asset('uploads/images/'.$novel->sCover) }}" class=" w-100 img-fluid"
                            alt="bookcover256">
                    </a>
                </div>
            </div>
            <div class="w-75 ntp_novel_single_infor overflow-Y overflow-Xh  ntp_custom_ver_scrollbar">
                {{-- Thông tin --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Tên truyện</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"> {{$novel->sNovel}} </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Tác giả</p>
                        </div>
                        <div class="col-sm-9">

                            <a href="#!" class=" w-50">
                                <p class="mb-0 text-success"><i class="fa-solid fa-user me-2"></i>{{$author->sNickName}}
                                </p>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Số chương</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"> {{$count}} chương </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Giới thiệu</p>
                        </div>
                        <div class="col-sm-9 ntl_tomtat overflow-auto ntp_custom_ver_scrollbar">
                            {!!htmlspecialchars_decode($novel->sDes)!!}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Thể loại</p>
                        </div>
                        <div class="col-sm-9 d-flex flex-wrap gap-3">
                            <button type="button" class="btn btn-primary position-relative"> Thể loại </button>
                            <button type="button" class="btn btn-primary position-relative"> Thể loại  </button>
                            <button type="button" class="btn btn-primary position-relative"> Thể loại  </button>
                            <button type="button" class="btn btn-primary position-relative"> Thể loại  </button>
                            <button type="button" class="btn btn-primary position-relative"> Thể loại </button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Tiến độ</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="mb-0 text-success">
                                @if ($novel->sProgress == 1)
                                    <span class="text text-success">Còn tiếp</span>
                                @elseif ($novel->sProgress == 2)
                                    <span class="text text-warning">Tạm ngưng</span>
                                @elseif ($novel->sProgress == 3)
                                    <span class="text text-danger">Hoàn thành</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Thông số</p>
                        </div>
                        <div class="col-sm-9">
                            <div class="row w-100">
                                <p class="text-muted mb-0 w-50">XXX lượt đọc</p>
                                <p class="text-muted mb-0 w-50">XXX đánh dấu</p>
                            </div>
                            <hr>
                            <div class="row w-100">
                                <p class="text-muted mb-0 w-25">Đánh giá: </p>
                                <ul class="rating mb-3 list-inline d-flex gap-2 w-50" data-mdb-toggle="rating">
                                    <li><i class="fas fa-star fa-sm text-warning " title="Bad"></i></li>
                                    <li><i class="fas fa-star fa-sm text-warning " title="Poor"></i></li>
                                    <li><i class="fas fa-star fa-sm text-warning " title="OK"></i></li>
                                    <li><i class="fas fa-star fa-sm text-warning " title="Good"></i></li>
                                    <li><i class="far fa-star fa-sm text-warning " title="Excellent"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Thao tác</p>
                        </div>
                        <div class="col-sm-9">
                            <div class="row w-100">
                                <a href="{{ route('Novel.show', [1]) }}" class=" w-50">
                                    <p class="text-muted mb-0"><i class="fa-solid fa-book-open me-2"></i>Đọc luôn
                                    </p>
                                </a>
                                <a href="#!" class=" w-50">
                                    <p class="text-muted mb-0"><i class="fa-solid fa-bookmark me-2"></i>Đánh dấu</p>
                                </a>
                            </div>
                            <hr>
                            <div class="row w-100">
                                <a href="#ntp_mucluc" class=" w-50">
                                    <p class="text-muted mb-0"><i class="fa-solid fa-bars me-2"></i>Mục lục
                                    </p>
                                </a>
                                <a href="#ntp_review" class=" w-50">
                                    <p class="text-muted mb-0"><i class="fas fa-comment me-2"></i>Binh luận đánh giá</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
