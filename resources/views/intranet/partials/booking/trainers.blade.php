<div class="row" id="trainers">
    <h2 data-toggle="collapse" data-parent="#booking-sheets" data-target="#trainer-details">Trainer
        Details</h2>
    <div id="trainer-details" class="collapse">
        <ul class="trainer-list">
            @foreach($trainers as $user_id => $trainer)
                <li>
                    {!! Form::checkbox('trainerIds[]', $user_id, $trainer['booking']) !!}
                    <strong>{{ $trainer['trainer_name'] }}</strong>
                </li>
            @endforeach
        </ul>
        @foreach($booking->bookingTrainers as $bookingTrainer)
            @if($bookingTrainer->user != null)
                <div class="trainer-info" id="trainer-{{$bookingTrainer->id}}">
                    <div class="trainer-title">
                        <a data-toggle="collapse"
                           data-target="#booking-trainers-{{ $bookingTrainer->id }}">{{ $bookingTrainer->user->full_name }}</a>
                        <a class="pull-right" href="#" @click.prevent="confirmDelete({{$bookingTrainer->id}})">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div id="booking-trainers-{{ $bookingTrainer->id }}" class="collapse">
                        <h5>Hotel Booked</h5>
                        <div class="checkbox-inline">
                            <strong>No</strong>
                            {!! Form::radio('booking_trainers['.$bookingTrainer->id.'][hotel_book]', '0', !$bookingTrainer->hotel_book) !!}
                        </div>
                        <div class="checkbox-inline">
                            <strong>Yes</strong>
                            {!! Form::radio('booking_trainers['.$bookingTrainer->id.'][hotel_book]', '1', $bookingTrainer->hotel_book) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('booking_trainers['.$bookingTrainer->id.'][hotel_name]', 'Hotel Name') !!}
                            {!! Form::text('booking_trainers['.$bookingTrainer->id.'][hotel_name]', $bookingTrainer->hotel_name,
                            ['class' => 'form-control', 'placeholder' => 'Hotel Name']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('booking_trainers['.$bookingTrainer->id.'][hotel_address]','Hotel Address') !!}
                            {!! Form::textarea('booking_trainers['.$bookingTrainer->id.'][hotel_address]', $bookingTrainer->hotel_address,
                            ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
                        </div>

                        <h5>Flight Booked</h5>
                        <div class="checkbox-inline">
                            <strong>No</strong>
                            {!! Form::radio('booking_trainers['.$bookingTrainer->id.'][flight_book]', '0', !$bookingTrainer->flight_book) !!}
                        </div>
                        <div class="checkbox-inline">
                            <strong>Yes</strong>
                            {!! Form::radio('booking_trainers['.$bookingTrainer->id.'][flight_book]', '1', $bookingTrainer->flight_book) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('booking_trainers['.$bookingTrainer->id.'][flight_info]','Flight Info') !!}
                            {!! Form::textarea('booking_trainers['.$bookingTrainer->id.'][flight_info]', $bookingTrainer->flight_info,
                            ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
                        </div>

                        <h5>Car Rental Needed</h5>
                        <div class="checkbox-inline">
                            <strong>No</strong>
                            {!! Form::radio('booking_trainers['.$bookingTrainer->id.'][car_rental_book]', '0', !$bookingTrainer->car_rental_book) !!}
                        </div>
                        <div class="checkbox-inline">
                            <strong>Yes</strong>
                            {!! Form::radio('booking_trainers['.$bookingTrainer->id.'][car_rental_book]', '1', $bookingTrainer->car_rental_book) !!}
                        </div>

                        <h5>Car Rental Booked</h5>
                        <div class="checkbox-inline">
                            <strong>No</strong>
                            {!! Form::radio('booking_trainers['.$bookingTrainer->id.'][car_rental]', '0', !$bookingTrainer->car_rental) !!}
                        </div>
                        <div class="checkbox-inline">
                            <strong>Yes</strong>
                            {!! Form::radio('booking_trainers['.$bookingTrainer->id.'][car_rental]', '1', $bookingTrainer->car_rental) !!}
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>