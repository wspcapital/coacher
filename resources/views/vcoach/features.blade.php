@extends('vcoach.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/vcoach/about.min.css')}}">
@endsection
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="box">
                {!! $post->content !!}
            </div>

        </div>
    </div>

@endsection