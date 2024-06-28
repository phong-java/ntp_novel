@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @guest
                    <div class="card-body">
                        @include('layouts.404_traiphep')
                    </div>
                @else
                    @auth
                        <div class="card">
                            <div class="card-header fw-bold"> {{ $message }} </div>

                            <div class="card-body">
                                <div class="alert alert-success" role="alert">{{ $message }}</div>
                            </div>

                        </div>
                    @endauth
                @endguest
            </div>
        </div>
    </div>
@endsection
