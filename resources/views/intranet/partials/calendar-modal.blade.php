<div class="form-group col-xs-12">
    <span class="label">Client:</span>
    <span class="value"> {{ $booking->booker->full_name }} </span>
</div>
<div class="form-group col-xs-12">
    <span class="label">Booking Type:</span>
    <span class="value"> {{ $booking->type }} </span>
</div>
<div class="form-group col-xs-12">
    <span class="label">Workshop City:</span>
    <span class="value"> {{ $booking->location_city }} </span>
</div>

<div class="form-group col-xs-12">
    <div class="col-xs-12 col-sm-6">
        <span class="label">Start Date:</span>
        <span class="value">{{ $booking->start_date->format('d/m/Y') }}</span>
    </div>
    <div class="col-xs-12 col-sm-6">
        <span class="label">End Date:</span>
        <span class="value">{{ $booking->end_date->format('d/m/Y') }}</span>
    </div>
</div>

<div class="form-group col-xs-12">
    <span class="label">Relationship Manager:</span>
    <span class="value">
        @if($booking->rm_user_id)
            {{ $booking->rm->full_name}}
        @endif
    </span>
</div>
<div class="form-group col-xs-12">
    <span class="label">Trainer(s):</span>
    <span class="value">
    @if($booking->bookingTrainers->count() != 0)
            @foreach($booking->bookingTrainers as $trainer)
                {{ $trainer->user->full_name }},
            @endforeach
        @endif
    </span>
</div>
<div class="form-group col-xs-12">
    <span class="label">Workbook:</span>
    <span class="value"></span>
</div>
<div class="form-group col-xs-12">
    <span class="label">Tracking #:</span>
    <span class="value">{{ $booking-> pdptrack}}</span>
</div>
<div class="form-group col-xs-12">
    <span class="label">Booking Number:</span>
    <span class="value"> {{ $booking->id }} </span>
</div>
<div class="col-xs-12">
    <a href="{{ asset('intranet/booking/'.$booking->id) }}">
        <button class="btn btn-info">Open Booking Sheet</button>
    </a>
</div>
