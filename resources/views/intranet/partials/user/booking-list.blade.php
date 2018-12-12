<div class="booking-list">
    @foreach($bookings as $month => $data)
        <div class="row">
            <h2 data-toggle="collapse" data-parent="#booking-sheets"
                data-target="#sec-{{$month}}">{{date('M Y',strtotime('1-'.substr($month,2,2).'-20'.substr($month,0,2)))}}</h2>
            <div id="sec-{{$month}}" class="collapse">
                @foreach($data as  $booking)

                    <div class="row">
                        <div class="col-xs-3"><a
                                    href="{{route('booking', $booking->id)}}">{{$booking->company}}</a>
                        </div>
                        <div class="col-xs-5">{{$booking->title}}</div>
                        <div class="col-xs-2">{{$booking->location_city}}</div>
                        <div class="col-xs-2"> {{$booking->start_date->format('m/d/y')}}</div>
                        <div class="col-xs-12">
                            <strong>City:</strong> {{$booking->location_city}} @if(count($booking->rm))
                                <br><strong>RM:</strong> {{$booking->rm->full_name}} @endif
                            <br><strong>Custom Workbook:</strong> @if($booking->customwb) Yes @else
                                No @endif
                            <br><strong>Trainers:</strong>
                            @foreach($booking->bookingTrainers as $bookingTrainer)
                                {{ $bookingTrainer->user->full_name }}
                                @if ($bookingTrainer->user->car_rental_book)
                                    <img src={{asset('/assets/dist/img/intranet/calendar/carbook.png')}}>
                                @endif
                                @if ($bookingTrainer->user->flight_book)
                                    <img src={{asset('/assets/dist/img/intranet/calendar/airplane.png')}}>
                                @endif
                                @if ($bookingTrainer->user->hotel_book)
                                    <img src={{asset('/assets/dist/img/intranet/calendar/hotel.png')}}>
                                @endif
                                ,
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>