jQuery(function ($) {

    $("#quantidade_perda").mask("99999999");

});

$(document).ready(function () {
    $('form').validate({
        rules: {
            quantidade_perda: {
                required: true
            },
            motivo: {
                required: true
            }
        },
        messages: {
            quantidade_perda: {
                required: "Este campo é obrigatório."
            },
            motivo: {
                required: "Este campo é obrigatório."
            }
        }
    });
});

function soma() {

    var quantidade = $('#quantidade').val();
    var preco = $('#preco').val().replace(',', '.');
    var quantidadePerda = $('#quantidade_perda').val();


    if (parseInt(quantidadePerda) <= parseInt(quantidade)) {

        var total = parseInt(quantidadePerda) * parseFloat(preco);

        $('#total_perda').val(total.toFixed(2).replace('.', ','));

    } else {

        bootbox.alert("Quantidade da Perda tem que ser menor ou igual a quantidade do lote.");

        $('#quantidade_perda').val('');
        $('#total_perda').val('');

    }

}


