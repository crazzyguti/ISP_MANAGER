@php
    $scripts = [

    "default" => [
        //"vendor/jquery/dist/jquery.js",
        //"vendor/mdbootstrap/js/popper.min.js"
        //"vendor/bootstrap/dist/js/bootstrap.min.js",
        //"vendor/mdbootstrap/js/mdb.min.js",
        //"vendor/contextMenu/dist/jquery.contextMenu.js",
        //"vendor/jquery.easing/js/jquery.easing.min.js",
        //"vendor/chart.js/dist/Chart.js",
        //"vendor/mdbootstrap/js/addons/datatables.js",
        //"vendor/jquery.steps/build/jquery.steps.min.js",
        //"vendor/mdbootstrap/js/addons/datatables.js",
        //c"vendor/holderjs/holder.min.js",
],

        "defer" => [
            "js/app.js",
        ]
    ];
@endphp

@foreach ($scripts["default"] as $item)
<script src="{{ asset($item) }}"></script>
@endforeach
@foreach ($scripts["defer"] as $item)
<script src="{{ asset($item) }}" defer></script>
@endforeach

<!--- Scripts -->
{{-- <script src="{{ asset('vendor/jquery/dist/jquery.js') }}"></script> --}}
{{-- <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script> --}}
{{-- <script src="{{ asset('vendor/mdbootstrap/js/popper.min.js') }}"></script> --}}
{{-- <script src="{{ asset('vendor/fontawesome/js/all.js') }}" data-auto-replace-svg="nest"></script> --}}
{{-- <script src="{{ asset('vendor/mdbootstrap/js/mdb.min.js') }}"></script> --}}
{{-- <script src="{{ asset('vendor/contextMenu/dist/jquery.contextMenu.js') }}"></script> --}}
{{-- <script src="{{ asset('js/sb-admin-2.min.js') }}"></script> --}}
<!-- Core plugin JavaScript-->
{{-- <script src="{{asset('vendor/jquery.easing/js/jquery.easing.min.js')}}"></script> --}}

<!-- Page level plugins -->
{{-- <script src="{{asset('vendor/chart.js/dist/Chart.js')}}"></script> --}}

<!-- Page level custom scripts -->
{{-- <script src="{{asset('vendor/datatable/datatables.js')}}"></script> --}}
{{-- <script src="{{asset('vendor/mdbootstrap/js/addons/datatables.js')}}"></script> --}}
{{-- <script src="{{asset('vendor/jquery.steps/build/jquery.steps.min.js')}}"></script> --}}
{{-- <script src="{{asset('vendor/holderjs/holder.min.js')}}"></script> --}}

