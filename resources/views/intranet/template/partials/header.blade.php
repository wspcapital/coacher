<header class="intranet-header">
    <nav class="custom navbar navbar-default">
        <div class="container-fluid portal-menu">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand pin-logo" href="{{ route('intranet') }}">
                    <img src="{{asset('assets/dist/img/intranet/pin-logo.png')}}" alt="logo">
                </a>
                <a class="navbar-brand intranet-logo" href="{{ route('intranet') }}">
                    <img src="{{asset('assets/dist/img/intranet/intranet-logo.png') }}">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li @if(Request::is('intranet'))class="active"@endif>
                        <a href="{{route('intranet')}}">@lang('intranet/template.menu.home')</a>
                    </li>
                    <li @if(Request::is('intranet/users'))class="active"@endif>
                        <a href="{{route('users')}}">@lang('intranet/template.menu.users')</a>
                    </li>
                    <li @if(Request::is('intranet/calendar'))class="active"@endif>
                        <a href="{{route('calendar')}}">@lang('intranet/template.menu.calendar')</a>
                    </li>
                    <li class="dropdown @if(Request::is('intranet/payments') || Request::is('intranet/coupons'))
                            active @endif"  >
                        <a class="dropdown-toggle" data-toggle="dropdown">@lang('intranet/template.menu.payments')
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('payments') }}">Payments List</a></li>
                            <li><a href="{{ route('coupons') }}">Coupons</a></li>
                        </ul>
                    </li>
                    <li @if(Request::is('intranet/libs/*') || Request::is('intranet/libs')
                        || Request::is('intranet/lib/*')) class="active"@endif>
                        <a href="{{route('libs')}}">@lang('intranet/template.menu.library')</a>
                    </li>
                    <li @if(Request::is('intranet/orders'))class="active"@endif>
                        <a href="{{route('orders')}}">@lang('intranet/template.menu.vcoach')</a>
                    </li>
                    <li @if(Request::is('intranet/bulks'))class="active"@endif>
                        <a href="{{route('bulks')}}">@lang('intranet/template.menu.bulks')</a>
                    </li>
                    <li @if(Request::is('intranet/posts') || Request::is('intranet/post/*'))class="active"@endif>
                        <a href="{{route('posts')}}">@lang('intranet/template.menu.cms')</a>
                    </li>
                    @if(Auth::check())
                        <li>
                            <a href="{{route('logout')}}">@lang('intranet/template.menu.logout')</a>
                        </li>
                    @else
                        <li>
                            <a href="{{route('portal/login')}}">@lang('intranet/template.menu.login')</a>
                        </li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if(Auth::check() and (!Request::is('intranet/calendar') and !Request::is('intranet/booking/*')))
                <div class="col-xs-12 col-lg-2" id="left-block">
                    <div class="row">
                        <button type="button" class="navbar-toggle hidden-lg pull-left" id="left-block-toggle"
                        @click ="showHide">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div id="profile">
                        @include('intranet.template.partials.left-block')
                    </div>
                </div>
                <div class="col-xs-12 col-lg-10 content-inner">
                    @else
                        <div class="col-sm-12 content-inner">
@endif

