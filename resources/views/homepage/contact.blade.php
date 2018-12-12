@extends('homepage.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/homepage/company.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/css/homepage/contact.min.css')}}">
@endsection
@section('main-content')
    <div class="top-block">
        <a href="{{ url('/') }}">
            <div class="sprite logo logo-white"></div>
        </a>
    </div>

    <div class="container main">
        <div id="sectionpanel">
            <div class="head-company company">
                <img src="{{ asset('assets/dist/img/homepage/contact.png') }}" class="pull-left">
                <h1 class="sect-title">have questions? contact us!</h1>

                <p>Headquartered in Chicago, Illinois, Pinnacle Performance Company quickly expanded to meet the demand
                    for its unique training around the globe.</p>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3 no-padding">

                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-stacked" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#tab1" aria-controls="home" role="tab" data-toggle="tab">
                            {{ $post->title }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#tab2" aria-controls="profile" role="tab" data-toggle="tab">
                            Inquiry
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 no-padding">
                <!-- Tab panes -->

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="tab1">

                    {!! $post->content !!}

                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab2">
                        <div class="form-title">
                            Complete the form below and click submit. (*) All fields are required.
                        </div>
                        {!! Form::open(['url' => '/contact']) !!}

                        <div class="form-group ">
                            {!! Form::label('first_name', 'First name *', ['class' => 'control-label']) !!}
                            {!! Form::text('first_name', '',['class'=>'form-control',
                                'required'=>'true']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::label('last_name', 'Last name *', ['class' => 'control-label']) !!}
                            {!! Form::text('last_name', '',['class'=>'form-control' ,
                                'required'=>'true']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
                            {!! Form::text('title', '',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::label('department', 'Department', ['class' => 'control-label']) !!}
                            {!! Form::text('department', '',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::label('company_name', 'Company name', ['class' => 'control-label']) !!}
                            {!! Form::text('company_name', '',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::label('company_address', 'Company address', ['class' => 'control-label']) !!}
                            {!! Form::text('company_address', '',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::label('company_address2', 'Company address2', ['class' => 'control-label']) !!}
                            {!! Form::text('company_address2', '',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::label('city', 'City', ['class' => 'control-label']) !!}
                            {!! Form::text('city', '',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::label('country', 'Country', ['class' => 'control-label']) !!}
                            {!! Form::select('country', $country,'US',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::label('state', 'State', ['class' => 'control-label']) !!}
                            {!! Form::text('state', '',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::label('zip', 'Zip Code', ['class' => 'control-label']) !!}
                            {!! Form::text('zip', '',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::label('phone', 'Telephone', ['class' => 'control-label']) !!}
                            {!! Form::text('phone', '',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::label('email', 'Email Address *', ['class' => 'control-label']) !!}
                            {!! Form::email('email', '',['class'=>'form-control','required'=>'true']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::label('industry', 'Industry', ['class' => 'control-label']) !!}
                            {!! Form::text('industry', '',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('no_of_employees', 'No. of Employees', ['class' => 'control-label']) !!}
                            {!! Form::text('no_of_employees', '',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::label('budget', 'Budget', ['class' => 'control-label']) !!}
                            {!! Form::text('budget', '',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::label('inquiry', 'Inquiry', ['class' => 'control-label']) !!}
                            {!! Form::textarea('inquiry','', ['class'=>'form-control','size' => '30x5']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::submit('Submit', ['class'=>'btn btn-primary', 'id'=>'submit']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection