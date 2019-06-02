@extends('adminlte::page')

@section('title', 'HorizonAdmissions | Create Interview Type')

@section('content_header')
    <h1>Create Interview Type</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border"></div>
        <form role="form" method="POST" action="{{ route('admin.interview_types.store') }}">
            @csrf
            <div class="box-body">
                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description"></textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="status">Status</label>
                    <div class="form-control" style="height: auto">
                        <input type="radio" name="status" class="" id="status" value="1" checked> Active<br>
                        <input type="radio" name="status" class="" id="status" value="0"> Inactive
                    </div>
                    @if ($errors->has('status'))
                        <span class="help-block">
                            <strong>{{ $errors->first('status') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop