@extends('intranet.template.app')

@section('main-content')
    <div class="container-fluid" id="one-lib">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <div class="user-info">
                    {!! Form::open(['url' => 'intranet/lib/category/save', 'method' => 'post', 'id' => 'libcategoryForm']) !!}
                    {!! Form::text('category_id', $category->id,['hidden' => true]) !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', $category->title,
                        ['class' => 'form-control', 'placeholder' => 'title']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description', $category->description,
                        ['class' => 'form-control', 'placeholder' => 'Description']) !!}
                    </div>
                    <div class=" col-xs-12 clearfix">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right btn-lg']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
