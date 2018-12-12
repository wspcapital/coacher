@extends('intranet.template.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('/assets/dist/css/intranet/booking.min.css')}}">
@endsection
@section('main-content')
    <div class="container-fluid">
        {!! Form::open(['url' => 'intranet/booking/create', 'method' => 'post', 'id' => 'bookingForm']) !!}
        {!! Form::token() !!}
        <div class="row">
            <div class=" col-xs-12 clearfix">
                <button id="submitForm" class="btn btn-primary pull-right btn-lg">Save</button>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="user-info">
                    <div class="element-group">
                       <div class="form-group">
                            {!! Form::label('type', 'Type') !!}
                            {!! Form::select('type', array_combine($booking->types, $booking->types), $booking->type,
                            ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group {{ $errors->has('title') ? ' has-error' : ''}} ">
                            {!! Form::label('title', 'Workshop Title *') !!}
                            {!! Form::text('title', '',
                            ['class' => 'form-control', 'placeholder' => 'title']) !!}
                            @if ($errors->has('title'))
                                <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 {{ $errors->has('start_date') ? ' has-error' : ''}}">
                            {!! Form::label('start_date', 'Start date') !!}
                            {!! Form::text('start_date', '',
                            ['class' => 'form-control', 'placeholder' => 'start date']) !!}
                            @if ($errors->has('start_date'))
                                <span class="help-block">
                                     <strong>{{ $errors->first('start_date') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 {{ $errors->has('end_date') ? ' has-error' : ''}}">
                            {!! Form::label('end_date', 'End date') !!}
                            {!! Form::text('end_date', '',
                            ['class' => 'form-control', 'placeholder' => 'end date']) !!}
                            @if ($errors->has('end_date'))
                                <span class="help-block">
                                     <strong>{{ $errors->first('end_date') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row" id="app-new-booking">
                        <h2 data-toggle="collapse" data-parent="#booking-sheets" data-target="#sec-location">
                            Location</h2>
                        @if ($errors->has('location_city'))
                            <span class="help-block alert-danger">
                                     <strong>{{ $errors->first('location_city') }}</strong>
                            </span>
                        @endif
                        <div id="sec-location" class="collapse">
                            <div class="form-group col-xs-12 col-sm-6">
                                {!! Form::label('location_name', 'Location') !!}
                                {!! Form::text('location_name', '',
                                ['class' => 'form-control', 'placeholder' => 'Location']) !!}
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                {!! Form::label('location_address', 'Address') !!}
                                {!! Form::text('location_address', '',
                                ['class' => 'form-control', 'placeholder' => 'Address']) !!}
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                {!! Form::label('location_country', 'Country') !!}
                                {!! Form::select('location_country', $country, '184',
                                 ['placeholder' => 'Chose country...', 'class'=> 'form-control', 'v-on:change' => 'setCountryLocation()']) !!}
                            </div>

                            <div class="form-group col-xs-12 col-sm-6 {{ $errors->has('location_city') ? ' has-error' : ''}}">
                                {!! Form::label('location_city', 'City *') !!}
                                {!! Form::text('location_city', '',
                                ['class' => 'form-control', 'placeholder' => 'City']) !!}
                            </div>

                            <div v-if="countryLocation === '184'" class="form-group col-xs-12 col-sm-6">
                                {!! Form::label('location_state', 'State') !!}
                                {!! Form::select('location_state', $state, '',
                                ['placeholder' => 'Chose state...', 'class'=> 'form-control']) !!}
                            </div>

                            <div v-if="countryLocation !== '184'" class="form-group col-xs-12 col-sm-6">
                                {!! Form::label('location_state', 'Provence') !!}
                                {!! Form::text('location_state', '',
                                ['class' => 'form-control', 'placeholder' => 'Provence']) !!}
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                {!! Form::label('location_zip', 'ZIP') !!}
                                {!! Form::text('location_zip', '',
                                ['class' => 'form-control', 'placeholder' => 'ZIP']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h2 data-toggle="collapse" data-parent="#booking-sheets" data-target="#sec-client">Client
                            Information</h2>
                        @if ($errors->has('company'))
                            <span class="help-block alert-danger">
                                     <strong>{{ $errors->first('company') }}</strong>
                            </span>
                        @endif
                        <div id="sec-client" class="collapse">
                            <div class="form-group col-xs-12 col-sm-6 {{ $errors->has('company') ? ' has-error' : ''}}">
                                {!! Form::label('company', 'Company *') !!}
                                {!! Form::text('company', '',
                                ['class' => 'form-control', 'placeholder' => 'Company']) !!}
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                {!! Form::label('company_website', 'Company website') !!}
                                {!! Form::text('company_website', '',
                                ['class' => 'form-control', 'placeholder' => 'Company website']) !!}
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                {!! Form::label('company_contact', 'Company contact') !!}
                                {!! Form::text('company_contact', '',
                                ['class' => 'form-control', 'placeholder' => 'Company contact']) !!}
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                {!! Form::label('client_phone', 'Client phone') !!}
                                {!! Form::text('client_phone', '',
                                ['class' => 'form-control', 'placeholder' => 'Client phone']) !!}
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                {!! Form::label('client_email', 'Client email') !!}
                                {!! Form::text('client_email', '',
                                ['class' => 'form-control', 'placeholder' => 'Client email']) !!}
                            </div>

                            <div class="form-group col-xs-12">
                                {!! Form::label('details', 'Description/Notes') !!}
                                {!! Form::textarea('details', '',
                                ['class' => 'form-control', 'placeholder' => 'Description/Notes', 'size' => '30x3']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h2 data-toggle="collapse" data-parent="#booking-sheets" data-target="#sec-logistics">
                            Logistics</h2>

                        <div id="sec-logistics" class="collapse">
                            <div class="element-group">
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-4">
                                        <strong>DDP Required</strong>
                                        {!! Form::checkbox('ddp', '1', true) !!}
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4">
                                        <strong>CAP Required</strong>
                                        {!! Form::checkbox('cap_required', '1', false) !!}
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4">
                                        <strong>GNA Sent</strong>
                                        {!! Form::checkbox('gna', '1', false) !!}
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4">
                                        <strong>Pinnacle Workshop Evaluations</strong>
                                        {!! Form::checkbox('evaluation', '1', false) !!}
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4">
                                        <strong>Custom workbook needed</strong>
                                        {!! Form::checkbox('customwb', '1', false) !!}
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4">
                                        <strong>Include PDP</strong>
                                        {!! Form::checkbox('pdp', '1', true) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                {!! Form::label('workbook', 'Workbook') !!}
                                {!! Form::text('workbook', '',
                                ['class' => 'form-control', 'placeholder' => 'Workbook']) !!}
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                {!! Form::label('part', 'Number of Participants') !!}
                                {!! Form::text('part', '0',
                                ['class' => 'form-control', 'placeholder' => 'Number of Participants']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('pdpship', 'Shipping Information') !!}
                                {!! Form::textarea('pdpship', '',
                                ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('noteship', 'Shipping Information (Client visible)') !!}
                                {!! Form::textarea('noteship', '',
                                ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('pdptrack', 'Tracking Number') !!}
                                {!! Form::text('pdptrack', '',
                                ['class' => 'form-control', 'placeholder' => 'Tracking Number']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('generalnote', 'General Notes (Client visible)') !!}
                                {!! Form::textarea('generalnote', '',
                                ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="row">
                    <div class="form-group">
                        <strong>Relationship Manager</strong>
                        {!! Form::select('rm_user_id', $rm, Auth::user()->id,
                        ['placeholder' => 'Chose relationship manager...', 'class'=> 'form-control']) !!}
                    </div>
                </div>

                <div class="row">
                    <h2 data-toggle="collapse" data-parent="#booking-sheets" data-target="#trainer-details">
                        Trainer details</h2>
                    <div id="trainer-details" class="collapse">
                        <ul class="trainer-list">
                            @foreach($trainers as $user_id => $trainer)
                                <li>
                                    {!! Form::checkbox('trainerIds[]', $user_id) !!}
                                    <strong>{{ $trainer }}</strong>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <h2 data-toggle="collapse" data-parent="#booking-sheets" data-target="#sec-other">Travel details</h2>

                    <div id="sec-other" class="collapse">
                        <div class="element-group">
                            <div class="form-group">
                                <strong>Ready to book travel</strong>
                                {!! Form::checkbox('readybook', '1', false) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('event_hotels', 'Hotel Recommendations') !!}
                            {!! Form::textarea('event_hotels', '',
                            ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('travelnotes','Travel Notes') !!}
                            {!! Form::textarea('travelnotes', '',
                            ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('accommodations','a. Accommodations (Client visible)') !!}
                            {!! Form::textarea('accommodations', '',
                            ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('corporate_rate', 'b. Corporate Rates (Client visible)') !!}
                            {!! Form::text('corporate_rate', '',
                            ['class' => 'form-control', 'placeholder' => 'Tracking Number']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('transfer','c. Airport Transportation (Client visible)') !!}
                            {!! Form::textarea('transfer', '',
                            ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
                        </div>

                        <div class="element-group">
                            <h5>Expenses</h5>

                            <div class="checkbox-inline">
                                <strong>Per Diem</strong>
                                {!! Form::radio('expenses', '0') !!}
                            </div>
                            <div class="checkbox-inline">
                                <strong>Receipts</strong>
                                {!! Form::radio('expenses', '1') !!}
                            </div>
                            <div class="checkbox-inline">
                                <strong>Expenses Complete</strong>
                                {!! Form::checkbox('expenses_complete', '1') !!}
                            </div>
                        </div>
                        <div class="element-group">
                            <h5>Workshop materials</h5>

                            <div class="checkbox-inline">
                                <strong>To be shipped to client</strong>
                                {!! Form::radio('materials', '0', true) !!}
                            </div>
                            <div class="checkbox-inline">
                                <strong>To be hand-carried by trainer</strong>
                                {!! Form::radio('materials', '1', false) !!}
                            </div>
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
