<?php
use App\Models\Novel;
use App\Models\Reading_history;
use Illuminate\Support\Facades\Auth;
?>
<div class="card ntp_read_history_card">
    <div class="card-header fw-bold ">Lịch sử đọc của bạn</div>
    <div class="card-body">
        <div class="badge bg-warning text-dark w-100 text-truncate mb-2">Lưu truyện trong này dễ mất dấu hãy dùng đánh
            dấu
        </div>
        @if (Auth::check())
            <?php
            
            $historys = DB::table('tblreading_history')
                ->join('tblchapter', 'tblreading_history.idChapter', '=', 'tblchapter.id')
                ->join('tblnovel', 'tblchapter.idNovel', '=', 'tblnovel.id')
                ->where('tblreading_history.idUser', Auth::user()->id)
                ->select('tblchapter.sChapter', 'tblchapter.id as chapter_id', 'tblchapter.iChapterNumber', 'tblnovel.id as novel_id', 'tblnovel.sNovel', 'tblreading_history.dUpdateDay')
                ->orderBy('tblreading_history.dUpdateDay', 'DESC')
                ->get()
                ->groupBy('novel_id')
                ->map(function ($item) {
                    return $item->first();
                })
                ->values();
                // var_dump($historys);
            ?>
            <div class="overflow-auto ntp_read_history ntp_custom_ver_scrollbar" style="height: 200px;">
                @foreach ($historys as $key => $history)
                    <div class="d-flex flex-row my-1 align-items-center justify-content-between">
                        <a href="{{ route('Novel.show', [$history->novel_id]) }}"
                            class="title text-truncate text-decoration-none text-reset"> Tên truyện: {{ $history->sNovel}}<br> Chương
                            {{ $history->iChapterNumber . ': ' . $history->sChapter }}
                        </a>
                        <div class="d-flex flex-row align-items-center">
                            <a href="{{ route('Chapter.show', [$history->chapter_id]) }}" title="Đọc tiếp" class="btn btn-success mx-2">...</a>
                            <a href="javascript:void(0);" data-link="{{ route('Chapter.xoa_lichsu_doc', [$history->novel_id]) }}" data-id-novel="{{$history->novel_id}}" title="Xóa lịch sử" class="btn ntp_remove_readding_history btn-danger me-2">X</a>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        @else
            <div class="overflow-auto ntp_read_history ntp_read_history_locall ntp_custom_ver_scrollbar"
                style="height: 200px;">

            </div>
        @endif
    </div>
</div>
