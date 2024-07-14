
<?php
use App\Models\Categories;
use Illuminate\Support\Str;

$cats = Categories::orderBy('id', 'DESC')->where('iStatus', 1)->get();

$matchingIds = [];

foreach ($theloai as $loai) {
    foreach ($cats as $cat) {
        if ($cat->id == $loai->idCategories) {
            $matchingIds[] = $cat->id;
        }
    }
}

?>
<div class="container">
    <div class="row mb-5">
        <div class="col-xl-12 mb-4">
            <!-- Profile picture card-->
            <div class="card  mb-xl-0">
                <div class="card-header fw-bold">Ảnh bìa truyện</div>
                <div class="card-body ntp_anh_bia_wrap text-center">
                    <!-- Profile picture image-->
                    <img class="ntp_anh_bia mb-2 w-50" src="{{ asset('uploads/images/' . $novel->sCover) }}"
                        alt="">

                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-5">
                <div class="card-header fw-bold">Thông tin chi tiết truyện</div>
                <div class="card-body">
                        <div class="mb-3">
                            <label class="small mb-1">Tên truyện:</label>
                           <span class="text-primary">{{ $novel->sNovel }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1">Mô tả:</label>
                            <div class="text-primary">{!! htmlspecialchars_decode($novel->sDes) !!}</div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1">Thể loại:</label>
                            @foreach ($cats as $key => $cat)
                                @if (in_array($cat->id, $matchingIds))
                                <span class="text-primary">{{ $cat->sCategories}}</span> |
                                @endif
                            @endforeach
                        </div>

                        <div class="gx-3 mb-3">
                            <label class="small mb-1">Tiến độ:</label>
                            <span class="text-primary">
                                <?php
                                    if( $novel->sProgress == '1') {
                                        echo'Còn tiếp';
                                    } elseif ($novel->sProgress == '2') {
                                        echo'Tạm ngừng';
                                    } elseif ($novel->sProgress == '3') {
                                        echo'Hoàn thành';
                                    }
                                ?>
                            </span>
                        </div>

                        <div class="gx-3 mb-3">
                            <label class="form-label">Minh chứng quyền tác giả / quyền sở hữu với tác phẩm đã cung cấp:</label>
                            <iframe id="ntp_banquyen_da_upload" src="{{asset('uploads/banquyen/' . $novel->sLicense)}}" class="w-100 vh-100"></iframe>
                        </div>

                    
                </div>
            </div>
            <form method="POST" id="ntp_form_novel_License" action="{{ route('Novel.xetduyet', [$novel->id]) }}">
                @csrf
                <div class="alert alert-success ntp_hidden" role="alert"></div> 
                <div class="alert alert-danger ntp_hidden" role="alert"></div>
                <input class="btn-check" type="radio" name="xuly" id="xuly1" value="1">
                <label class="btn btn-outline-primary" for="xuly1">Xác thực bản quyền thành công</label>
        
                <input class="btn-check" type="radio" name="xuly" id="xuly2" value="3">
                <label class="btn btn-outline-primary" for="xuly2">Xác thực bản quyền thất bại</label>
            </form>
        </div>
    </div>
</div>