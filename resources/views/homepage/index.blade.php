@extends('homepage.template.app')
@section('style')
    @parent
    <link href="{{asset('assets/dist/css/homepage/index.min.css')}}" rel="stylesheet" type="text/css">
@show
@section('main-content')
    {{-- <div id="main-slider">
         <ul class="bxslider">
             <li><img src="{{asset('assets/dist/img/homepage/slide-1.png')}}" class="img-responsive"></li>
             <li>
                 <img src="{{asset('assets/dist/img/homepage/video-play.png')}}" class="video-play">
                 <div id="player"></div>
             </li>
         </ul>
     </div>--}}
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="{{asset('assets/dist/img/homepage/slide-11.png')}}" class="img-responsive slider-img1"
                     alt="pic1">
            </div>

            <div class="item">
                <a class="youtube-pop" href="//player.vimeo.com/video/147371806" target="_blank">
                    <img src="{{asset('assets/dist/img/homepage/video-play.png')}}" id="carousel-player"
                         class="video-play img-responsive" alt="pic2">
                </a>
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3">
                <a href="{{ URL::asset('company') }}">
                    <div class="infobox text-left">
                        <img src="{{asset('assets/dist/img/homepage/m-who.png')}}">

                        <h3>Who</h3>
                        Pinnacle Performance Company is a premier, global communication skills training company.
                    </div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <a class="youtube-pop" href="//player.vimeo.com/video/147371806"
                   target="_blank"><!--a href="{{-- URL::asset('pinvideo') --}}"-->
                    <div class=" infobox text-left">
                        <img src="{{asset('assets/dist/img/homepage/m-why.png')}}">

                        <h3>Why</h3>
                        At Pinnacle, we believe the ability to communicate with purpose and clarity is the key to
                        personal
                        and professional success.
                    </div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <a href="{{ URL::asset('services') }}">
                    <div class="infobox text-left">
                        <img src="{{asset('assets/dist/img/homepage/m-what.png')}}">

                        <h3>What</h3>
                        With this in mind, we have developed an award-winning curriculum and methodology designed to
                        help
                        anyone, in any industry, convey their message more effectively and persuasively.
                    </div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <a href="{{ URL::asset('how-are-we-different') }}">
                    <div class="infobox text-left">
                        <img src="{{asset('assets/dist/img/homepage/m-how.png')}}">

                        <h3>How</h3>
                        Our master instructors facilitate customized, experiential workshops designed to empower
                        individuals
                        at every level of the corporate arena with the tools needed to deliver captivating and
                        influential
                        communication.
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="parallax">
        <div class="container">
            <em>"Gets you beyond the tricks and traps to help you understand what really engages an audience."</em>
            <br>
            <div class="pull-right">- Dylan Taylor <br> CEO, Colliers International</div>
        </div>
    </div>
    <div class="container">
        <div class="clearfix video-pop">

            <div class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-0 text-center">
                <div class="video">
                    <img src="{{asset('assets/dist/img/homepage/video1.jpg')}}" class="img-responsive">
                    <a class="youtube-pop" href="//player.vimeo.com/video/147369022" target="_blank">
                        <div class="hover"></div>
                    </a>
                </div>
                <h3>VIRTUAL COACH</h3>
            </div>
            <div class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-0 text-center">
                <div class="video">
                    <img src="{{asset('assets/dist/img/homepage/video2.jpg')}}" class="img-responsive">
                    <a class="youtube-pop" href="//player.vimeo.com/video/147371647" target="_blank">
                        <div class="hover"></div>
                    </a>
                </div>
                <h3>THE PINNACLE METHOD &trade;</h3>
            </div>
            <div class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-0 text-center">
                <div class="video">
                    <img src="{{asset('assets/dist/img/homepage/video3.jpg')}}" class="img-responsive">
                    <a class="youtube-pop" href="//player.vimeo.com/video/147371806" target="_blank">
                        <div class="hover"></div>
                    </a>
                </div>
                <h3>PINNACLE IN 90 SECONDS</h3>
            </div>
        </div>
    </div>
    </div>
@endsection