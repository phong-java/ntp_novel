<div class="card">
    <div class="card-header fw-bold">Tuyện mới cập nhật</div>
    <div class="card-body">
        <div class="overflow-auto ntp_custom_ver_scrollbar" style="height: 500px;">
            <?php
                for ($i=0; $i < 20; $i++) { 
                    ?>
            <div class="d-flex ntp_history_item p-1">
                <div class="flex-shrink-0" style="width: 50px;">
                    <img class="w-100" src="{{ asset('uploads/images/bookcover256.jpg') }}" alt="bookcover256">
                </div>
                <div class="flex-grow-1 ms-3">
                    <a href="{{route('Novel.show',[1])}}" class="title text-decoration-none text-reset fw-bold">Đồng Thời Xuyên
                        Qua:
                        Người Bình Thường Chỉ Có Mình Ta?
                    </a><br><span class="fw-lighter">Tác giả: Phạm Tuấn Phong</span>
                </div>
                <span class="ms-3">0 phút trước</span>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>
