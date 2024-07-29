@php
use App\Models\Novel;
use App\Models\Reading_history;
use App\Models\Chapter;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

$oneWeekAgo = Carbon::now()->subWeek();

$novels = Novel::select('tblnovel.id', 'tblnovel.sNovel', 'tblnovel.sCover', 'tblnovel.sDes', 'tblnovel.dCreateDay', 'tblnovel.dUpdateDay', 'tblnovel.sProgress', 'tblnovel.iStatus', 'tblnovel.idUser', 'tblnovel.iLicense_Status', 'tblnovel.sLicense', DB::raw('COUNT(tblreading_history.id) as read_count'))
    ->join('tblchapter', 'tblnovel.id', '=', 'tblchapter.idNovel')
    ->join('tblreading_history', 'tblchapter.id', '=', 'tblreading_history.idChapter')
    ->where('tblreading_history.dCreateDay', '>=', $oneWeekAgo)
    ->groupBy('tblnovel.id', 'tblnovel.sNovel', 'tblnovel.sCover', 'tblnovel.sDes', 'tblnovel.dCreateDay', 'tblnovel.dUpdateDay', 'tblnovel.sProgress', 'tblnovel.iStatus', 'tblnovel.idUser', 'tblnovel.iLicense_Status', 'tblnovel.sLicense')
    ->orderByDesc('read_count')
    ->take(10)
    ->get();
@endphp

<div class="card">
    <div class="card-header fw-bold">Truyện được đọc nhiều trong tuần</div>
    <div class="card-body">
        <div class="ntp_slick">
            @foreach ($novels as $key => $novel)
            <div class="card ntp_novel text-center ">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <a href="{{route('Novel.show',[$novel->id])}}">
                        <img class="w-100 ntp_anh_bia" src="{{ asset('uploads/images/'.$novel->sCover) }}" class="img-fluid"
                            alt="{{$novel->sCover}}">
                    </a>
                </div>
                <a href="{{route('Novel.show',[1])}}">
                    <p class="card-title ntp_novel_title m-0 fw-bold"> {{$novel->sNovel}} </p>
                </a>
                <div class="card-footer p-1 ntp_novel_infor"> {{$novel->read_count}} lượt đoc</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

