let path = location.pathname.slice(1);
let moduleName = path.split('/');

if (moduleName.length > 2 && moduleName[3] !== 'new') {
    require('./../responsive-table');
}

$(function () {
    $('#basic-addon2').on('click', function(e) {
        e.preventDefault();
        let query = $('#search-text').val();
        $.get(`/intranet/libs/search/${query}`).then((response) => {
            $('#main-block').html(response);
        }, (response) => {
            // error callback
            console.log('error')
        });
    })
});