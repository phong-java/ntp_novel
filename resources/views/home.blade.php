@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-11 container py-4 ">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                Bạn đã đăng nhập thành công
            </div>
        </div>
    </div>
</div>
@endsection