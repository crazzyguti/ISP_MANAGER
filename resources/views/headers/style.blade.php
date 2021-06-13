@php
    $styles = [
        "css/app.css",
        //"down/bootstrap-extend.min.css",
        "css/style.css",
        // "vendor/datatable/datatables.min.css"
        // "css/reasy-ui.css"
        //  "vendor/jsoneditor/dist/jsoneditor.css",
    ];

@endphp

@foreach ($styles as $item)
<link href="{{ asset($item) }}" rel="stylesheet">
@endforeach

{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
{{-- <link href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
{{-- <link href="{{ asset('vendor/mdbootstrap/css/mdb.css') }}" rel="stylesheet"> --}}
{{-- <link href="{{ asset('vendor/fontawesome/css/all.css') }}" rel="stylesheet"> --}}
{{-- <link href="{{ asset('vendor/contextMenu/dist/jquery.contextMenu.css') }}" rel="stylesheet"> --}}
{{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> --}}
{{-- <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet"> --}}
{{-- <link href="{{ asset('vendor/chart.js/dist/Chart.min.css') }}" rel="stylesheet"> --}}
{{-- <link href="{{ asset('vendor/datatable/datatables.min.css') }}" rel="stylesheet"> --}}
