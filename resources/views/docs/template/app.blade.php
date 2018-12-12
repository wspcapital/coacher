<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name='description'
          content='Pinnacle Performance Company leverages time-tested performance delivery techniques to train you to infuse your communication skills with intention.'/>
    <meta name='keywords'
          content='communications skills, communication training, presentation skills training, business acting, sales training, effective speaking, public speaking, interpersonal skills, customer service'/>
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <title>Pinnacle</title>
@section('style')
    <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{{asset('/assets/dist/css/app.min.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/dist/css/intranet/intranet.min.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/dist/css/docs/ina.min.css')}}">
@show
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>


@yield('main-content')


</body>
@section('scripts')
    <script src="{{asset('assets/dist/js/app.js')}}"></script>
    @include('flashy::message')
@show
</html>
