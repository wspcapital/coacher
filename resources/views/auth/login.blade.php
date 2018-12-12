@extends('portal.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('/assets/dist/css/portal/login.min.css')}}">
@show
@section('main-content')
    <div class="container login-form">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                {!! Form::open(['url' => '/login', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                {!! Form::token() !!}
                @if (session('blocked'))
                    <div class="{{ session('blocked') ? ' has-error' : '' }}">
                        <span class="help-block">
                              <strong>{{ session('blocked') }}</strong>
                        </span>
                    </div>
                @endif
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                    {!! Form::label('email', 'Email *', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::email('email', '',['class'=>'form-control',
                        'required'=>'true', 'placeholder' => 'email']) !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label('password', 'Password *', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::password('password', ['class'=>'form-control',
                        'required'=>'true', 'placeholder' => 'password']) !!}
                    </div>

                </div>
                {!! Form::submit('Submit', ['class'=>'btn btn-primary', 'id'=>'submit']) !!}
                {!! Form::close() !!}

                <a href="{{ url('/password/reset') }}">Forgot Password?</a>
            </div>
        </div>
    </div>
@endsection
