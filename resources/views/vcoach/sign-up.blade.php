@extends('vcoach.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/vcoach/how-it-works.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/css/vcoach/register.min.css')}}">
@endsection
@section('main-content')
    <div class="container" id="app">
        {!! Form::open(['url' => '/register', 'id' => 'myForm', 'v-on:submit.prevent' => 'nextForm']) !!}
        <h1 class="text-center">REGISTRATION</h1>

        <div class="box register" v-show="step == 1">
            <h3>Account Information</h3>

            <p>* All fields are required</p>
            <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                {{ Form::label('first_name', 'First Name*') }}
                {{ Form::text('first_name', Request::old('first_name'),
                 ['class' => 'form-control', 'required'=>'true', 'v-model' => 'user.first_name' ] ) }}
                @if ($errors->has('first_name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                {{ Form::label('last_name', 'Last Name*') }}
                {{ Form::text('last_name', Request::old('last_name'),
                 ['class' => 'form-control', 'required'=>'true', 'v-model' => 'user.last_name'] ) }}
                @if ($errors->has('last_name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                {{ Form::label('phone', 'Phone*') }}
                {{ Form::text('phone', Request::old('phone'),
                 ['class' => 'form-control', 'required'=>'true', 'v-model' => 'user.phone'] ) }}
                @if ($errors->has('phone'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                {{ Form::label('email', 'Email*') }}
                {{ Form::email('email', Request::old('email'),
                ['class' => 'form-control', 'required'=>'true', 'v-model' => 'user.email'] ) }}
                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                {{ Form::label('email_confirmation', 'Confirm Email*') }}
                {{ Form::email('email_confirmation', '',
                 ['class' => 'form-control', 'required'=>'true', 'v-model' => 'user.email_confirmation'] ) }}
            </div>
            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                {{ Form::label('password', 'Password*') }}
                {{ Form::password('password',
                ['class' => 'form-control', 'required'=>'true', 'v-model' => 'user.password'] ) }}
                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                {{ Form::label('password_confirmation', 'Confirm Password*') }}
                {{ Form::password('password_confirmation',
                ['class' => 'form-control', 'required'=>'true', 'v-model' => 'user.password_confirmation'] ) }}
            </div>
        </div>

        <div class="box register" v-show="step == 2">
            <h3>Profile Information</h3>
            <div class="form-group">
                {{ Form::label('company', 'Company') }}
                {{ Form::text('company', Request::old('company'),
                 ['class' => 'form-control',  'v-model' => 'user.company'] ) }}
            </div>
            <div class="form-group">
                {{ Form::label('address1', 'Address') }}
                {{ Form::text('address1', Request::old('address1'),
                 ['class' => 'form-control',  'v-model' => 'user.address1'] ) }}
            </div>
            <div class="form-group">
                {{ Form::label('address2', '') }}
                {{ Form::text('address2', Request::old('address2'),
                 ['class' => 'form-control',  'v-model' => 'user.address2'] ) }}
            </div>
            <div class="form-group">
                {{ Form::label('city', 'City') }}
                {{ Form::text('city', Request::old('city'),
                 ['class' => 'form-control',  'v-model' => 'user.city'] ) }}
            </div>
            <div class="form-group">
                {{ Form::label('state', 'State/Province') }}
                {{ Form::text('state', Request::old('state'),
                 ['class' => 'form-control',  'v-model' => 'user.state'] ) }}
            </div>
            <div class="form-group">
                {{ Form::label('country', 'Country') }}
                {{ Form::text('country', Request::old('country'),
                 ['class' => 'form-control',  'v-model' => 'user.country'] ) }}
            </div>
            <div class="form-group">
                {{ Form::label('zip', 'Zip') }}
                {{ Form::text('zip', Request::old('zip'),
                 ['class' => 'form-control',  'v-model' => 'user.zip'] ) }}
            </div>
        </div>

        <div class="box register" v-show="step == 3">
            Please confirm the following information is correct:
            <ul>
                <li><strong>Name:</strong> @{{ user.first_name}} @{{ user.last_name }}</li>
                <li><strong>Phone:</strong> @{{ user.phone }}</li>
                <li><strong>Email:</strong> @{{ user.email }}</li>
                <li><strong>Company:</strong> @{{ user.company }}</li>
                <li><strong>Address:</strong> @{{ user.address1 }}
                    <div>@{{ user.address2 }}</div>
                </li>
                <li><strong>City:</strong> @{{ user.city }}</li>
                <li><strong>State/Province:</strong> @{{ user.state }}</li>
                <li><strong>Country:</strong> @{{ user.country }}</li>
                <li><strong>Zip:</strong> @{{ user.zip }}</li>
            </ul>
        </div>

        <div class="text-right button-block">
            {{Form::button('PREVIOUS', ['class' => 'btn btn-primary', 'v-on:click' => 'previous', 'v-show' => 'step > 1'])}}
            {{Form::submit('next', ['class' => 'btn btn-primary', 'v-show' => 'step < 3'])}}
            {{Form::button('registration', ['class' => 'btn btn-primary', 'v-show' => 'step == 3', 'v-on:click'=> 'registration'])}}
        </div>
        {{Form::close()}}


    </div>

@endsection