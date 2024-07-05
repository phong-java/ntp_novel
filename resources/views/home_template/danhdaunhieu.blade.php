<div class="card">
    <div class="card-header fw-bold">Truyện được đánh dấu nhiều</div>
    <div class="card-body">
        <div class="ntp_slick">
            <?php
                
                for ($i=0; $i < 10; $i++) { 
                    ?>
            <div class="card ntp_novel text-center ">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <a href="{{route('Novel.show',[1])}}">
                        <img class="w-100" src="{{ asset('uploads/images/bookcover256.jpg') }}" class="img-fluid"
                            alt="bookcover256">
                    </a>
                </div>
                <a href="{{route('Novel.show',[1])}}">
                    <p class="card-title ntp_novel_title m-0 fw-bold"> Đã từng, ta muốn làm người tốt </p>
                </a>
                <div class="card-footer p-1 ntp_novel_infor">200 lượt đánh dấu</div>
            </div>
            <?php
                }
                ?>
        </div>
    </div>
</div>
