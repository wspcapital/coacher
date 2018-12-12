@extends('intranet.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('/assets/dist/css/intranet/booking.min.css')}}">
    <link rel="stylesheet" href="{{asset('//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css')}}">
@endsection
@section('main-content')
    <div class="container-fluid">
        {!! Form::open(['route' => 'booking/save', 'method' => 'post', 'id' => 'bookingForm']) !!}
        {!! Form::token() !!}
        {!! Form::text('booking_id', $booking->id, ['hidden'=>'true']) !!}
        <div class="row">
            <div class=" col-xs-12 clearfix">
                <button id="submitForm" class="btn btn-primary pull-right btn-lg">Save</button>
                <a href="{{ route('booking/save-as', $booking->id) }}" id="save-as1" class="btn btn-primary pull-right btn-lg">Duplicate</a>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="user-info">
                    {!! Form::text('booker_user_id', $booking->booker_user_id, ['hidden' => true]) !!}
                    <div class="booking-info">
                        <div><b>Workshop Title: </b> {{ $booking->title }}</div>
                        <div><b>Workshop Dates: </b> {{ $booking->start_date->format('m/d/y') }}
                            - {{ $booking->end_date->format('m/d/y') }}</div>
                        <div><b>Workshop City: </b> {{ $booking->location_city }}</div>
                        <div><b>Client: </b> {{ $booking->company }}</div>
                        <div><b>RM: </b>
                            @if ($booking->rm_user_id)
                                {{ $booking->rm->full_name }}
                            @endif
                        </div>
                    </div>
                    <div class="element-group">
                        <div class="form-group">
                            {!! Form::label('type', 'Type') !!}
                            {!! Form::select('type', array_combine($booking->types, $booking->types), $booking->type,
                            ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group {{ $errors->has('title') ? ' has-error' : ''}}">
                            {!! Form::label('title', 'Workshop Title*') !!}
                            {!! Form::text('title', $booking->title,
                            ['class' => 'form-control', 'placeholder' => 'title']) !!}
                            @if ($errors->has('title'))
                                <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 {{ $errors->has('start_date') ? ' has-error' : ''}}">
                            {!! Form::label('start_date', 'Start date') !!}
                            {!! Form::text('start_date', $booking->start_date->format('m/d/y'),
                            ['class' => 'form-control', 'placeholder' => 'Start date']) !!}
                            @if ($errors->has('start_date'))
                                <span class="help-block">
                                     <strong>{{ $errors->first('start_date') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 {{ $errors->has('end_date') ? ' has-error' : ''}}">
                            {!! Form::label('end_date', 'End date') !!}
                            {!! Form::text('end_date', $booking->end_date->format('m/d/y'),
                            ['class' => 'form-control', 'placeholder' => 'End date']) !!}
                            @if ($errors->has('end_date'))
                                <span class="help-block">
                            <strong>{{ $errors->first('end_date') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>

                    @include('intranet.partials.booking.trainers')
                    @include('intranet.partials.booking.other')
                    @include('intranet.partials.booking.location')
                    @include('intranet.partials.booking.client-information')
                    @include('intranet.partials.booking.logistics')

                </div>
            </div>
            {{-- Right --}}
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <strong>Relationship Manager</strong>
                    {!! Form::select('rm_user_id', $rm, $booking->rm_user_id,
                     ['placeholder' => 'Chose relationship manager...', 'class'=> 'form-control']) !!}
                </div>

                @include('intranet.partials.booking.curriculum')
                @include('intranet.partials.booking.attachments')

            </div>
        </div>

        @include('intranet.partials.booking.participant-booking')

        <div class=" col-xs-12 clearfix">
            {!! Form::submit('Save',
              ['class' => 'btn btn-primary pull-right btn-lg', 'id'=>'saveForm']) !!}

            <a href="{{ route('booking/save-as', $booking->id) }}" id="save-as2" class="btn btn-primary pull-right btn-lg">Duplicate</a>
        </div>

        {!! Form::close() !!}

        <div class="col-xs-2">
            <a href="#" id="print-booking-modal" class="btn  btn-primary ">
                Print
            </a>
        </div>
    </div>
    @include('intranet.partials.booking.print-booking')
@endsection
@section('scripts')
    @parent
    <link rel="stylesheet" href="{{asset('/assets/dist/libs/datetimepicker-master/jquery.datetimepicker.min.css')}}">
    <script src="{{asset('/assets/dist/libs/datetimepicker-master/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="{{asset('/assets/dist/libs/datetimepicker-master/setting.js') }}"></script>
    <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js')}}"
            type="text/javascript"></script>
@endsection