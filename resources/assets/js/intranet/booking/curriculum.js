require('./../../../../../node_modules/fullcalendar');
import moment from "moment";

$(function () {
    let eventBackGround = [
        '#86BCFF', '#FFE920', '#DFDF00', '#8ADCFF', '#EFF9FC', '#FFA8D3', '#CBC5F5', '#6CA870', '#FFFFB5', '#F5D0A9',
        '#00FF40', '#2ECCFA', '#FF00BF', '#F3F781', '#8A2908', '#D8CEF6', '#F78181', '#CEF6CE', '#81F781', '#088A68',
        '#8A0886', '#58FAD0', '#F3F781', '#F3E2A9', '#FE2E9A'
    ];
    let bookingId = $('[name="booking_id"]').val();
    ///  произвольное число для массива с цветами
    function randomInteger(min, max) {
        let rand = min + Math.random() * (max - min);
        rand = Math.round(rand);
        return rand;
    }

    function getBackground() {
        let currBackGround = '';

        if(eventBackGround.length > 0)
        {
            let currIndex = randomInteger(0, eventBackGround.length);
            currBackGround = eventBackGround[currIndex];
            eventBackGround.splice(currIndex, 1);
        }
        return currBackGround;
    }

    $('#external-events .fc-event').each(function () {

        // store data so the calendar knows to render an event upon drop
        $(this).data('event', {
            title: $.trim($(this).children('.event-title').text()), // use the element's text as the event title
            stick: true, // maintain when user navigates (see docs on the renderEvent method)
            subtitle: $.trim($(this).children('.subtitle').text()),
            description: $(this).children('#lessonId').val(),
            duration: "00:" + parseInt($(this).children().text()),
            backgroundColor: getBackground(),
            textColor: '#000000'
        });

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
        });

    });

    // We will refer to $calendar in future code
    $("#calendar").fullCalendar({

            // Start of calendar options
            defaultView: 'agendaDay',
            height: 650,
            slotDuration: "00:15:00",
            allDaySlot: false,
            now: $('#curriculum-start-day').val(),
            minTime: "07:00:00",
            maxTime: "21:00:00",
            // Make possible to respond to clicks and selections
            selectable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function () {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },

            eventSources: [
                {
                    url: `/intranet/bookings/curriculum/events/${bookingId}`, // use the `url` property
                    textColor: 'black'  // an option!
                }
            ],
            viewRender: function (currentView) {
                $('#current_day').val(moment(currentView.start).format('YYYY-MM-DD'));
                /// all rows in the table
                let allTr = $('.fc-slats > table > tbody > tr');
                //  console.log(moment(currentView.start).format('MM/DD/YYYY'));
                ///  get schedule from server
                let schedule = getScheduled(moment(currentView.start).format('YYYY-MM-DD'));

                /*  allTr.each(function (index, v) {
                 let timeItem = $(v).attr('data-time');
                 if (timeItem < schedule.start || timeItem >= schedule.end) {
                 $(v).hide();
                 }
                 });*/

                let minDate = moment($('#curriculum-start-day').val()),
                    maxDate = moment($('#curriculum-end-day').val());
                // Past
                if (minDate >= currentView.start && minDate < currentView.end) {
                    $(".fc-prev-button").prop('disabled', true);
                    $(".fc-prev-button").addClass('fc-state-disabled');
                }
                else {
                    $(".fc-prev-button").removeClass('fc-state-disabled');
                    $(".fc-prev-button").prop('disabled', false);
                }
                // Future
                if (maxDate >= currentView.start && maxDate < currentView.end) {
                    $(".fc-next-button").prop('disabled', true);
                    $(".fc-next-button").addClass('fc-state-disabled');
                } else {
                    $(".fc-next-button").removeClass('fc-state-disabled');
                    $(".fc-next-button").prop('disabled', false);
                }
            },

            eventRender: function (event, element) {
                element.find(".fc-bg").css("pointer-events", "none");
                element.find('.fc-title').append("<br/>" + event.subtitle);
                element.append(`<div>
                            <button class="btn btn-danger" id='btnDeleteEvent' >
                            <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </div>`);
                element.append(`<div>
                            <button class="btn btn-success" id='btnEditEvent' >
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                        </div>`);

                /// remove event
                element.find("#btnDeleteEvent").click(function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: "get",
                        url: '/intranet/bookings/curriculum/event/delete',
                        data: {id: event.id},
                        success: function () {
                            $('#calendar').fullCalendar('removeEvents', event._id);
                        },
                        error: function () {
                            $('#calendar').fullCalendar('removeEvents', event._id);
                            console.log('error');
                        }
                    });
                });
                //  edit event
                element.find("#btnEditEvent").click(function (e) {
                    e.preventDefault();
                    let newTitle = prompt("Enter a new title for this ", event.title);
                    let newSubtitle = prompt("Enter a new subtitle for this ", event.subtitle);
                    if (newTitle != null) {
                        // Update event
                        event.title = newTitle.trim() != "" ? newTitle : event.title;
                        event.subtitle = newSubtitle.trim() != "" ? newSubtitle : event.subtitle;
                        // Call the "updateEvent" method
                        $('#calendar').fullCalendar("updateEvent", event);
                    }
                });
                // console.log(event.description);
            },
            // This is the callback that will be triggered when a selection is made.
            // It gets start and end date/time as part of its arguments
            select: function (start, end, events, view) {
                //PopUpShow();
                //   $('#external-events').show();
                // Whatever happens, unselect selection
                // $calendar.fullCalendar("unselect");

            }, // End select callback

            // Make events editable, globally
            editable: true,

            // Callback triggered when we click on an event
// редактирование eventa


        } // End of calendar options
    );

    //Скрыть PopUp при загрузке страницы


    /*  ///////
     $('.fc-event').on('mousedown', function() {
     $(this).addClass('event-active');
     });
     $(document.body).on('mouseup', function() {
     $('.fc-event').removeClass('event-active');
     $('.fc-event').css({'width': 'inherit', 'left':'0', 'top':'0'});
     })*/

    $('#saveForm').on('click', function (e) {
        e.preventDefault();
        submit();
    });
    $('#submitForm').on('click', function (e) {
        e.preventDefault();
        submit();
    });

    $("#days-map-modal").on('click', function (e) {
        e.preventDefault();
        $("#printDaysMapModal").modal('show');
    });

    $("#days-details-modal").on('click', function (e) {
        e.preventDefault();
        $("#printDetailsModal").modal('show');
    });

    $('#print-daymap').on('click', function (e) {
        e.preventDefault();
        $('#printDaysMapModal').find($('.modal-body')).printThis({debug: true, printContainer: false});
    });

    $('#print-details').on('click', function (e) {
        e.preventDefault();
        $('#printDetailsModal').find($('.modal-body')).printThis({debug: true, printContainer: false});
    });

    function getScheduled(currentDay) {
        let schedule = "";
        $.ajax({
            method: 'get',
            async: false,
            url: `/intranet/bookings/getSchedule/${getBookingId()}/${currentDay}`,
            success: function (response) {
                schedule = response.data;
                $("input[name='start_time']").val(schedule.start);
                $("input[name='end_time']").val(schedule.end);
            },
            error: function (error) {
                return error;
            }
        });

        return schedule;
    }


    function getBookingId() {
        let path = location.pathname.slice(1);
        let urlArray = path.split('/');
        return urlArray[urlArray.length - 1];
    }

    //// save schedule
    $("#start_time").on('change', function (e) {
        let data = {
            start: $("#start_time").val(),
            end: $("#end_time").val(),
            current_day: $('#current_day').val(),
            bookingId: getBookingId()
        };
        saveSchedule(data);
    });

    $("#end_time").on('change', function (e) {
        let data = {
            start: $("#start_time").val(),
            end: $("#end_time").val(),
            current_day: $('#current_day').val(),
            bookingId: getBookingId()
        };
        saveSchedule(data);
    });

    function saveSchedule(data) {
        let msg = {
            'data': data,
            '_token': document.querySelector('#token').getAttribute('value')
        };
        $.ajax({
            method: 'post',
            async: false,
            url: `/intranet/bookings/saveSchedule`,
            data: msg,
            success: function (response) {
                console.log('ok')
            },
            error: function (error) {
                console.log(error);
            }
        });
    }


    function submit() {
        let form = $('#bookingForm');
        let clientevents = $('#calendar').fullCalendar('clientEvents');
        //console.log(toJSON(clientevents));
        let curriculum = [];
        if (clientevents.length > 0) {
            clientevents.forEach(function (item, i, arr) {
                let colorEvent = '';
                if (item.color !== undefined) {
                    colorEvent = item.color;
                } else {
                    colorEvent = item.backgroundColor;
                }
                curriculum[i] = {
                    booking_id: bookingId,
                    title: item.title,
                    id: item.id,
                    color: colorEvent,
                    subtitle: item.subtitle,
                    lesson_id: item.description,
                    booking_date: item.start.format("YYYY-MM-DD"),
                    time_start: item.start.format("HH:mm:ss"),
                    time_end: item.end.format("HH:mm:ss"),
                }
            });
            form.append($('<input type="hidden" name="curriculum">').val(JSON.stringify(curriculum)));
        }
        // and submit
        form.get(0).submit();
    }
});

