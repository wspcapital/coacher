@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/intranet/chat.min.css')}}">
@endsection

<div class="container" id="chat">
    <div class="row">
        <a href=
           @if(Request::is('intranet/*'))
                   "{{url('/intranet/user/'.$addressee)}}"
        @else
            "{{url('/portal/virtual-coach')}}"
        @endif
        class="btn btn-primary">
        Leave Chat
        </a>
    </div>
    <div class="row">
        <div class="col-xs-12 col-xs-offset-0 col-sm-8 col-sm-offset-2 " id="message-block">
            <ul id="message">
                @foreach($messages as $message)
                    <li class="message animated
                        @if($message->author == $user_id)
                            bounceInLeft
                            @else
                            bounceInRight
                            @endif
                            ">
                        <b>{{$message->userAuthor->full_name}}</b>
                        <p>{{ $message->message }}</p>
                        <small class="pull-right">{{$message->created_at->format('m/d/y H:i:s')}}</small>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-8 col-sm-offset-2">
                <form method="post" class="form">
                    {{ csrf_field() }}
                    <input type="hidden" name="author" id="userId" value="{{$user_id}}">
                    <input type="hidden" name="addressee" id="addressee" value="{{ $addressee }}">
                    <div class="col-xs-12 col-sm-9">
                        <textarea id='user-message' name="message"
                                  class="form-control"></textarea>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <input type="submit" id="submit" class="btn btn-success" value="Send">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@section('scripts')
    @parent
    <script src="{{asset('assets/dist/libs/socket/socket-io-client.min.js')}}"></script>
@endsection
