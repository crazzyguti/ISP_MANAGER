@extends('layouts.client')

@section('content')
<div class="container">
    <div class="row border border-danger">
        <div class="col-md-10 col-md-10 py-4">
        <h1 class="text-dark">Profile {{$users->fullName}}</h1>
        </div>
    <div class="col-2"><a href="{{route('users.index')}}" class="float-right"><img title="profile image"
                    class="rounded-circle img-fluid"
                    src="http://www.gravatar.com/avatar/28fd20ccec6865e2d5f0e1f4446eb7bf?s=100"></a>
        </div>
    </div>
    <div class="row">
        <div class="col-3 d-none">
            <!--left col-->
            <div class="text-center">
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar rounded-circle img-thumbnail"
                    alt="avatar">
                <h6>Upload a different photo...</h6>
                <input type="file" class="text-center mx-auto file-upload">
            </div>
            <br>
            <ul class="list-group">
                <li class="list-group-item text-muted">Activity <i class="fas fa-tachometer-alt fa-1x"></i>
                </li>
                <li class="list-group-item text-right"><span class="float-left"><strong>Shares</strong></span> 125</li>
                <li class="list-group-item text-right"><span class="float-left"><strong>Likes</strong></span> 13</li>
                <li class="list-group-item text-right"><span class="float-left"><strong>Posts</strong></span> 37</li>
                <li class="list-group-item text-right"><span class="float-left"><strong>Followers</strong></span> 78
                </li>
            </ul>
            <div class="card">
                <div class="card-header">Social Media</div>
                <div class="card-body">
                    <i class="fab fa-facebook fa-2x"></i>
                    <i class="fab fa-github fa-2x"></i>
                    <i class="fab fa-twitter fa-2x"></i>
                    <i class="fab fa-pinterest fa-2x"></i>
                    <i class="fab fa-google-plus fa-2x"></i>
                </div>
            </div>
        </div>
        <!--/col-3-->
        <div class="col-md-9">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab"
                        aria-controls="messages" aria-selected="true">Messages</a>
                 </li>
                <li class="nav-item">
                <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab"
                    aria-controls="settings" aria-selected="true">Settings</a>
                </li>
            </ul>
            <div class="tab-content">
                <hr>
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <form class="form" method="POST" action="{{ route('register') }}" id="registrationForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstName" class="col-form-label">
                                    <i class="fas fa-user"></i> {{ __('First Name') }} </label>
                                <input id="firstName" type="text"
                                    class="form-control {{ $errors->has('firstName') ? 'is-invalid' : '' }}"
                                    name="firstName" value="{{$users->firstName}}" required autofocus>

                                @if ($errors->has('firstName'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('firstName') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastName" class="col-form-label"><i class="fas fa-user"></i>
                                    {{ __('Last Name') }}</label>

                                <input id="lastName" type="text"
                                    class="form-control {{ $errors->has('lastName') ? 'is-invalid' : '' }}"
                                    name="lastName" value="{{$users->lastName}}" required>

                                @if ($errors->has('lastName'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('lastName') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password" class="col-form-label"><i class="fas fa-lock"></i>
                                    {{ __('Password') }}</label>

                                <input id="password" type="password"
                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    name="password" value="{{ old('password') }}" required minlength="6"
                                    maxlength="100">

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="password-confirm" class="col-form-label"><i class="fas fa-lock"></i>
                                    {{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" value="{{ old('password_confirmation') }}" required
                                    minlength="6" maxlength="100">

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>
                        <div class="form-row">


                            <div class="form-group col-md-6">
                                <label for="email_phone" class="col-form-label"><i class="fas fa-envelope"></i>
                                    {{_("E-mail or ")}} <i class="fas fa-mobile"></i>
                                    {{ __('Phone') }}</label>
                                <input id="email_phone" type="text"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    pattern="^\+?[0-9]{3}[0-9]{3}[0-9]{4,}|[a-zA-Z.!#$%&amp;’*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+"
                                    name="email_phone" value="{{ old('email_phone') }}" required>

                                @if ($errors->has('email_phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email_phone') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="location" class="ol-form-label">
                                    <i class="fas fa-location-arrow"></i> {{ __('location') }}
                                </label>
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

                        <div class="form-row">
                            <label for="birthday" class="col-form-label">
                                <i class="fas fa-birthday-cake"></i> {{ __('Birthday') }}</label>
                            <input id="birthday" type="date"
                                class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}" name="birthday"
                                value="{{ old('birthday') }}" required>

                            @if ($errors->has('birthday'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('birthday') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-row p-2">
                            <label for="genderma" class="col-form-label">{{ __('Gender') }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input {{ $errors->has('gender') ? ' is-invalid' : '' }}"
                                    type="radio" name="gender" id="genderma" value="male"
                                    {{old("gender") == "male" ? "checked" : ""  }}>
                                <label class="form-check-label" for="genderma">
                                    <i class="fas fa-male"></i>  {{ __('male') }}</label>

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
                        <div class="form-row">
                            <div class="col-md-12">
                                <br>
                                <button class="btn btn-lg btn-success" type="submit"><i
                                        class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i>
                                    Reset</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                </div>
                <div class="tab-pane fade show" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                    messages
                </div>
                <div class="tab-pane fade show" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                    settings
                </div>
            </div>

        </div>


        @endsection
