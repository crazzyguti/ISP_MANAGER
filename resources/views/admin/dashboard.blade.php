@extends('layouts.client')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        Your application's dashboard.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
