<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('headers.style')
    @include('headers.script')
    @yield("css")
</head>

<body>
    @section('partials.menu')

    @show

    <div class="container">
        @yield('content')
    </div>
</body>

</html>
