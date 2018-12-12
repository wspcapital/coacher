@extends('intranet.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('/assets/dist/css/intranet/calendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css')}}">
@endsection
@section('main-content')
    <div class="container-fluid">
        {!! Form::open(['url' => 'intranet/booking/save',  'class' => 'form-inline',
        'method' => 'post', 'id' => 'calendarSearchForm']) !!}
        {!! Form::token() !!}
        <div class="form-group">
            {!! Form::select('user', $users, '', ['placeholder' => 'Search By User...', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::select('type', ['Workshop' => 'Workshop','Bookout' => 'Bookout','Bulk' => 'Bulk','Rouser' => 'Rouser',
                'Tradeshow' => 'Tradeshow','Webinar' => 'Webinar','ELS' => 'ELS','ELS + Workshop' => 'ELS + Workshop'],
                 '', ['placeholder' => 'Type...', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::select('location', [''=>'All','us'=>'USA','ous'=>'OUS'], '',
             ['placeholder' => 'Location...', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::text('calendar_search', '',
                        ['placeholder' => 'Search Calendar', 'class' => 'form-control']) !!}
        </div>
        {!! Form::close() !!}
        <div id="calendar"></div>
    </div>

    <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <img class="img-responsive hidden-xs" src="{{asset('assets/dist/img/portal/checkout-logo.png')}}" alt="logo">
            <h4 class="modal-title" id="myModalLabel">
               Booking Brief
            </h4>
        </div>
        <div class="modal-body">
            {{-- Ajax--}}
        </div>
    </div>

@endsection
