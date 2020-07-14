@extends('layouts.client')

@section('content')
<p>
    <button id="setJSON">Set JSON</button>
    <button id="getJSON">Get JSON</button>
</p>
<div id="jsoneditor"></div>
@section('script')
<script src="{{asset('vendor/jsoneditor/dist/jsoneditor.js')}}"></script>
<script>
    $(function () {

        // create the editor
        const container = document.getElementById('jsoneditor')
        const options = {}
        const editor = new JSONEditor(container, options)

        // set json
        document.getElementById('setJSON').onclick = function () {
            let ajaxOption = {
                url: '{{ url("/demo") }}',
                dataType:"json"
            }
            $.ajax(ajaxOption).done(function (data) {
                editor.set(data)
            });
        }

        // get json
        document.getElementById('getJSON').onclick = function () {
            const json = editor.get()
            alert(JSON.stringify(json, null, 2))
        }
    })
</script>
@endsection
@endsection