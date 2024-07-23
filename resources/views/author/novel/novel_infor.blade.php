
<?php
use App\Models\Categories;
use Illuminate\Support\Str;

$cats = Categories::orderBy('id', 'DESC')->where('iStatus',1)->get();

?>
<div class="container mb-4">
    <div class="row">
        <div class="col-md-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header fw-bold">Ảnh bìa truyện</div>
                <div class="card-body ntp_anh_bia_wrap text-center">
                    <!-- Profile picture image-->
                    <img class="ntp_anh_bia mb-2 w-100"
                        src="{{ asset('uploads\images\bookcover256.jpg') }}" alt="">
                    <!-- Profile picture help block-->
                    <div class="my-3">
                        <div class="alert alert-success ntp_hidden update_anhdaidien" role="alert"></div>
                        <div class="alert alert-danger ntp_hidden update_anhdaidien" role="alert"></div>
                        <label for="ntp_input_anhbiatruyen" class="btn m-0 btn-primary form-label">Chọn ảnh bìa</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header fw-bold">Thông tin chi tiết truyện</div>
                <div class="card-body">
                    <form method="POST" id="ntp_form_create_novel" action="{{ route('Novel.store', [Auth::user()->id]) }}">
                        @csrf
                        <input class="form-control d-none" type="file" id="ntp_input_anhbiatruyen"  name="anhbia" accept="image/*">
                        <div class="alert alert-success ntp_hidden" role="alert"></div>
                        <div class="alert alert-danger ntp_hidden" role="alert"></div>
                       
                        <div class="mb-3">
                            <label class="small mb-1" for="inputnovelname">Tên truyện</label>
                            <input class="form-control" id="inputnovelname" maxlength="255" name="tentruyen" type="text" placeholder="Tên truyện là">
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1">Mô tả</label>
                            <textarea name="motatruyen" id="motatruyen" class="ntp_ckeditor ckeditor w-100" {{--cols="30" rows="10"--}}></textarea>
                        </div>

                        <div class="gx-3 mb-3 input-group"> 
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown"
                            aria-expanded="false"> Thể loại</button>
                            <div class="dropdown-menu dropdown-menu-lg-end">
                                <div class="d-flex gap-3 flex-wrap p-2 ntp_select_the_loai overflow-auto ntp_custom_ver_scrollbar" role="group" aria-label="Basic checkbox toggle button group">
                                    @foreach ($cats as $key => $cat)
                                        <input class="form-check-input btn-check" type="checkbox" autocomplete="off" value="{{$cat->id}}" name="theloai[]" id="{{Str::slug($cat->sCategories).'_'.$cat->id}}">
                                        <label class="btn btn-outline-primary" for="{{Str::slug($cat->sCategories).'_'.$cat->id}}">{{$cat->sCategories}}</label>
                                    @endforeach
                                  </div>
                            </div>
                        </div>

                        <div class="gx-3 mb-3">
                            <label class="small mb-1">Tiến độ</label>
                            <select class="form-select" name="tiendo" id="inputnovelprogress" aria-label="Default select example">
                                <option value="1">Còn tiếp</option>
                                <option value="2">Tạm ngừng</option>
                                <option value="3">Hoàn thành</option>
                            </select>
                        </div>
                    
                        <div class="gx-3 mb-3">
                            <label for="upload_banquyen" class="form-label">Minh chứng quyền tác giả hoặc quyền sở hữu với tác phẩm</label>
                            <input class="form-control mb-3" type="file" name="banquyen" id="upload_banquyen">
                        </div>

                        <!-- Save changes button-->
                        <button class="btn btn-primary ntp_btn_create_novel" type="button">tạo mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
