@extends('docs.template.app')
@section('main-content')
    <div class="container pad-top">
        <h2>@lang('doc/ina.form_title', ['name' => e($p->user->full_name)])</h2>

        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
        <div class="form-group">
            <b>@lang('doc/ina.ina_user_name'): {{ $p->user->full_name }} </b>
        </div>
        @if(isset($p->user->title))
            <div class="form-group">
                <b>@lang('doc/ina.ina_user_title'): {{$p->user->title}}</b>
            </div>
        @endif
        @if(isset($p->user->position))
            <div class="form-group">
                <b>@lang('doc/ina.ina_user_position'): {{$p->user->position}}</b>
            </div>
        @endif
        @if(isset($p->user->company))
            <div class="form-group">
                <b>@lang('doc/ina.ina_user_company'): {{$p->user->company}}</b>
            </div>
        @endif

        {!! Form::open(['url' => '/docs/ina/'.$p->share_hash, 'method' => 'post', 'id' => 'inaForm']) !!}
        {!! Form::text('status', 'received',['hidden' => true]) !!}

        <h4>@lang('doc/ina.question_role_duties')</h4>
        <div class="container pad-bottom">
            {!! Form::label('client_role_duts', trans('doc/ina.field_role')) !!}
            {!! Form::textarea('client_role_duts', !empty($p->data->ina->client_role_duts) ? $p->data->ina->client_role_duts : '',
            ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
        </div>

        <h4>@lang('doc/ina.question_audiens')</h4>
        <div class="container pad-bottom">
            <div class="col-xs-6">
                <div class="form-group">
                    {!! Form::checkbox('audiens_senior', '1', (!empty($p->data->ina->audiens_senior) && $p->data->ina->audiens_senior == '1') ) !!}
                    {!! Form::label('audiens_senior', trans('doc/ina.field_audiens_senior')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('audiens_team', '1', (!empty($p->data->ina->audiens_team) && $p->data->ina->audiens_team == '1') ) !!}
                    {!! Form::label('audiens_team', trans('doc/ina.field_audiens_team')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('audiens_clients', '1', (!empty($p->data->ina->audiens_clients) && $p->data->ina->audiens_clients == '1') ) !!}
                    {!! Form::label('audiens_clients', trans('doc/ina.field_audiens_clients')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('audiens_stakeholders', '1', (!empty($p->data->ina->audiens_stakeholders) && $p->data->ina->audiens_stakeholders == '1') ) !!}
                    {!! Form::label('audiens_stakeholders', trans('doc/ina.field_audiens_stakeholders')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('audiens_peers', '1', (!empty($p->data->ina->audiens_peers) && $p->data->ina->audiens_peers == '1') ) !!}
                    {!! Form::label('audiens_peers', trans('doc/ina.field_audiens_peers')) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('audiens_other', trans('doc/ina.field_other')) !!}
                    {!! Form::textarea('audiens_other', !empty($p->data->ina->audiens_other) ? $p->data->ina->audiens_other : '',
                    ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    {!! Form::checkbox('audiens_subordinates', '1', (!empty($p->data->ina->audiens_subordinates) && $p->data->ina->audiens_subordinates == '1') ) !!}
                    {!! Form::label('audiens_subordinates', trans('doc/ina.field_audiens_subordinates')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('audiens_media', '1', (!empty($p->data->ina->audiens_media) && $p->data->ina->audiens_media == '1') ) !!}
                    {!! Form::label('audiens_media', trans('doc/ina.field_audiens_media')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('audiens_community', '1', (!empty($p->data->ina->audiens_community) && $p->data->ina->audiens_community == '1') ) !!}
                    {!! Form::label('audiens_community', trans('doc/ina.field_audiens_community')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('audiens_students', '1', (!empty($p->data->ina->audiens_students) && $p->data->ina->audiens_students == '1') ) !!}
                    {!! Form::label('audiens_students', trans('doc/ina.field_audiens_students')) !!}
                </div>
            </div>
        </div>

        <h4>@lang('doc/ina.question_skills')</h4>
        <div class="container pad-bottom">
            <div class="col-xs-6">
                <div class="form-group">
                    {!! Form::checkbox('skills_nervos', '1', (!empty($p->data->ina->skills_nervos) && $p->data->ina->skills_nervos == '1') ) !!}
                    {!! Form::label('skills_nervos', trans('doc/ina.field_skills_nervos')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('skills_off_track', '1', (!empty($p->data->ina->skills_off_track) && $p->data->ina->skills_off_track == '1') ) !!}
                    {!! Form::label('skills_off_track', trans('doc/ina.field_skills_off_track')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('skills_enthusiasm', '1', (!empty($p->data->ina->skills_enthusiasm) && $p->data->ina->skills_enthusiasm == '1') ) !!}
                    {!! Form::label('skills_enthusiasm', trans('doc/ina.field_skills_enthusiasm')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('skills_is_not_clear', '1', (!empty($p->data->ina->skills_is_not_clear) && $p->data->ina->skills_is_not_clear == '1') ) !!}
                    {!! Form::label('skills_is_not_clear', trans('doc/ina.field_skills_is_not_clear')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('skills_intimidating', '1', (!empty($p->data->ina->skills_intimidating) && $p->data->ina->skills_intimidating == '1') ) !!}
                    {!! Form::label('skills_intimidating', trans('doc/ina.field_skills_intimidating')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('skills_confidence', '1', (!empty($p->data->ina->skills_confidence) && $p->data->ina->skills_confidence == '1') ) !!}
                    {!! Form::label('skills_confidence', trans('doc/ina.field_skills_confidence')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('skills_concise', '1', (!empty($p->data->ina->skills_concise) && $p->data->ina->skills_concise == '1') ) !!}
                    {!! Form::label('skills_concise', trans('doc/ina.field_skills_concise')) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('skills_other', trans('doc/ina.field_other')) !!}
                    {!! Form::textarea('skills_other', isset($p->data->ina->skills_other) ? $p->data->ina->skills_other : '',
                    ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    {!! Form::checkbox('skills_compelling', '1', (!empty($p->data->ina->skills_compelling) && $p->data->ina->skills_compelling == '1') ) !!}
                    {!! Form::label('skills_compelling', trans('doc/ina.field_skills_compelling')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('skills_too_fast', '1', (!empty($p->data->ina->skills_too_fast) && $p->data->ina->skills_too_fast == '1') ) !!}
                    {!! Form::label('skills_too_fast', trans('doc/ina.field_skills_too_fast')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('skills_monotone', '1', (!empty($p->data->ina->skills_monotone) && $p->data->ina->skills_monotone == '1') ) !!}
                    {!! Form::label('skills_monotone', trans('doc/ina.field_skills_monotone')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('skills_viruses', '1', (!empty($p->data->ina->skills_viruses) && $p->data->ina->skills_viruses == '1') ) !!}
                    {!! Form::label('skills_viruses', trans('doc/ina.field_skills_viruses')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('skills_questions', '1', (!empty($p->data->ina->skills_questions) && $p->data->ina->skills_questions == '1') ) !!}
                    {!! Form::label('skills_questions', trans('doc/ina.field_skills_questions')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('skills_language', '1', (!empty($p->data->ina->skills_language) && $p->data->ina->skills_language == '1') ) !!}
                    {!! Form::label('skills_language', trans('doc/ina.field_skills_language')) !!}
                </div>
            </div>

        </div>

        <h4>@lang('doc/ina.question_message')</h4>
        <div class="container pad-bottom">
            <div class="col-xs-6">
                <div class="form-group">
                    {!! Form::checkbox('message_presentations', '1', (!empty($p->data->ina->message_presentations) && $p->data->ina->message_presentations == '1') ) !!}
                    {!! Form::label('message_presentations', trans('doc/ina.field_message_presentations')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('message_running_meetings', '1', (!empty($p->data->ina->message_running_meetings) && $p->data->ina->message_running_meetings == '1')) !!}
                    {!! Form::label('message_running_meetings', trans('doc/ina.field_message_running_meetings')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('message_web_meetings', '1', (!empty($p->data->ina->message_web_meetings) && $p->data->ina->message_web_meetings == '1')) !!}
                    {!! Form::label('message_web_meetings', trans('doc/ina.field_message_web_meetings')) !!}
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    {!! Form::checkbox('message_pitches', '1', (!empty($p->data->ina->message_pitches) && $p->data->ina->message_pitches == '1')) !!}
                    {!! Form::label('message_pitches', trans('doc/ina.field_message_pitches')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('message_conversations', '1', (!empty($p->data->ina->message_conversations) && $p->data->ina->message_conversations == '1')) !!}
                    {!! Form::label('message_conversations', trans('doc/ina.field_message_conversations')) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('message_reviews', '1', (!empty($p->data->ina->message_reviews) && $p->data->ina->message_reviews == '1')) !!}
                    {!! Form::label('message_reviews', trans('doc/ina.field_message_reviews')) !!}
                </div>
            </div>
        </div>

        <h4>@lang('doc/ina.question_training')</h4>
        <div class="container pad-bottom">
            <div class="col-xs-9">
                {!! Form::label('training_other', trans('doc/ina.field_other')) !!}
                {!! Form::textarea('training_other', isset($p->data->ina->training_other) ? $p->data->ina->training_other : '',
                ['class' => 'form-control', 'placeholder' => '', 'size' => '30x3']) !!}
            </div>
        </div>


        <div class="clearfix pad-bottom">
            {!! Form::submit('Save',
              ['class' => 'btn btn-primary pull-right btn-lg', 'id'=>'saveForm']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection