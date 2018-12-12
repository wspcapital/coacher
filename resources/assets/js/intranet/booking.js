let pathBooking = location.pathname.slice(1);
let moduleNameBooking = pathBooking.split('/');
if(moduleNameBooking[2] === 'new')
{
    require('./booking/new_booking');
}
else
{
    require('./../../../../node_modules/jquery-ui');
    require('./booking/trainers');
    require('./booking/participant');
    require('./booking/curriculum');
    require('./booking/attachments');
    require('./booking/logistics');
    require('./booking/location');
}


$(function(){

    $("#print-booking-modal").on('click', function(e){
        e.preventDefault();
        $("#printModal").modal('show');
    });

    $('#print-booking').on('click', function(e) {
        e.preventDefault();
        $('#printModal').find($('.modal-body')).printThis({debug: true, printContainer: false});
    });
});



