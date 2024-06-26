
<div class="container-xl p-0">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header fw-bold">Ảnh đại diện</div>
                <div class="card-body ntp_av_wrap text-center">
                    <!-- Profile picture image-->
                    <img class="ntp_av rounded-circle mb-2"
                        src="{{ asset('uploads/user_av/'.Auth::user()->sAvatar) }}" alt="">
                    <!-- Profile picture help block-->
                    <div class="my-3">
                        <div class="alert alert-success ntp_hidden" role="alert"></div>
                        <div class="alert alert-danger ntp_hidden" role="alert"></div>
                        <label for="av_upoad" class="btn m-0 btn-primary form-label">Thay đổi ảnh đại diện</label>
                      </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header fw-bold">Thông tin chi tiết</div>
                <div class="card-body">
                    <form method="POST" id="ntp_form_update_infor_user" action="{{ route('User.update', [$user->id]) }}">
                        @csrf
                        <div class="alert alert-success ntp_hidden" role="alert"></div>
                        <div class="alert alert-danger ntp_hidden" role="alert"></div>
                        <input class="form-control d-none" type="file"  name="anhdaidien" accept="image/*" id="av_upoad">
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Tên (Cách mà chúng tôi hiển thị bạn trên website)</label>
                            <input class="form-control" id="inputUsername" maxlength="255" name="tennguoidung" type="text" placeholder="Tên bạn là" value="{{ old('tennguoidung') ? old('tennguoidung') : $user->name }}">
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                            <input class="form-control" id="inputEmailAddress" type="email" disabled value="{{$user->email }}">
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Ngày sinh</label>
                                <input class="form-control" id="inputBirthday" type="date" value="{{ old('ngaysinh') ? old('ngaysinh') : $user->dBirthday }}" name="ngaysinh" placeholder="Chọn ngày sinh của bạn">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">Giới tính</label>
                                <select class="form-select" name="gioitinh" aria-label="Default select example">
                                    @if($user->sGender=='')
                                        <option disabled  selected>Giới tính của bạn là ? (không bắt buộc)</option>
                                    @endif
                                    <option <?php echo $user->sGender=='nam'?'selected':''?> value="nam">Nam</option>
                                    <option <?php echo $user->sGender=='nữ'?'selected':''?> value="nữ">Nữ</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputLocation">Địa chỉ</label>
                            <input class="form-control" id="inputLocation" type="text" maxlength="255" placeholder="Địa chỉ của bạn" name="diachi" value="{{ old('diachi') ? old('diachi') : $user->sAdress }}">
                        </div>

                        <!-- Save changes button-->
                        <button class="btn btn-primary ntp_btn_update_infor_user" type="button">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
