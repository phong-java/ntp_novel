@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12 mb-5">
                @include('chapter.chapter_content')
            </div>

            <div class="col-md-12 mb-5">
                @include('home_template.danhdaunhieu')
            </div>

            <div class="col-md-12 mb-5">
                @include('chapter.chapter_review')
            </div>
        </div>
    </div>
@endsection