<div class="row">
    <h2 data-toggle="collapse" data-parent="#booking-sheets" data-target="#sec-client">Client
        Information</h2>
    @if ($errors->has('company'))
        <span class="help-block alert-danger">
            <strong>{{ $errors->first('company') }}</strong>
        </span>
    @endif
    <div id="sec-client" class="collapse">
        <div class="form-group col-xs-12 col-sm-6 {{ $errors->has('company') ? ' has-error' : ''}}">
            {!! Form::label('company', 'Company *') !!}
            {!! Form::text('company', $booking->company,
            ['class' => 'form-control', 'placeholder' => 'Company']) !!}
        </div>

        <div class="form-group col-xs-12 col-sm-6">
            {!! Form::label('company_website', 'Company website') !!}
            {!! Form::text('company_website', $booking->company_website,
            ['class' => 'form-control', 'placeholder' => 'Company website']) !!}
        </div>

        <div class="form-group col-xs-12 col-sm-6">
            {!! Form::label('company_contact', 'Company contact') !!}
            {!! Form::text('company_contact', $booking->company_contact,
            ['class' => 'form-control', 'placeholder' => 'Company contact']) !!}
        </div>

        <div class="form-group col-xs-12 col-sm-6">
            {!! Form::label('client_phone', 'Client phone') !!}
            {!! Form::text('client_phone', $booking->client_phone,
            ['class' => 'form-control', 'placeholder' => 'Client phone']) !!}
        </div>

        <div class="form-group col-xs-12 col-sm-6">
            {!! Form::label('client_email', 'Client email') !!}
            {!! Form::text('client_email', $booking->client_email,
            ['class' => 'form-control', 'placeholder' => 'Client email']) !!}
        </div>

        <div class="form-group col-xs-12">
            {!! Form::label('details', 'Description/Notes') !!}
            {!! Form::textarea('details', $booking->details,
            ['class' => 'form-control', 'placeholder' => 'Description/Notes', 'size' => '30x3']) !!}
        </div>
    </div>
</div>