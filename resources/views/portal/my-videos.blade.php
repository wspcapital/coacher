@extends('portal.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/portal/my-videos.min.css')}}">
@endsection
@section('main-content')
    <div class="modal fade" id="faq-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    @include('vcoach.partials.faqs')
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix start-content">
        <img class="pull-left" src="{{asset('assets/dist/img/portal/video-logo.png')}}">
        <div class="page-title pull-left">My Videos
            <span class="page-subtitle">Upload and manage Virtual Coach videos. View workshop videos.</span>
        </div>
    </div>
    <div id="video-block">
        <video src="" controls hidden></video>
    </div>

    <div id="my-videos">
        @include('portal.partials.messages')
        <div id="video-player"></div>
        <div id="videos" class="video-files" class="hidden">
            <div class="col-xs-12">
                <h3 data-toggle="collapse" data-target="#workshops" class="collapsed">Workshop Videos</h3>
                <div id="workshops" class="collapse">
                    @include('portal.partials.my-workshops-video',
                     ['videos' => $videos['workshop'], 'vit' => 'workshop'])
                </div>
            </div>

            <div class="col-xs-12">
                <h3 data-toggle="collapse" data-target="#webinar" class="collapsed">Webinar Recordings</h3>
                <div id="webinar" class="collapse">
                    @include('portal.partials.my-workshops-video',
                    ['videos' => $videos['webinar'], 'vit' => 'webinar'])
                </div>
            </div>

            <div class="col-xs-12">
                <h3 data-toggle="collapse" data-target="#learnings" class="collapsed">Video Learning Module</h3>
                <div id="learnings" class="collapse">
                    @include('portal.partials.my-workshops-video',
                     ['videos' => $videos['learning'], 'vit' => 'learning'])
                </div>
            </div>

            <div class="col-xs-12">
                <h3 data-toggle="collapse" data-target="#uploaded-videos" class="collapsed">Virtual Coach Videos</h3>
                <div id="uploaded-videos" class="collapse">
                    @if($videos['virtual-coach'] != null)
                        @foreach($videos['virtual-coach'] as $video)
                            <div class="col-xs-12 col-sm-3">
                                <a href="#"
                                   @click.prevent="playVideo('{{asset($video['video']->assets->getMedia()[0]->getUrl())}}')">
                                    <img src="{{asset($video['video']->assets->getMedia()[0]->getUrl('preview'))}}"
                                         alt="preview" class="img-responsive">
                                </a>
                            </div>
                            <div class="col-xs-12 col-sm-9">
                                <div class="info-block">
                                    <h2> @if($video['video']->orders->getIna('title') != null)
                                            {{$video['video']->orders->getIna('title') }}
                                        @else {{ $video['video']->assets->getMedia()[0]->file_name}}
                                        @endif
                                    </h2>
                                    <p>
                                        Uploaded: {{ $video['video']->orders->created_at->format('m/d/y') }}
                                    </p>
                                </div>
                                <div class="pull-right">
                                    @if ($video['vpr'] != null)
                                        <a href="{{ asset($video['vpr']->assets->getMedia()[0]->getUrl()) }}"
                                           target="_blank">
                                            <button class="btn btn-primary btn-lg" type="button">
                                                VPR AVAILABLE
                                            </button>
                                        </a>
                                    @endif

                                    @if($video['video']->orders->status == -1)
                                        <button class="btn btn-primary btn-lg" type="button" data-toggle="modal"
                                                data-target="#myModal{{ $video['video']->id }}">
                                            CONTINUE
                                        </button>
                                        @include('portal.partials.myVideos.create-form')
                                    @elseif($video['video']->orders->status == 0)
                                        <button class="btn btn-primary btn-lg" type="button" data-toggle="modal"
                                                data-target="#myModal{{ $video['video']->id }}">
                                            EDIT SUBMISSION
                                        </button>
                                        @include('portal.partials.myVideos.update-form')
                                    @else
                                        <button class="btn btn-primary btn-lg" type="button" data-toggle="modal"
                                                data-target="#myModal{{ $video['video']->id }}">
                                            View INA
                                        </button>
                                        @include('portal.partials.myVideos.show-form')
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 progress-img">
                                <img src="{{ asset('assets/dist/img/portal/progress-'. $video['video']->orders->status .'.png') }}"
                                     class="img-responsive" alt="progress">
                            </div>

                        @endforeach
                    @endif
                </div>
            </div>
            <a name="ina"></a>

            <div class="col-xs-12 button-block">
                @if(Auth::user()->getVCoaches() > 0)
                    <video-upload></video-upload>
                @else
                    @include('portal.partials.need-credits', ['type' => 'video'])
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
@show