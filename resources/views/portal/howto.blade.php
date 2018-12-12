@extends('portal.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('assets/dist/css/portal/howto.min.css') }}">
@endsection
@section('main-content')
    <div class="howto">
        <div class="clearfix video-pop">

            <div class="col-xs-8 col-xs-offset-2 col-sm-2 col-sm-offset-0 text-center">
                <div class="video">
                    <a class="youtube-pop" href="//www.youtube.com/embed/MGjLNJ6AnHM" target="_blank">
                        <img src="{{asset('assets/dist/img/portal/VCoach_credit.jpg')}}" class="img-responsive">

                        <div class="hover"></div>
                    </a>
                </div>
                YOUR VIRTUAL COACHING SESSION
            </div>
            <div class="col-xs-8 col-xs-offset-2 col-sm-2 col-sm-offset-0 text-center">
                <div class="video">
                    <a class="youtube-pop" href="//www.youtube.com//embed/KLUgb0yANiA" target="_blank">
                        <img src="{{asset('assets/dist/img/portal/VCoach_upload.jpg')}}" class="img-responsive">

                        <div class="hover"></div>
                    </a>
                </div>
                VIRTUAL COACH VIDEO ASSESSMENT
            </div>
        </div>
    </div>

@endsection