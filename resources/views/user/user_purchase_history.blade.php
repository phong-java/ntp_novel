
<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase_history;
use App\Models\Chapter;
use App\Models\Novel;

    if(Auth::check()) {
        $iduser = Auth::user()->id;
        $purchase_historys = Purchase_history::where('idUser',$iduser)->get();
    }
?>

@if(Auth::check())
<div class="card">
    <div class="card-header fw-bold">Lịch sử mua chương</div>
    <div class="card-body">
        <div class="overflow-auto ntp_custom_ver_scrollbar" style="height: 600px;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên truyện</th>
                        <th scope="col">Tên chương</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Ngày mua </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchase_historys as $key => $purchase_history)
                    
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td><?php 
                                $chapter = Chapter::find($purchase_history->idChapter)->first();
                                $novel = Novel::find($chapter->idNovel);
                                echo($novel->sNovel);
                            ?></td>
                            <td>{{ $chapter->sChapter }}</td>
                            <td>{{ $purchase_history->iprice }} <i class="fa-solid fa-coins" aria-hidden="true"></i></td>
                            <td><?php
                                $date = $purchase_history->dCreateDay;
                                $formatted_date = $date->format('d / m / Y');
                                echo $formatted_date;
                            ?></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endif