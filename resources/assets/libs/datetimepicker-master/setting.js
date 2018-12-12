$(function () {
    $("input[name='due_at']").datetimepicker({
        format:'Y/m/d h:i a', formatTime: 'h:i a',
        lang:'en'
    });

    $("input[name='start_date']").datetimepicker({
        timepicker: false,
        format: 'm/d/Y',
        scrollInput: false
    });

    $("input[name='end_date']").datetimepicker({
        timepicker: false,
        format: 'm/d/Y',
        scrollInput: false
    });

    $("#start_time").datetimepicker({
        datepicker : false,
        ampm: true, // FOR AM/PM FORMAT
        format: 'g:i a',
        formatTime: 'g:i a',
        scrollInput: false
    });
    $("#end_time").datetimepicker({
        datepicker : false,
        ampm: true, // FOR AM/PM FORMAT
        format: 'g:i a',
        formatTime: 'g:i a',
        scrollInput: false
    });
});