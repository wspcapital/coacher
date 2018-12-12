<template>
    <div>
        <div class="row" v-for="part in participants">

            <div class="col-md-3">
                <input type="text" v-bind:name="'part[' + part.user.id + '][first_name]'" class="form-control" v-bind:value='part.user.first_name'/>
            </div>
            <div class="col-md-3">
                <input type="text" v-bind:name="'part[' + part.user.id + '][last_name]'" class="form-control" v-bind:value='part.user.last_name'/>
            </div>
            <div class="col-md-5">
                <input type="text" v-bind:name="'part[' + part.user.id + '][email]'" class="form-control" v-bind:value='part.user.email'/>
            </div>
            <div class="col-md-1">

            </div>
        </div>
        <div class="row" v-if="addParticipant">

            <div class="col-md-3">
                <input type="text" class="form-control" v-model='newParticipant.first_name'/>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" v-model='newParticipant.last_name'/>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" v-model='newParticipant.email'/>
            </div>
            <div class="col-md-1">

            </div>
        </div>
        <div class="clearfix">
            <button type="button" class="pull-right btn-primary btn" v-on:click="addForm()">Add</button>
        </div>
    </div>

</template>
<script>

    export default{
        data(){
            return {
                participants: [],
                addParticipant: false,
                newParticipant: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    id: '',
                    item_participant: 0
                }
            }
        },
        props: [
            'parts'
        ],
        created(){
            this.participants = jQuery.parseJSON(this.parts);
        },
        methods: {
            addForm() {
                if (this.newParticipant.first_name != '' && this.newParticipant.last_name != '' &&
                        this.newParticipant.email != '') {
                    this.participants.push({
                        'user': {
                            first_name: this.newParticipant.first_name,
                            last_name: this.newParticipant.last_name,
                            email: this.newParticipant.email,
                            id: 'newPart_' + this.newParticipant.item_participant
                        }
                    });
                    this.newParticipant.item_participant++;
                    this.clearForm();
                }
                this.addParticipant = true;
            },
            clearForm() {
                this.newParticipant.first_name = '';
                this.newParticipant.last_name = '';
                this.newParticipant.email = '';            }
        }
    }

</script>