<div class="card ntp_review_wrap" id="ntp_review">
    <div class="card-header fw-bold">Bình luận đánh giá</div>
    <div class="card-body">
        <div class="card mb-4">
            <div class="card-header fw-bold">Viết bình luận</div>
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="d-flex flex-start w-100 gap-3">
                        <img class="ntp_av_review rounded-circle shadow-1-strong" width="65"
                            height="65"src="{{ asset('uploads/user_av/time_1719592364_file_default-avatar-photo-placeholder-icon-grey-vector-38594401.jpg') }}" alt="">
                        <div class="w-100">
                            <ul class="rating mb-3 list-inline d-flex gap-2" data-mdb-toggle="rating">
                                <li><i class="far fa-star fa-sm text-warning " title="Bad"></i></li>
                                <li><i class="far fa-star fa-sm text-warning " title="Poor"></i></li>
                                <li><i class="far fa-star fa-sm text-warning " title="OK"></i></li>
                                <li><i class="far fa-star fa-sm text-warning " title="Good"></i></li>
                                <li><i class="far fa-star fa-sm text-warning " title="Excellent"></i></li>
                            </ul>
                            <div data-mdb-input-init class="form-outline mb-3">
                                <textarea class="form-control" id="textAreaExample" rows="4"
                                    placeholder="viết bình luận đánh giá của bạn vào đây.."></textarea>
                            </div>
                            <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-success">
                                Đăng <i class="fa-solid fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header fw-bold"> Các đánh giá</div>
            <div class="card-body">
                <div class="overflow-auto ntp_custom_ver_scrollbar p-3 ps-0" style="height: 500px;">
                    <?php
                for ($i=1; $i <= 6; $i++) { 
                    ?>
                    <div class="d-flex  ntp_review_item flex-start mb-4 gap-3">
                        <img class="ntp_av_review rounded-circle shadow-1-strong" src="{{ asset('uploads/user_av/time_1719592364_file_default-avatar-photo-placeholder-icon-grey-vector-38594401.jpg') }}" alt="">
                        <div class="card w-100">
                            <div class="">
                                <div class="p-4">
                                    <p>Tên người dùng - yyyy-mm-dd hh:mm:ss</p>
                                    <ul class="rating mb-3 list-inline d-flex gap-2" data-mdb-toggle="rating">
                                        <li><i class="fas fa-star fa-sm text-warning " title="Bad"></i></li>
                                        <li><i class="fas fa-star fa-sm text-warning " title="Poor"></i></li>
                                        <li><i class="fas fa-star fa-sm text-warning " title="OK"></i></li>
                                        <li><i class="fas fa-star fa-sm text-warning " title="Good"></i></li>
                                        <li><i class="far fa-star fa-sm text-warning " title="Excellent"></i></li>
                                    </ul>
                                    <p>
                                        xx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xxxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xxxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx xxx x xxx xx.
                                    </p>

                                    {{-- <div class="d-flex justify-content-between align-items-center">
                                        <a href="#!" class="link-muted"><i class="fas fa-reply me-1"></i>
                                            Phản hồi<i></i></a>
                                    </div> --}}
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

    </div>
</div>
