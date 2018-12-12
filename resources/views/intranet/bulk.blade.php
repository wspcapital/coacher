@extends('intranet.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/intranet/bulks.min.css')}}">
@endsection
@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="user-info">
                    {!! Form::open(['route' => 'bulk/save', 'method' => 'post', 'id' => 'userForm']) !!}
                    {!! Form::text('bulk_id', $bulk->id, ['hidden'=>'true']) !!}
                    <div class="form-group" id="app-bulk">
                        <div class="form-group">
                            <strong>Relationship Manager</strong>
                            {!! Form::select('rm_user_id', $rm, $bulk->rm_user_id,
                            ['placeholder' => 'Chose relationship manager...', 'class'=> 'form-control']) !!}
                        </div>

                        <div class="form-group {{ $errors->has('company') ? ' has-error' : ''}}">
                            {!! Form::label('company', 'Company *') !!}
                            {!! Form::text('company', $bulk->company,
                            ['class' => 'form-control', 'placeholder' => 'Company']) !!}
                            @if ($errors->has('company'))
                                <span class="help-block alert-danger">
                                <strong>{{ $errors->first('company') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('location_city') ? ' has-error' : ''}}">
                            {!! Form::label('location_city', 'City *') !!}
                            {!! Form::text('location_city', $bulk->location_city,
                            ['class' => 'form-control', 'placeholder' => 'City']) !!}
                            @if ($errors->has('location_city'))
                                <span class="help-block alert-danger">
                                <strong>{{ $errors->first('location_city') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('location_country', 'Country') !!}
                            {!! Form::select('location_country', $country, $bulk->location_country,
                             ['placeholder' => 'Chose country...', 'class'=> 'form-control', 'v-on:change' => 'setCountryLocation()']) !!}
                        </div>

                        <div v-if="countryLocation === '184'" class="form-group">
                            {!! Form::label('location_state', 'State') !!}
                            {!! Form::select('location_state', $state, $bulk->location_state,
                            ['placeholder' => 'Chose state...', 'class'=> 'form-control']) !!}
                        </div>

                        <div v-if="countryLocation !== '184'" class="form-group">
                            {!! Form::label('location_state', 'Provence') !!}
                            {!! Form::text('location_state', $bulk->location_state,
                            ['class' => 'form-control', 'placeholder' => 'Provence']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('company_contact', 'Contact person') !!}
                            {!! Form::text('company_contact', $bulk->company_contact,
                            ['class' => 'form-control', 'placeholder' => 'Contact person']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('client_email', 'Email address') !!}
                            {!! Form::text('client_email', $bulk->client_email,
                            ['class' => 'form-control', 'placeholder' => 'Email address']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('client_phone', 'Telephone') !!}
                            {!! Form::text('client_phone', $bulk->client_phone,
                            ['class' => 'form-control', 'placeholder' => 'Telephone']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('details', 'Admin Notes') !!}
                            {!! Form::textarea('details', $bulk->details,
                            ['class' => 'form-control', 'placeholder' => 'Description/Notes', 'size' => '30x3']) !!}
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Package</th>
                                <th>Quantity</th>
                                <th>Assigned</th>
                                <th>Used</th>
                                <th>Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Video</td>
                                <td>
                                    {!! Form::text('vcoaches', $bulk->vcoaches,
                                    ['class' => 'form-control', 'placeholder' => '']) !!}
                                    @if ($errors->has('vcoaches'))
                                        <span class="help-block alert-danger">
                                            <strong>{{ $errors->first('vcoaches') }}</strong>
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span id="vcoaches_assign"></span>
                                </td>
                                <td>
                                    <span id="vcoaches_use"></span>
                                </td>
                                <td>
                                    <span id="vcoaches_balance"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Session</td>
                                <td>
                                    {!! Form::text('sessions', $bulk->sessions,
                                    ['class' => 'form-control', 'placeholder' => '']) !!}
                                    @if ($errors->has('sessions'))
                                        <span class="help-block alert-danger">
                                            <strong>{{ $errors->first('sessions') }}</strong>
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span id="sessions_assign"></span>
                                </td>
                                <td>
                                    <span id="sessions_use"></span>
                                </td>
                                <td>
                                    <span id="sessions_balance"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    @include('intranet.partials.bulk.participant-bulk')
                </div>
            </div>
            <div class="col-xs-12 clearfix">
                {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right btn-lg']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

