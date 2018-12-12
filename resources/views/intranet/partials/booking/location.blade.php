<div class="row" id="location">
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
            {!! Form::text('location_name', $booking->location_name,
            ['class' => 'form-control', 'placeholder' => 'Location']) !!}
        </div>

        <div class="form-group col-xs-12 col-sm-6">
            {!! Form::label('location_address', 'Address') !!}
            {!! Form::text('location_address', $booking->location_address,
            ['class' => 'form-control', 'placeholder' => 'Address']) !!}
        </div>

        <div class="form-group col-xs-12 col-sm-6">
            {!! Form::label('location_country', 'Country') !!}
            {!! Form::select('location_country', $country, empty($booking->location_country) ? '184' : $booking->location_country,
             ['placeholder' => 'Chose country...', 'class'=> 'form-control', 'v-on:change' => 'setCountryLocation()']) !!}
        </div>

        <div class="form-group col-xs-12 col-sm-6 {{ $errors->has('location_city') ? ' has-error' : ''}}">
            {!! Form::label('location_city', 'City *') !!}
            {!! Form::text('location_city', $booking->location_city,
            ['class' => 'form-control', 'placeholder' => 'City']) !!}
        </div>

        <div v-if="countryLocation === '184'" class="form-group col-xs-12 col-sm-6">
            {!! Form::label('location_state', 'State') !!}
            {!! Form::select('location_state', $state, $booking->location_state,
            ['placeholder' => 'Chose state...', 'class'=> 'form-control']) !!}
        </div>

        <div v-if="countryLocation !== '184'" class="form-group col-xs-12 col-sm-6">
            {!! Form::label('location_state', 'Provence') !!}
            {!! Form::text('location_state', $booking->location_state,
            ['class' => 'form-control', 'placeholder' => 'Provence']) !!}
        </div>

        <div class="form-group col-xs-12 col-sm-6">
            {!! Form::label('location_zip', 'ZIP') !!}
            {!! Form::text('location_zip', $booking->location_zip,
            ['class' => 'form-control', 'placeholder' => 'ZIP']) !!}
        </div>
    </div>
</div>