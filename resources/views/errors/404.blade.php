@extends('errors.layout')

@php
$error_number = 404;
@endphp

@section('title')
<h1>{{__("Page not found!")}} </h1>
@endsection

@section('description')
<div class="container">
<img src="https://media.giphy.com/media/Ro2MgOxH9iaVG/giphy.gif" alt="passwordScann">
<p> Sorry, but the page you were trying to view does not exist.</p>
<p> There Could be a lots of Reason Behind this </p>
 <ul>
   <li> You are a <code>All-time</code> Unlucky person, Thus. </li>
   <li> God Doesn' t love you at all, Thus. </li> <li> Dooms day is here, Servers are Dyings, Thus. </li>
<li> You killed a Kitten Recently, Thus. </li>
<li> You Mistyped a <strong>URL</strong>, Thus. </li>
<li> You Followed a <strong>OLD, DEAD, BROKEN</strong> url, Thus. </li>
<li> Or you are just missing Windows Blue Screen, Thus. </li>
</ul>
<p>nough Said, Now <a href="javascript:window.history.back()">Go Back</a> // Or Return To <a href="{{url('')}}">homepage</a></p>
@php
$default_error_message = "Please <a href='javascript:history.back()''>go back</a> or return to <a href='".url('')."'>our homepage</a>.";
  @endphp
  {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
</div>
@endsection



    @section('css')
<style>
    ::-moz-selection {
        background: #b3d4fc;
        text-shadow: none;
    }

    ::selection {
        background: #b3d4fc;
        text-shadow: none;
    }

    html {
        padding: 30px 10px;
        font-size: 20px;
        line-height: 1.4;
        color: #737373;
        background: #0001AB;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
    }


    body {
        max-width: 800px;
        _width: 800px;
        padding: 30px 20px 50px;
        border-radius: 4px;
        margin: 0 auto;
        background: #0001AB;
        font-family: Lucida, monospace;
    }

    h1 {
        margin: 0 10px;
        font-size: 50px;
        text-align: center;
        background-color: #FFF;
        color: #0001AB;
    }

    h1 span {
        color: #bbb;
    }

    h3 {
        margin: 1.5em 0 0.5em;
    }

    p {
        margin: 1em 0;
        color: #FFF;
    }

    ul {
        padding: 0 0 0 40px;
        margin: 1em 0;
        color: #FFF;
    }

    .container {
        max-width: 600px;
        _width: 600px;
        margin: 0 auto;
    }

    p a {
        color: orange;
        text-decoration: none;
        text-transform: uppercase;
    }
</style>
@endsection
