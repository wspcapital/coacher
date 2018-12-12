<h3>Virtual Coach Credits</h3>
<table class="table">
    <thead>
    <tr>
        <th>Type</th>
        <th>Amount</th>
        <th>Creditor</th>
        <th>Booking ID</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach($credits as $credit)
        <tr>
            <td>
                <p>{{ $credit->type }}</p>
            </td>
            <td>
                <p>{{ $credit->amount }}</p>
            </td>
            <td>
                <p>{{ $credit->creditor->full_name }}</p>
            </td>
            <td>
                <p>{{ $credit->booking_id }}</p>
            </td>
            <td>
                <p>{{ $credit->created_at->format('m/d/y') }}</p>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>