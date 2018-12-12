@extends('homepage.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/homepage/company.min.css')}}">
@show
@section('main-content')
    <div class="top-block">
        <a href="{{ url('/') }}">
            <div class="sprite logo logo-white"></div>
        </a>
    </div>

    <div class="container main">
        <div id="sectionpanel">
            <div class="head-company company">
                <img src="{{ asset('assets/dist/img/homepage/m-who.png') }}" class="pull-left">

                <h1 class="sect-blk-title">Why Pinnacle Performance Company?</h1>

                <p>Founded by professional actors and Fortune 500 Executives, Pinnacle Performance Company delivers its
                    ground-breaking, intention-based training&trade; to professionals all over the world. We have meshed
                    time-honored performance techniques with the essential communication skills needed to succeed at
                    every
                    level of the corporate arena.</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3 no-padding">

                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-stacked" role="tablist">
                    @foreach($posts as $post)
                        <li role="presentation" @if($loop->first) class="active" @endif>
                            <a href="#tab{{$post->id}}" aria-controls="home" role="tab" data-toggle="tab">
                                {{$post->title}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-9 no-padding">
                <!-- Tab panes -->
                <div class="tab-content">
                    @foreach($posts as $post)
                        <div role="tabpanel" class="tab-pane @if($loop->first)active @endif" id="tab{{$post->id}}">
                            {!! $post->content !!}
                        </div>
                    @endforeach
                    {{--Modal --}}
                        <div id="myModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button>
                                        <h4 class="modal-title"></h4>
                                    </div>
                                    <div class="modal-body"></div>
                                    <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Close</button></div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection