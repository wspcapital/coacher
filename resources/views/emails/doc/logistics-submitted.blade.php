<div class="modal fade" id="logistics-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" id="modal-logistic">
        <div class="modal-content">
            <div class="modal-body">

                <div class="container pad-top">
                    <h2>Logistics Request for {{$booking->company}}</h2>
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                    @endif
                    <p>Pinnacle Performance Company Workshop Logistics Request</p>WORKSHOP: {{$booking->title}}
                    <br>DATES: {{$booking->start_date}} - {{$booking->end_date}}
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
                        @if($trainer->user != null)
                            <div>
                                <a data-toggle="collapse"
                                   data-target="#trainer-{{$trainer->user_id}}">{{$trainer->user->full_name}}</a>

                                <div id="trainer-{{$trainer->user->id}}" class="collapse">
                                    <div class="clearfix">
                                        {{--$trainer->user->thumbnail(['resize'=>'w[100]h[100]e[true]','class'=>'pull-left pad-right'])--}}
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
                        Individual Needs Analysis for each participant prior to the workshop and to create their
                        personal
                        Pinnacle Green Room accounts. The Pinnacle Green Room is our online portal to access videos,
                        reports
                        and our library of tools, tips and techniques.</p>
                    <div>
                        <table class="table table-striped">
                            @foreach($booking->bookingParticipants as $participant)
                                <tr>
                                    <td class="col-md-3">
                                        {{ $participant->user->first_name }}
                                    </td>
                                    <td class="col-md-3">
                                        {{ $participant->user->last_name }}
                                    </td>
                                    <td class="col-md-5">
                                        {{ $participant->user->email }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <hr>
                    <p><strong>Hotel and Travel Recommendations</strong></p>

                    <p>a. <strong>Accommodations:</strong> Are there any nearby hotels that you'd recommend for our
                        trainer?</p>
                    @if(!empty($booking->accommodations))<strong>{{ $booking->accommodations }}</strong>@endif

                    <p>b.
                        <strong>Corporate Rates:</strong> Do you have a corporate rate at this hotel that you would like
                        the
                        trainer to use?
                    </p>
                    @if(!empty($booking->corporate_rate))<strong>{{ $booking->corporate_rate }}</strong>@endif

                    <p>
                        c.
                        <strong>Airport Transportation:</strong> Would you prefer your trainer uses a taxi or is there
                        another method you would rather have him use to travel from the airport to the hotel/venue?
                    </p>
                    @if(!empty($booking->transfer))<strong>{{ $booking->transfer }}</strong>@endif
                    <hr>
                    <p>
                        <strong>Address of Workshop Location: Please provide the address where the training will be
                            held.
                            Including room numbers and any security details your trainer should know.</strong>
                    </p>
                    <p>
                        <strong>Confirm Location:</strong>
                        @if(isset($booking->data()->logistics->booklocation) && $booking->data()->logistics->booklocation === '1')
                            <strong><i class="text-green fa fa-check" aria-hidden="true"></i></strong>
                        @else
                            <strong><i class="fa fa-times text-danger" aria-hidden="true"></i></strong>
                        @endif
                    </p>
                    {{-- <p>{{ $booking->location_name }}:

                     </p>
                     <p>{{ $booking->booklocation }}: </p>--}}
                    <p><strong>Location</strong>
                    </p>

                    <p>Location Name: <strong>{{ $booking->location_name }}</strong></p>
                    <p>Location Address: <strong>{{ $booking->location_address }}</strong></p>
                    <p>City: <strong>{{ $booking->location_city }}</strong></p>

                    @if($booking->location_country == 184)
                        <p>State: <strong>{{ empty($state[$booking->location_state]) ? '' : $state[$booking->location_state] }}</strong></p>
                    @else
                        <p>Provence: <strong>{{ $booking->location_state }}</strong></p>
                    @endif
                    <p>Zip Code: <strong>{{ $booking->location_zip }}</strong></p>
                    <p>Country: <strong>{{ empty($country[$booking->location_country]) ? '' : $country[$booking->location_country] }}</strong></p>

                    <div class="row">
                        <div class="col-md-6">
                            <p>Start Date <strong>{{ $booking->start_date }}</strong></p>
                        </div>
                        <div class="col-md-6">
                            <p>End Date <strong>{{ $booking->end_date }}</strong></p>
                        </div>
                    </div>

                    <hr>
                    <p>
                        <strong>Site Contact: Please provide an onsite contact for the day of the event. The instructor
                            will
                            need access to the building/room at least 1 hour prior to the start time</strong>
                    </p>

                    <div class="row">
                        <div class="col-sm-3">
                            {{ $booking->site_contact_fname }}
                        </div>
                        <div class="col-sm-3">
                            {{ $booking->site_contact_lname }}
                        </div>
                        <div class="col-sm-3">
                            {{ $booking->site_contact_phone }}
                        </div>
                        <div class="col-sm-3">
                            {{ $booking->site_contact_email }}
                        </div>
                    </div>
                    <hr>
                    <p><strong>Room Set up: Please confirm the following will be available in the training
                            facility:</strong></p>

                    <p>Projector w/speakers or a TV so that we can plug our camera in for video playback (regular red,
                        white and yellow RCA jack inputs).
                        @if(isset($booking->data()->logistics->projector) && $booking->data()->logistics->projector === '1')
                            <i class="text-green fa fa-check" aria-hidden="true"></i>
                        @else
                            <strong><i class="fa fa-times text-danger" aria-hidden="true"></i></strong>@endif</p>


                    @if(isset($booking->data()->logistics->board) && $booking->data()->logistics->board === '0')
                        <p>
                            Whiteboard<strong><i class="text-green fa fa-check" aria-hidden="true"></i></strong>
                            &nbsp;Flipchart<strong><i class="fa fa-times text-danger" aria-hidden="true"></i></strong>
                        </p>
                    @elseif(isset($booking->data()->logistics->board) && $booking->data()->logistics->board === '1')
                        <p>
                            Whiteboard<strong><i class="fa fa-times text-danger" aria-hidden="true"></i></strong>
                            &nbsp;Flipchart<strong><i class="text-green fa fa-check" aria-hidden="true"></i></strong>
                        </p>
                    @else
                        <p>Whiteboard<strong>&nbsp;</strong>Flipchart<strong>&nbsp;</strong></p>
                    @endif

                    <p>Preferably the room is setup in U-Shaped configuration (Boardroom set up is the least desirable).
                        However, most set-ups are fine as long as there is room for everyone to move!
                        @if(isset($booking->data()->logistics->ushape) && $booking->data()->logistics->ushape === '1')
                            <strong><i class="text-green fa fa-check" aria-hidden="true"></i></strong>
                        @else
                            <strong><i class="fa fa-times text-danger" aria-hidden="true"></i></strong>
                        @endif
                    </p>


                    <p>The room will need to be set up so that participants have room to stand up, stretch out and move
                        around
                        @if(isset($booking->data()->logistics->stretchroom) && $booking->data()->logistics->stretchroom === '1')
                            <strong><i class="text-green fa fa-check" aria-hidden="true"></i></strong>
                        @else
                            <strong><i class="fa fa-times text-danger" aria-hidden="true"></i></strong>
                        @endif</p>
                    <hr>

                    <p>
                        <strong>Shipping Information: We will be shipping the workshop materials to you prior to the
                            workshop. Please provide a ship to address for materials. We ask that you do not hand out
                            either
                            ahead of time. Instead have them ready for our instructor the first morning.</strong>
                    </p>{{ $booking->shipping }}
                    <hr>
                    <p>For each full day of training will lunch be provided?
                        @if(isset($booking->data()->logistics->lunch) && $booking->data()->logistics->lunch === '1')
                            <strong><i class="text-green fa fa-check" aria-hidden="true"></i></strong>
                        @elseif(isset($booking->data()->logistics->lunch) && $booking->data()->logistics->lunch === '0')
                            <strong><i class="fa fa-times text-danger" aria-hidden="true"></i></strong>
                        @else
                            <strong></strong>
                        @endif
                    </p>

                    <p>If not, please recommend some restaurants either in or close to building for the trainer to get a
                        quick lunch.</p>
                    </p>{{ $booking->restaurants }}
                    <hr>
                    <p>General Notes</p>
                    {{ $booking->generalnote }}
                    <p>Thanks so much for taking the time to complete all of the information. The more thorough the
                        information the smoother the event will go for everyone.</p>
                </div>

            </div>
        </div>
    </div>
</div>
