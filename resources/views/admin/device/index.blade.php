@extends('layouts.client')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.sidebar')


        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Device</div>
                <div class="card-body">
                    <a href="{{ url('/admin/device/create') }}" class="btn btn-success btn-sm" title="Add New Device">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>

                    <form method="GET" action="{{ url('/admin/device') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table" id="datatableD">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                    <th>DeviceData</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($device as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->brand }}</td>
                                    <td>{{ $item->model }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>
                                        <a href="{{ url('/admin/device/' . $item->id) }}" title="View Device"><button
                                                class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>
                                                View</button></a>
                                        <a href="{{ url('/admin/device/' . $item->id . '/edit') }}"
                                            title="Edit Device"><button class="btn btn-primary btn-sm"><i
                                                    class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                Edit</button></a>

                                        <form method="POST" action="{{ url('/admin/device' . '/' . $item->id) }}"
                                            accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Device"
                                                onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                    class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#ModalSetting" data-whatever="{{$item->brand}}"> GetDataform
                                        </button>
                                    </td>
                                    <td class="d-none device_default_config">{{ $item->deviceData }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $device->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-lg" id="ModalSetting" tabindex="-1" role="dialog" aria-labelledby="ModalSettingLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalSettingLabel">Device Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                        <div class="row py-2">
                            <div class="col-md-4"><b>Information</b></div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>Wireless Name:</b></div>
                            <div class="mr-auto px-1" id="WirelessName">Wia</div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>Wireless Key:</b></div>
                            <div class="mr-auto px-1" id="WirelessKey">12345678</div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>DefaultMacAddress:</b></div>
                            <div class="mr-auto px-1" id="DefaultMacAddress">AC:2B:6E:B1:58:5A</div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>DefaultGateway: </b></div>
                            <div class="mr-auto px-1" id="DefaultGateway">192.168.0.1</div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>Remote IP:</b></div>
                            <div class="mr-auto px-1" id="RemoteIP">85.187.243.x</div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>RemotePort:</b></div>
                            <div class="mr-auto px-1" id="RemotePort">8000</div>
                        </div>
                        <div class="row py-2">
                            <div class="col-md-4"><b>Login Info</b></div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto">Username :</div>
                            <div class="mr-auto px-1" id="username">admin</div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto">Password :</div>
                            <div class="mr-auto px-1" id="password">admin</div>
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    $(document).ready(function () {
        //$('#datatableD').DataTable();

        let devicesData = $(".device_default_config");

        let JsonData = [];
        JsonData.push(JSON.parse(devicesData.text()));
        console.log(JsonData);

        $('#ModalSetting').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other
            //methods
            //instead.
            // console.log(event);
            var modal = $(this)
            modal.find('.modal-title').text('Device Data for ' + recipient)
            modal.find('.modal-body input').val(recipient);
            // console.log(modal.find(".device_default_config").text())

        })
    });
</script>
@endsection
