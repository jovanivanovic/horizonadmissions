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
        <div class="box-header with-border"></div>
        <div class="box-body">
            <table class="datatable table table-striped table-bordered" style="width: 100%; background-color: white;">
                <thead>
                    <tr>
                        <th>Date and Time</th>
                        <th>Type</th>
                        <th>Student</th>
                        <th>Status</th>
                        <th>Actions</th>
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
                                <a href="#student-{{ $interview->student->id }}" class="student-info" data-student-id="{{ $interview->student->id }}">{{ $interview->student->full_name }}</a>
                            </td>
                            <td>
                                <i class="fa fa-fw fa-circle-o text-{{ $status_colors[$interview->status] }}"></i>
                                {{ ucfirst($interview->status) }}
                            </td>
                            <td>
                                {{--<div class="btn-group">--}}
                                    {{--<a href="{{ route('admin.users.edit', $user->id) }}" type="button" class="btn btn-flat btn-primary btn-xs"><i class="fa fa-pencil"></i></a>--}}
                                {{--</div>--}}
                                @if ($interview->status == 'pending')
                                    <a href="{{ route('staff.interviews.confirm', $interview->id) }}" type="button" class="btn btn-flat btn-success btn-xs">
                                        Confirm
                                    </a>
                                    <a href="{{ route('staff.interviews.reject', $interview->id) }}" type="button" class="btn btn-flat btn-danger btn-xs">
                                        Reject
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body no-padding">
            {!! $calendar->calendar() !!}
        </div>
    </div>

    <div class="modal fade" id="student-info" tabindex="-1" role="dialog" aria-labelledby="student-info">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/fullcalendar.min.css') }}">
@stop

@section('js')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js'></script>
    <script src='{{ asset('vendor/fullcalendar/libs/moment.min.js') }}'></script>
    <script src='{{ asset('vendor/fullcalendar/fullcalendar.min.js') }}'></script>

    {!! $calendar->script() !!}

    <script>
        $(document).ready(function () {
            $('.datatable').dataTable();
        });
    </script>

    <script>
        $(document).on('click', '.student-info', function (e) {
            var user_id = $(this).attr('data-student-id');

            axios.get('/api/getUserInfo?user_id=' + user_id)
                .then(function (response) {
                    var $modal = $('#student-info');

                    var $modal_content = $modal.find('.modal-content');

                    $modal_content.html(response.data);

                    $modal.modal({
                        backdrop: true,

                    });
                })
                .catch(function (error) {

                });
        });
    </script>
@stop