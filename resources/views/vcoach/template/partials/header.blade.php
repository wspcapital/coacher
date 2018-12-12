<div class="container-fluid top-content">
    <div class="row">
        <div class="content-title">
            <div class="top-menu">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <a class="navbar-brand" href="{{route('vcoach')}}">
                                <img class="img-responsive" src="{{asset('assets/dist/img/vcoach/vc_logo_2.png')}}">
                            </a>
                        </div>
                        <div class="hero">
                            @if(Request::is('vcoach'))
                                <h1>Remote assessment, development and coaching
                                    of presentation and communication skills.</h1>
                                <div class="clearfix">
                                    <p class="pull-left orange">create a secure, private account and get started
                                        today</p>
                                    <div class="pull-right">
                                        <a href="{{route('how-it-works')}}" class="btn">How it works</a>
                                        <a href="{{route('sign-up') }}" class="btn">Sign up now</a>
                                    </div>
                                </div>
                            @else
                                <h1> {{ $title }}</h1>
                            @endif
                        </div>
                    </div><!-- /.container-fluid -->
                </nav>
            </div>
        </div>
    </div>
</div>