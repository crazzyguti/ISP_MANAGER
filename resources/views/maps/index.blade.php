@extends('layouts.client')

@section('title', 'Google Maps application')

@section('css')
<style>
    #m_app {
        width: 100%;
        height: 500px;
        background-color: grey;
    }

    .row.body>div {
        padding: 30px;
        border: 1px solid
    }

    .with-border h3 {
        border: 1px solid black;
        max-width: 300px;
        margin: auto auto 20px auto;
        padding: 15px;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    #drop-container {
        display: none;
        height: 100%;
        width: 100%;
        position: absolute;
        z-index: 1;
        top: 0px;
        left: 0px;
        background-color: rgba(100, 100, 100, 0.5);
    }

    #drop-silhouette {
        color: white;
        border: white dashed 8px;
        height: calc(100% - 15px);
        width: calc(100% - 15px);
        background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAAAXNSR0IArs4c6QAAAAZiS0dEAGQAZABkkPCsTwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB90LHAIvICWdsKwAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAACdklEQVR42u3csU7icBzA8Xp3GBMSeRITH8JHMY7cRMvmVmXoE9TAcJubhjD4ApoiopgqDMWAKAgIcSAiCfxuwhwROVJbkPD9rP23ob8vpZCQKgoAAAAAAAAAAPDYyiK/eNM05bNtr6+vSjgcXiHxDMkE1WpVFvGcfpCVICAIQUAQgoAgBAFBCAKCgCAEAUEIAoIQBAQhCAgCghAEBCEICEIQEIQgIAgIQhAQhCAgCEFAEIKAICAIQUAQgoAgBAFBCDIzhmFINBo9/K6D0XVddnd3ZaneDY7jSCqVcn3SfjyeKRKJbJ2dnYllWbKUl2i5XJaXlxdJJBIy7yDHx8fy9vYm6XR6OWMM3d/fi4hIqVSSWCwmsw5ycHAgrVZLRETOz8+XO8ZQpVJ5H2Y6nRZN0/b9DqLruhSLxfd9MpkMMT6L0uv1JJlMih9BhveJwWDwvv7i4oIY4zw8PIwMtt1uSzweF6+CHB0dSbfbHVmbzWaJMcnj4+OHAd/d3cne3p64DWKapjw/P39Yd3l5SYxpVKvVsYO2LEtUVd2ZNoiu6+I4ztg1V1dXxPAiSq/Xk5OTk0k9pNVqyenp6ch94l+5XI4YbtRqNfHa9fX1t43xcwGa/Nnc3PwdDAY9OZht28rGxgZPvP6KSCSy9fT09OUrw7ZtPqa8jFKv113HuLm5IYbXVFXdcRPl9vaWGH5GaTQaU8fI5/PE8JumafvNZvO/MQqFAjFmJRqNHk6Ksqgx5vr1zzAM2d7edr3/6uqqsra2NnZbp9NR+v2+62OHQqG5zObXPIMEAgFlfX3dl2N79btl1viTA0FAEIKAIAQBAAAAAAAAsMz+Ai1bUgo6ebm8AAAAAElFTkSuQmCC');
        background-repeat: no-repeat;
        background-position: center;
    }
</style>
@endsection

@section('sidebar')
@parent
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col">
                    <h3><b>{{__('localeList')}}</b></h3>
                </div>
            </div>
            <div class="row">
                <div class="col border p-0">
                    <div id="localelist" class="list-group overflow-auto">
                        @forelse ($locales as $item)
                        <a class="list-group-item list-group-item-action" data-localName="{{$item->slug}}"
                            href="#">{{$item->name}}</a>
                        @empty
                        <p>{{__("locale is not found")}}</p>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col">
                    <div class="btn-group" role="group" aria-label="markerList">
                        <button type="button" class="btn btn-primary"><img src="{{asset('images/markers/black.png')}}"
                                width="38px" height="38px" alt="black"></button>
                        <button type="button" class="btn btn-primary"><img src="{{asset('images/markers/green.png')}}"
                                width="38px" height="38px" alt="green"></button>
                        <button type="button" class="btn btn-primary"><img src="{{asset('images/markers/cicle.png')}}"
                                width="38px" height="38px" alt="cicle"></button>
                    </div>
                </div>
                <div class="col border">
                    Filter List
                    <div id="searchArea">
                        <label for="SearchPlace">Place Name</label>
                        <input type="text" name="SearchPlace" id="SearchPlace">
                        <span class="context-menu-one btn btn-neutral">right click me</span>
                    </div>
                </div>
            </div>
            <div class="row body">
                <div class="col">
                    <div id="m_app"></div>
                    <div id="drop-container">
                        <div id="drop-silhouette"></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- Default form register -->
                            <form class="text-center border border-light p-5" action="#">

                                <p class="h4 mb-4">Sign up</p>

                                <div class="form-row mb-4">
                                    <div class="col">
                                        <!-- First name -->
                                        <input type="text" id="defaultRegisterFormFirstName" class="form-control"
                                            placeholder="First name" autocomplete="FirstName">
                                    </div>
                                    <div class="col">
                                        <!-- Last name -->
                                        <input type="text" id="defaultRegisterFormLastName" class="form-control"
                                            placeholder="Last name">
                                    </div>
                                </div>

                                <!-- E-mail -->
                                <input type="email" id="defaultRegisterFormEmail" class="form-control mb-4"
                                    placeholder="E-mail" autocomplete="username">

                                <!-- Password -->
                                <input type="password" id="RegisterFormPassword" class="form-control"
                                    placeholder="Password" aria-describedby="current-password"
                                    autocomplete="current-password">
                                <small id="RegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                                    At least 8 characters and 1 digit
                                </small>

                                <!-- Phone number -->
                                <input type="text" id="defaultRegisterPhonePassword" class="form-control"
                                    placeholder="Phone number" aria-describedby="defaultRegisterFormPhoneHelpBlock">
                                <small id="defaultRegisterFormPhoneHelpBlock" class="form-text text-muted mb-4">
                                    Optional - for two step authentication
                                </small>

                                <!-- Newsletter -->
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input"
                                        id="defaultRegisterFormNewsletter">
                                    <label class="custom-control-label" for="defaultRegisterFormNewsletter">Subscribe to
                                        our newsletter</label>
                                </div>

                                <!-- Sign up button -->
                                <button class="btn btn-info my-4 btn-block" type="submit">Sign in</button>

                                <!-- Social register -->
                                <p>or sign up with:</p>

                                <a href="#" class="mx-2" role="button"><i
                                        class="fab fa-facebook-f light-blue-text"></i></a>
                                <a href="#" class="mx-2" role="button"><i
                                        class="fab fa-twitter light-blue-text"></i></a>
                                <a href="#" class="mx-2" role="button"><i
                                        class="fab fa-linkedin-in light-blue-text"></i></a>
                                <a href="#" class="mx-2" role="button"><i class="fab fa-github light-blue-text"></i></a>

                                <hr>
                                <p id="position"></p>
                                <hr>

                                <!-- Terms of service -->
                                <p>By clicking
                                    <em>Sign up</em> you agree to our
                                    <a href="" target="_blank">terms of service</a>

                            </form>
                            <!-- Default form register -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



@section('script')
<script>
    var map;
    var markers = [];

    function initMap() {
        var defaultCenter = new google.maps.LatLng(42.7985709, 27.2829266);
        let mapOption = {
            center: defaultCenter,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.HYBRID,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.TOP_CENTER
            },
            zoomControl: true,
            zoomControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            scaleControl: true,
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_TOP
            },
            fullscreenControl: true
        }

        map = new google.maps.Map(m_app, mapOption);
        let SearchPlace = document.querySelector("#SearchPlace");

        autocomplete = new google.maps.places.Autocomplete(SearchPlace);
        autocomplete.bindTo('bounds', map);

        map.addListener('click', (e) => {
            placeMarkerAndPanTo(e.latLng, map);
        });



    }
    var position = document.querySelector("#position");

    function placeMarkerAndPanTo(latLng, map) {
        url = "{{asset('images/users/Person.png')}}";
        var marker = new google.maps.Marker({
            position: latLng,
            map,
            icon: {
                url,
                scaledSize: new google.maps.Size(38, 38)
            },
            animation: google.maps.Animation.DROP,
            draggable: true,
        });
        map.panTo(latLng);

        markers.push(marker);

        marker.addListener('drag', (e) => {
            position.innerHTML = latLng
        });

        marker.addListener('dragend', (e) => {
            position.innerHTML = latLng
        });
    }

    function initEvents() {

        markers.forEach(marker => {

        });


    }

    function initalize() {
        initMap();
        initEvents();
    }
</script>
<script defer
    src="https://maps.googleapis.com/maps/api/js?key={{env('mapsApiKey')}}&libraries=places&callback=initalize">
</script>
@endsection
@endsection
