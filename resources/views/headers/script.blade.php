@php
    $scripts = [

    "default" => [
        "vendor/jquery/dist/jquery.js",
        "vendor/@popperjs/core/dist/umd/popper.js",
        "vendor/bootstrap/dist/js/bootstrap.min.js",
        "vendor/mdbootstrap/js/mdb.min.js",
        "vendor/contextMenu/dist/jquery.contextMenu.js",
        "vendor/jquery.easing/js/jquery.easing.min.js",
        "vendor/chart.js/dist/Chart.js",
        "vendor/datatable/datatables.js",
        "vendor/jquery.steps/build/jquery.steps.min.js",
        "vendor/holderjs/holder.min.js",
        "vendor/push.js/bin/push.js",
        // "js/crypto.js",
        "vendor/moment/min/moment-with-locales.min.js",
],

        "defer" => [

        ]
    ];
@endphp

@foreach ($scripts["default"] as $item)
<script src="{{ asset($item) }}"></script>
@endforeach
@foreach ($scripts["defer"] as $item)
<script src="{{ asset($item) }}" defer></script>
@endforeach

@section('scripts')

<script src="{{ mix("js/manifest.js") }}"></script>
<script src="{{ mix("js/vendor.js") }}"></script>
<script src="{{ mix("js/app.js") }}"></script>

@endsection


