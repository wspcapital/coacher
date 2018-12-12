@extends('intranet.template.app')
@section('style')
    @parent
    <link rel="stylesheet" href="{{asset('assets/dist/css/intranet/payments.min.css')}}">
@endsection
@section('main-content')
    <div class="clearfix">
        {{ $payments->links() }}
    </div>
    <table id="miyazaki">
        <thead>
        <tr>
            <th>ID</th>
            <th>Created At</th>
            <th>Status</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>Amount</th>
            <th>Currency</th>
            <th>Vcoaches</th>
            <th>Sessions</th>
            <th>Description</th>
            <th>Coupon</th>
            <th>Failure</th>
        </tr>
        </thead>
        <tbody>
        @forelse($payments as $payment)
            <tr>
                <td>
                    <p>{{ $payment->id }}</p>
                </td>
                <td>
                    <p>{{ $payment->created_at->format('m/d/Y H:i:s') }}</p>
                </td>
                <td>
                    <p><span class="label label-{{$payment->getStatusClass()}}">{{ $payment->status }}</span></p>
                </td>
                <td>
                    <p><a href="/intranet/user/{{ $payment->user->id }}">{{ $payment->user->getFullName() }}</a></p>
                </td>
                <td>
                    <p> {{ $payment->user->email }}</p>
                </td>
                <td>
                    <p>{{ $payment->amount_format }}</p>
                </td>
                <td>
                    <p>{{ strtoupper($payment->currency) }}</p>
                </td>
                <td>
                    <p>{{ $payment->vcoaches_qty }}</p>
                </td>
                <td>
                    <p>{{ $payment->sessions_qty }}</p>
                </td>
                <td>
                    <p>{{ $payment->description }}</p>
                </td>
                <td>
                    @if($payment->coupon)
                        <small><code>{{ $payment->coupon->code }}</code></small>
                    @elseif($payment->coupon_id)
                        <span class="text-muted text-nowrap"
                              title="This coupon has been deleted"
                              data-toggle="tooltip"
                              data-placement="right">Coupon ID: {{ $payment->coupon_id }}</span>
                    @else
                        <p> &minus; </p>
                    @endif
                </td>
                <td class="text-danger">
                    <p>
                <span @if(mb_strlen($payment->failure_message) > 50)data-toggle="popover" data-placement="left"
                      data-trigger="hover" data-content="{{{ $payment->failure_message }}}"@endif>
                    @if($payment->failure_code){{ $payment->failure_code }}:@endif
                    {{ str_limit($payment->failure_message, 50) }}
                </span>
                    </p>
                </td>
            </tr>
        @empty
            <tr class="warning">
                <td colspan="12" class="text-center text-warning">No payments</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection