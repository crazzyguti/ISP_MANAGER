@php

$url = $url ?? url()->current();;

@endphp

<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Sidebar</h4>
            <p class="card-text">{{$url}}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item {{ (request()->is('admin')) ? 'active' : '' }}" role="presentation">
                <a class="stretched-link" href="{{ url('/admin') }}">
                    {{__("Dashboard")}}
                </a>
            </li>
            <li class="list-group-item {{ (request()->is('admin/category')) ? 'active' : '' }}" role="presentation">
                <a class="stretched-link" href="{{ url('/admin/category') }}">
                    Categories
                </a>
            </li>
            <li class="list-group-item {{ (request()->is('admin/device')) ? 'active' : '' }}" role="presentation">
                <a class="stretched-link" href="{{ url('/admin/device') }}">
                    Devices
                </a>
            </li>
        </ul>
    </div>
</div>

{{-- <li class="{{ (request()->is('admin/cities')) ? 'active' : '' }}">   --}}

