@extends('intranet.template.app')

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="user-info">
                    {!! Form::open(['url' => 'intranet/bulk/create', 'method' => 'post', 'id' => 'userForm']) !!}
                    {!! Form::token() !!}

                    <div class="form-group" id="app-bulk">

                        <div class="form-group">
                            <strong>Relationship Manager</strong>
                            {!! Form::select('rm_user_id', $rm, Auth::user()->id,
                            ['placeholder' => 'Chose relationship manager...', 'class'=> 'form-control']) !!}
                        </div>

                        <div class="form-group {{ $errors->has('company') ? ' has-error' : ''}}">
                            {!! Form::label('company', 'Company *') !!}
                            {!! Form::text('company', '',
                            ['class' => 'form-control', 'placeholder' => 'Company']) !!}
                            @if ($errors->has('company'))
                                <span class="help-block alert-danger">
                                <strong>{{ $errors->first('company') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('location_city') ? ' has-error' : ''}}">
                            {!! Form::label('location_city', 'City *') !!}
                            {!! Form::text('location_city', '',
                            ['class' => 'form-control', 'placeholder' => 'City']) !!}
                            @if ($errors->has('location_city'))
                                <span class="help-block alert-danger">
                                <strong>{{ $errors->first('location_city') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('location_country', 'Country') !!}
                            {!! Form::select('location_country', $country, '184',
                             ['placeholder' => 'Chose country...', 'class'=> 'form-control', 'v-on:change' => 'setCountryLocation()']) !!}
                        </div>

                        <div v-if="countryLocation === '184'" class="form-group">
                            {!! Form::label('location_state', 'State') !!}
                            {!! Form::select('location_state', $state, '',
                            ['placeholder' => 'Chose state...', 'class'=> 'form-control']) !!}
                        </div>

                        <div v-if="countryLocation !== '184'" class="form-group">
                            {!! Form::label('location_state', 'Provence') !!}
                            {!! Form::text('location_state', '',
                            ['class' => 'form-control', 'placeholder' => 'Provence']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('company_contact', 'Contact person') !!}
                            {!! Form::text('company_contact', '',
                            ['class' => 'form-control', 'placeholder' => 'Contact person']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('client_email', 'Email address') !!}
                            {!! Form::text('client_email', '',
                            ['class' => 'form-control', 'placeholder' => 'Email address']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('client_phone', 'Telephone') !!}
                            {!! Form::text('client_phone', '',
                            ['class' => 'form-control', 'placeholder' => 'Telephone']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('details', 'Admin Notes') !!}
                            {!! Form::textarea('details', '',
                            ['class' => 'form-control', 'placeholder' => 'Description/Notes', 'size' => '30x3']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('vcoaches', 'Video Quantity') !!}
                            {!! Form::text('vcoaches', '',
                            ['class' => 'form-control', 'placeholder' => '']) !!}
                            @if ($errors->has('vcoaches'))
                                <span class="help-block alert-danger">
                                            <strong>{{ $errors->first('vcoaches') }}</strong>
                                        </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('sessions', 'Coaching Session Quantity') !!}
                            {!! Form::text('sessions', '',
                            ['class' => 'form-control', 'placeholder' => '']) !!}
                            @if ($errors->has('sessions'))
                                <span class="help-block alert-danger">
                                            <strong>{{ $errors->first('sessions') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 clearfix">
                {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right btn-lg']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <link rel="stylesheet" href="/assets/dist/libs/datetimepicker-master/jquery.datetimepicker.min.css">
    <script src="/assets/dist/libs/datetimepicker-master/jquery.datetimepicker.full.min.js"></script>
    <script src="/assets/dist/libs/datetimepicker-master/setting.js"></script>
@endsection
