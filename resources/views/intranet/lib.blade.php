@extends('intranet.template.app')

@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/intranet/lib.min.css')}}">
@endsection

@section('main-content')
    <div class="container-fluid" id="one-lib">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <div class="user-info">
                    {!! Form::open(['route' => 'lib/save', 'method' => 'post', 'id' => 'postForm']) !!}
                    {!! Form::text('lib_id', $lib->id,['hidden' => true]) !!}
                    {!! Form::text('asset_id', $lib->asset_id,['hidden' => true]) !!}
                    {!! Form::text('category_id', $lib->category_id,['hidden' => true]) !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', $lib->title,
                        ['class' => 'form-control', 'placeholder' => 'title']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description', $lib->description,
                        ['class' => 'form-control', 'placeholder' => 'Description']) !!}
                    </div>
                    @if($lib->asset_id != null)
                    <div class="file-block">
                        <img src="{{asset('assets/dist/img/intranet/library/'.$lib->asset->type.'-icon.png')}}" alt="icon">
                        <a href="../{{ $lib->asset->getMedia()[0]->getUrl() }}" download>
                            {{ $lib->asset->getMedia()[0]->file_name }}
                        </a>
                    </div>
                    @endif
                    <div class="form-group">
                        <upload-file old-asset-id="@if ($lib->asset_id) {{$lib->asset_id}} @endif"></upload-file>
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
