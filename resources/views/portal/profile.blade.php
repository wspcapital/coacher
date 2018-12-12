@extends('portal.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/portal/profile.min.css')}}">
@endsection
@section('main-content')
    <div class="start-content" id="vcoach">
        <div class="row">
            <img src="{{ asset('assets/dist/img/portal/profile-icon.png') }}">
            <span class="page-title">My Profile</span>
        </div>
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <div id="inner-container">
                {!! Form::open(['url' => 'portal/profile/save', 'method' => 'post', 'id' => 'postForm']) !!}
                {!! Form::text('user_id', $user->id,['hidden' => true]) !!}
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                        {!! Form::label('first_name', 'First Name') !!}
                        {!! Form::text('first_name', $user->first_name,
                        ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('last_name', 'Last Name') !!}
                        {!! Form::text('last_name', $user->last_name,
                        ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('title', 'Position') !!}
                        {!! Form::text('title', $user->title,
                        ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('company', 'Company or Firm') !!}
                        {!! Form::text('company', $user->company,
                        ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('website', 'Website') !!}
                        {!! Form::text('website', $user->website,
                        ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('address1', 'Address1') !!}
                        {!! Form::text('address1', $user->address1,
                        ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6">
                   <div class="form-group">
                        {!! Form::label('address2', 'Address2') !!}
                        {!! Form::text('address2', $user->address2,
                        ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('city', 'City') !!}
                        {!! Form::text('city', $user->city,
                        ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('state', 'State') !!}
                        {!! Form::text('state', $user->state,
                        ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('zip', 'Zip') !!}
                        {!! Form::text('zip', $user->zip,
                        ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('phone', 'Phone') !!}
                        {!! Form::text('phone', $user->phone,
                        ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('fax', 'Fax') !!}
                        {!! Form::text('fax', $user->fax,
                        ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                    <div class=" col-xs-12 clearfix">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right btn-lg',
                        'id' => 'submitForm']) !!}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection