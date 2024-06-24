@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12 mb-5">
                @include('single.thongtintruyen')
            </div>

            <div class="col-md-12 mb-5">
                @include('single.single_mucluc')
            </div>

            <div class="col-md-12 mb-5">
                {{-- truyện được đánh dấu nhiều --}}
                @include('home_template.danhdaunhieu')
            </div>

            <div class="col-md-12 mb-5">
                @include('single.single_review')
            </div>
        </div>
    </div>
@endsection