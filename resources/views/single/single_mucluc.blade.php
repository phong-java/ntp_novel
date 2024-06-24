<div class="card">
    <div class="card-header fw-bold">Mục lục</div>
    <div class="card-body">
        <div class="overflow-auto ntp_custom_ver_scrollbar" style="height: 500px;">
            <?php
                for ($i=1; $i <= 100; $i++) { 
                    ?>
            <div class="d-flex ntp_mucluc p-2 gap-2 w-100">
                <div class="flex-grow-1 w-70">
                    <a href="{{ route('Chapter.show', [1]) }}" class="title text-decoration-none text-reset fw-bold"> Chương
                        <?php echo $i; ?>: chương không có tiêu đề. 
                    </a>
                </div>
                <span class="ntp_time_update w-30">
                    <?php
                    $minutes = 36450; // Ví dụ số phút
                    
                    $days = floor($minutes / (24 * 60));
                    $hours = floor(($minutes - $days * 24 * 60) / 60);
                    $remainingMinutes = $minutes % 60;
                    
                    echo "$days ngày, $hours giờ, $remainingMinutes phút  trước";
                    
                    ?>
                </span>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>
