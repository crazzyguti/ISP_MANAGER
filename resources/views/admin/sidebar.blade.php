
<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{__("Sidebar")}}</h4>
            <p class="card-text"></p>
        </div>
        <ul class="list-group">
            <li class="list-group-item {{ (request()->is('admin')) ? 'active' : '' }}" role="presentation">
                <a class="stretched-link" href="{{ url('/admin') }}">
                    {{__("Admin Panel")}}
                </a>
            </li>
            <li class="list-group-item {{ (request()->is('admin/category')) ? 'active' : '' }}" role="presentation">
                <a class="stretched-link" href="{{ url('/admin/category') }}">
                    {{__("Categories")}}
                </a>
            </li>
            <li class="list-group-item {{ (request()->is('admin/users')) ? 'active' : '' }}" role="presentation">
                <a class="stretched-link" href="{{ url('/admin/users') }}">
                    {{__("Users")}}
                </a>
            </li>
            <li class="list-group-item {{ (request()->is('admin/roles')) ? 'active' : '' }}" role="presentation">
                <a class="stretched-link" href="{{ url('/admin/roles') }}">
                    {{__("Roles")}}
                </a>
            </li>
            <li class="list-group-item {{ (request()->is('admin/device')) ? 'active' : '' }}" role="presentation">
                <a class="stretched-link" href="{{ url('/admin/device') }}">
                    {{__("Devices")}}
                </a>
            </li>
            <li class="list-group-item {{ (request()->is('admin/locations')) ? 'active' : '' }}" role="presentation">
                <a class="stretched-link" href="{{ url('/admin/locations') }}">
                    {{__("Locations")}}
                </a>
            </li>
        </ul>
    </div>
</div>



{{-- <li class="{{ (request()->is('admin/cities')) ? 'active' : '' }}">   --}}

