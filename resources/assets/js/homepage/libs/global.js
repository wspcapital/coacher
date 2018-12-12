$(function () {
    /* searching through content */
    $('.search').keyup(function () {
        var $s = $('.searchable'), search = $.trim($(this).val().toLowerCase()), $p = $('.search-panel');
        $s.removeClass('hidden');
        $p.removeClass('hidden');
        $s.each(function () {
            var isFound = false;
            $(this).find('.title, .description').each(function () {
                if ($(this).text().toLowerCase().indexOf(search) !== -1) {
                    isFound = true;
                }
            });
            if (!isFound) {
                $(this).addClass('hidden');
            }
        });

        //kill panels with no searchable
        $.each($p, function () {
            if (!($(this).find('.searchable:not(.hidden)').length)) {
                $(this).addClass('hidden');
            }
        });

        //pop open results
        $('.collapse').addClass('in');
    });

    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    //Youtube video pops
    let $overlay = $('<div id="overlay" class="hidden"><div class="content"> <a href="#" class="sprite x"></a> <div class="video"></div></div></div>');
    $overlay.prependTo('body');
    $('.sprite.x,#overlay').click(function (e) {
        e.preventDefault();
        $overlay.addClass('hidden').find('.video').html('');

    });

    $('.youtube-pop').click(function (e) {
        e.preventDefault();
        $overlay.removeClass('hidden').find('.video').html('<iframe src="' + $(this).prop('href') + '?autoplay=true" width="100%" height="100%" src="" frameborder="0" allowfullscreen></iframe>');
    });

});