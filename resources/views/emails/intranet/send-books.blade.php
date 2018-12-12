Dear Admin,
<br><br>
A book order request was submitted with the following workshop information:
<br><br>
Workshop ID: {{$booking->id}}
<br>Customer: {{$booking->company}}
<br>Workshop: {{$booking->title}}
<br>Workshop Date: {{$booking->start_date}} - {{$booking->end_date}}
<br>Rouser:
<br>Qty: {{$booking->part}}
<br>Custom Workbook: {{$booking->customwb ? 'Yes' : 'No'}}
<br>Workbook:{{$booking->workbook}}
<br>Tracking Number: {{$booking->pdptrack}}
<br>Shipping Info: {{$booking->pdpship}}
<br>PDP Included: {{$booking->pdp ? 'Yes' : 'No'}}
<br>
Relationship Manager: {{$booking->rm->full_name}}
<br><br>
Pinper.com System Notification