@extends('layouts.client')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.sidebar')

        <div class="container">
            <div class="d-lg-none text-success">hide on screens wider than lg</div>
            <div class="d-none d-lg-block text-danger">hide on screens smaller than lg</div>
            <div class="d-none d-xl-block text-warning">hide on screens smaller than lg</div>
        </div>
    </div>
</div>

@endsection
