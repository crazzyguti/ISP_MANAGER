@extends('layouts.client')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @auth

                    <p>
                        Welcome Again <b>{{Auth::user()->fullName}}</b>
                    </p>
                    @endauth

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
