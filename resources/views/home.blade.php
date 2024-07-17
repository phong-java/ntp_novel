@extends('layouts.app')

@section('content')
    <div class="container">
        
        <div class="row justify-content-center">
            @include('search.search')
            <div class="col-md-12 mb-5">
                @include('home_template.danhgiacao')
            </div>
            <div class="col-md-12 mb-5">
                <div class=" row">
                    <div class="col-md-6 mb-4 mb-md-0">
                        {{-- Lịch sử đọc --}}
                        @include('user.user_read_history')
                    </div>
                    <div class="col-md-6">
                        {{-- Đánh dấu --}}
                        @include('user.user_bookmark')
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-5">
                @include('home_template.docnhieu')
            </div>

            <div class="col-md-12 mb-5">
                {{-- truyện được đánh dấu nhiều --}}
                @include('home_template.danhdaunhieu')
            </div>

            <div class="col-md-12 mb-5">
                <div class=" row">
                    <div class="col-md-8 mb-4 mb-md-0">
                        {{-- truyện mới cập nhật --}}
                        @include('home_template.truyenmoicapnhat')
                    </div>
                    <div class="col-md-4">
                        {{-- Thể loại --}}
                        @include('home_template.theloai')
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-5">
                @include('home_template.docnhieutrongtuan')

            </div>

        </div>
    </div>
@endsection
