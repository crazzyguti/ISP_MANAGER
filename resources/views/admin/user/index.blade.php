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
{{-- <form action="#" onsubmit="return false">
    <div class="row">
        <div class="col">
            <input type="tel" id="phone" name="phone" class="form-control" value=""
                pattern="^\+?[0-9]{3}[0-9]{3}[0-9]{4,15}" required>
        </div>
        <div class="col">
            <input type="button" value="checkphone" id="checkphone">
        </div>
    </div>
</form> --}}

{{-- {{$userGroups}} --}}


<div class="row">


    @foreach ($users as $user)



    <div class="row">
            <div class="col">
                <div class="card">
                    {{-- <img class="card-img-top w-100" data-src="holder.js/200x200/?text=Image cap" alt="Card image cap"> --}}
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{url("users/$user->id")}}">{{$user->fullName}}</a></h4>
                        <p class="card-text">{{$user->roles->first()->name}}</p>
                        <p class="card-text">{{$user->getPermission()}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action list-group-item-primary">{{$user->firstName}}</li>
                        <li class="list-group-item list-group-item-action list-group-item-warning">{{$user->lastName}}</li>
                        <li class="list-group-item list-group-item-action list-group-item-danger">{{$user->created_at}}</li>
                        <li class="list-group-item list-group-item-action list-group-item-info">{{$user->email_phone}}</li>
                    </ul>
                </div>
            </div>
        </div>

    @endforeach

    @include('vendor.pagination.bootstrap-4')

</div>





@endsection
@section('script')
<script>
    const url = '{{$phoneValidatorURL}}';
    const reqData = {
        method: "GET",
        body: {
            phone: "+90 534 545 81 76"
        }
    };

    $("#checkphone").on("click", function (e) {
        var phone = $("#phone").val();
        var data = {
            phone
        }
        $.ajax({
            url,
            method: reqData.method,
            data
        }).done(function (responce) {
            console.log(responce);
        });
    })
</script>
@endsection
