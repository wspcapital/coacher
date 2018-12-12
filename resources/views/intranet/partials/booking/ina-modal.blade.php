<div class="modal fade" id="ina-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

                <div class="wrapper">
                    <div class="row">
                        <h4> @lang('doc/ina.question_role_duties')</h4>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <p id="client_role_duts"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h4> @lang('doc/ina.question_audiens')</h4>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_audiens_senior')</label>
                                <input type="checkbox" id="audiens_senior" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_audiens_team')</label>
                                <input type="checkbox" id="audiens_team" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_audiens_clients')</label>
                                <input type="checkbox" id="audiens_clients" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_audiens_stakeholders')</label>
                                <input type="checkbox" id="audiens_stakeholders" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_audiens_peers')</label>
                                <input type="checkbox" id="audiens_peers" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_other')</label>
                                <p id="audiens_other"></p>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_audiens_subordinates')</label>
                                <input type="checkbox" id="audiens_subordinates" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_audiens_media')</label>
                                <input type="checkbox" id="audiens_media" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_audiens_community')</label>
                                <input type="checkbox" id="audiens_community" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_audiens_students')</label>
                                <input type="checkbox" id="audiens_students" disabled/>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <h4>@lang('doc/ina.question_skills')</h4>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_skills_nervos')</label>
                                <input type="checkbox" id="skills_nervos" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_skills_off_track')</label>
                                <input type="checkbox" id="skills_off_track" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_skills_enthusiasm')</label>
                                <input type="checkbox" id="skills_enthusiasm" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_skills_is_not_clear')</label>
                                <input type="checkbox" id="skills_is_not_clear" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_skills_intimidating')</label>
                                <input type="checkbox" id="skills_intimidating" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_skills_confidence')</label>
                                <input type="checkbox" id="skills_confidence" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_skills_concise')</label>
                                <input type="checkbox" id="skills_concise" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_other')</label>
                                <p id="skills_other"></p>
                            </div>

                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_skills_compelling')</label>
                                <input type="checkbox" id="skills_compelling" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_skills_too_fast')</label>
                                <input type="checkbox" id="skills_too_fast" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_skills_monotone')</label>
                                <input type="checkbox" id="skills_monotone" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_skills_viruses')</label>
                                <input type="checkbox" id="skills_viruses" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_skills_questions')</label>
                                <input type="checkbox" id="skills_questions" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_skills_language')</label>
                                <input type="checkbox" id="skills_language" disabled/>
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
                                <input type="checkbox" id="message_presentations" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_message_running_meetings')</label>
                                <input type="checkbox" id="message_running_meetings" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_message_web_meetings')</label>
                                <input type="checkbox" id="message_web_meetings" disabled/>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_message_pitches')</label>
                                <input type="checkbox" id="message_pitches" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_message_conversations')</label>
                                <input type="checkbox" id="message_conversations" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('doc/ina.field_message_reviews')</label>
                                <input type="checkbox" id="message_reviews" disabled/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h4>@lang('doc/ina.question_training')</h4>
                        <div id="training_other" class="col-xs-9"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
