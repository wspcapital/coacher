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
                <img src="{{ asset('assets/dist/img/homepage/m-why.png') }}" class="pull-left">

                <h1 class="sect-blk-title">How Are We Different?</h1>
                <p>Nothing off-the-shelf, nothing outsourced, and no two courses are exactly the same.</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3 no-padding">

                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-stacked" role="tablist">
                    @foreach($posts as $post)
                    <li role="presentation" @if($loop->first)class="active" @endif>
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
                    <div role="tabpanel" class="tab-pane @if($loop->first) active @endif" id="tab{{$post->id}}">
                        {!! $post->content !!}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection