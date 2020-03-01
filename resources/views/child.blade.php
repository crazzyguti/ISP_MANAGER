@extends('layouts.app2')

@section('title', 'Page Title')

@section('sidebar')
@parent

<p>{{__("This is appended to the master sidebar.")}}</p>
@endsection

@section('content')
<p>This is my body content.</p>

{{$user->firstName}}
@endsection
