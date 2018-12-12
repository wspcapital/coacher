@extends('intranet.template.app')

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="user-info">
                    {!! Form::open(['url' => 'intranet/bookout/create', 'method' => 'post', 'id' => 'bookoutForm']) !!}
                    {!! Form::token() !!}

                    <div class="form-group col-xs-12">
                        {!! Form::label('details', 'Description/Notes') !!}
                        {!! Form::textarea('details', '',
                        ['class' => 'form-control', 'placeholder' => 'Description/Notes', 'size' => '30x3']) !!}
                    </div>

                    <div class="form-group col-xs-12">
                        {!! Form::label('generalnote', 'Note') !!}
                        {!! Form::text('generalnote', '',
                        ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                    <div class="form-group">
                        <div class="form-group col-xs-12 col-sm-6 {{ $errors->has('start_date') ? ' has-error' : ''}}">
                            {!! Form::label('start_date', 'Start date') !!}
                            {!! Form::text('start_date', '',
                            ['class' => 'form-control', 'placeholder' => 'start date']) !!}
                            @if ($errors->has('start_date'))
                                <span class="help-block">
                                     <strong>{{ $errors->first('start_date') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-xs-12 col-sm-6 {{ $errors->has('end_date') ? ' has-error' : ''}}">
                            {!! Form::label('end_date', 'End date') !!}
                            {!! Form::text('end_date', '',
                            ['class' => 'form-control', 'placeholder' => 'end date']) !!}
                            @if ($errors->has('end_date'))
                                <span class="help-block">
                                     <strong>{{ $errors->first('end_date') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 clearfix">
                {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right btn-lg']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <link rel="stylesheet" href="/assets/dist/libs/datetimepicker-master/jquery.datetimepicker.min.css">
    <script src="/assets/dist/libs/datetimepicker-master/jquery.datetimepicker.full.min.js"></script>
    <script src="/assets/dist/libs/datetimepicker-master/setting.js"></script>
@endsection
