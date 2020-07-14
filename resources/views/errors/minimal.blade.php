@extends('layouts.client')
@section('css')
<style>
    .default {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 100;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .code {
        border-right: 2px solid;
        font-size: 26px;
        padding: 0 15px 0 15px;
        text-align: center;
    }

    .message {
        font-size: 18px;
        text-align: center;
    }
</style>
@endsection
@section("content");`
<div class="flex-center position-ref full-height">


    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>Oops!</h1>
                <h2>
                    @yield('code')</h2>
                <div class="error-details">
                    @yield('message')
                </div>
                <h2>{{ $exception->getMessage() }}</h2>
                <div class="error-actions">
                    <a href="{{url('/')}}" class="btn btn-primary btn-lg"><i class="fas fa-home"></i>Take Me Home </a>
                    <a href="{{url('/contact')}}" class="btn btn-default btn-lg"><i class="fas fa-envelope"></i> Contact
                        Support </a>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
