<div class="modal" id="printDaysMapModal" tabindex="-1" role="dialog" aria-labelledby="printDaysMapModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div style="margin-bottom: 15px;padding-top: 20px;" class="header">
                    <img src="{{asset('assets/dist/img/vcoach/pinn.png')}}"
                         style="margin-left: 75px;margin-right: 50px;float: left;" align="absmiddle" class="pull-left">

                    <p style="color: #dd5900 !important;font-size: 12pt;margin-left: 50px; font-family: Calibri,sans-serif;">
                        Title:&nbsp;
                            <span style="color: #000000 !important;font-size: 12pt; font-family: Calibri,sans-serif;">
                                {{ $booking->title }}
                            </span>
                    </p>

                    <p style="color: #dd5900 !important;font-size: 12pt;margin-left: 50px; font-family: Calibri, sans-serif;">
                        Company:&nbsp;
                            <span style="color: #000000 !important;font-size: 12pt; font-family: Calibri,sans-serif;">
                                {{ $booking->company }}
                            </span>
                    </p>

                    <p style="color: #dd5900 !important;font-size: 12pt;margin-left: 50px; font-family: Calibri,sans-serif;">
                        Contact Person:&nbsp;
                            <span style="color: #000000 !important;font-size: 12pt;font-family: Calibri,sans-serif;">
                                {{ $booking->company_contact }}
                            </span>
                    </p>
                </div>
                <table cellspacing="0" border="1"
                       style="margin-top: 10px;margin-left: 50px;margin-right: 50px; font-family: Calibri,sans-serif;">
                    @foreach($booking_days as $booking_date => $booking_day)
                        <tr>
                            <td colspan="2" style="width:800px;font-size: 10pt; text-align:center">
                                    <span style="color:#dd5900 !important; font-family: Calibri,sans-serif;">
                                        Day {{ $booking_day['num'] }}({{ $booking_date }})
                                    </span>
                            </td>
                        </tr>
                        @foreach($booking_day['lessons'] as $lesson)

                            <tr>
                                <td style="width:200px;padding-top:10px;font-size: 10pt; font-family: Calibri,sans-serif;"
                                    align="center" valign="top">
                                    <p style="color:#000000 !important;">
                                        {{ $lesson->time_start }}
                                    </p>
                                </td>
                                <td style="padding-left:20px; padding:10px; font-size: 10pt; font-family: Calibri,sans-serif;">
                                    <p style="color:#dd5900 !important; font-weight: 700;">
                                        {{ $lesson->title }}
                                    </p>

                                    <p style="color:#000000 !important;">
                                        {{ $lesson->subtitle }}
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </table>
            </div>
            <div class="modal-footer">
                <button id="print-daymap"> Print</button>
                <button data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>