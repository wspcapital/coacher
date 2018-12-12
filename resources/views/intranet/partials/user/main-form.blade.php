{!! Form::open(['url' => "intranet/user/save/$user->id", 'id' => 'userForm','method' => 'post', 'files'=>true]) !!}
{!! Form::token() !!}
{!! Form::text('user_id', $user->id,['hidden' => true]) !!}
<div class="form-group">
    {!! Form::label('first_name', 'First Name') !!}
    {!! Form::text('first_name', $user->first_name,
    ['class' => 'form-control', 'placeholder' => 'first name']) !!}
</div>
<div class="form-group">
    {!! Form::label('last_name', 'Last Name') !!}
    {!! Form::text('last_name', $user->last_name,
    ['class' => 'form-control', 'placeholder' => 'last name']) !!}
</div>
<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', $user->email,
    ['class' => 'form-control', 'placeholder' => 'email']) !!}
    @if ($errors->has('email'))
        <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                    </span>
    @endif
</div>
<div class="form-group">
    {!! Form::label('city', 'City') !!}
    {!! Form::text('city', $user->city,
    ['class' => 'form-control', 'placeholder' => 'City']) !!}
</div>
<div class="form-group">
    {!! Form::label('state', 'State') !!}
    {!! Form::text('state', $user->state,
    ['class' => 'form-control', 'placeholder' => 'State']) !!}
</div>
<div class="form-group">
    {!! Form::label('company', 'Company') !!}
    {!! Form::text('company', $user->company,
    ['class' => 'form-control', 'placeholder' => 'Company']) !!}
</div>
<div class="form-group">
    {!! Form::label('lang', 'Language') !!}
    {!! Form::text('lang', $user->lang,
    ['class' => 'form-control', 'placeholder' => 'Language']) !!}
</div>
<div class="form-group">
    <div class="row">
        <div class="col-xs-4">
            {!! Form::label('color', 'Color') !!}
            <input type="color" id="html5colorpicker" class="form-control"
                   onchange="clickColor(0, -1, -1, 5)" value="{{$user->color}}" name="color">
        </div>
    </div>
</div>

<div class="element-group">
    <strong>Staff Settings</strong>
    @foreach($roles as $role)
        <div class="form-group">
            {!! Form::checkbox('role[]', $role->id, $user->hasRole($role->name)) !!}
            {!! Form::label('role', $role->display_name) !!}
        </div>
    @endforeach
    @if($user->hasRole('admin'))
        <div class="form-group">

            {!! Form::label('assistant', 'Assistant') !!}
            {!! Form::select('assistant_id', $assistants,
            $user->assistant ? $user->assistant->assistant_user_id : ' ',
            ['class' => 'form-control', 'id' => 'assistant']) !!}
        </div>
    @endif
    <div class="form-group {{ $errors->has('file') ? ' has-error' : '' }}">
        {!! Form::label('file', 'Change Image') !!}
        {!! Form::file('file') !!}
        @if ($errors->has('file'))
            <span class="help-block">
                <strong>{{ $errors->first('file') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('bio', 'Bio') !!}
        {!! Form::textarea('bio', $user->getBio(),['class'=>'form-control', 'rows' => 5, ]) !!}
    </div>
</div>