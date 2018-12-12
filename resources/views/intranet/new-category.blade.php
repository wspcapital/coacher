@extends('intranet.template.app')

@section('main-content')
    <div class="container-fluid" >
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <div class="user-info">
                    {!! Form::open(['url' => 'intranet/lib/category/create', 'id' => 'libcategoryForm']) !!}
                    {!! Form::text('parent_id', $parent_category,['hidden' => true]) !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', '',
                        ['class' => 'form-control', 'placeholder' => 'title']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description', '',['id' => 'description']) !!}

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

