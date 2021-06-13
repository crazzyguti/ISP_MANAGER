@extends('layouts.admin2')
@section('content')
<div class="card">
    <div class="card-header">Users</div>
    <div class="card-body">
        <a href="{{ url('/admin/users/create') }}" class="btn btn-success btn-sm" title="Add New Users">
            <i class="fa fa-plus" aria-hidden="true"></i>Add New</a>

        <form method="GET" action="{{ url('/admin/users') }}" accept-charset="UTF-8"
            class="form-inline my-2 my-lg-0 float-right" role="search">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..."
                    value="{{ request('search') }}">
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
                    @foreach($users as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->firstName }}</td>
                        <td>{{ $item->lastName }}</td>
                        <td>{{ $item->email_phone}}</td>
                        <td>
                            <a href="{{ url('/admin/users/' . $item->id) }}" title="View Users"><button
                                    class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>
                                    View</button></a>
                            <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" title="Edit Users"><button
                                    class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                        aria-hidden="true"></i>
                                    Edit</button></a>

                            <form method="POST" action="{{ url('/admin/users' . '/' . $item->id) }}"
                                accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Users"
                                    onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                        aria-hidden="true"></i> Delete</button>
                            </form>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                data-target="#ModalSetting" data-whatever="@getbootstrap"> GetDataform
                            </button>
                        </td>
                        {{-- <td>{!! $item->Devicedata !!}</td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="pagination-wrapper"> {!! $users->appends(['search' => Request::get('search')])->render() !!} </div> --}}
        </div>

    </div>
</div>