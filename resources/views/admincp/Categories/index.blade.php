<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header fw-bold">Danh sách thể loại truyện</div>



                @guest
                <div class="card-body">
                    @include('layouts.404_traiphep')
                </div>
            @else
                @auth
                    @if (Auth::user()->sRole == 'admin')
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Mã thể loại</th>
                                    <th scope="col">Tên thể loại</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Ngày khởi tạo</th>
                                    <th scope="col">Cập nhật lần cuối</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($cats as $key => $cat)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $cat->id }}</td>
                                        <td>{{ $cat->sCategories }}</td>
                                        <td class="w-25">{{ $cat->sDes }}</td>
                                        <td>
                                            @if ($cat->iStatus == 1)
                                                <span class="text text-success">kích hoạt</span>
                                            @else
                                                <span class="text text-danger">Không kích hoạt</span>
                                            @endif
                                        </td>
                                        <td>{{ $cat->dCreateDay }}</td>
                                        <td>{{ $cat->dUpdateDay }}</td>
                                        <td>
                                            <a href="{{route('Categories.edit',[$cat -> id])}}" class="btn btn-primary"> Sửa</a>
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