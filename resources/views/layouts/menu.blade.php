<div class="card">
    <img class="card-img-top" data-src="holder.js/100x180/?text=Image cap" alt="Card image cap">
    <div class="card-body">
        <h4 class="card-title">Title</h4>
        <p class="card-text">Text</p>
    </div>
    <ul class="list-group list-group-flush">
        @foreach ($menulist as $key=>$item)
        {{dd($key)}}
        @endforeach
{{--
        @forelse ($menulist as $item)

        <li class="list-group-item"></li>
        @empty

        @endforelse --}}
        <li class="list-group-item">Item 1</li>
        <li class="list-group-item">Item 2</li>
        <li class="list-group-item">Item 3</li>
    </ul>
</div>
