<header class="container-fluid head-portal">
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
                <a class="navbar-brand" href="/"><img src="{{asset('assets/dist/img/portal/logo.png')}}" class="img-responsive"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li @if(Request::is('portal'))class="active"@endif>
                        <a href="{{route('portal')}}">@lang('portal/template.menu.home')</a>
                    </li>
                    <li @if(Request::is('portal/my-videos'))class="active"@endif>
                        <a href="{{ route('my-videos')}}">@lang('portal/template.menu.my-videos')</a>
                    </li>
                    <li @if(Request::is('portal/virtual-coach'))class="active"@endif>
                        <a href="{{ route('virtual-coach') }}">@lang('portal/template.menu.vcoach')</a>
                    </li>
                    <li @if(Request::is('portal/video-tips'))class="active"@endif>
                        <a href="{{ route('video-tips') }}">@lang('portal/template.menu.tips')</a>
                    </li>
                    <li @if(Request::is('portal/library'))class="active"@endif>
                        <a href="{{ route('library') }}">@lang('portal/template.menu.library')</a>
                    </li>
                    <li @if(Request::is('portal/profile'))class="active"@endif>
                        <a href="{{ route('profile')}}">@lang('portal/template.menu.profile')</a>
                    </li>
                    @if(Auth::check())
                        <li>
                            <a href="{{ route('logout') }}">@lang('portal/template.menu.logout')</a>
                        </li>
                    @else
                        <li @if(Request::is('login'))class="active"@endif>
                            <a href="{{url('portal/login')}}">@lang('portal/template.menu.login')</a>
                        </li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>

