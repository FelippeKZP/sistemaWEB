function excluir(id) {
    swal({
        title: "Deseja Realmente Excluir ?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        buttons: ["Fechar", "Confirmar"],
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: BASE_URL + 'cliente/cliente_deletar/' + id,
                    type: 'POST',
                    success: function () {
                        swal("Cliente excluido com sucesso.", {
                            icon: "success",
                        });
                        setTimeout(window.location.href = window.location.href, 50000);
                    }
                });
            } else {

            }
        });
}

$('input[name=cep]').on('blur', function () {
    var cep = $(this).val();

    $.ajax({
        url: 'http://api.postmon.com.br/v1/cep/' + cep,
        type: 'GET',
        dataType: 'json',
        success: function (json) {
            if (typeof json.logradouro != 'undefined') {
                $('input[name=rua]').val(json.logradouro);
                $('input[name=bairro]').val(json.bairro);
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
                } else {
                    return true;
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
                    $('#email').val('');
                }
            }
        });
    }
});

function pegarCidades(obj) {
    var item = obj.value;

    $.ajax({
        url: BASE_URL + "ajax/pegar_cidades",
        type: "POST",
        data: {estado: item},
        dataType: 'json',
        success: function (json) {
            var html = '';
            for (var i in json) {
                html += '<option value="' + json[i].id + '">' + json[i].nome + '</option>'
            }

            $('#cidade').html(html);
        }
    });
}

jQuery(function ($) {

    $("#telefone").mask("(99) 9999-9999");
    $("#data_cadastro").mask("99/99/9999");
    $('#data_aniversario').mask("99/99/9999");
    $("#cep").mask("99999-999");
    $("#numero").mask("99999999");
});

$("#cpf").keydown(function () {
    try {
        $("#cpf").unmask();
    } catch (e) {
    }

    var tamanho = $("#cpf").val().length;

    if (tamanho < 11) {
        $("#cpf").mask("999.999.999-99");
    } else if (tamanho >= 11) {
        $("#cpf").mask("99.999.999/9999-99");
    }

    // ajustando foco
    var elem = this;
    setTimeout(function () {
        // mudo a posi��o do seletor
        elem.selectionStart = elem.selectionEnd = 10000;
    }, 0);
    // reaplico o valor para mudar o foco
    var currentValue = $(this).val();
    $(this).val('');
    $(this).val(currentValue);
});


$(document).ready(function () {
    $('form').validate({
        rules: {
            nome: {
                required: true
            },
            cpf: {
                required: true
            },
            telefone: {
                required: true
            },
            email: {
                email: true
            },
            data_cadastro: {
                required: true
            },
            estado: {
                required:true
            },
            cidade:{
                required:true
            }
        },
        messages: {
            nome: {
                required: "Este Campo é Obrigatório."
            },
            cpf: {
                required: "Este Campo é Obrigatório."
            },
            telefone: {
                required: "Este Campo é Obrigatório."
            },
            email: {
                email: "Este Campo é um Email."
            },
            data_cadastro: {
                required: "Este Campo é Obrigatório."
            },
            estado:{
                required:"Este Campo é Obrigatório."
            },
            cidade:{
                required:"Este Campo é Obrigatório."
            }
        }
    });
});

