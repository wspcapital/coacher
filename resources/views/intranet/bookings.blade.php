@extends('intranet.template.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('/assets/dist/css/intranet/bookings.min.css')}}">
@endsection

@section('main-content')

    <div class="container-fluid" id="app-bookings">

        <div class="container-fluid">
            {!! Form::open(['route' => 'intranet', 'class' => 'form-inline pull-right' ,'method' => 'post', 'id' => 'bookingsSearchForm']) !!}
            {!! Form::token() !!}
            <div class="form-group ">
                {!! Form::select('rm', $rm, !empty($term_request['rm']) ? $term_request['rm'] : '', ['placeholder' => 'Search By RM...', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::select('trainer', $trainers, !empty($term_request['trainer']) ? $term_request['trainer'] : '', ['placeholder' => 'Search By Trainer...', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::text('search_bookings', !empty($term_request['search_bookings']) ? $term_request['search_bookings'] : '',
                            ['placeholder' => 'Search Bookings', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::text('search_students', !empty($term_request['search_students']) ? $term_request['search_students'] : '',
                            ['placeholder' => 'Search Students', 'class' => 'form-control']) !!}
            </div>
            {!! Form::submit('Submit Query', ['class' => 'btn btn-primary pull-right small user-save']) !!}
            {!! Form::close() !!}
        </div>

        @foreach($bookings as $month => $data)
            <div class="row">
                <h3 data-toggle="collapse" data-parent="#booking-sheets"
                    data-target="#sec-{{$month}}">{{date('M Y',strtotime('1-'.substr($month,2,2).'-20'.substr($month,0,2)))}}</h3>
                <div id="sec-{{$month}}" class="collapse">
                    @foreach($data as $key => $booking)

                        <div class="row">
                            <table class="table">
                                <tr>
                                    <td class="main-td">
                                        <a href="/intranet/booking/{{$booking->id}}">{{$booking->company}}</a><br />
                                        <strong>City:</strong> {{$booking->location_city}}
                                        @if(count($booking->rm))
                                            <br><strong>RM:</strong> {{$booking->rm->full_name}}
                                        @endif
                                        <br/><strong>Custom Workbook: </strong> @if($booking->customwb) Yes @else No @endif
                                        <br/><strong>Trainers: </strong>
                                        @if($booking->bookingTrainers->count())
                                            @foreach($booking->bookingTrainers as $trainer)
                                                @if($trainer->user)
                                                    {{ $trainer->user->full_name }}
                                                    @if ($trainer->car_rental_book)
                                                        <img src="{{asset('/assets/dist/img/intranet/calendar/carbook.png')}}">
                                                    @endif
                                                    @if ($trainer->flight_book)
                                                        <img src="{{asset('/assets/dist/img/intranet/calendar/airplane.png')}}">
                                                    @endif
                                                    @if ($trainer->hotel_book)
                                                        <img src="{{ asset('/assets/dist/img/intranet/calendar/hotel.png') }}">
                                                    @endif
                                                    ,
                                                @endif
                                            @endforeach
                                        @endif
                                        <br><strong>Books Sent:</strong> {{$booking->data('bookssent') ? 'Yes':'No'}}
                                        <br><strong>Tracking Number:</strong> {{$booking->pdptrack}}
                                    </td>
                                    <td>
                                        {{$booking->title}}
                                    </td>
                                    <td>
                                        {{$booking->location_city}}
                                    </td>
                                    <td class="td-date">
                                        {{$booking->start_date->format('m/d/y')}}
                                    </td>
                                </tr>
                            </table>
                           {{-- <div class="col-xs-3"><a href="/intranet/booking/{{$booking->id}}">{{$booking->company}}</a>
                            </div>
                            <div class="col-xs-5">{{$booking->title}}</div>
                            <div class="col-xs-2">{{$booking->location_city}}</div>
                            <div class="col-xs-2"> {{$booking->start_date->format('m/d/y')}}</div>
                            <div class="col-xs-12">
                                <strong>City:</strong> {{$booking->location_city}}
                                @if(count($booking->rm))
                                    <br><strong>RM:</strong> {{$booking->rm->full_name}}
                                @endif
                                <br/><strong>Custom Workbook: </strong> @if($booking->customwb) Yes @else No @endif
                                <br/><strong>Trainers: </strong>
                                @if($booking->bookingTrainers->count())
                                    @foreach($booking->bookingTrainers as $trainer)
                                        @if($trainer->user)
                                            {{ $trainer->user->full_name }}
                                            @if ($trainer->car_rental_book)
                                                <img src="{{asset('/assets/dist/img/intranet/calendar/carbook.png')}}">
                                            @endif
                                            @if ($trainer->flight_book)
                                                <img src="{{asset('/assets/dist/img/intranet/calendar/airplane.png')}}">
                                            @endif
                                            @if ($trainer->hotel_book)
                                                <img src="{{ asset('/assets/dist/img/intranet/calendar/hotel.png') }}">
                                            @endif
                                            ,
                                        @endif
                                    @endforeach
                                @endif
                                <br><strong>Books Sent:</strong> {{$booking->data('bookssent') ? 'Yes':'No'}}
                                <br><strong>Tracking Number:</strong> {{$booking->pdptrack}}
                            </div>--}}
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    </div>
    </div>

@endsection
