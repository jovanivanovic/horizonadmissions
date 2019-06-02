@extends('adminlte::page')

@section('title', 'HorizonAdmissions | Interviews')

@section('content_header')
    <h1>Interviews</h1>
@stop

@section('content')
    @php
        $status_colors = [
            'pending' => 'yellow',
            'rejected' => 'red',
            'confirmed' => 'green'
        ];
    @endphp

    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="box-tools pull-right">
                <div class="pull-right mb-10 hidden-sm hidden-xs">
                    <a href="{{ route('student.interviews.create') }}" class="btn btn-success btn-xs">Create new</a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <table class="datatable table table-striped table-bordered" style="width: 100%; background-color: white;">
                <thead>
                <tr>
                    <th>Date and Time</th>
                    <th>Type</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($interviews as $interview)
                    <tr>
                        <td>
                            {{ $interview->datetime }}
                        </td>
                        <td>
                            {{ $interview->type->name }}
                        </td>
                        <td>
                            <i class="fa fa-fw fa-circle-o text-{{ $status_colors[$interview->status] }}"></i>
                            {{ ucfirst($interview->status) }}
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