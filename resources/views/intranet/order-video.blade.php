@extends('intranet.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/intranet/order.min.css')}}">
@endsection

@section('main-content')
    <div class="container-fluid" id="one-post">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="user-info">
                    {!! Form::open(['route' => ['order/videoSave', $order->id],
                     'method' => 'post', 'id' => 'postForm', 'files' => true]) !!}
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
                                        <option value="">Pick a Trainer...</option>
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
                            <td> VPR</td>
                            <td>
                                {!! Form::file('vpr') !!}
                                @if($vpr != null)
                                    <div class="vpr-block">
                                        <a href="{{ asset($vpr->assets->getMedia()[0]->getUrl()) }}" target="_blank">
                                            View VPR
                                        </a>
                                    </div>
                                @endif
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
                        <br><span class="fa fa-check @if($order->status > 1)text-success @endif "></span> Trainer
                        Assigned
                        <br><span class="fa fa-check @if($order->status >= 3)text-success @endif "></span> Completed
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
                <div id="order-video">
                    @if($orderAssets == null)
                        <p> Video does not exist </p>
                    @else
                        <video src="{{asset($orderAssets->assets->getMedia()[0]->getUrl())}}" controls ></video>
                    @endif
                </div>
                <div class="order-info-block">
                    <p><strong>{{ $order->getIna('title') }}</strong></p>
                    <strong>Participant has attended a live workshop</strong>
                    <p>
                        <span>
                           @if($order->getIna('workshop'))
                                Yes
                            @else
                                No
                            @endif
                        </span>
                    </p>

                    <p><strong>Who is this message for?</strong></p>

                    <p>{{ $order->getIna('whoisfor') }}</p>

                    <p><strong>What is the challenge for this audience?</strong></p>

                    <p>{{ $order->getIna('challenge') }}</p>

                    <p><strong>What is the key takeaway?</strong></p>

                    <p>{{ $order->getIna('takeaway') }}</p>

                    <p><strong>How do you want them to react?</strong></p>

                    <p>{{ $order->getIna('react') }}</p>

                    <p><strong>Other instructions</strong></p>

                    <p>{{ $order->getIna('misc') }}</p>
                </div>
            </div>

        </div>
    </div>
@endsection

