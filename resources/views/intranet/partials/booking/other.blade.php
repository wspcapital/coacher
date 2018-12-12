<div class="row">
    <h2 data-toggle="collapse" data-parent="#booking-sheets" data-target="#sec-other">Travel Details</h2>
    <div id="sec-other" class="collapse">
        <div class="element-group">
            <div class="form-group">
                <strong>Ready to book travel</strong>
                {!! Form::checkbox('readybook', '1', $booking->readybook) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('event_hotels', 'Hotel Recommendations') !!}
            {!! Form::textarea('event_hotels', $booking->event_hotels,
            ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('travelnotes','Travel Notes') !!}
            {!! Form::textarea('travelnotes', $booking->travelnotes,
            ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('accommodations','a. Accommodations (Client visible)') !!}
            {!! Form::textarea('accommodations', $booking->accommodations,
            ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('corporate_rate', 'b. Corporate Rates (Client visible)') !!}
            {!! Form::text('corporate_rate', $booking->corporate_rate,
            ['class' => 'form-control', 'placeholder' => 'Tracking Number']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('transfer','c. Airport Transportation (Client visible)') !!}
            {!! Form::textarea('transfer', $booking->transfer,
            ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
        </div>

        <div class="element-group">
            <h5>Expenses</h5>
            <div class="checkbox-inline">
                <strong>Per Diem</strong>
                {!! Form::radio('expenses', '0', !$booking->expenses) !!}
            </div>
            <div class="checkbox-inline">
                <strong>Receipts</strong>
                {!! Form::radio('expenses', '1', $booking->expenses) !!}
            </div>
            <div class="checkbox-inline">
                <strong>Expenses Complete</strong>
                {!! Form::checkbox('expenses_complete', '1', $booking->expenses_complete) !!}
            </div>
        </div>
        <div class="element-group">
            <h5>Workshop materials</h5>
            <div class="checkbox-inline">
                <strong>To be shipped to client</strong>
                {!! Form::radio('materials', '0', empty($booking->materials) || !$booking->materials ? true : false) !!}
            </div>
            <div class="checkbox-inline">
                <strong>To be hand-carried by trainer</strong>
                {!! Form::radio('materials', '1', $booking->materials == 1) !!}
            </div>
        </div>
    </div>
</div>