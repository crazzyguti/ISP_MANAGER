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
                                <i class="fas fa-envelope"></i> {{_("E-mail or ")}} <i class="fas fa-mobile"></i>
                                {{ _('Phone') }}</label>

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
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

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
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
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
                        <!-- Register -->
                        <p>Not a member?
                            <a href="">Register</a>
                        </p>

                        <!-- Social login -->
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false">
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
