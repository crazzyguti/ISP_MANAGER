@extends('layouts.client')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header info-color text-light" id="cardHeader">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="text-center border border-light">
                        @csrf

                        <div class="form-group row">
                            <label for="email_phone" class="col-md-4 col-form-label text-md-right">
                                <i class="fas fa-envelope"></i>
                                {{_("E-mail or ")}}
                                <i class="fas fa-mobile"></i>
                                {{ _('Phone') }}
                            </label>

                            <div class="col-md-6">
                                <input id="email_phone" type="text"
                                    class="form-control{{ $errors->has('email_phone') ? ' is-invalid' : '' }}"
                                    pattern="^\+?[0-9]{3}[0-9]{3}[0-9]{4,15}|[0-9a-zA-Z.!#$%&amp;’*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+"
                                    name="email_phone" value="{{ old('email_phone') }}" required>

                                @if ($errors->has('email_phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email_phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                {{ __('Password') }}
                            </label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3 offset-md-7">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>

                        <!-- Social login -->
                        <div class="d-none">
                            <!-- Register -->
                            <p>Not a member?
                                <a href="">Register</a>
                            </p>

                            <p>or sign in with:</p>
                            <a type="button" class="btn-floating btn-fb btn-sm">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a type="button" class="btn-floating btn-tw btn-sm">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a type="button" class="btn-floating btn-li btn-sm">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a type="button" class="btn-floating btn-git btn-sm">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false">
    <div class="toast-header">
        <svg class=" rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
            <rect fill="#007aff" width="100%" height="100%" /></svg>
        <strong class="mr-auto">Bootstrap</strong>
        <small>11 mins ago</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        Hello, world! This is a toast message.
    </div>
</div> --}}



<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="card">
            <h4 class="card-header" id="cardHeader">{{ __('Login') }}</h4>
            <div class="card-body">
                <div class="alert alert-danger" role="alert">
                    {{__("Wrong Data")}}
                </div>

                <form data-toggle="validator" role="form" method="post" action="{{ route('login') }}"
                    class="text-center border border-light">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__("Email / Phone")}}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope-open"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="email_phone" value="JossMP"
                                        pattern=".{4,}" title="" required="">
                                </div>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group row">
                                <label for="email_phone" class="col-md-4 col-form-label text-md-right">
                                    <i class="fas fa-envelope"></i>
                                    {{_("E-mail or ")}}
                                    <i class="fas fa-mobile"></i>
                                    {{ _('Phone') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="email_phone" type="text"
                                        class="form-control{{ $errors->has('email_phone') ? ' is-invalid' : '' }}"
                                        pattern="^\+?[0-9]{3}[0-9]{3}[0-9]{4,15}|[0-9a-zA-Z.!#$%&amp;’*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+"
                                        name="email_phone" value="{{ old('email_phone') }}" required>

                                    @if ($errors->has('email_phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email_phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__("Password")}}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-unlock"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control" pattern=".{4,}" title="Password" required="">
                                </div>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox_remember" type="checkbox" name="remember">
                        <label for="checkbox_remember"> {{__("Remember")}}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="redirect" value="">
                            <input type="submit" class="btn btn-primary btn-lg btn-block" value="Login" name="submit">
                        </div>
                    </div>
                </form>
                <div class="clear"></div>
                <i class="fa fa-user fa-fw"></i>{{__("Don't have an account yet?")}}<a href="#">Register</a><br>
                <i class="fa fa-undo fa-fw"></i> ¿Se te olvidó tu contraseña? <a href="#">Recupérala</a>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>
    const email_phone = document.querySelector("#email_phone");
    const password = document.querySelector("#password");
    const cardHeader = document.querySelector("#cardHeader");
    const demoUser = {
        email: "manyaka_88@abv.bg",
        password: "password"
    }

    cardHeader.addEventListener("click", (e) => {
        e.preventDefault();
        email_phone.value = demoUser.email;
        password.value = demoUser.password;

        $('.toast').toast('show');
    });
</script>
@endsection
