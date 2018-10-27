$('#email').on('change', function () {
    var datatype = $(this).attr('data-type');
    var p = $(this).val();

    if (p != '') {
        $.ajax({
            url: BASE_URL + 'ajax/' + datatype,
            type: 'GET',
            data: {p: p},
            dataType: 'json',
            success: function (json) {
                var total;
                for (var i in json) {
                    total = json[i].total;
                }
                if (total == 0) {
                    return true;
                } else {
                    bootbox.alert('O Email informado já existe no banco de dados.');
                    $('#ie').val('');
                }
            }
        });
    }
});