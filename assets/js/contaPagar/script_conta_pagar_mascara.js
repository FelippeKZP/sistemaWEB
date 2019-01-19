jQuery(function ($) {

    $("#data_conta").mask("99/99/9999");
    $('#data_vencimento').mask("99/99/9999");
    $('#data_pagamento').mask("99/99/9999");

});

$(document).ready(function () {

    $('#total').mask('000.000.000.000.000,00', {reverse: true, placeholder: "0,00"});

});