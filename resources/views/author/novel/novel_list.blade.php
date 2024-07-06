<div class="container" id="ntp_novel_list_wrap">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header fw-bold">Danh sách truyện đã đăng</div>
                @guest
                <div class="card-body">
                    @include('layouts.404_traiphep')
                </div>
            @else
                @auth
                    @if (Auth::user()->sRole !== 'user')
                    <div class="card-body overflow-auto ntp_custom_ver_scrollbar" style="height: 1000px;">
                        <table class="table table-hover ntp_novel_list">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    {{-- <th scope="col">Mã thể loại</th> --}}
                                    <th scope="col">Ảnh bìa</th>
                                    <th scope="col">Tên truyện</th>
                                    <th scope="col">Số chương</th>
                                    <th scope="col">Tiến độ</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Ngày khởi tạo</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($novels as $key => $novel)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        {{-- <td>{{ $cat->id }}</td> --}}
                                        <td> <img class="ntp_anh_bia mb-2 w-100" src="{{ asset('uploads/images/'.$novel->sCover) }}" alt=""></td>
                                        <td class="name">{{ $novel->sNovel }}</td>
                                        <td>X chương</td>
                                        <td>
                                            @if ($novel->sProgress == 1)
                                                <span class="text text-success">Còn tiếp</span>
                                            @elseif($novel->sProgress == 2)
                                                <span class="text text-warning">Tạm ngưng</span>
                                            @elseif($novel->sProgress == 3)
                                                <span class="text text-danger">Hoàn thành</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($novel->iStatus == 1)
                                                <span class="text text-success">Đăng tải</span>
                                            @else
                                                <span class="text text-danger">Đã bị ghỡ bỏ</span>
                                            @endif
                                        </td>
                                        <td>{{ $novel->dCreateDay }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{route('Novel.quan_ly_truyen',[$novel->id])}}">Quản lý truyện</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <div class="card-body">
                            @include('layouts.404_traiphep')
                        </div>
                    @endif
                @endauth
            @endguest
            </div>
        </div>
    </div>
</div>