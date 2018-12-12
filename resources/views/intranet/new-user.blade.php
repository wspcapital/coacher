@extends('intranet.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('css/intranet/user.css')}}">
@show
@section('main-content')
    <div class="container-fluid" id="one-user">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <div class="user-info">
                    {!! Form::open(['route' => 'user/create', 'method' => 'post', 'id' => 'userForm']) !!}
                    {!! Form::token() !!}
                    <div class="form-group">
                        {!! Form::label('first_name', 'First Name') !!}
                        {!! Form::text('first_name', '',
                        ['class' => 'form-control', 'placeholder' => 'first name']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('last_name', 'Last Name') !!}
                        {!! Form::text('last_name', '',
                        ['class' => 'form-control', 'placeholder' => 'last name']) !!}
                    </div>
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::text('email', '',
                        ['class' => 'form-control', 'placeholder' => 'email']) !!}
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('city', 'City') !!}
                        {!! Form::text('city', '',
                        ['class' => 'form-control', 'placeholder' => 'City']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('state', 'State') !!}
                        {!! Form::text('state', '',
                        ['class' => 'form-control', 'placeholder' => 'State']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('company', 'Company') !!}
                        {!! Form::text('company', '',
                        ['class' => 'form-control', 'placeholder' => 'Company']) !!}
                    </div>

                <div class="element-group">
                    <strong>Staff Settings</strong>
                    @foreach($roles as $role)
                        <div class="form-group">
                            {!! Form::checkbox('role[]', $role->id) !!}
                            {!! Form::label('role', $role->display_name) !!}
                        </div>
                    @endforeach
                </div>
                <div class=" col-xs-12 clearfix">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right btn-lg']) !!}
                </div>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
@endsection