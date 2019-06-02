@extends('adminlte::page')

@section('title', 'HorizonAdmissions | Users')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="box-tools pull-right">
                <div class="pull-right mb-10 hidden-sm hidden-xs">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-xs">Create new</a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <table class="datatable table table-striped table-bordered" style="width: 100%; background-color: white;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                {{ $user->id }}
                            </td>
                            <td>
                                {{ $user->full_name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                {{ $user->role->display_name }}
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" type="button" class="btn btn-flat btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                </div>
                                <a href="{{ route('admin.users.toggle_status', $user->id) }}" type="button" class="btn btn-flat {{ $user->status == 1 ? 'btn-danger' : 'btn-success' }} btn-xs">
                                    {{ $user->status == 1 ? 'Deactivate' : 'Activate' }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('.datatable').dataTable();
        });
    </script>
@stop