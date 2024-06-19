@extends('layouts.app')

@section('content')
    @include('layouts.nav')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thêm thể loại truyện</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('Categories.store') }}">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput"
                                    placeholder="name@example.com">
                                <label for="floatingInput">Tên danh mục</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 300px;"></textarea>
                                <label for="floatingTextarea">Mô tả</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                    <option selected value="1">Kích hoạt</option>
                                    <option value="0">Vô hiệu hóa</option>
                                </select>
                                <label for="floatingSelect">Trạng thái hoạt động</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
