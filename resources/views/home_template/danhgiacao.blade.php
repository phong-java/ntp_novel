<div class="card">
    <div class="card-header fw-bold">Truyện được đánh giá cao</div>
    <div class="card-body">
        <div class="ntp_recommend ntp_slick_l_p0">
            <?php
            
            for ($i=0; $i < 4; $i++) { 
                ?>

            <div class="ntp_item d-flex gap-2">
                <div class="w-50 mb-4 mb-md-0">
                    {{-- Ảnh bìa --}}
                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                        <a href="{{route('Novel.show',[1])}}">
                            <img class="w-100" src="{{ asset('uploads/images/bookcover256.jpg') }}" class="img-fluid"
                                alt="bookcover256">
                        </a>
                    </div>
                </div>
                <div class="w-50  overflow-Y overflow-Xh  ntp_custom_ver_scrollbar">
                    {{-- Thông tin --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Tên truyện</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"> Tên truyện </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Số chương</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"> XX chương </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Giới thiệu</p>
                            </div>
                            <div class="col-sm-9 ntl_tomtat overflow-auto ntp_custom_ver_scrollbar">
                                <p class="text-muted mb-0">
                                    xxxxx xxx xx xxxx, xxx xxx xx xxx xxx xxx xxx.<br>
                                    1: xx xxx xxx x xxx xx xxxxx xx xxx xx.<br>
                                    2:  xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx.<br>
                                    3:  xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx.<br>
                                    xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx.<br>
                                    xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx<br>
                                    xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx<br>
                                    xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx.<br>
                                    xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx<br>
                                    xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Tác giả</p>
                            </div>
                            <div class="col-sm-9">

                                <a href="#!" class=" w-50">
                                    <p class="mb-0 text-success"><i class="fa-solid fa-user me-2"></i>Bút danh tác giả
                                    </p>
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Tiến độ</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="mb-0 text-success">Còn tiếp</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Thông số</p>
                            </div>
                            <div class="col-sm-9 d-flex">
                                <p class="text-muted mb-0 w-50">XXX lượt đọc</p>
                                <p class="text-muted mb-0 w-50">XXX đánh dấu</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Thao tác</p>
                            </div>
                            <div class="col-sm-9 d-flex">
                                <a href="{{route('Novel.show',[1])}}" class=" w-50">
                                    <p class="text-muted mb-0"><i class="fa-solid fa-book-open me-2"></i>Đọc luôn
                                    </p>
                                </a>
                                <a href="#!" class=" w-50">
                                    <p class="text-muted mb-0"><i class="fa-solid fa-bookmark me-2"></i>Đánh dấu</p>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?php
            }
            ?>

        </div>
    </div>
</div>
