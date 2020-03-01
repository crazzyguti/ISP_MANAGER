<div class="form-group {{ $errors->has('brand') ? 'has-error' : ''}}">
    <label for="brand" class="control-label">{{ 'Brand' }}</label>
    <input class="form-control" name="brand" type="text" id="brand"
        value="{{ isset($device->brand) ? $device->brand : ''}}">
    {!! $errors->first('brand', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('model') ? 'has-error' : ''}}">
    <label for="model" class="control-label">{{ 'Model' }}</label>
    <input class="form-control" name="model" type="text" id="model"
        value="{{ isset($device->model) ? $device->model : ''}}">
    {!! $errors->first('model', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'Type' }}</label>
    <select class="form-control" name="type" id="type">
        @php
            $Types = ["Router","Phone","Wireles Reperator"];
        @endphp
        @forelse ($Types as $item)
            <option value="{{ $item ?? ''}}">{{ $item ?? ''}}</option>
        @empty

        @endforelse

    </select>
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('deviceData') ? 'has-error' : ''}}">
    <label for="deviceData" class="control-label">{{ 'Devicedata' }}</label>
    <textarea class="form-control" rows="5" name="deviceData" type="textarea"
        id="deviceData">{{ $device->deviceData ?? ""}}</textarea>
    {!! $errors->first('deviceData', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <select class="form-control" name="user_id" id="user_id">
        <option value="{{ Auth::id() ?? ''}}">{{ Auth::User()->firstName ?? ''}}</option>
    </select>

    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}

</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
