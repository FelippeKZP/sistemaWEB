$('input[name=cep]').on('blur', function () {
     var cep = $(this).val();
     
     $.ajax({
         url: 'http://api.postmon.com.br/v1/cep/' + cep,
         type: 'GET',
         dataType: 'json',
         success: function(json){
             if(typeof json.logradouro != 'undefined'){
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


$('#cpf').on('change', function () {
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
                    bootbox.alert('O CPF/CNPJ informado já existe no banco de dados.');
                    $('#cpf').val('');
                }
            }
        });
    }
});

$('#rg').on('change', function () {
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
                    bootbox.alert('O RG/IE informado já existe no banco de dados.');
                    $('#rg').val('');
                }
            }
        });
    }
});

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
                    $('#rg').val('');
                }
            }
        });
    }
});

