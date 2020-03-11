@extends('layouts.client')
@section('css')
<style>
    #phone:valid {
        border: 5px solid green;
    }

    #phone:invalid {
        border: 5px solid red;
    }
</style>
@endsection
@section('content')

{{--  <h4 class="card-title"><a href="{{url("admin/users/$user->id")}}">{{$user->fullName}}</a></h4>
<p class="card-text">{{$user->roles->first()}}</p> --}}

<div class="container my-4">
    <div class="row">
        <div class="col">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>fullName</th>
                        {{-- <th>LastName</th> --}}
                        <th>email_phone</th>
                        <th>gender</th>
                        <th>created_at</th>
                    </tr>
                </thead>
                <tbody>

                    {{-- @foreach ($users as $user)


                    <tr>
                        <td>{{$user->firstName}}</td>
                    <td>{{$user->lastName}}</td>
                    <td>{{$user->email_phone}}</td>
                    <td>{{$user->created_at}}</td>
                    </tr>


                    @endforeach --}}

                </tbody>
                <tfoot>
                    <tr>
                        <th>fullName</th>
                        {{-- <th>LastName</th> --}}
                        <th>email_phone</th>
                        <th>gender</th>
                        <th>created_at</th>

                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- @include('vendor.pagination.bootstrap-4') --}}

    </div>
</div>




@endsection
@section('script')
<script>
    $(document).ready(function () {
        // $('#example').DataTable({
        //     //responsive: true,
        //     //dom: 'Bfrtip',
        //     "ajax": `{{url('/json')}}`,
        //     buttons: [{
        //         extend: 'copy',
        //         text: 'Copy current page',
        //         exportOptions: {
        //             modifier: {
        //                 page: 'current'
        //             }
        //         }
        //     }]
        // });

        var table = $('#example').DataTable({
            ajax: `{{url('/json')}}`,
            responsive: true,
            "columns": [{
                    "data": "fullName"
                },
                {
                    "data": "email_phone"
                },
                {
                    "data": "gender"
                },
                {
                    "data": "created_at"
                }
            ],
            "dom": '<"top"i>rt<"bottom"flp><"clear">'

        });

        $("<button>TR</button>").appendTo("div.toolbar");
        table.on('xhr', function () {
            var json = table.ajax.json();
            console.log(json.data);
            //alert(json.data.length + ' row(s) were loaded');
        });
    });
</script>
@endsection
