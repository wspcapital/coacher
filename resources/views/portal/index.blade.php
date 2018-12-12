@extends('portal.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/portal/home.min.css')}}">
@endsection

@section('main-content')
    <div id="menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <a href="{{route('my-videos')}}"><img src="{{asset('assets/dist/img/portal/my-videos.png')}}"
                                                               class="img-responsive"></a>
                </div>
                <div class="col-xs-12 col-md-4">
                    <a href="{{route('video-tips')}}"><img
                                src="{{asset('assets/dist/img/portal/video-tips.png')}}" class="img-responsive"></a>
                </div>
                <div class="col-xs-12 col-md-4">
                    <a href="{{route('library')}}"><img src="{{asset('assets/dist/img/portal/library.png')}}"
                                                             class="img-responsive"></a>
                </div>
            </div>
        </div>
    </div>
    <div id="submenu" class="clearfix container">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 box">
                <h3>@lang('portal/index.video.title')</h3>

                <p>@lang('portal/index.video.description')</p>
                <a href="{{route('my-videos')}}" class="btn pull-right btn-primary small variable">
                    @lang('portal/index.video.button')
                </a>
            </div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 box">
                <h3>@lang('portal/index.vcoach.title')</h3>

                <p>@lang('portal/index.vcoach.description')</p>
                <a href="{{route('virtual-coach')}}" class="btn btn-primary pull-right small variable">
                    @lang('portal/index.vcoach.button')
                </a>
            </div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 box">
                <h3>@lang('portal/index.session.title')</h3>

                <p>@lang('portal/index.session.description')</p>
                <a href="{{route('virtual-coach')}}" class="btn btn-primary pull-right small variable">
                    @lang('portal/index.session.button')
                </a>
            </div>
        </div>

    </div>
    <div id="trainer-spotlight" class="clearfix">
        <div class="clearfix">
            <h2 class="pull-right">TRAINER SPOTLIGHT</h2>
        </div>

      {{--  {{$trainer->thumbnail(['resize'=>'w[140]h[170]e[true]','class'=>'pull-left pad-right'])}}--}}
       {{-- <h3 class="text-grey">{{$trainer->FullName}}</h3>
        @if(!is_array($trainer->data->bio))
            {{$trainer->data->bio}}
        @endif--}}
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection