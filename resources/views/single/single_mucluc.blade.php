

<?php

use Carbon\Carbon;

?>
<div class="card" id="ntp_mucluc">
    <div class="card-header fw-bold">Mục lục</div>
    <div class="card-body">
        <div class="overflow-auto ntp_custom_ver_scrollbar" style="height: 500px;">
            @foreach ($chapters as $key => $chapter)
                <div class="d-flex ntp_mucluc p-2 gap-2 w-100">
                    <div class="flex-grow-1 w-70">
                        <a href="{{ route('Chapter.show', [$chapter->id]) }}"
                            class="title text-decoration-none text-reset fw-bold">
                            Chương
                            <?php echo $chapter->iChapterNumber; ?>: {{$chapter->sChapter}}.
                        </a>
                    </div>
                    <span class="ntp_time_update w-30">
                        <?php
                        $minutes = 36450; // Ví dụ số phút
                        
                        $days = floor($minutes / (24 * 60));
                        $hours = floor(($minutes - $days * 24 * 60) / 60);
                        $remainingMinutes = $minutes % 60;

                        $time = Carbon::parse($chapter->dCreateDay);
                        $time = $time->locale('Vi');

                        // Tính khoảng thời gian so với thời điểm hiện tại
                        $diff = $time->diffForHumans();
                        
                        echo  $diff ;
                        ?>
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</div>
