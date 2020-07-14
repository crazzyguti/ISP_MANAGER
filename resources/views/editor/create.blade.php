@extends('layouts.client')

@section('content')

<p>
    In this example:
  </p>
  <ul>
    <li>the field <code>_id</code> and its value are read-only</li>
    <li>the field <code>name</code> is read-only but has an editable value</li>
    <li>the field <code>age</code> and its value are editable</li>
  </ul>

  <div id="jsoneditor"></div>

@section('script')
<script src="{{asset('vendor/jsoneditor/dist/jsoneditor.js')}}"></script>
<script>
const options = {
      onEditable: function (node) {
        // node is an object like:
        //   {
        //     field: 'FIELD',
        //     value: 'VALUE',
        //     path: ['PATH', 'TO', 'NODE']
        //   }
        switch (node.field) {
          case '_id':
            return false

          case 'name':
            return {
              field: false,
              value: true
            }

          default:
            return true
        }
      }
    }

    const json = {
      _id: 123456,
      name: 'John',
      age: 32
    }

    const editor = new JSONEditor(container, options, json)
</script>
@endsection
@endsection
