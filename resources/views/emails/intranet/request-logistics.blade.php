Dear {{ $booking->company_contact }},<br>
<br>
In preparation for the upcoming Pinnacle experience workshop at {{ $booking->company }},
we would like for you to complete this logistics form to help us satisfy the necessary requirements.<br>
<br>
Click the link below to access the form.<br>
<br>
{{ link_to_action('DocController@getLogistics', null, $booking->share_hash) }}<br>
<br>
Regards, {{ $booking->rm->full_name }}<br>
{{ $booking->rm->email }}<br>
<br>
Pinper.com System Notification