$(function () {

    $('#searchs').on('on focus', function () {
        if ($(this).val() == '') {
            $(this).animate({
                width: '200px'
            }, 'fast');
        }
    });
});


setTimeout("document.location = BASE_URL + 'cliente' ",1000 * 60 * 60 * 24);