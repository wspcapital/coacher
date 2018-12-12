@include('js-localization::head')
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@lang('portal/template.title')</title>
@section('style')
    <!-- Latest compiled and minified CSS -->

        <link rel="stylesheet" href="{{asset('/assets/dist/css/app.min.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/dist/css/portal/portal.min.css')}}">
@show

@yield('js-localization.head')
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
@include('portal.template.partials.header')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if(Auth::check() and !Request::is('portal'))
                <div class="col-xs-12 col-md-2" id="left-block">
                    <div class="row">
                        <button type="button" class="navbar-toggle hidden-md pull-left" id="left-block-toggle"
                        @click ="showHide">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div id="profile">
                        @include('portal.template.partials.left-block')
                    </div>
                </div>
                <div class="col-xs-12 col-md-10 content-inner">
                    @else
                        <div class="col-sm-12 content-inner">
                            @endif
                            @yield('main-content')

                        </div>
                </div>
        </div>
</section>

@include('portal.template.partials.footer')

@section('scripts')
    <script src="{{asset('assets/dist/js/app.js')}}"></script>
    @include('flashy::message')
@show
</body>
</html>