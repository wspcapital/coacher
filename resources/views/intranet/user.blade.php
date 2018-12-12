@extends('intranet.template.app')
@section('style')
    @parent
    <!-- SIPML5 API:
    DEBUG VERSION: 'SIPml-api.js'
    RELEASE VERSION: 'release/SIPml-api.js'
    -->
    <link rel="stylesheet" href="{{asset('/assets/dist/css/intranet/user.min.css')}}">
@show
@section('main-content')
    <div class="container-fluid" id="one-user" v-cloak>
        <div class="row">
            <div class="container-fluid save-button-block">
                <button class="btn  btn-primary small pull-right" @click=submit>Save</button>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="user-info">

                    @include('intranet.partials.user.main-form')

                    @include('intranet.partials.user.credit')

                    @include('intranet.partials.user.credit-history')

                    <div class="col-xs-4">
                        @if($user->getTrainer())
                            Trainer: {{ $user->getTrainer() }}
                        @endif
                        <br>Member Since: {{ $user->created_at->format('m/d/y') }}
                        <br>Last Login:
                            @if($user->login_at)
                            {{ $user->login_at->format('m/d/y') }}
                            @endif
                            <br>
                        <a href="{{route('user/debug', $user->id)}}">DEBUG</a>
                    </div>
                    <div class=" col-xs-8 clearfix">
                        {{-- @if($user->data('account_sent'))--}}
                        @if($user->login_at)
                            <a href="#" @click.prevent='sendAccount({{$user->id}})'
                               class="btn btn-primary small pull-right">Resend Account</a>
                        @else
                            <a href="#" @click.prevent='sendAccount({{$user->id}})' id="send-account"
                               class="btn  btn-primary small pull-right">Send Account</a>
                        @endif
                        <a href="#" @click.prevent="sendEmail({{$user->id}})" id="send-email"
                           class="btn btn-primary small pull-right">
                            Email Password
                        </a>
                        <block-user user-id="{{ $user->id }}" block="{{ $user->blocked }}"></block-user>

                        {{--<a href="{{asset('/intranet/user/delete/'.$user->id)}}" @click.prevent="confirmDelete"
                           class="btn btn-danger small pull-right">Delete Account</a>--}}
                    </div>

                </div>
            </div>
            <div class="col-xs-12 col-md-6">

                @include('intranet.partials.user.order')
                {{--    Work sho p--}}
                <workshop-videos></workshop-videos>
                <!---------------------------------------------------------------------------------------------------------->
                <learning-videos></learning-videos>
                <!---------------------------------------------------------------------------------------------------------->
                <webinar-videos></webinar-videos>

                {{-- Bookings --}}
              @include('intranet.partials.user.booking-list')
            </div>
        </div>
        <div class="container-fluid save-button-block">
            <button class="btn  btn-primary small pull-right" @click=submit>Save</button>
        </div>
    </div>
    <div class="container-fluid chat-button">
        <a id="load-vcoach" class="btn  btn-primary small pull-right">Join
            Room</a>
            <a href="{{ route('intranet-chat', $user->id) }}" class="btn  btn-primary small pull-right">Join
                Chat</a>
    </div>
    @include('intranet.partials.video-chat')
@endsection

@section('scripts')
    @parent
    <script src="{{asset('/assets/dist/libs/webrtc/SIPml-api.js?svn=250')}}" type="text/javascript"></script>
    <script src="{{asset('/assets/dist/libs/webrtc/SIP-init.js')}}" type="text/javascript"></script>
    <!-- Le javascript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    {{--<script type="text/javascript" src="./assets/js/bootstrap-transition.js"></script>
    <script type="text/javascript" src="./assets/js/bootstrap-alert.js"></script>
    <script type="text/javascript" src="./assets/js/bootstrap-modal.js"></script>
    <script type="text/javascript" src="./assets/js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="./assets/js/bootstrap-scrollspy.js"></script>
    <script type="text/javascript" src="./assets/js/bootstrap-tab.js"></script>
    <script type="text/javascript" src="./assets/js/bootstrap-tooltip.js"></script>
    <script type="text/javascript" src="./assets/js/bootstrap-popover.js"></script>
    <script type="text/javascript" src="./assets/js/bootstrap-button.js"></script>
    <script type="text/javascript" src="./assets/js/bootstrap-collapse.js"></script>
    <script type="text/javascript" src="./assets/js/bootstrap-carousel.js"></script>
    <script type="text/javascript" src="./assets/js/bootstrap-typeahead.js"></script>--}}

    <!-- Audios -->
    <audio id="audio_remote" autoplay="autoplay"></audio>
    <audio id="ringtone" loop src="{{ asset('assets/dist/libs/webrtc/sounds/ringtone.wav') }}"></audio>
    <audio id="ringbacktone" loop src="{{ asset('assets/dist/libs/webrtc/sounds/ringbacktone.wav') }}"></audio>
    <audio id="dtmfTone" src="{{ asset('assets/dist/libs/webrtc/sounds/dtmf.wav') }}"></audio>

    <!-- GOOGLE ANALYTICS -->
    <script type="text/javascript">
        var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
        document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
    </script>

    <script type="text/javascript">
        try {
            var pageTracker = _gat._getTracker("UA-6868621-19");
            pageTracker._trackPageview();
        } catch (err) {
        }
    </script>
@endsection
