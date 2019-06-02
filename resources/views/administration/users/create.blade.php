@extends('adminlte::page')

@section('title', 'HorizonAdmissions | Create User')

@section('content_header')
    <h1>Create User</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border"></div>
        <form role="form" method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="box-body">
                <div class="form-group has-feedback {{ $errors->has('role') ? 'has-error' : '' }}">
                    <label>User Type</label>
                    <select class="form-control" name="role">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->display_name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="help-block">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First name">
                    @if ($errors->has('first_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last name">
                    @if ($errors->has('last_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label for="phone">Phone</label>
                    <input type="phone" name="phone" class="form-control" id="phone" placeholder="Phone">
                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <label for="password_confirmation">Retype Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Retype password">
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
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