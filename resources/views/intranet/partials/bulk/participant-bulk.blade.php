<div class="row" id="participant">
    <h2 data-toggle="collapse" data-parent="#booking-sheets" data-target="#sec-participants">
        Participants</h2>
    <div id="sec-participants" class="collapse col-xs-12">
        <div class="button-block">
            <button type="button" class="btn btn-primary" @click="postNotify('all')">
                <span>Notify All</span></button>
            <button type="button" class="btn btn-primary" @click="postNotify('new')">
                <span>Notify New</span></button>
        </div>
        <div class="participant-list">

            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Vcoaches</th>
                    <th>Sessions</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="participant in participants">
                    <td>
                        <a :href="'intranet/user/' +  participant.user.id">
                            @{{ participant.user.first_name }} @{{ participant.user.last_name }}
                        </a>
                        <p>@{{  participant.user.email  }}</p>
                    </td>

                    <td>
                        {!! Form::text('', '',
                        ['class'=>'form-control', 'v-model'=>'participant.user.vcoaches', '@change' => 'saveVCoaches(participant.user)']) !!}
                    </td>

                    <td>
                        {!! Form::text('', '',
                        ['class'=>'form-control', 'v-model'=>'participant.user.sessions', '@change' => 'saveSessions(participant.user)']) !!}
                    </td>

                    <td class="event-participant">
                        <a href="#" @click.prevent="confirmDelete(participant.user.id)">
                            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                        </a>
                        <a href="javascript:void(0)" class="fa fa-envelope text-primary" @click="postNotify(participant.id)"></a>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="alert alert-danger" v-if="errors.status">
                <strong>Error!</strong> @{{ errors.message }}
            </div>
            <div class="add-participants">
                <div class="col-xs-12 col-sm-3">
                    {!! Form::label('', 'First Name') !!}
                    {!! Form::text('', '',
                     ['class'=>'form-control', 'v-model'=>'newParticipant.first_name']) !!}
                </div>
                <div class="col-xs-12 col-sm-3">
                    {!! Form::label('', 'Last Name') !!}
                    {!! Form::text('', '',
                     ['class'=>'form-control', 'v-model'=>'newParticipant.last_name']) !!}
                </div>
                <div class="col-xs-12 col-sm-3">
                    {!! Form::label('', 'Email') !!}
                    {!! Form::text('', '',
                     ['class'=>'form-control', 'v-model'=>'newParticipant.email']) !!}
                </div>
                <div class="col-xs-12 col-sm-3">
                    <button class='btn btn-primary btn-lg' @click.prevent="addParticipant()">Add participant</button>
                </div>
            </div>
        </div>
    </div>
</div>