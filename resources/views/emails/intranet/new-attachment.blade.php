{{$user->full_name}} uploaded the file {{$bookingAssets->assets->getMedia()[0]->file_name}} with share to you.
<br><br>
Document Name: {{$bookingAssets->assets->getMedia()[0]->file_name}} <br/>
Booking Sheet Link: <a href="https://www.pinper.com/intranet/booking/{{$bookingAssets->booking_id}}">
    pinper.com/intranet/booking/{{$bookingAssets->booking_id}}
    &nbsp;</a><br/>
Client: {{$user->full_name}} <br/>
Workshop Date: {{$bookingAssets->booking->start_date}} <br/>
RM: @if($bookingAssets->booking->rm != null)
    {{ $bookingAssets->booking->rm->full_name }}, <br/>
@endif
<br><br>

