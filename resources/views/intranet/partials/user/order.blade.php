<div id="order-history">
    <p><strong>Order History</strong></p>
    <table id="miyazaki">
        <thead>
        <tr>
            <th>Order</th>
            <th>Type</th>
            <th>Coach</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($user->bookingParticipant as $participant)
            @foreach($participant->orders as $order)
                @if($order->status != -1)
                    <tr>
                        <td>
                            <p><a href="{{ route('order', $order->id) }}">
                                    {{ $order->id }}
                                </a></p>
                        </td>
                        <td>
                            <p>{{ $order->type }}</p>
                        </td>
                        <td>
                            <p>
                                @if($order->orderTrainer)
                                    {{ $order->orderTrainer->full_name }}
                                @endif
                            </p>
                        </td>
                        <td>
                            <p>{{ $order->created_at->format('m/d/y') }}</p>
                        </td>
                        <td>
                            <p>{{ $order->getStatus() }}</p>
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        </tbody>
    </table>
</div>