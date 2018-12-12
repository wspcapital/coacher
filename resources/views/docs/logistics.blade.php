@extends('docs.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/dist/css/docs/logistics.min.css') }}">
    @endsection
@section('main-content')
    {!! Form::open(['method' => 'post', 'id' => 'logisticsForm']) !!}
    {!! Form::token() !!}
        <div class="container pad-top">
            <h2>Logistics Request for {{$booking->company}}</h2>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif
            <p>Pinnacle Performance Company Workshop Logistics Request</p>WORKSHOP: {{$booking->title}}
            <br>DATES: {{$booking->start_date->format('M d Y')}} - {{$booking->end_date->format('M d Y')}}
            <hr>
            <p>Please review and complete the following logistics information required for a successful
                engagement.</p>

            <p>
                <strong>Should you have questions, please contact:</strong></p>
            <span class="text-blue">Relationship Manager:</span>
            @if($booking->rm){{$booking->rm->full_name}}@endif<br>
            <span class="text-blue">Relationship Manager Email:</span>
            @if($booking->rm)<a href="mailto:{{$booking->rm->email}}">{{$booking->rm->email}}</a>@endif
            <hr>
            <p><strong>Trainer Assignments:</strong></p>
            @foreach($booking->bookingTrainers as $trainer)
                @if($trainer->user_id)
                    <div>
                        <a class="col-md-2" href="{{ url('intranet/user/' . $trainer->user_id) }}" target="_blank">{{$trainer->user->full_name}}</a>
                        &nbsp;&nbsp;
                        <a class="col-md-2" data-toggle="collapse"
                           data-target="#trainer-{{$trainer->user_id}}">
                            <img class="img-responsive hidden-xs" src="{{asset('/assets/dist/img/intranet/booking/logistics/info.png')}}" alt="bio"></a>

                        <div id="trainer-{{$trainer->user->id}}" class="collapse">
                            <div class="clearfix">
                                @if(is_string($trainer->user->data('bio')))
                                    {{$trainer->user->data('bio')}}
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            <hr>
            <p><strong>Participant List</strong></p>

            <p>Please provide contact information for all participants. We will use this information to send out
                Individual Needs Analysis for each participant prior to the workshop and to create their personal
                Pinnacle Green Room accounts. The Pinnacle Green Room is our online portal to access videos, reports
                and our library of tools, tips and techniques.</p>

            <div>
                    <participants parts="{{ $booking->bookingParticipants }}"></participants>


            </div>
            <hr>
            <hr>
            <p><strong>Hotel and Travel Recommendations</strong></p>

            <p>a. <strong>Accommodations:</strong> Are there any nearby hotels that you'd recommend for our trainer?</p>

                {!! Form::textarea('accommodations', !empty($booking->accommodations) ? $booking->accommodations : '',
                ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
            <p>b.
                <strong>Corporate Rates:</strong> Do you have a corporate rate at this hotel that you would like the
                trainer to use?
            </p>
            {!! Form::text('corporate_rate', $booking->corporate_rate,
                            ['class' => 'form-control', 'placeholder' => '']) !!}
            <p>
                c.
                <strong>Airport Transportation:</strong> Would you prefer your trainer uses a taxi or is there
                another method you would rather have him use to travel from the airport to the hotel/venue?
            </p>
            {!! Form::textarea('transfer', !empty($booking->transfer) ? $booking->transfer : '',
                ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
            <hr>
            <p>
                <strong>Address of Workshop Location: Please provide the address where the training will be held.
                    Including room numbers and any security details your trainer should know.</strong>
            </p>
            <p><strong>Confirm Location</strong>
            </p>
            {!! Form::checkbox('booklocation', '1', $booking->booklocation ) !!}
            {!! Form::label('booklocation', 'Confirmed Location Data') !!}
            <p><strong>Location</strong>
            </p>

            {!! Form::label('location_name', 'Location Name') !!}
            {!! Form::text('location_name', $booking->location_name,
                            ['class' => 'form-control', 'placeholder' => '']) !!}

            {!! Form::label('location_address', 'Location Address') !!}
            {!! Form::text('location_address', $booking->location_address,
                            ['class' => 'form-control', 'placeholder' => '']) !!}

            {!! Form::label('location_city', 'City') !!}
            {!! Form::text('location_city', $booking->location_city,
                            ['class' => 'form-control', 'placeholder' => '']) !!}

            <div v-if="countryLocation === '184'">
                {!! Form::label('location_state', 'State') !!}
                {!! Form::select('location_state', $state, $booking->location_state,
                ['placeholder' => 'Chose state...', 'class'=> 'form-control']) !!}
            </div>

            <div v-if="countryLocation !== '184'">
                {!! Form::label('location_state', 'Provence') !!}
                {!! Form::text('location_state', $booking->location_state,
                ['class' => 'form-control', 'placeholder' => 'Provence']) !!}
            </div>

            {!! Form::label('location_zip', 'Zip Code') !!}
            {!! Form::text('location_zip', $booking->location_zip,
                            ['class' => 'form-control', 'placeholder' => '']) !!}

            {!! Form::label('location_country', 'Country') !!}
            {!! Form::select('location_country', $country, empty($booking->location_country) ? '184' : $booking->location_country,
             ['placeholder' => 'Chose country...', 'class'=> 'form-control', 'v-on:change' => 'setCountryLocation()']) !!}

            <p><strong>Workshop Time: Please confirm that start time and end time below.</strong></p>

            {!! Form::checkbox('data[logistics][workshop_time_confirm]', '1', isset($booking->data()->logistics->workshop_time_confirm) && $booking->data()->logistics->workshop_time_confirm === '1' ) !!}
            {!! Form::label('data[logistics][workshop_time_confirm]', 'I agree') !!}

            <div class="row">
                <div class="col-md-6">
                    {!! Form::label('start_date', 'Start Date') !!}
                    {!! Form::text('start_date', $booking->start_date->format('m/d/Y'),
                                    ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('end_date', 'End Date') !!}
                    {!! Form::text('end_date', $booking->end_date->format('m/d/Y'),
                                    ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <hr>
            {{--<bookingdays bdays="{{ $booking->bookingSchedules }}"></bookingdays>--}}
            <p><strong>Schedule</strong></p>
            @foreach($booking->bookingSchedules as $schedule)
                <div class="row">
                    <div class="col-md-3">{{ $schedule->booking_day }}</div>
                    <div class="col-md-3">{{ $schedule->start }}</div>
                    <div class="col-md-3">{{ $schedule->end }}</div>
                </div>
            @endforeach
            <hr>
            <p>
                <strong>Site Contact: Please provide an onsite contact for the day of the event. The instructor will
                    need access to the building/room at least 1 hour prior to the start time</strong>
            </p>

            <div class="row">
                <div class="col-sm-3">
                    {!! Form::label('site_contact_fname', 'First Name') !!}
                    {!! Form::text('site_contact_fname', $booking->site_contact_fname,
                                    ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('site_contact_lname', 'Last Name') !!}
                    {!! Form::text('site_contact_lname', $booking->site_contact_lname,
                                    ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('site_contact_phone', 'Phone Number') !!}
                    {!! Form::text('site_contact_phone', $booking->site_contact_phone,
                                    ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('site_contact_email', 'Email Address') !!}
                    {!! Form::text('site_contact_email', $booking->site_contact_email,
                                    ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <hr>
            <p><strong>Room Set up: Please confirm the following will be available in the training facility:</strong></p>

            {!! Form::checkbox('data[logistics][projector]', '1', isset($booking->data()->logistics->projector) && $booking->data()->logistics->projector === '1' ) !!}
            {!! Form::label('data[logistics][projector]', 'Projector w/speakers or a TV so that we can plug our camera in for video playback (regular red, white and yellow RCA jack inputs).') !!}

            {!! Form::radio('data[logistics][board]', '0', isset($booking->data()->logistics->board) && $booking->data()->logistics->board === '0' ) !!}
            {!! Form::label('data[logistics][board]', 'Whiteboard') !!}

            {!! Form::radio('data[logistics][board]', '1', isset($booking->data()->logistics->board) && $booking->data()->logistics->board === '1' ) !!}
            {!! Form::label('data[logistics][board]', 'Flipchart') !!}

            {!! Form::checkbox('data[logistics][ushape]', '1', isset($booking->data()->logistics->ushape) && $booking->data()->logistics->ushape === '1' ) !!}
            {!! Form::label('data[logistics][ushape]', 'Preferably the room is setup in U-Shaped configuration (Boardroom set up is the least desirable). However, most set-ups are fine as long as there is room for everyone to move!') !!}

            {!! Form::checkbox('data[logistics][stretchroom]', '1', isset($booking->data()->logistics->stretchroom) && $booking->data()->logistics->stretchroom === '1' ) !!}
            {!! Form::label('data[logistics][stretchroom]', 'The room will need to be set up so that participants have room to stand up, stretch out and move around') !!}
            <hr>

            <p>
                <strong>Shipping Information: We will be shipping the workshop materials to you prior to the
                    workshop. Please provide a ship to address for materials. We ask that you do not hand out either
                    ahead of time. Instead have them ready for our instructor the first morning.</strong>
            </p>{!! Form::textarea('shipping', $booking->shipping,
                ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
            <hr>
            <p>For each full day of training will lunch be provided?</p>

            {!! Form::radio('data[logistics][lunch]', '1', isset($booking->data()->logistics->lunch) && $booking->data()->logistics->lunch === '1' ) !!}
            {!! Form::label('data[logistics][lunch]', 'Yes') !!}

            {!! Form::radio('data[logistics][lunch]', '0', isset($booking->data()->logistics->lunch) && $booking->data()->logistics->lunch === '0' ) !!}
            {!! Form::label('data[logistics][lunch]', 'No') !!}

            <p>If not, please recommend some restaurants either in or close to building for the trainer to get a
                quick lunch.</p>
            </p>{!! Form::textarea('restaurants', $booking->restaurants,
                ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
            <hr>
            {!! Form::label('notes', 'General Notes') !!}
            {!! Form::textarea('notes', $booking->generalnote,
                ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
            <p>Thanks so much for taking the time to complete all of the information. The more thorough the
                information the smoother the event will go for everyone.</p>
            <div class=" col-xs-12 clearfix submit">
                {!! Form::submit('Save',
                  ['class' => 'clearfix btn btn-primary pull-right', 'id'=>'saveForm']) !!}
            </div>
        </div>


    {!! Form::close() !!}
@endsection
@section('scripts')
    @parent
    <link rel="stylesheet" href="/assets/dist/libs/datetimepicker-master/jquery.datetimepicker.min.css">
    <script src="/assets/dist/libs/datetimepicker-master/jquery.datetimepicker.full.min.js"></script>
    <script src="/assets/dist/libs/datetimepicker-master/setting.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
@endsection