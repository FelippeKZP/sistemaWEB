$(function () {

    $('#searchs').on('on focus', function () {
        if ($(this).val() == '') {
            $(this).animate({
                width: '200px'
            }, 'fast');
        }
    });
});

$(function () {

    $('#searchs2').on('on focus', function () {
        if ($(this).val() == '') {
            $(this).animate({
                width: '200px'
            }, 'fast');
        }
    });
});

