@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-4">
                <div class=" row">
                    <div class="col-md-6 mb-4 mb-md-0">
                        {{-- Lịch sử đọc --}}
                        @include('home_template.lichsudoc')
                    </div>
                    <div class="col-md-6">
                        {{-- Đánh dấu --}}
                        @include('home_template.danhdau')
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                @include('home_template.docnhieu')
            </div>

            <div class="col-md-12 mb-4">
                {{-- truyện được đánh dấu nhiều --}}
                @include('home_template.danhdaunhieu')
            </div>

            <div class="col-md-12 mb-4">
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

            <div class="col-md-12 mb-4">
                @include('home_template.docnhieutrongtuan')

            </div>

        </div>
    </div>
@endsection
