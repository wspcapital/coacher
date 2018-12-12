<div class="row">
    <div class="col-xs-12">
        <div class="form-group col-xs-6">
            {!! Form::label('start_time', 'Start Time') !!}
            {!! Form::text('start_time', '',
            ['class' => 'form-control', 'id' => 'start_time', 'placeholder' => 'Start time']) !!}
        </div>
        <div class="form-group col-xs-6">
            {!! Form::label('end_time', 'End Time') !!}
            {!! Form::text('end_time', '',
            ['class' => 'form-control', 'id' => 'end_time', 'placeholder' => 'End time']) !!}
        </div>
        {!! Form::hidden('current_day', '', ['id' => 'current_day']) !!}
    </div>
    <h2 id="curriculum-render" data-toggle="collapse" data-parent="#curriculum" data-target="#curriculum">
        Curriculum</h2>
    <div id="curriculum">
        @if(Session::has('error_curriculum'))
            <div class="alert alert-danger">
                {{Session::get('error_curriculum')}}
            </div>
        @endif
        <div class="col-xs-12">
            <div class="col-xs-2">
                <a href="#" id="days-map-modal" class="btn  btn-primary ">
                    Day Map
                </a>
            </div>

            <div class="col-xs-2">
                <a href="#" id="days-details-modal" class="btn  btn-primary ">
                    Details
                </a>
            </div>
        </div>
        <div class="col-xs-8">
            <div id="calendar"></div>
        </div>
        <div class="col-xs-4">
            <input type="hidden" id="curriculum-start-day" value="{{$curriculum['startDate']}}">
            <input type="hidden" id="curriculum-end-day" value="{{$curriculum['endDate']}}">
            <div id="external-events">
                <ul class="list-group">
                    @foreach($lessons as $lesson)
                        <li class="list-group-item fc-event">
                            <span class="badge duration">{{ $lesson->time }}
                                <small>minutes</small>
                            </span>
                            <div class="event-title">
                                {{ $lesson->title }}
                            </div>
                            <div class="hidden subtitle">
                                {{$lesson->subtitle}}
                            </div>
                            <input type="hidden" id="lessonId" value="{{$lesson->id}}">
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@include('intranet.partials.booking.print-days-map')
@include('intranet.partials.booking.print-details')