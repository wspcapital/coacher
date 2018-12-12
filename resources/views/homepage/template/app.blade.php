<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name='description'
          content='Pinnacle Performance Company leverages time-tested performance delivery techniques to train you to infuse your communication skills with intention.'/>
    <meta name='keywords'
          content='communications skills, communication training, presentation skills training, business acting, sales training, effective speaking, public speaking, interpersonal skills, customer service'/>
    <title>Communication Skills by Pinnacle Performance </title>
    {{--<link rel="icon" type="image/x-icon" href="http://pinper.raccoonie.com/webroot/assets/main/images/favicon.ico?ver=2.0">--}}
    @section('style')
        <link href="{{asset('assets/dist/css/app.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/dist/css/homepage/homepage.min.css')}}" rel="stylesheet" type="text/css">
    @show
    {{--    @include('homepage.template.partials.google-analytics')--}}
</head>
<body>
<div id="content">
    <div class="sprite open"></div>
    <div id="header">
        <div class="container-fluid">
            <div class="row">
                <a href="{{ route('/') }}">
                    @if(Request::is('/'))
                        <div class="sprite logo"></div>
                    @else
                        <div class="sprite logo-white"></div>
                    @endif
                </a>
                <div class="sprite close"></div>

                <div class="col-xs-5 col-xs-offset-1 col-md-3 col-md-offset-3">
                    @if(!Auth::check())
                        <form action="{{ route('login') }}" class="form-horizontal" id="login" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <p class="hidden-xs">log in to the Pinnacle Learning Portal</p>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="email address">
                            </div>
                            <div class="form-group">
                                <input name="password" class="form-control" placeholder="password" type="password">
                            </div>
                            <div class="form-group">
                                <a href="{{url('/password/reset')}}">Forgot Password?</a>
                            </div>
                            <div class="pull-right">
                                <input type="submit" id="form-submit" value="submit" class="pull-right btn-primary">
                            </div>
                        </form>
                    @endif

                </div>

                <div class="col-xs-6">
                    <div class="links pull-right">
                        <a href="{{ route('company') }}">About Pinnacle Performance</a>
                        <a href="{{ route('services') }}">Services we deliver</a>
                        <a href="{{ route('how-are-we-different') }}">How are we different?</a>
                        <a href="{{ route('events') }}">Events & red carpet</a>
                        <a href="{{ route('contact') }}">Contact us</a>
                        <a href="http://pinper.com/blog">Blog</a>
                        <a href="http://pinper.com/blog/podcast/">Podcasts</a>
                        @if(Auth::check())
                            <a href="{{ route('logout') }}">Log Out</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('/') }}">
        @if(Request::is('/'))
            <div class="sprite logo"></div>
        @else
            <div class="sprite logo-white"></div>
        @endif
    </a>
    @yield('main-content')

    @include('portal.template.partials.footer')
</div>

<script src="{{asset('assets/dist/js/app.js')}}"></script>
</body>
</html>
