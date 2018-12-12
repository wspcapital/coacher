@extends('portal.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/portal/my-videos.min.css')}}">
@endsection
@section('main-content')
    <div class="start-content" id="video-tips">
        <div class="row">
            <img src="{{ asset('assets/dist/img/portal/video-tips-logo.png') }}">
            <span class="page-title">Video Tips</span>
        </div>
        <div style="-moz-column-count: 4;-webkit-column-count: 4;column-count: 4;">
            <ul>
        @foreach($videos as $video)
            <li><a href="javascript:void(0)" @click="setVideo('{{ $video->asset->getMedia()[0]->getUrl() }}')" >{{ $video->title }}</a></li>
        @endforeach
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="video-player" class="center">
                    <div id="video-block">
                        <video src="" controls hidden></video>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection
