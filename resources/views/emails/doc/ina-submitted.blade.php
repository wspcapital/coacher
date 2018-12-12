{{ $participant->user->full_name }}
<br><br>
You successfully submitted the INA for your workshop on {{date('m/d/y',strtotime($participant->booking->start_date))}}.
<br><br>
Your submission contains the following:
<br><br>
<div class="wrapper">
    <div class="row">
        <h4> @lang('doc/ina.question_role_duties')</h4>
        <div class="col-xs-6">
            <div class="form-group">
                <p id="client_role_duts">{{ $participant->data()->ina['client_role_duts'] }}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <h4> @lang('doc/ina.question_audiens')</h4>
        <div class="col-xs-6">
            <div class="form-group">
                <label for="">@lang('doc/ina.field_audiens_senior')</label>
                <input type="checkbox" {{  !empty($participant->data()->ina['audiens_senior']) ? 'checked' : '' }} id="audiens_senior" disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_audiens_team')</label>
                <input type="checkbox" {{ !empty($participant->data()->ina['audiens_team']) ? 'checked' : '' }} id="audiens_team" disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_audiens_clients')</label>
                <input type="checkbox" id="audiens_clients" {{ !empty($participant->data()->ina['audiens_clients']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_audiens_stakeholders')</label>
                <input type="checkbox" id="audiens_stakeholders" {{ !empty($participant->data()->ina['audiens_stakeholders']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_audiens_peers')</label>
                <input type="checkbox" id="audiens_peers" {{ !empty($participant->data()->ina['audiens_peers']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_other')</label>
                <p id="audiens_other">{{ !empty($participant->data()->ina['audiens_other']) ? $participant->data()->ina['audiens_other'] : '' }}</p>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <label for="">@lang('doc/ina.field_audiens_subordinates')</label>
                <input type="checkbox" id="audiens_subordinates" {{  !empty($participant->data()->ina['audiens_subordinates']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_audiens_media')</label>
                <input type="checkbox" id="audiens_media" {{  !empty($participant->data()->ina['audiens_media']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_audiens_community')</label>
                <input type="checkbox" id="audiens_community" {{  !empty($participant->data()->ina['audiens_community']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_audiens_students')</label>
                <input type="checkbox" id="audiens_students" {{  !empty($participant->data()->ina['audiens_students']) ? 'checked' : '' }} disabled/>
            </div>

        </div>
    </div>

    <div class="row">
        <h4>@lang('doc/ina.question_skills')</h4>
        <div class="col-xs-6">
            <div class="form-group">
                <label for="">@lang('doc/ina.field_skills_nervos')</label>
                <input type="checkbox" id="skills_nervos" {{ !empty($participant->data()->ina['skills_nervos']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_skills_off_track')</label>
                <input type="checkbox" id="skills_off_track" {{ !empty($participant->data()->ina['skills_off_track']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_skills_enthusiasm')</label>
                <input type="checkbox" id="skills_enthusiasm" {{ !empty($participant->data()->ina['skills_enthusiasm']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_skills_is_not_clear')</label>
                <input type="checkbox" id="skills_is_not_clear" {{ !empty($participant->data()->ina['skills_is_not_clear']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_skills_intimidating')</label>
                <input type="checkbox" id="skills_intimidating" {{ !empty($participant->data()->ina['skills_intimidating']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_skills_confidence')</label>
                <input type="checkbox" id="skills_confidence" {{ !empty($participant->data()->ina['skills_confidence']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_skills_concise')</label>
                <input type="checkbox" id="skills_concise" {{ !empty($participant->data()->ina['skills_concise']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_other')</label>
                <p id="skills_other">{{ !empty($participant->data()->ina['skills_other']) ? $participant->data()->ina['skills_other'] : '' }}</p>
            </div>

        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <label for="">@lang('doc/ina.field_skills_compelling')</label>
                <input type="checkbox" id="skills_compelling" {{ !empty($participant->data()->ina['skills_compelling']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_skills_too_fast')</label>
                <input type="checkbox" id="skills_too_fast" {{ !empty($participant->data()->ina['skills_too_fast']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_skills_monotone')</label>
                <input type="checkbox" id="skills_monotone" {{ !empty($participant->data()->ina['skills_monotone']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_skills_viruses')</label>
                <input type="checkbox" id="skills_viruses" {{ !empty($participant->data()->ina['skills_viruses']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_skills_questions')</label>
                <input type="checkbox" id="skills_questions" {{ !empty($participant->data()->ina['skills_questions']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_skills_language')</label>
                <input type="checkbox" id="skills_language" {{ !empty($participant->data()->ina['skills_language']) ? 'checked' : '' }} disabled/>
            </div>
        </div>
    </div>

    <div class="row">
        <h4>
            <srtong>@lang('doc/ina.question_message')</srtong>
        </h4>
        <div class="col-xs-6">
            <div class="form-group">
                <label for="">@lang('doc/ina.field_message_presentations')</label>
                <input type="checkbox" id="message_presentations" {{ !empty($participant->data()->ina['message_presentations']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_message_running_meetings')</label>
                <input type="checkbox" id="message_running_meetings" {{ !empty($participant->data()->ina['message_running_meetings']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_message_web_meetings')</label>
                <input type="checkbox" id="message_web_meetings" {{ !empty($participant->data()->ina['message_web_meetings']) ? 'checked' : '' }} disabled/>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <label for="">@lang('doc/ina.field_message_pitches')</label>
                <input type="checkbox" id="message_pitches" {{ !empty($participant->data()->ina['message_pitches']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_message_conversations')</label>
                <input type="checkbox" id="message_conversations" {{ !empty($participant->data()->ina['message_conversations']) ? 'checked' : '' }} disabled/>
            </div>
            <div class="form-group">
                <label for="">@lang('doc/ina.field_message_reviews')</label>
                <input type="checkbox" id="message_reviews" {{ !empty($participant->data()->ina['message_reviews']) ? 'checked' : '' }} disabled/>
            </div>
        </div>
    </div>

    <div class="row">
        <h4>@lang('doc/ina.question_training')</h4>
        <div id="training_other" class="col-xs-9">{{ !empty($participant->data()->ina['skills_other']) ? $participant->data()->ina['training_other'] : '' }}</div>
    </div>
</div>
Thank you.
<br><br>
The Pinnacle Performance Team.