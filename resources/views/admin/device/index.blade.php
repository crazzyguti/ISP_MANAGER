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
                                            data-target="#ModalSetting" data-whatever="@getbootstrap"> GetDataform
                                        </button>
                                    </td>
                                    <td>{!! $item->Devicedata !!}</td>
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
                    <div class="container-fluid">
                        <div class="row py-2">
                            <div class="col-md-4"><b>Information</b></div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>System Time:</b></div>
                            <div class="mr-auto px-3">2020-04-15 23:29:09</div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>Uptime:</b></div>
                            <div class="mr-auto px-1">3 day(s) 23 hour(s) 56 min 59 s</div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>Firmware Version</b></div>
                            <div class="mr-auto px-1">V15.03.06.48_multi</div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>Hardware Version:</b></div>
                            <div class="mr-auto px-1">V1.0</div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><b>WAN Status</b></div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>Connection Type:</b></div>
                            <div class="mr-auto px-1">PPPoE</div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>Connection Status:</b></div>
                            <div class="mr-auto px-1">Connected</div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>Connection Duration:</b></div>
                            <div class="mr-auto px-1">3 day(s) 1 hour(s) 36 min 22 s</div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>IP Address:</b></div>
                            <div class="mr-auto px-1">46.254.132.244</div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>Subnet Mask:</b></div>
                            <div class="mr-auto px-1">255.255.255.255</div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>Default Gateway:</b></div>
                            <div class="mr-auto px-1">85.187.243.6</div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>Primary DNS:</b></div>
                            <div class="mr-auto px-1">8.8.8.8</div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>Secondary DNS:</b></div>
                            <div class="mr-auto px-1">1.1.1.1</div>
                        </div>
                        <div class="row py-2">
                            <div class="ml-auto"><b>MAC Address:</b></div>
                            <div class="mr-auto px-1">D8:CB:8A:84:43:AE</div>
                        </div>
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


{{-- LAN Status
IP Address:
192.168.0.1
Subnet Mask:
255.255.255.0
MAC Address:
58:D9:D5:68:D9:A0

WiFi Status
2.4 GHz Network:
Visible
Hotspot Name:
host_wifi
Encryption Mode:
WPA/WPA2-PSK
WiFi Channel:
10
WiFi Bandwidth:
40
MAC Address:
58:D9:D5:68:D9:A1
5 GHz Network:
Visible
Hotspot Name:
host_wifi_5G
Encryption Mode:
WPA/WPA2-PSK
WiFi Channel:
36
WiFi Bandwidth:
80
MAC Address:
58:D9:D5:68:D9:A5 --}}

@section('script')
<script>
    $(document).ready(function () {
        //$('#datatableD').DataTable();


        $('#ModalSetting').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other
            //methods
            //instead.
            console.log(event);
            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body input').val(recipient)
        })
    });
</script>
@endsection
