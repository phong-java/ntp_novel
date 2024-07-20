<?php
use App\Models\Novel;
use App\Models\Bookmarks;
use Illuminate\Support\Facades\Auth;
?>


<div class="card ntp_bookmarks_card">
    <div class="card-header fw-bold">Đánh dấu của bạn</div>
    <div class="card-body">
        @if (Auth::check())
            <?php
                $iduser = Auth::user()->id;
                $bookmarks = Bookmarks::where('idUser', $iduser)->get();
            ?>
            <div class="overflow-auto ntp_bookmarks ntp_custom_ver_scrollbar" style="height: 200px;">
                @foreach ($bookmarks as $key => $bookmark)
                    <?php
                    $novel = Novel::find($bookmark->idNovel);
                    ?>
                    <div class="d-flex flex-row my-1 align-items-center justify-content-between">
                        <a href="{{ route('Novel.show', [$novel->id]) }}"
                            class="title text-truncate text-decoration-none text-reset">{{ $novel->sNovel }}</a>
                        <a href="javascript:void(0);" data-link="{{ route('Bookmark.bookmark_remove', [$novel->id]) }}"
                            class="btn btn-danger ntp_bookmark_remove mx-2">X</a>
                    </div>
                    <hr>
                @endforeach
            </div>
        @else
            <div class="overflow-auto ntp_bookmarks ntp_bookmarks_locall ntp_custom_ver_scrollbar" style="height: 200px;"></div>
        @endif
    </div>
</div>
