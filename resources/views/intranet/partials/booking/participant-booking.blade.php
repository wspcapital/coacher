<div class="row" id="participant">
    <h2 data-toggle="collapse" data-parent="#booking-sheets" data-target="#sec-participants">
        Participants</h2>
    <div id="sec-participants" class="collapse ">
        <div class="form-group col-xs-4">
            {!! Form::label('ina_type', 'INA Type') !!}
            {!! Form::select('ina_type', $ina_type, empty($booking->ina_type) ? 3 : $booking->ina_type,
             ['placeholder' => 'Select INA Version...', 'class'=> 'form-control']) !!}
        </div>
        <div class="button-block col-xs-12">
            <button type="button" class="btn btn-primary" @click = "sendAllInas"><span>Send all INAs</span></button>
            <button type="button" class="btn btn-primary" @click = "sendAllDDPs"><span>Send all DDPs</span></button>

            <button id="print-inas" type="button" class="btn btn-primary">
                <span>Print INAs</span></button>
            <button type="button" class="btn btn-primary" @click="sendAllAccount(participants)">
                <span>Send All Accounts</span></button>
            <button type="button" class="btn btn-primary"
                @click="sendAllAccount(participants)"><span>Send All Vcoach Accounts</span>
            </button>
        </div>
        <div class="participant-list">

            <table class="table">
                <thead>
                <tr>
                    <th data-toggle="tooltip" title="INA Status: If Request is sent or INA is submitted.">INA</th>
                    <th data-toggle="tooltip" title="Account Status: If user account has been sent.">ACT</th>
                    <th data-toggle="tooltip" title="Performance Report Status">DDP</th>
                    <th></th>
                    <th>Vcoaches</th>
                    <th>Sessions</th>
                    <th>Trainer</th>
                    <th>Do not notify</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="participant in participants">
                    <td v-if="participant.data.ina.status=='sent'"><i class="fa fa-question text-danger" aria-hidden="true"></i></td>
                    <td v-else-if="participant.data.ina.status=='received'"><i class="fa fa-check text-success" aria-hidden="true"></i></td>
                    <td v-else></td>

                    <td v-if="participant.data.account_sent=='1'"><i class="fa fa-check text-success" aria-hidden="true"></i></td>
                    <td v-else-if="participant.data.account_sent=='1'"><i class="fa fa-question text-danger" aria-hidden="true"></i></td>
                    <td v-else></td>

                    <td v-if="participant.data.ddp.notice_sent=='1'"><i class="fa fa-check alert-success" aria-hidden="true"></i></td>
                    <td v-else-if="participant.data.ddp.status=='uploaded'"><i class="fa fa-check text-danger" aria-hidden="true"></i></td>
                    <td v-else></td>
                    <td>
                        <a :href="'/intranet/user/' +  participant.user.id">
                            @{{ participant.user.first_name }} @{{ participant.user.last_name }}
                        </a>
                        <p>@{{  participant.user.email  }}</p>
                    </td>
                    <td>
                        <input type="text" class="form-control" v-model="participant.user.vcoaches" @change="saveVCoaches(participant.user)">
                    </td>
                    <td>
                        <input type="text" class="form-control" v-model="participant.user.sessions" @change="saveSessions(participant.user)">
                    </td>
                    <td>
                        <select v-model="participant.user.trainerId" @change="saveTrainer(participant)"
                        class="form-control">
                            <option v-for="trainer in trainers" v-bind:value="trainer.value">
                                @{{ trainer.text }}
                            </option>
                        </select>
                    </td>
                    <td><input value="1" type="checkbox" v-model="participant.data.blockNotify" @change="blockNotify(participant)"/></td>
                    <td>
                        <button type="button" class="btn  btn-primary small dropdown-toggle" data-toggle="dropdown">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" ng-hide="p.user.id">
                            <li><a href="">Save this sheet to activate</a></li>
                        </ul>
                        <ul class="dropdown-menu" role="menu" ng-show="p.user.id">
                            <li>
                                <a href="#" v-on:click.prevent="sendAccount(participant)" v-if="participant.data.account_sent !== undefined && participant.data.account_sent === '1'"><span>Resend Account</span></a>
                                <a href="#" v-on:click.prevent="sendAccount(participant)" v-else><span>Send Account</span></a>
                            </li>

                            <li><a href="#" v-on:click.prevent="sendAccount(participant)" v-if="participant.data.account_sent !== undefined && participant.data.account_sent === '1'"><span>Resend VC Notice</span></a>
                                <a href="#" v-on:click.prevent="sendAccount(participant)" v-else><span>Send VC Notice</span></a>
                            </li>

                            <li>
                                <a href="#" v-on:click.prevent="sendINA(participant)" v-if="participant.data.ina !== undefined && participant.data.ina.status === 'sent'">Re-Request INA</a>
                                <a href="#" v-on:click.prevent="sendINA(participant)" v-else><span>Request INA</span></a>
                            </li>

                            <li >
                                <a v-if="participant.share_hash" href="#" v-on:click.prevent="" data-toggle="modal" data-target="#popupModal" data-title="INA link" v-bind:data-content="JSON.stringify(['{{ url('docs/ina/') }}', participant.id])">View
                                    INA link</a>
                            </li>

                            <li>
                                <a v-if="participant.data.ina.status === 'received'" href="#" v-on:click.prevent="" data-toggle="modal" data-target="#ina-modal" data-title="INA" v-bind:data-content="JSON.stringify(participant.data.ina)">View INA</a>
                            </li>

                            <li>
                                <input type="file" @change="upload(participant)" name="ddp-file" :id="'ddp-file-' + participant.id" class="inputfile"/>
                                <label class="variable" :for="'ddp-file-' + participant.id">Upload DDP</label>
                            </li>

                            <li>
                                <a v-if="participant.data.ddp.status==='uploaded'" :href="participant.data.ddp.url" target="_blank">View DDP</a>
                            </li>

                            <li v-if="participant.data.ddp.status==='uploaded'">
                                <a href="#" v-on:click.prevent="sendDDP(participant)" v-if="participant.data.ddp.notice_sent==='1'"><span>Resend DDP Notice</span></a>
                                <a href="#" v-on:click.prevent="sendDDP(participant)" v-else><span>Send DDP Notice</span></a>
                            </li>
                        </ul>
                    </td>
                    <td>
                        <a href="#" @click.prevent="confirmDelete(participant.user.id)">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="alert alert-danger" v-if="errors.status">
                <strong>Error!</strong> @{{ errors.message }}
            </div>
            <div class="add-participants">
                <div class="col-xs-12 col-sm-3">
                    {!! Form::label('', 'Participant First Name') !!}
                    {!! Form::text('', '',
                     ['class'=>'form-control', 'id'=>'newParticipantFN', 'v-model'=>'newParticipant.first_name']) !!}
                </div>
                <div class="col-xs-12 col-sm-3">
                    {!! Form::label('', 'Participant Last Name') !!}
                    {!! Form::text('', '',
                     ['class'=>'form-control', 'id'=>'newParticipantLN', 'v-model'=>'newParticipant.last_name']) !!}
                </div>
                <div class="col-xs-12 col-sm-3">
                    {!! Form::label('', 'Participant Email') !!}
                    {!! Form::text('', '',
                     ['class'=>'form-control', 'id'=>'newParticipantEmail', 'v-model'=>'newParticipant.email']) !!}
                </div>
                <div class="col-xs-12 col-sm-3">
                    <button class='btn btn-primary btn-lg' id="addParticipant" @click.prevent="addParticipant()">Add participant</button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('intranet.partials.booking.print-participants-inas')
@include('intranet.partials.booking.pop-up')
@include('intranet.partials.booking.ina-modal')
