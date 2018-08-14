$(document).ready(function () {
    $('form').validate({
        rules: {
            cod_barras: {
                required: true
            },
            nome: {
                required: true
            },
            quantidade_min: {
                required: true
            },
            preco: {
                required: true
            },
            preco_compra: {
                required: true
            }
        },
        messages: {
            cod_barras: {
                required: "Este campo é obrigatório."
            },
            nome: {
                required: "Este campo é obrigatório."
            },
            quantidade_min: {
                required: "Este campo é obrigatório."
            },
            preco: {
                required: "Este campo é obrigatório."
            },
            preco_compra: {
                required: "Este campo é obrigatório."
            }
        }
    });
});
