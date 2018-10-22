$('input[name=cep]').on('blur', function () {
    var cep = $(this).val();

    $.ajax({
        url: 'http://api.postmon.com.br/v1/cep/' + cep,
        type: 'GET',
        dataType: 'json',
        success: function (json) {
            if(typeof json.logradouro != 'undefined') {
                $('input[name=rua]').val(json.logradouro);
                $('input[name=bairro]').val(json.bairro);
                $('input[name=cidade]').val(json.cidade);
                $('input[name=estado]').val(json.estado);
                $('input[name=pais]').val("Brasil");
                $('input[name=numero]').focus();
            }

        }
    });
});

$('#cnpj').on('change', function () {
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

                if (total <= 0) {
                    return true;
                } else {
                    bootbox.alert('O CNPJ informado já existe no banco de dados.');
                    $('#cnpj').val('');
                }
            }
        });
    }
});

$('#ie').on('change', function () {
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
                if (total <= 0) {
                    return true;
                } else {
                    bootbox.alert('O IE informado já existe no banco de dados.');
                    $('#ie').val('');
                }
            }
        });
    }
});