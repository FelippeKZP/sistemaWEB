$(document).ready(function () {

    $('form').validate({
        rules: {
            dinheiro: {
                required: true
            }
        },
        messages: {
            dinheiro: {
                required: "Este Campo É Obrigatório."
            }
        }
    });

});

$(document).ready(function () {

    $('#dinheiro').mask('000.000.000.000.000,00', {reverse: true, placeholder: "0,00"});

    $('#troco').mask('000.000.000.000.000,00', {reverse: true, placeholder: "0,00"});

});

function soma() {

    var total_venda = $('#total').val().replace(',', '.');
    var dinheiro = $('#dinheiro').val().replace(',', '.');

    if (parseFloat(dinheiro) >= parseFloat(total_venda)) {

        var troco = parseFloat(dinheiro) - parseFloat(total_venda);

        $('#troco').val(troco.toFixed(2).replace('.', ','));

    } else {

        bootbox.alert("Dinheiro Tem Que Ser Maior Que O Total Da Venda");

        $('#dinheiro').val('');
        $('#troco').val('');

    }

}

