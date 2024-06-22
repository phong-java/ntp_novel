
<div class="container-xl p-0">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2"
                        src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">Ảnh không được lớn hơn 5mb</div>
                    <!-- Profile picture upload button-->
                    <button class="btn btn-primary phong" type="button">Thay đổi ảnh đại diện</button>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Thông tin chi tiết</div>
                <div class="card-body">
                    <form   method="POST" action="{{ route('User.update', [$user->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Tên (Cách mà chúng tôi hiển thị bạn trên website)</label>
                            <input class="form-control" id="inputUsername" name="tennguoidung" type="text" placeholder="Tên bạn là" value="{{ old('tennguoidung') ? old('tennguoidung') : $user->name }}">
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
                                    <option <?php echo $user->sGender=='Nam'?'selected':''?> value="Nam">Nam</option>
                                    <option <?php echo $user->sGender=='Nữ'?'selected':''?> value="Nữ">Nữ</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="inputLocation">Địa chỉ</label>
                            <input class="form-control" id="inputLocation" type="text" placeholder="Địa chỉ của bạn" name="diachi" value="{{ old('diachi') ? old('diachi') : $user->sAdress }}">
                        </div>

                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
