@extends('adminlte::page')

@section('title', 'HorizonAdmissions | Create Interview')

@section('content_header')
    <h1>Create Interview</h1>
@stop

@section('content')
    @php
        $interview_types_exist = $interview_types->count() > 0;
    @endphp
    <div class="box box-primary">
        <div class="box-header with-border"></div>
        <form role="form" method="POST" action="{{ route('student.interviews.store') }}">
            @csrf
            <div class="box-body">
                @if (!$interview_types_exist)
                    <div class="callout callout-danger">
                        <h4>Appointment limit reached!</h4>

                        <p>You have already appointed interviews with all types. You can only appoint an interview with a certain type once.</p>
                    </div>
                @endif
                <div class="form-group has-feedback {{ $errors->has('type_id') ? 'has-error' : '' }}">
                    <label>Available Interview Types</label>
                    <select class="form-control" name="type_id" {{ $interview_types_exist ?: 'disabled' }}>
                        <option>---</option>
                        @foreach ($interview_types as $interview_type)
                            <option value="{{ $interview_type->id }}">{{ $interview_type->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('type_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('type_id') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Interview Date</label>
                    <div class='input-group date' id='datepicker'>
                        <input type="text" name="date" class="form-control" id="datepicker-input" value="---" {{ $interview_types_exist ? '' : 'disabled' }} />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group has-feedback {{ $errors->has('datetime') ? 'has-error' : '' }}">
                    <label>Interview Time Slot</label>
                    <select id="time-slots" name="datetime" class="form-control" disabled>
                        <option>---</option>
                    </select>
                    @if ($errors->has('datetime'))
                        <span class="help-block">
                            <strong>{{ $errors->first('datetime') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary" {{ $interview_types_exist ? '' : 'disabled' }}>Submit</button>
            </div>
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">

@stop

@section('js')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js'></script>
    <script src='{{ asset('vendor/fullcalendar/libs/moment.min.js') }}'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js'></script>

    <script type="text/javascript">
        $(function () {
            var interview_types_exist = {{ $interview_types_exist }};

            $('#datepicker').datepicker({
                daysOfWeekDisabled: {{ json_encode(config('admissions.excluded_days_of_week')) }},
                format: 'yyyy-mm-dd'
            });

            $('#datepicker').datepicker().on('changeDate', function (e) {
                $('#datepicker-input').change();
            });
            $('#datepicker-input').val(moment().format('YYYY-MM-DD'));
            $('#datepicker-input').change(function () {
                if (interview_types_exist) {
                    var newDate = $('#datepicker-input').val();

                    axios.get('/api/getAvailableInterviewSlots?date=' + newDate)
                        .then(function (response) {
                            console.log(response.data);

                            $("#time-slots").removeAttr('disabled');
                            $("#time-slots").empty();

                            response.data.forEach(function (value, index) {
                                $("#time-slots").append('<option value="' + value + '">' + moment(value).format('hh:mm A') + '</option>')
                            });
                        })
                        .catch(function (error) {

                        });
                } else {
                    $("#time-slots").attr('disabled');
                }
            });
        });
    </script>
@stop