@extends('vcoach.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/vcoach/about.min.css')}}">
@endsection
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                {!! $posts['left-block']->content !!}
            </div>
            <div class="col-md-9">
                <div class="box">
                    {!! $posts['right-block']->content !!}
                </div>
            </div>
        </div>
    </div>

@endsection