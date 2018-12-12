<div class="modal" id="printDetailsModal" tabindex="-1" role="dialog" aria-labelledby="printDetailsModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="header" style="margin-bottom: 20px;padding-top: 20px;">
                    <img src="{{asset('assets/dist/img/vcoach/pinn.png')}}" style="margin-left: 25px;margin-right: 20px;float: left;"  class="pull-left">
                    <div class="caption">
                        <p style="color: #dd5900 !important;font-size: 14pt;margin-left: 50px; font-family: Calibri, sans-serif;">
                            Title:&nbsp;
                                <span style="color: #000000 !important;font-size: 14pt; font-family: Calibri,sans-serif;">
                                    {{ $booking->title }}
                                </span>
                        </p>
                        <p style="color: #dd5900 !important;font-size: 14pt;margin-left: 50px; font-family: Calibri, sans-serif;">
                            Company:&nbsp;
                                <span style="color: #000000 !important;font-size: 14pt; font-family: Calibri,sans-serif;">
                                    {{ $booking->company }}
                                </span>
                        </p>
                        <p style="color: #dd5900 !important;font-size: 14pt;margin-left: 50px; font-family: Calibri, sans-serif;">
                            Contact Person:&nbsp;
                                <span style="color: #000000 !important;font-size: 14pt; font-family: Calibri,sans-serif;">
                                    {{ $booking->company_contact }}
                                </span>
                        </p>
                    </div>
                </div>
                <table class="table">
                    @foreach($booking_days as $booking_date => $booking_day)
                        <tr>
                            <td colspan="2" style="width:1200px;border-top: 2px solid black;border-bottom: 2px solid black; text-align: center;">
                                <h5 style="color: #dd5900;font-family: Calibri,sans-serif; font-weight: 700; font-size: 14pt;">
                                    Day {{ $booking_day['num'] }}
                                        <span>
                                            ({{ \Carbon\Carbon::parse($booking_day['time_start'])->format('H:i A') }} -
                                            {{ \Carbon\Carbon::parse($booking_day['time_end'])->format('H:i A') }})
                                        </span>
                                </h5>
                            </td>
                        </tr>
                        @foreach($booking_day['lessons'] as $lesson)
                            <tr>
                                <td style="color: #000000;padding:3px 0;padding-top: 10px; width:300px;font-family: Calibri,sans-serif;" align="left" valign="top">
                                    <strong>
                                        {{ $lesson->title }}
                                    </strong>
                                </td>
                                <td style="color: #000000;padding:3px 0; width:500px;font-family: Calibri,sans-serif;font-size: 12px;">
                                    <p style="font-weight: 700; color: #000000;">
                                        {{ $lesson->subtitle }}
                                    </p>
                                    <p>
                                        {{ $lesson->description }}
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </table>
            </div>
            <div class="modal-footer">
                <button id="print-details">Print</button>
                <button data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
