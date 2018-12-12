<div class="modal fade" data-show="true" id="schedule-modal" tabindex="-1"
     role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                {!! Form::open(['route' => 'addSession', 'method' => 'post', 'id' => 'sessionForm'])  !!}
                {!! Form::token() !!}
                <div v-show="step == 1" class="hidden">
                    <h2>REQUEST FORM SUBMITTED SUCCESSFULLY</h2>
                    WE'LL GET RIGHT BACK TO YOU
                </div>
                <div v-show="step == 0">
                    <h2>Coaching Session Request</h2>
                    <div class="form-group">
                        {!! Form::checkbox('workshop', '1') !!}
                        Check here if you attended a live Pinnacle Workshop
                    </div>
                    <div class="form-group">
                        {!! Form::label('free', 'I am free') !!}
                        {!! Form::select('free', ['this week' => 'this week',
                                                  'next week' => 'next week',
                                                  'week after next week' => 'week after next week'],
                                                  '', ['class'=>'form-control'] )!!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('time', 'Time') !!}
                        {!! Form::select('time', ['7:00 AM - Noon' => '7:00 AM - Noon',
                                                  'Noon - 6:00 PM' => 'Noon - 6:00 PM',
                                                  '6:00 PM - 10:00 PM' => '6:00 PM - 10:00 PM'],
                         '', ['class'=>'form-control'] )!!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('timezone', 'My timezone') !!}
                        {!! Form::select('timezone', $timezone, config('app.timezone'),
                              ['placeholder' => 'Pick a Time zone...', 'class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('skednotes', 'Scheduling Notes') !!}
                        {!! Form::textarea('skednotes', '',
                        ['class' => 'form-control', 'size' => '30x3']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('functionality', 'Session Topic') !!}
                        <select name="functionality" id="functionality" class="form-control">
                            @foreach($lessons as $lesson)
                                <option value="{{ $lesson->title }}"> {{ $lesson->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        {!! Form::label('clarification', 'Describe the audience that presents the greatest challenge.') !!}
                        {!! Form::textarea('clarification', '',
                        ['class' => 'form-control', 'size' => '30x3']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('situation', 'What delivery skills do you want to improve most?') !!}
                        {!! Form::textarea('situation', '',
                        ['class' => 'form-control', 'size' => '30x3']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('relevant', 'Please provide any other details you want to share prior to your coaching session.') !!}
                        {!! Form::textarea('relevant', '',
                        ['class' => 'form-control', 'size' => '30x3']) !!}
                    </div>
                    <div class="form-group">
                        <div class="alert alert-danger" id="error-term">
                            <strong>Error!</strong> The terms field is required..
                        </div>
                        {!! Form::checkbox('terms', '1', false, ['required' => 'true', 'id' => 'term']) !!}
                        I agree to the terms: Any cancellation within 48 hours of the Virtual Coach session date
                        scheduled will
                        result in cancellation of the order. A new Virtual Coach package will need to be purchased in
                        order to
                        receive Virtual Coaching services.
                    </div>
                    <div class="clearfix">
                        <button type="button" id="close-modal" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right btn-lg']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
