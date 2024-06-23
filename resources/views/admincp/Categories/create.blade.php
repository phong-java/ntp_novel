@extends('layouts.app')

@section('content')
    

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thêm thể loại truyện</div>
                    @guest
                        <div class="card-body">
                            @include('layouts.404_traiphep')
                        </div>
                    @else
                        @auth
                            @if (Auth::user()->sRole == 'admin')
                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('Categories.store') }}">
                                        @csrf

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{old('tentheloai')}}" name="tentheloai" id="floatingInput"
                                                placeholder="Tên danh mục">
                                            <label for="floatingInput">Tên danh mục</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" placeholder="Leave a comment here" name="motatheloai" id="floatingTextarea"
                                                style="height: 300px;">{{old('motatheloai')}}</textarea>
                                            <label for="floatingTextarea">Mô tả</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="floatingSelect" name="trangthai"
                                                aria-label="Floating label select example">
                                                <option selected value="1">Kích hoạt</option>
                                                <option value="0">Vô hiệu hóa</option>
                                            </select>
                                            <label for="floatingSelect">Trạng thái hoạt động</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>

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
@endsection
