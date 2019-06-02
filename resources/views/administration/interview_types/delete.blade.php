@extends('adminlte::page')

@section('title', 'HorizonAdmissions | Delete Interview Type: '.$interview_type->name)

@section('content_header')
    <h1>Delete Interview Type <small>{{ $interview_type->name }}</small></h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border"></div>
        <form role="form" method="POST" action="{{ route('admin.interview_types.destroy', $interview_type->id) }}">
            {{ method_field('DELETE') }}
            @csrf
            <div class="box-body">
                <p>Are you sure you want to delete interview type "{{ $interview_type->name }}"?</p>
                <p>This will also delete all the interviews associated with it!</p>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button name="yes" type="submit" class="btn btn-success">Yes</button>
                <button name="no" type="submit" class="btn btn-danger">No</button>
            </div>
        </form>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop