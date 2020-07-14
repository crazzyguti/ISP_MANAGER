@extends('layouts.client')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-4">
                        <div class="d-flex justify-content-start">
                            <div class="image-container">
                                <img src="https://i.picsum.photos/id/222/150/150.jpg" id="imgProfile"
                                    style="width: 150px; height: 150px" class="img-thumbnail" />
                                <div class="middle">
                                    {{-- <input type="button" class="btn btn-secondary" id="btnChangePicture"  value="Change" /> --}}
                                    <a href="{{ url('/admin/users/' . $user->id . "/edit") }}" class="btn btn-secondary" id="btnChangePicture">Change</a>
                                    <input type="file" style="display: none;" id="profilePicture" name="file" />

                                </div>
                            </div>
                            <div class="userData ml-3">
                                <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">
                                <a href="{{url('/admin/users/' . $user->id )}}">{{$user->fullName}}</a></h2>
                                <h6 class="d-block"><a href="javascript:void(0)">1,500</a> Video Uploads</h6>
                                <h6 class="d-block"><a href="javascript:void(0)">300</a> Blog Posts</h6>
                            </div>
                            <div class="ml-auto">
                                <input type="button" class="btn btn-primary d-none" id="btnDiscard"
                                    value="Discard Changes" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="basicInfo-tab" data-toggle="tab"
                                    href="#basicInfo" role="tab" aria-controls="basicInfo"
                                    aria-selected="true">Потребителско Информация</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="connectedServices-tab" data-toggle="tab"
                                        href="#connectedServices" role="tab" aria-controls="connectedServices"
                                        aria-selected="false">Устройство</a>
                                </li>
                            </ul>
                            <div class="tab-content ml-1" id="myTabContent">
                                <div class="tab-pane fade show active" id="basicInfo" role="tabpanel"
                                    aria-labelledby="basicInfo-tab">


                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Пълно име</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            <input type="text" name="firstName" id="firstName" value="{{$user->fullName}}">
                                        </div>
                                    </div>
                                    <hr />

                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Рожден ден</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            <input type="date" name="birthday" id="birthday" value="{{$user->birthday}}">
                                        </div>
                                    </div>
                                    <hr />


                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Локация</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            {{$user->location->name}}
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Роля</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            @forelse ($user->getRoleNames() as $item)
                                                {{$item}}
                                            @empty

                                            @endforelse
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-sm-3 col-md-2 col-5">
                                            <label style="font-weight:bold;">Something</label>
                                        </div>
                                        <div class="col-md-8 col-6">
                                            Something
                                        </div>
                                    </div>
                                    <hr />

                                </div>
                                <div class="tab-pane fade" id="connectedServices" role="tabpanel"
                                    aria-labelledby="ConnectedServices-tab">
                                    Facebook, Google, Twitter Account that are connected to this account
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>


    @endsection
