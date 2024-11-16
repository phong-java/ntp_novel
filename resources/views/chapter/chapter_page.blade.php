@extends('layouts.app')
@section('content')
    <div class="container ntp_chapter_page">
        <div class="row justify-content-center">

            <div class="col-md-12 mb-5">
                @include('chapter.chapter_content')
            </div>

            <button class="ntp_get_content"> okokok</button>

            <div class="col-md-12 mb-5">
                @include('home_template.danhdaunhieu')
            </div>
        </div>
    </div>
@endsection