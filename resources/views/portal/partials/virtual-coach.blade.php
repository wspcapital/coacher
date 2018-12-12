@if(Auth::user()->data('vcoach_room'))
    <div id="vcoach-container" @if(empty($isadmin))class="collapse"@endif>
        <div id="chat-container" class="box">
            <video id="localVideo" autoplay muted></video>
            <div id="remotesVideos"></div>
            <div id="unsupportedError" style="display: none">
                <span class="fa fa-exclamation-triangle"></span><br>
                Sorry, but your browser does not support real-time communications.<br>
                Please use <a href="https://www.google.com/chrome/" target="_blank">Chrome</a> or
                <a href="https://www.mozilla.org/firefox/" target="_blank">Firefox</a> web browser to proceed.
            </div>
        </div>
        @include('partials.webrtc-script', ['room_name' => Auth::user()->getVcoachRoomHash()])
        {{--Former::open_vertical()->id('chatform')}}
        <div id="chatbox" class="box padded">
            <div id="chat-content"></div>
            {{Former::text('line')->label('')->class('form-control')->placeholder('Type here, enter to send')}}
        </div>
        <div class="clearfix">
            {{Former::submit('Send')->class('btn pull-right btn-border')}}
        </div>
        {{Former::close()--}}

    </div>
@endif