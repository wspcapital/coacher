@extends('intranet.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/intranet/shared-video.min.css')}}">
@endsection
@section('main-content')
    <div id="shared-video">
        <div v-if="video">
            <h2> @{{ video.title }} @{{ video.asset.media[0].file_name }} </h2>
            <p v-if="video.asset.get_doc_videos != null">
                <a v-bind:href="filePath + video.asset.get_doc_videos.doc_assets.id + '/' + video.asset.get_doc_videos.doc_assets.media[0].file_name">
                    @{{ video.asset.get_doc_videos.doc_assets.media[0].file_name }}
                </a>
            </p>
            <table class="table">
                <thead>
                <tr>
                    <th>Participant</th>
                    <th>Remove</th>
                </tr>
                <tbody class="sortable">


                <tr v-for="participant in participants" v-bind:id="'part' + participant.id">
                    <td>
                        <a v-bind:href="'/intranet/user/' + participant.id">
                            @{{ participant.email }}
                        </a>
                    </td>
                    <td>
                        <a class="delshared" @click="delParticipant(participant.id)">
                        <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-6">
                    <form action="" class="form-inline">
                        <label for="email">Participant Email</label>
                        <input type="email" id="email" class="form-control" v-model="email" required>
                        <button @click.prevent="emailParticipant" class="btn btn-primary add-participant">Add</button>
                    </form>
                </div>
            </div>
            <div class="row booking-participant">
                <div class="col-md-6">
                    <form action="" class="form-inline">
                        <label for="booking">Booking Id</label>
                        <input type="text" id="booking" class="form-control" v-model="bookingId">
                        <button @click.prevent="bookingParticipant" class="btn btn-primary add-participant">Add</button>
                    </form>
                </div>
            </div>
            <div class="row" v-if="errorStatus">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="alert alert-danger" >
                        <p v-for="error in errors">
                            <strong>Error!</strong> @{{ error[0] }}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection