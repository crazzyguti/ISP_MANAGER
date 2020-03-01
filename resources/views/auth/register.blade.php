@extends('layouts.client')
@section('css')
<style>
    input:invalid {
        outline: 2px red solid;
    }

    input:valid {
        outline: 2px greenyellow solid;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="firstName" class="col-md-4 col-form-label text-md-right"><i
                                    class="fas fa-user"></i> {{ __('First Name') }} </label>

                            <div class="col-md-6">
                                <input id="firstName" type="text"
                                    class="form-control {{ $errors->has('firstName') ? 'is-invalid' : '' }}"
                                    name="firstName" value="{{ old('firstName') }}" required autofocus>

                                @if ($errors->has('firstName'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('firstName') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastName" class="col-md-4 col-form-label text-md-right"><i
                                    class="fas fa-user"></i> {{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="lastName" type="text"
                                    class="form-control {{ $errors->has('lastName') ? 'is-invalid' : '' }}"
                                    name="lastName" value="{{ old('lastName') }}" required>

                                @if ($errors->has('lastName'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('lastName') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                <i class="fas fa-lock"></i> {{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" name="password" type="password"
                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    value="{{ old('password') }}" required minlength="6" maxlength="100">

                                    <i class="fas fa-eye"></i>
                                    <i class="fas fa-eye-slash"></i>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><i
                                    class="fas fa-lock"></i> {{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" value="{{ old('password_confirmation') }}" required
                                    minlength="6" maxlength="100">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email_phone" class="col-md-4 col-form-label text-md-right">
                                <i class="fas fa-envelope"></i> {{_("E-mail or Mobile")}}
                                <i class="fas fa-mobile"></i> {{ __('Phone') }}
                            </label>
                            <div class="col-md-6">
                                <input id="email_phone" name="email_phone" type="text"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    pattern="^\+?[0-9]{3}[0-9]{3}[0-9]{4,}|[a-zA-Z.!#$%&amp;’*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+"
                                    name="email_phone" value="{{ old('email_phone') }}" required>

                                @if ($errors->has('email_phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email_phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">
                                <i class="fas fa-location-arrow"></i> {{ __('location') }}
                            </label>

                            <div class="col-md-6">

                                <select class="form-control {{ $errors->has('location') ? ' is-invalid' : '' }}"
                                    name="location" id="location" required>
                                    <option value="0">Default</option>
                                    @forelse ($locations as $location)
                                    @if ($location->id == old("location"))
                                    <option value="{{$location->id}}" selected>{{$location->name}}</option>
                                    @else
                                    <option value="{{$location->id}}">{{$location->name}}</option>
                                    @endif

                                    @empty
                                    <option value="0">Default</option>
                                    @endforelse
                                </select>
                                @if ($errors->has('location'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="birthday" class="col-md-4 col-form-label text-md-right">
                                <i class="fas fa-birthday-cake"></i> {{ __('Birthday') }}</label>

                            <div class="col-md-6">
                                <input id="birthday" type="date"
                                    class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}"
                                    name="birthday" value="{{ old('birthday') }}" required>

                                @if ($errors->has('birthday'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="genderma"
                                class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input {{ $errors->has('gender') ? ' is-invalid' : '' }}"
                                    type="radio" name="gender" id="genderma" value="male"
                                    {{old("gender") == "male" ? "checked" : ""  }}>
                                <label class="form-check-label" for="genderma"><i class="fas fa-male"></i>
                                    {{ __('male') }}</label>

                                @if ($errors->has('gender'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input {{ $errors->has('gender') ? ' is-invalid' : '' }}"
                                    type="radio" name="gender" id="genderfe" value="female"
                                    {{old("gender") == "female" ? "checked" : ""  }}>
                                <label class="form-check-label" for="genderfe"><i class="fas fa-female"></i>
                                    {{ __('female') }}</label>
                            </div>
                            @if ($errors->has('gender'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    const lastPass = "";

    function makeid(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    function pass_gen() {
        var d = new Date();
        var deffPass = d.getFullYear();
        var result = "";
        var characters = d.getDay() + d.getMonth() + d.getFullYear();
        return deffPass;
    }

    $(function () {
        $.contextMenu({
            selector: '#password',
            callback: function (key, options) {
                var m = "clicked: " + key;
                //window.console && console.log(m) || alert(m);
                $(this).val(pass_gen())
            },
            items: {
                "edit": {
                    name: "Edit",
                    icon: "edit"
                },
                "cut": {
                    name: "Cut",
                    icon: "cut"
                },
                copy: {
                    name: "Copy",
                    icon: "copy"
                },
                "paste": {
                    name: "Paste",
                    icon: "paste"
                },
                "delete": {
                    name: "Delete",
                    icon: "delete"
                },
                "sep1": "---------",
                "quit": {
                    name: "Quit",
                    icon: function () {
                        return 'context-menu-icon context-menu-icon-quit';
                    }
                }
            }
        });

        $('.context-menu-one').on('click', function (e) {
            console.log('clicked', this);
        })
    });
</script>
@endsection
