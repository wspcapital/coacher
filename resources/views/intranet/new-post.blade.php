@extends('intranet.template.app')


@section('main-content')
    <div class="container-fluid" >
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <div class="user-info">
                    {!! Form::open(['route' => 'post/create', 'id' => 'postForm']) !!}
                    {!! Form::token() !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', '',
                        ['class' => 'form-control', 'placeholder' => 'title']) !!}
                    </div>
                    <div class="form-group" {{ $errors->has('alias') ? ' has-error' : '' }}>
                        {!! Form::label('alias', 'Alias') !!}
                        {!! Form::text('alias', '', ['class' => 'form-control', 'placeholder' => 'alias']) !!}
                        @if ($errors->has('alias'))
                            <span class="help-block alert alert-danger">
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
                        {!! Form::textarea('content', '',['id' => 'content']) !!}

                    </div>

                    <div class="form-group">
                        <strong>Category</strong>
                        {!! Form::select('category_id', $categories, null, ['placeholder' => 'Pick a Category...']) !!}
                    </div>
                    <div class="element-group">
                        <strong>Visible</strong>
                        <div class="form-group">
                            {!! Form::checkbox('visible', '1', true) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 clearfix">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right btn-lg']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>

@endsection

@section('script')
    @parent
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#content',
            plugins: ["code"],
            toolbar: "code"
        });
    </script>
@show
