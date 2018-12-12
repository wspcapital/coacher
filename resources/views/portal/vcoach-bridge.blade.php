@extends('portal.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/portal/my-videos.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/css/portal/vcoach.min.css')}}">
@endsection
@section('main-content')
    <div class="start-content" id="vcoach">
        <div class="modal fade " id="explain3-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        The Virtual Coaching program allows you to receive professional feedback and guidance when and
                        where YOU need it.
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset('assets/dist/img/portal/bulb.png') }}">
        <span class="page-title">Virtual Coach</span>
        <button class="btn btn-primary btn-faq" data-toggle="modal" data-target="#explain3-modal">?</button>

        <div id="inner-container">
            @include('portal.partials.messages')
            @if(Auth::user()->getSessions() < 1)
                @include('portal.partials.need-credits', ['type' => 'session'])
            @else
                @include('portal.partials.new-session-ina-modal')
                <div class="clearfix">
                    {{--  @if(Auth::user()->data('vcoach_room'))--}}
                    @if($scheduled)
                        <span class="next-session">Next scheduled session: {{ $scheduled }}</span>
                    @endif
                    <a href="#" class="btn btn-border btn-primary small variable pull-right" data-toggle="modal"
                       data-target="#schedule-modal">REQUEST SESSION</a>
                </div>
            @endif
            <table class="table-striped">
                <thead>
                <tr>
                    <th>SESSION TITLE</th>
                    <th>DATE REQUESTED</th>
                    <th>DATE SCHEDULED</th>
                    <th>TRAINER</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->getIna('functionality') }}</td>
                        <td> {{ $order->created_at->format('m/d/y') }}  </td>
                        <td>
                            @if($order->due_at)
                                {{ $order->due_at }}
                            @endif
                        </td>
                        <td>@if($order->order_trainer_id != null)
                                {{ $order->orderTrainer->full_name }}
                            @endif
                        </td>
                        <td>
                            <a href="" data-toggle="modal" data-target="#schedule-modal-{{ $order->id }}">
                                <span>
                                    {{ isset($order->order_trainer_id) ? 'View' : 'Edit' }}
                                </span> Request </a>
                            @include('portal.partials.old-session-ina-modal')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="video-chat">
            @include('portal.partials.video-chat')
        </div>
    </div>
    @if($statusVideoChat || $chatStatus != 0)
        <div class="chat-button">
            @if($statusVideoChat)
                <a id="load-vcoach" class="btn  btn-primary small">
                    Join Room</a>
            @endif
            @if($chatStatus != 0)
                <a id="join-chat" href="{{ route('portal-chat') }}" class="btn  btn-primary small">
                    Join Chat</a>
            @endif
     @endif
        </div>
        </div>
        </div>
        </div>
        </div>
@endsection

@section('scripts')
    @parent
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script src="{{asset('/assets/dist/libs/webrtc/SIPml-api.js?svn=250')}}" type="text/javascript"></script>
    <script src="{{asset('/assets/dist/libs/webrtc/SIP-init.js')}}" type="text/javascript"></script>
    <!-- Le javascript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {{-- <script
             src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
             integrity="sha256-/SIrNqv8h6QGKDuNoLGA4iret+kyesCkHGzVUUV0shc="
             crossorigin="anonymous"></script>--}}
    {{-- <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
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
    {{--
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
        </script>
    --}}

    <script type="text/javascript">
        try {
            var pageTracker = _gat._getTracker("UA-6868621-19");
            pageTracker._trackPageview();
        } catch (err) {
        }
    </script>
@endsection