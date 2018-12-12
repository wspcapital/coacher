$(function () {
    $('.sprite.open').click(function () {
        $('#header').slideDown();
    });
    $('.sprite.close').click(function () {
        $('#header').slideUp();
    });

    $('.sel-jump').click(function (e) {
        e.preventDefault();
        $('.sel-jump').removeClass('sel');
        $(this).addClass('sel');
        $('.category').hide();
        $('[data-id=' + $(this).attr('data-target') + ']').show();
    });
    if ($('.parallax').length) {
        $(window).scroll(function () {
            var x = $(this).scrollTop();
            $('.parallax').css('background-position', '0% ' + parseInt(-x / 4) + 'px');
        });
    }
});