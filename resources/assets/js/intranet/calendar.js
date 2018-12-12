require('./../../../../node_modules/jquery-ui');
require('./../../../../node_modules/fullcalendar');
require('./../../../../node_modules/printthis');

$(function () {

    let calendar = $('#calendar');
    let source = '/intranet/calendar-events';

    calendar.fullCalendar({
        events: source,
        height: 'auto',
        timezone: 'local',
        eventRender: function (event, element) {
            if(typeof event.title === 'object'){
                let icons = '';
                if(typeof event.title.icons === 'object')
                {
                    event.title.icons.forEach(function(icon){
                        icons += "<img src='/assets/dist/img/intranet/calendar/" + icon + ".png' />";
                    });
                }

                let eventTitle = '';

                if(event.title.fullName !== null) eventTitle += event.title.fullName;
                if(event.title.company !== null) eventTitle += '&#58;&nbsp;' + event.title.company;
                if(event.title.location_city !== null) eventTitle += '&nbsp;&#40;' + event.title.location_city + '&#41;';
                if(event.title.icons !== null) eventTitle += '&nbsp;<span class="icons">' + icons + '</span>&nbsp;';
                if(event.title.logistics_ddp == '1') eventTitle += '&nbsp;<i class="fa fa-bus" aria-hidden="true"></i>&nbsp;';
                if(event.title.note !== null) eventTitle += event.title.note;

                element.find('.fc-title').html(eventTitle);
            }
            else element.find('.fc-title').html(event.title);
        },

        eventClick: function (calEvent, jsEvent, view) {
            if (calEvent.booking_type == 'Workshop')
            {
                $.ajax({
                    url: `/intranet/calendar-infoBooking?booking_id=${calEvent.booking_id}`,
                    method: 'get',
                    success: function (responce) {
                        $('.modal-body').html(responce);
                        $("#myModal").modal('show');
                    },
                    error: function (e) {
                        console.log('error');
                    }
                });
                return false;
            }
        }
    });

    $("select").on('change', function () {
        let filtr = '';
        let user = $("[name='user']").val();
        let type = $("[name='type']").val();
        let location = $("[name='location']").val();
        if (user.length > 0)
            filtr += '?user=' + encodeURIComponent(user);
        if (type.length > 0)
            if (filtr.length > 0)
                filtr += '&type=' + encodeURIComponent(type);
            else filtr += '?type=' + encodeURIComponent(type);
        if (location.length)
            if (filtr.length > 0)
                filtr += '&location=' + encodeURIComponent(location);
            else filtr += '?location=' + encodeURIComponent(location);
        if (filtr.length > 0) {
            calendar.fullCalendar('removeEventSource', source);
            calendar.fullCalendar('refetchEvents');
            calendar.fullCalendar('addEventSource', '/intranet/calendar-events' + filtr);
            calendar.fullCalendar('refetchEvents');
            source = '/intranet/calendar-events' + filtr;
        } else {
            calendar.fullCalendar('removeEventSource', source);
            calendar.fullCalendar('refetchEvents');
            calendar.fullCalendar('addEventSource', '/intranet/calendar-events');
            calendar.fullCalendar('refetchEvents');
            source = '/intranet/calendar-events';
        }

    });

    $("form").on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            method: "GET",
            url: '/intranet/calendar-search',
            data: {term: encodeURIComponent($("[name='calendar_search']").val())}
        }).done(function (data) {
            console.log(data);
        }).fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

});

