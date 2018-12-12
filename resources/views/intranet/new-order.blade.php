@extends('intranet.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('css/intranet/user.css')}}">
@show
@section('main-content')
    <div class="container-fluid" id="one-post">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <div class="user-info">
                    {!! Form::open(['route' => 'order/create', 'method' => 'post', 'id' => 'postForm']) !!}
                    {!! Form::token() !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', '',
                        ['class' => 'form-control', 'placeholder' => 'title']) !!}
                    </div>
                    <div class="form-group" {{ $errors->has('alias') ? ' has-error' : '' }}>
                        {!! Form::label('alias', 'Alias') !!}
                        {!! Form::text('alias', '',
                        ['class' => 'form-control', 'placeholder' => 'alias']) !!}
                        @if ($errors->has('alias'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('alias') }}</strong>
                             </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('subtitle', 'Subtitle') !!}
                        {!! Form::text('subtitle', '',
                        ['class' => 'form-control', 'placeholder' => 'Subtitle']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('content', 'Content') !!}
                        {!! Form::textarea('content', '',
                        ['class' => 'form-control', 'placeholder' => 'Content']) !!}
                    </div>
                    <div class="form-group">
                        <strong>Category</strong>

                    </div>
                    <div class="element-group">
                        <strong>Visible</strong>
                            <div class="form-group">
                                {!! Form::checkbox('visible', '1', true) !!}
                            </div>
                    </div>
                    <div class=" col-xs-12 clearfix">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right btn-lg']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
@endsection