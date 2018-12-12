<div class="row" id="logistics">
    <h2 data-toggle="collapse" data-parent="#booking-sheets" data-target="#sec-logistics">
        Logistics</h2>
    @if ($errors->has('part'))
        <span class="help-block alert-danger">
            <strong>{{ $errors->first('part') }}</strong>
        </span>
    @endif
    <div id="sec-logistics" class="collapse">
        <div class="element-group">
            <div class="row">
                <div class="form-group col-xs-12 col-sm-4">
                    <strong>DDP Required</strong>
                    {!! Form::checkbox('preport', '1', !empty($booking->preport) ? $booking->preport : true) !!}
                </div>
                <div class="form-group col-xs-12 col-sm-4">
                    <strong>CAP Required</strong>
                    {!! Form::checkbox('cap_required', '1', $booking->cap_required) !!}
                </div>
                <div class="form-group col-xs-12 col-sm-4">
                    <strong>GNA Sent</strong>
                    {!! Form::checkbox('gna', '1', $booking->gna) !!}
                </div>
                <div class="form-group col-xs-12 col-sm-4">
                    <strong>Pinnacle Workshop Evaluations</strong>
                    {!! Form::checkbox('evaluation', '1', $booking->evaluation) !!}
                </div>
                <div class="form-group col-xs-12 col-sm-4">
                    <strong>Custom workbook needed</strong>
                    {!! Form::checkbox('customwb', '1', $booking->customwb) !!}
                </div>
                <div class="form-group col-xs-12 col-sm-4">
                    <strong>Include PDP</strong>
                    {!! Form::checkbox('pdp', '1', !empty($booking->pdp) ? $booking->pdp : true) !!}
                </div>
            </div>
        </div>
        <div class="row button-block">
            <button type="button" class="btn btn-primary" @click = "sendLogistics"><span>
            @if($booking->share_hash) ReSend Logistics @else Request Logistics @endif
        </span></button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#logistics-modal"><span>
            View Logistics
        </span></button>
            <button type="button" class="btn btn-primary" @click = "sendBooks"><span>
            @if(!empty($booking->data->bookssent)) ReSend Books @else Send Books @endif
        </span></button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#logisticsLinkModal"><span>
            View Logistics link
        </span></button>
        </div>
        <div class="form-group col-xs-12 col-sm-6">
            {!! Form::label('workbook', 'Workbook') !!}
            {!! Form::text('workbook', $booking->workbook,
            ['class' => 'form-control', 'placeholder' => 'Workbook']) !!}
        </div>

        <div class="form-group col-xs-12 col-sm-6 {{ $errors->has('part') ? ' has-error' : ''}}">
            {!! Form::label('part', 'Number of Participants') !!}
            {!! Form::text('part', $booking->part,
            ['class' => 'form-control', 'placeholder' => 'Number of Participants']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('pdpship', 'Shipping Information') !!}
            {!! Form::textarea('pdpship', $booking->pdpship,
            ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('noteship', 'Shipping Information (Client visible)') !!}
            {!! Form::textarea('noteship', $booking->noteship,
            ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('pdptrack', 'Tracking Number') !!}
            {!! Form::text('pdptrack', $booking->pdptrack,
            ['class' => 'form-control', 'placeholder' => 'Tracking Number']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('generalnote', 'General Notes (Client visible)') !!}
            {!! Form::textarea('generalnote', $booking->generalnote,
            ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
        </div>
    </div>
</div>
@include('intranet.partials.booking.logistics-modal')
@include('intranet.partials.booking.logistics-link-modal')