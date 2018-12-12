require('./libs/top-menu');
require('./libs/global');


/* get bios */
$('div[data-bio]').click(function () {
    $.getJSON('/bio/' + $(this).attr('data-bio'), function (r) {
        $('#bio-modal .modal-title').html(r.name);
        $('#bio-modal .modal-body').html(r.bio);
        $('#bio-modal').modal('show');
    });

});
//// slider
$('.carousel').carousel({
    interval: 100000,
    pause: 'hover',
    wrap: true
});

/* end video player */
$('.get-post').click(function (e) {
    e.preventDefault();
    $.get('/post/' + $(this).attr('data-id'), function (r) {
        $('.sel-jump').removeClass('sel');
        $('.category').hide();
        $('[data-id=post]').html(r.content).show();
        console.log(r);
    }, 'json');
});