
<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{__("Sidebar")}}</h4>
             <p class="card-text">{{$title}}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item {{ (request()->is('admin')) ? 'active' : '' }}" role="presentation">
                <a class="stretched-link text-light" href="{{ url('/admin') }}">
                    {{__("Admin Panel")}}
                </a>
            </li>
            <li class="list-group-item {{ (request()->is('admin/category')) ? 'active' : '' }}" role="presentation">
                <a class="stretched-link" href="{{ url('/admin/category') }}">
                    {{__("Categories")}}
                </a>
            </li>
            <li class="list-group-item {{ (request()->is('admin/device')) ? 'active' : '' }}" role="presentation">
                <a class="stretched-link" href="{{ url('/admin/device') }}">
                    {{__("Devices")}}
                </a>
            </li>
        </ul>
    </div>
</div>



{{-- <li class="{{ (request()->is('admin/cities')) ? 'active' : '' }}">   --}}

