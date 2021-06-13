@extends('layouts.client')

@section('css')
<style>
    input:invalid {
        border: solid 2px red;
    }

    input:valid {
        border: solid 2px green;
    }
</style>
@endsection

@section('content')

<div class="container">

    <div class="card bg-light">
        <article class="card-body">
            <form>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input id="firstName" name="firstName" type="text" placeholder="Full name" pattern="(\w+)\s(\w+)"
                        class="form-control {{ $errors->has('firstName') ? 'is-invalid' : '' }}"
                        value="{{ old('firstName') }}" required autofocus>

                    @if ($errors->has('firstName'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('firstName') }}</strong>
                    </span>
                    @endif
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope" id="email_phone_icon"></i> </span>
                    </div>
                    <input id="email_phone" name="email_phone" type="text" placeholder="email or phone"
                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                        pattern="^\+?[0-9]{3}[0-9]{3}[0-9]{4,}|[0-9a-zA-Z.!#$%&amp;’*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+"
                        name="email_phone" value="{{ old('email_phone') }}" required>
                    @if ($errors->has('email_phone'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email_phone') }}</strong>
                    </span>
                    @endif
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-phone" id="email_phone_icon2"></i> </span>
                    </div>
                    <select class="custom-select" style="max-width: 120px;">
                        <option selected>+359</option>
                    </select>
                    <input name="" class="form-control" placeholder="Phone number" type="text">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                    </div>
                    <select class="form-control">
                        <option value="admin">Admin</option>
                        <option value="developer">Developer</option>
                        <option value="worker">Worker</option>
                        <option value="kasa">Kasa</option>
                        <option value="client" selected>Client</option>
                    </select>
                </div> <!-- form-group end.// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" placeholder="Create password" type="password"
                        autocomplete="new-password">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" placeholder="Repeat password" type="password"
                        autocomplete="new-password">
                </div> <!-- form-group// -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"> Create Account </button>
                </div> <!-- form-group// -->
            </form>
        </article>
    </div> <!-- card.// -->

</div>
<!--container end.//-->
@endsection

@section('script')
<script>
    var formValid = {
        email_phone: function (target, lastIcon, newIcon) {
            if (target.classList.contains(lastIcon)) {
                target.classList.replace(lastIcon, newIcon);
            } else {
                target.classList.replace(newIcon, lastIcon);
            }
        }
    }



    function iconReplacer(target, lastIcon, newIcon) {
        if (target.classList.contains(lastIcon)) {
            target.classList.replace(lastIcon, newIcon);
        } else {
            target.classList.replace(newIcon, lastIcon);
        }
    }


    const email_phone_icon = document.querySelector("#email_phone_icon");
    email_phone_icon.parentElement.addEventListener("click", (e) => {
        formValid.email_phone(e.target, "fa-phone", "fa-envelope");
        //iconReplacer(e.target, "fa-phone", "fa-envelope");
        console.log(e.target);
    });
</script>
@endsection
