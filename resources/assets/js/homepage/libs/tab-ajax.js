$(function() {
    $('.get-post').on('click', function(e) {
        e.preventDefault();
        let data = this.innerHTML;
        ajaxRequest(data);
    });

    $('.imgs').on('click', function(e) {
        e.preventDefault();
        let data  = $(this).next().html();
        ajaxRequest(data);
    });
});


function ajaxRequest(data) {
    $.ajax({
        url: '/getTabContent',
        method: 'get',
        data: {'title' : data},
        success: function(response){
            console.log(response);
            $('.modal-title').html(response.title);
            $('.modal-body').html(response.content);
        },
        error: function (error) {
            console.log('error');
        }
    });
}