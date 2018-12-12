$(function () {
    $('.bumpbox').click(function () {
        if (!$(this).hasClass('bumped')) {
            $('.collapse').removeClass('in');
            $('.bumpbox').removeClass('bumped');
            $($(this).attr('data-target')).collapse('show');
            $(this).addClass('bumped');
        }
    });

    $('#right-for-me').change(function () {
        $('#iam').html($('#right-for-me option:selected').attr('data-text'));
    });
});