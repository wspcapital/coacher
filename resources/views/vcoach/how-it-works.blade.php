@extends('vcoach.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/vcoach/how-it-works.min.css')}}">
@endsection
@section('main-content')
    <div class="container" id="app">

            <h1>HOW IT WORKS</h1>
            <h3>virtual coach is easy, convenient and secure.</h3>
            <div class="row" id="how-it-works">
                <div class="col-xs-12 col-sm-3 bumpbox" data-target="#video">
                    <img src="{{asset('assets/dist/img/vcoach/video.png')}}" class="img-responsive">
                    create a video
                </div>
                <div class="col-xs-12 col-sm-3 bumpbox" data-target="#upload">
                    <img src="{{asset('assets/dist/img/vcoach/upload.png')}}" class="img-responsive">
                    upload your video
                </div>
                <div class="col-xs-12 col-sm-3 bumpbox" data-target="#coaching">
                    <img src="{{asset('assets/dist/img/vcoach/coaching.png')}}" class="img-responsive">
                    receive coaching
                </div>
                <div class="col-xs-12 col-sm-3 bumpbox" data-target="#succeed">
                    <img src="{{asset('assets/dist/img/vcoach/succeed.png')}}" class="img-responsive">
                    succeed
                </div>

                @foreach($posts as $post)
                <div class="collapse col-md-12" id="{{$post->subtitle}}">
                        {!! $post->content !!}
                </div>
                @endforeach

            </div>


    </div>

@endsection