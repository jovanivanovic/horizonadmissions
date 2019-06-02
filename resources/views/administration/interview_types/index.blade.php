@extends('adminlte::page')

@section('title', 'HorizonAdmissions | Interview Types')

@section('content_header')
    <h1>Interview Types</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="box-tools pull-right">
                <div class="pull-right mb-10 hidden-sm hidden-xs">
                    <a href="{{ route('admin.interview_types.create') }}" class="btn btn-success btn-xs">Create new</a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <table class="datatable table table-striped table-bordered" style="width: 100%; background-color: white;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Pending</th>
                        <th>Rejected</th>
                        <th>Confirmed</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($interview_types as $interview_type)
                        <tr>
                            <td>
                                {{ $interview_type->id }}
                            </td>
                            <td>
                                {{ $interview_type->name }}
                            </td>
                            <td>
                                {{ Str::limit($interview_type->description, 75) }}
                            </td>
                            <td>
                                {{ $interview_type->count_pending_interviews }}
                            </td>
                            <td>
                                {{ $interview_type->count_rejected_interviews }}
                            </td>
                            <td>
                                {{ $interview_type->count_confirmed_interviews }}
                            </td>
                            <td>
                                {!! $interview_type->status == 1 ? '<i class="fa fa-fw fa-circle-o text-green"></i> Active' : '<i class="fa fa-fw fa-circle-o text-red"></i> Inactive' !!}
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.interview_types.show', $interview_type->id) }}" type="button" class="btn btn-flat btn-success btn-xs"><i class="fa fa-list"></i></a>
                                    <a href="{{ route('admin.interview_types.edit', $interview_type->id) }}" type="button" class="btn btn-flat btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('admin.interview_types.delete', $interview_type->id) }}" type="button" class="btn btn-flat btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                </div>
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