@extends('intranet.template.app')
@section('main-content')
    <div class="col-md-6 col-md-offset-3">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open(['url' => 'intranet/user/save']) !!}
        <div class="row">
            <div class="col-md-6">
                {!! Form::text('user_id', $user->id, ['hidden' => true]) !!}
                <div class="form-group">
                    {!! Form::label('first_name', 'First Name') !!}
                    {!! Form::text('first_name', $user->first_name, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('last_name', 'Last Name') !!}
                    {!! Form::text('last_name', $user->last_name, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
                </div>
                {{--{{Former::password('password')->label('Password')}}--}}
                <div class="form-group">
                    {!! Form::label('title', 'Position') !!}
                    {!! Form::text('title', $user->title, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('company', 'Company or Firm') !!}
                    {!! Form::text('company', $user->company, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('website', 'Website') !!}
                    {!! Form::text('website', $user->website, ['class' => 'form-control']) !!}
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('address1', 'Address') !!}
                    {!! Form::text('address1', $user->address1, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address2', ' ') !!}
                    {!! Form::text('address2', $user->address2, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('city', 'City') !!}
                    {!! Form::text('city', $user->city, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('state', 'State') !!}
                    {!! Form::text('state', $user->state, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('zip', 'Zip') !!}
                    {!! Form::text('zip', $user->zip, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('phone', 'Phone') !!}
                    {!! Form::text('phone', $user->phone, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('fax', 'Fax') !!}
                    {!! Form::text('fax', $user->fax, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="clearfix">
                {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection