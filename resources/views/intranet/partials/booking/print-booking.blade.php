<div class="col-xs-10 col-xs-offset-2">
    <div class="modal" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h2 id="printModalLabel">Pinnacle Workshop Booking Sheet</h2>
                </div>
                <div class="modal-body">
                    <h3>{{ $booking->title }}</h3>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">

                            {{-- <dt>Client Company:&nbsp;{{$booking->company}}</dt>

                             <dt>Workshop Title:&nbsp;{{$booking->title}}</dt>--}}

                            <p><strong>Start Date:</strong>&nbsp;{{$booking->start_date->format('Y/m/d')}}</p>

                            <p><strong>End Date:</strong>&nbsp;{{$booking->end_date->format('Y/m/d')}}</p>

                            {{--     @foreach ($booking_days as $booking_date => $booking_day)
                                     <dt class='d'>Day {{ $booking_date }}</dt>
                                     <dd class='noedit'>Start: {{ $booking_day['time_start'] }} |
                                         End: {{ $booking_day['time_end'] }}</dd>
                                 @endforeach--}}
                            <h4> List of Trainers </h4>
                            @foreach ($trainers as $trainer)
                                @if ($trainer['booking'])
                                    <p> {{ $trainer['trainer_name'] }} </p>
                                @endif
                            @endforeach

                            <h4 class="clearfix">Location</h4>
                            <p><strong>Location Name:</strong>&nbsp;{{$booking->location_name}}</p>

                            <p><strong>Address:</strong>&nbsp;{{$booking->location_address}}</p>

                            <p><strong>City:</strong>&nbsp;{{$booking->location_city}}</p>

                            <p><strong>State:</strong>&nbsp;{{$booking->location_state}}</p>

                            <p><strong>ZIP Code:</strong>&nbsp;{{$booking->location_zip}}</p>

                            <p><strong>Country:</strong>&nbsp;{{$booking->location_country}}</p>

                        </div>

                        <div class="col-xs-12 col-md-6">
                            <h4 class="clearfix">Client Information</h4>
                            <dl>
                                <dt>Client Company:&nbsp;{{$booking->company}}</dt>
                                <dt>Client Contact:&nbsp;{{$booking->company_contact}}</dt>
                                <dt>Client Phone:&nbsp;{{$booking->client_phone}}</dt>
                                <dt>Client Email:&nbsp;{{$booking->client_email}}</dt>
                                <dt>Description/Notes: {{$booking->details}}</dt>

                    {{--<h3>Workshop Details</h3>
                    <dt>No. of participants:&nbsp;{{count($booking->participants)}}</dt>

                    <dt>Description/Notes</dt>
                    <dd>{{$booking->details}}</dd>

                    <dt>DDP Required:&nbsp;@if($booking->preport)<span>Yes</span>@else<span>No</span>@endif
                    </dt>

                    <dt>GNA Sent:&nbsp;@if($booking->gna)<span>Yes</span>@else<span>No</span>@endif</dt>

                    <dt>Custom Workbook:&nbsp;@if($booking->customwb)<span>Yes</span>@else
                            <span>No</span>@endif</dt>

                    <dt>Workbook:&nbsp;@if($booking->workbook)<span>Yes</span>@else<span>No</span>@endif
                    </dt>

                    <dt>Include PDP:&nbsp;@if($booking->pdp)<span>Yes</span>@else<span>No</span>@endif</dt>

                    <dt>Shipping Information:&nbsp;{{$booking->pdpship}}</dt>

                    <dt>Tracking Number:&nbsp;{{$booking->pdptrack}}</dt>

                    <dt>Workshop Materials:&nbsp;@if($booking->materials)
                            <span>To be hand-carried by trainer</span>@else
                            <span>To be shipped to client</span>@endif</dt>--}}
                </dl>
                <h4>Listed Participants</h4>
                <div id="students" style="width:90%">
                    <table width="100%" cellpadding="3">
                        @foreach ($booking->BookingParticipants as $participant)
                            <tr>
                                <td style='border-bottom:1px dotted #CCC;padding:3px 0;'>{{ $participant->user->full_name }}</td>
                                <td style='border-bottom:1px dotted #CCC;'>{{ $participant->user->email }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        {{--<hr>
        <h3>Hotel &amp; Booking Information</h3>
        <dl>
            <dt>Hotel Recommendations</dt>
            <dd>{{$booking->event_hotels}}</dd>
            <dt>Travel Notes</dt>
            <dd>{{$booking->travelnotes}}</dd>
        </dl>--}}
        {{-- <br clear="all"/>
         <hr size="1" color="#CCCCCC"/>--}}
        <h4 class="clearfix">Logistics Requirements</h4>

        <p>a.
            Accommodations:&nbsp; Are there any nearby hotels that you'd recommend for our trainer?
        </p>

        <p>b.
            Corporate Rates:&nbsp; Do you have a corporate rate at this hotel that you would like the
            trainer to use?
        </p>

        <p>c.
            Airport Transportation:&nbsp; Would you prefer your trainer uses a taxi or is there another
            method you would rather have him use to travel from the airport to the hotel/venue?
        </p>

        <p><strong>Confirm Location:</strong>&nbsp;{{$booking->location_name}}</p>
        {{--  <hr>

         <h3 class="clearfix">Alternate Location</h3>

         <dt>Location Name:&nbsp;</dt>

         <dt>Address:&nbsp;</dt>

         <dt>City:&nbsp;</dt>

         <dt>Zip Code:&nbsp;</dt>

         <dt>Country:&nbsp;</dt>

         <hr>
         <h3 class="clearfix">Workshop Time: Please confirm that start time and end time below.</h3>
         <hr>

         <h3 class="clearfix">Site Contact: Please provide an onsite contact for the day of the event. The
             instructor will need access to the building/room at least 1 hour prior to the start time</h3>


         <dt>First Name:&nbsp;</dt>
         <dt>Last Name:&nbsp;</dt>
         <dt>Phone Number:&nbsp;</dt>
         <dt>Email Address:&nbsp;</dt>

         <hr>
         <h3 class="clearfix">Room Set up: Please confirm the following will be available in the training
             facility:</h3>


         <dt>Projector w/speakers or a TV so that we can plug our camera in for video playback (regular red,
             white and yellow RCA jack inputs).:&nbsp;<span>No</span></dt>

         <dt>Preferably the room is setup in U-Shaped configuration (Boardroom set up is the least
             desirable). However, most set-ups are fine as long as there is room for everyone to move!:&nbsp;<span>No</span>
         </dt>

         <dt>The room will need to be set up so that participants have room to stand up, stretch out and move
             around:&nbsp;<span>No</span></dt>

         <hr>
         <h3 class="clearfix">
             Shipping Information: We will be shipping the workshop materials to you prior to the workshop.
             Please provide a ship to address for materials. We ask that you do not hand out either ahead of
             time. Instead have them ready for our instructor the first morning.
         </h3>

         <hr>
         <h3 class="clearfix">For each full day of training will lunch be provided?</h3>
         <dt>No</dt>

         <h3 class="clearfix">If not, please recommend some restaurants either in or close to building for
             the trainer to get a quick lunch.</h3>
         <dt>No</dt>
         <hr>
         <h3>General Notes</h3>
         <dt>{{$booking->generalnote}}</dt>
         <hr>
         @if(count($booking->bookingTrainers) > 0)
             <h3 class='clearfix'>Trainer Details</h3>
             @foreach($booking->bookingTrainers as $bookingTrainer)
                 @if( $bookingTrainer->user != null)
                     <div class="row">
                         <div class="col-xs-12"><h3 class="train">{{ $bookingTrainer->user->full_name }}</h3>
                         </div>
                         <div class='col-md-6'>
                             <dl>
                                 <dt>Hotel Booked?&nbsp;@if($bookingTrainer->hotel_book)<span>Yes</span>@else
                                         <span>No</span>@endif</dt>
                                 <br clear="all"/>
                                 <dt>Hotel Info:</dt>
                                 <dt>Hotel Name:&nbsp;{{ $bookingTrainer->hotel_name }}</dt>
                                 <dt>Hotel Address:&nbsp;{{ $bookingTrainer->hotel_address }}</dt>
                             </dl>
                         </div>
                         <div class="col-md-6">
                             <dl>
                                 <dt>Flight Info:&nbsp;{{ $bookingTrainer->flight_info }}</dt>

                                 <dt>Car Rental Needed?&nbsp;@if($bookingTrainer->car_rental)
                                         <span>Yes</span>@else<span>No</span>@endif</dt>

                                 <dt>Car Rental Booked?&nbsp;@if($bookingTrainer->car_rental_book)
                                         <span>Yes</span>@else<span>No</span>@endif</dt>
                             </dl>
                         </div>
                     </div>
                 @endif
             @endforeach
         @endif--}}
    </div>
    <div class="modal-footer">
        <button id="print-booking">Print</button>
        <button data-dismiss="modal">Close</button>
    </div>
</div>
</div>
</div>
</div>