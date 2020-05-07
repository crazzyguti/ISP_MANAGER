@extends('layouts.client')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header info-color text-light" id="cardHeader">{{ __('Login Form') }}</div>

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

@endsection


@section('script')
<script>
    let email_phone = document.querySelector("#email_phone");
    let password = document.querySelector("#password");
    let cardHeader = document.querySelector("#cardHeader");
    let demoUser = {
        email: "manyaka_88@abv.bg",
        password: "password"
    }

    cardHeader.addEventListener("click", (e) => {
        e.preventDefault();
        email_phone.value = demoUser.email;
        password.value = demoUser.password;
        $('.toast').toast('show');
        console.log("clicked")
    });

    $('.card').addClass('animated tada bounceInDown');

</script>


@endsection
