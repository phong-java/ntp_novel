<div class="card" id="ntp_review">
    <div class="card-header fw-bold">Bình luận đánh giá</div>
    <div class="card-body">
        <div class="card mb-4">
            <div class="card-header fw-bold">Viết bình luận</div>
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="d-flex flex-start w-100 gap-3">
                        <img class="ntp_av_nav rounded-circle shadow-1-strong" width="65"
                            height="65"src="{{ asset('uploads/user_av/phong_av.jpg') }}" alt="">
                        <div class="w-100">
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

        <div class="card ntp_review_wrap">
            <div class="card-header fw-bold"> Các đánh giá</div>
            <div class="card-body">
                <div class="overflow-auto ntp_custom_ver_scrollbar p-3 ps-0" style="height: 500px;">
                    <?php
                for ($i=1; $i <= 4; $i++) { 
                    ?>
                    <div class="d-flex ntp_review_item flex-start mb-4 gap-3">
                        <img class="ntp_av_review rounded-circle shadow-1-strong" src="{{ asset('uploads/user_av/phong_av.jpg') }}" alt="">
                        <div class="card w-100">
                            <div class="">
                                <div class="p-4">
                                    <p>Phạm Tuấn Phong - 2024-06-06 09:27:45</p>
                                    <p>
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                        ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus
                                        viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla.
                                        Donec lacinia congue felis in faucibus ras purus odio, vestibulum in
                                        vulputate at, tempus viverra turpis.
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="#!" class="link-muted"><i class="fas fa-reply me-1"></i>
                                            Phản hồi<i></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 

                    $r = rand(1,6);
                    for ($t=1; $t <= $r; $t++)  {
                        ?>
                    <div class="d-flex  ntp_review_item ntp_review_item_child flex-start mb-4 gap-3">
                        <img class="ntp_av_review rounded-circle shadow-1-strong" src="{{ asset('uploads/user_av/phong_av.jpg') }}" alt="">
                        <div class="card w-100">
                            <div class="">
                                <div class="p-4">
                                    <p>Phạm Tuấn Phong - phản hồi - 2024-06-06 09:27:45</p>
                                    <p>
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                        ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus
                                        viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla.
                                        Donec lacinia congue felis in faucibus ras purus odio, vestibulum in
                                        vulputate at, tempus viverra turpis.
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="#!" class="link-muted"><i class="fas fa-reply me-1"></i>
                                            Phản hồi<i></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                }
                  ?>
                </div>
            </div>
        </div>

    </div>
</div>
