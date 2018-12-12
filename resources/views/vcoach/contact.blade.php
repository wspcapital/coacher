@extends('vcoach.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/vcoach/how-it-works.min.css')}}">
@endsection
@section('main-content')
    @if(!empty($post->content))
        <div class="container" id="app">
            {!! $post->content !!}
        </div>
    @endif
@endsection