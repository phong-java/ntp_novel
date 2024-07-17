
<?php
    $p_link = $previousChapterId != '0' ? route('Chapter.show', [$previousChapterId]) : route('Novel.show',[$novel->id]);
    $n_link = $nextChapterId != '0' ? route('Chapter.show', [$nextChapterId]) : route('Novel.show',[$novel->id]);
?>

<div class="ntp_chapter_title text-center mb-4">
    <h3>{{$novel->sNovel}}</h3>
<h5>{{'Chương '.$chapter->iChapterNumber.': '.$chapter->sChapter}}</h5>
</div>

<div class="card">
    <div class="card-header d-flex gap-3 fw-bold justify-content-evenly align-items-center">
        <a href="{{$p_link}}" class="d-flex gap-2 align-items-center"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i> Chương trước </a>
        <a href="{{route('Novel.show',[$novel->id]).'#ntp_mucluc'}}" class="d-flex gap-2 align-items-center"><i class="fa-solid fa-bars" aria-hidden="true"></i>Mục lục</a>
        <a href="{{$n_link}}" class="d-flex gap-2 align-items-center">Chương sau <i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a>
    </div>
    <div class="card-body">
        {!!htmlspecialchars_decode($chapter->sContent)!!}
    </div>
    <div class="card-footer d-flex gap-3 fw-bold justify-content-evenly align-items-center">
        <a href="{{$p_link}}" class="d-flex gap-2 align-items-center"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i> Chương trước </a>
        <a href="{{route('Novel.show',[$novel->id]).'#ntp_mucluc'}}" class="d-flex gap-2 align-items-center"><i class="fa-solid fa-bars" aria-hidden="true"></i>Mục lục</a>
        <a href="{{$n_link}}" class="d-flex gap-2 align-items-center">Chương sau <i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a>
    </div>
</div>
