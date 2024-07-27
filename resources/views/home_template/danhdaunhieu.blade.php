@php
use App\Models\Comment;
use App\Models\Novel;
use Illuminate\Support\Facades\DB;

$novels = Novel::select('tblnovel.id', 'tblnovel.sNovel', 'tblnovel.sCover', 'tblnovel.sDes', 'tblnovel.dCreateDay', 'tblnovel.dUpdateDay', 'tblnovel.sProgress', 'tblnovel.iStatus', 'tblnovel.idUser', 'tblnovel.iLicense_Status', 'tblnovel.sLicense', DB::raw('COUNT(tblbookmarks.id) as bookmark_count'))
    ->leftJoin('tblbookmarks', 'tblnovel.id', '=', 'tblbookmarks.idNovel')
    ->groupBy('tblnovel.id', 'tblnovel.sNovel', 'tblnovel.sCover', 'tblnovel.sDes', 'tblnovel.dCreateDay', 'tblnovel.dUpdateDay', 'tblnovel.sProgress', 'tblnovel.iStatus', 'tblnovel.idUser', 'tblnovel.iLicense_Status', 'tblnovel.sLicense')
    ->where('tblnovel.iLicense_Status', '=', 1)
    ->where('tblnovel.iStatus', '=', 1)
    ->orderByDesc('bookmark_count')
    ->take(10)
    ->get();
@endphp

<div class="card">
    <div class="card-header fw-bold">Truyện được đánh dấu nhiều</div>
    <div class="card-body">
        <div class="ntp_slick">
            @foreach ($novels as $key => $novel)
            <div class="card ntp_novel text-center ">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <a href="{{route('Novel.show',[$novel->id])}}">
                        <img class="w-100" src="{{ asset('uploads/images/'.$novel->sCover) }}" class="img-fluid"
                            alt="{{$novel->sCover}}">
                    </a>
                </div>
                <a href="{{route('Novel.show',[$novel->id])}}">
                    <p class="card-title ntp_novel_title m-0 fw-bold"> {{$novel->sNovel}} </p>
                </a>
                <div class="card-footer p-1 ntp_novel_infor">{{$novel->bookmark_count}}lượt đánh dấu</div>
            </div>
            @endforeach
        </div>
    </div>
</div>
