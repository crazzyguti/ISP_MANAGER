@extends('layouts.client')
@section('css')
<style>
    #phone:valid {
        border: 5px solid green;
    }

    #phone:invalid {
        border: 5px solid red;
    }
</style>
@endsection
@section('content')

{{--  <h4 class="card-title"><a href="{{url("admin/users/$user->id")}}">{{$user->fullName}}</a></h4>
<p class="card-text">{{$user->roles->first()}}</p> --}}

<div class="container my-4">
    <div class="row">
        <div class="col">

        </div>

        {{-- @include('vendor.pagination.bootstrap-4') --}}

    </div>
</div>




@endsection
@section('script')
<script>

</script>
@endsection
