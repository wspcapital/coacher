@extends('intranet.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/intranet/chat.min.css')}}">
@endsection
@section('main-content')
    @include('chat')
@endsection

@section('scripts')
    @parent
    <script src="{{asset('assets/dist/libs/socket/socket-io-client.min.js')}}"></script>
@endsection
