@extends('intranet.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/intranet/order.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/dist/libs/datetimepicker-master/jquery.datetimepicker.min.css')}}">
@endsection
@section('main-content')
    <div class="container-fluid" id="one-post">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="user-info">
                    {!! Form::open(['route' => ['order/sessionSave', $order->id], 'method' => 'post', 'id' => 'postForm']) !!}
                    {!! Form::text('order_id', $order->id,['hidden' => true]) !!}
                    <table class="table">
                        <tbody>
                        <tr>
                            <td> @lang('intranet/orders.member') </td>
                            <td>
                                {{$order->bookingParticipants->user->full_name}}
                            </td>
                        </tr>
                        <tr>
                            <td> Email</td>
                            <td>
                                {{$order->bookingParticipants->user->email}}
                            </td>
                        </tr>
                        <tr>
                            <td> Company</td>
                            <td>
                                {{$order->bookingParticipants->booking->company}}
                            </td>
                        </tr>
                        <tr>
                            <td> Trainer</td>
                            <td>
                                <select name="order_trainer_id" id="" class="form-control">
                                    @if($order->order_trainer_id == 0)
                                        <option value="0">Pick a Trainer...</option>
                                    @endif
                                    @foreach($trainers as $trainer)
                                        <option value="{{$trainer->id}}"
                                                @if($order->order_trainer_id == $trainer->id)
                                                selected
                                                @endif>
                                            {{ $trainer->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td> Date Scheduled</td>
                            <td>
                                {!! Form::text('due_at', $order->due_at,
                                  ['class' => 'form-control', 'placeholder' => 'Due at']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td> Time Zone</td>
                            <td>
                                {!! Form::select('timezone', $timezone, ($order->timezone) ? $order->timezone : config('app.timezone'),
                                 ['placeholder' => 'Pick a Time zone...', 'class'=>'form-control']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td> Admin Notes</td>
                            <td>
                                {!! Form::textarea('admin_notes', $order->admin_notes,
                                [ 'class'=>'form-control', 'size' => '30x3']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td> Internal Coach Notes</td>
                            <td>
                                {!! Form::textarea('coach_notes', $order->coach_notes,
                                [ 'class'=>'form-control', 'size' => '30x3']) !!}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="col-xs-6">
                        <strong>Status {{ $order->getStatus() }}</strong>
                        <br><span class="fa fa-check @if($order->status >= 0)text-success @endif "></span> Submitted
                        <br><span class="fa fa-check @if($order->status > 0)text-success @endif "></span> Trainer
                        Assigned
                        <br><span class="fa fa-check @if($order->status > 1)text-success @endif "></span> In Process
                        <br><span class="fa fa-check @if($order->status > 2)text-success @endif "></span> Completed
                    </div>
                    <div class="col-xs-6 no-padding-right">
                        <div class="col-xs-12 order-button">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right btn-lg']) !!}
                        </div>
                        <div class="col-xs-12 order-button">
                            {!! Form::submit('Close order', ['name'=>'close', 'class' => 'btn btn-primary close-order btn-lg']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <h3>Session Request Information {{ $order->getIna('workshop') }} </h3>

                <p><strong>Participant has attended a live workshop</strong></p>
                <p> <span>
                           @if($order->getIna('workshop'))
                            Yes
                        @else
                            No
                        @endif
                        </span></p>

                <p><strong>I am free</strong></p>
                <p> {{ $order->getIna('free') }} </p>

                <p><strong>Scheduling Notes</strong></p>
                <p> {{ $order->getIna('skednotes') }} </p>

                <p><strong>Session Topic</strong></p>
                @if(isset($pdf))
                    <p>
                        <a href="{{ asset('assets/dist/lessons/' . $pdf->pdf) }}"> {{ $order->getIna('functionality') }} </a>
                    </p>
                @endif

                <p><strong>Were there any points made in the Virtual Performance Report you'd like clarified?</strong>
                </p>
                <p> {{ $order->getIna('clarification') }} </p>

                <p><strong>Is this a particular communication situation you'd like to discuss?</strong></p>
                <p> {{ $order->getIna('situation') }} </p>

                <p><strong>Please provide any other relevant details you want to share prior to your coaching
                        session.</strong></p>
                <p> {{ $order->getIna('relevant') }} </p>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="{{asset('/assets/dist/libs/datetimepicker-master/jquery.js')}}"></script>
    <script src="{{asset('/assets/dist/libs/datetimepicker-master/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="{{asset('/assets/dist/libs/datetimepicker-master/setting.js')}}"></script>
@endsection
