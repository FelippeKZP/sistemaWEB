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
                required: "Este campo � obrigat�rio."
            },
            nome: {
                required: "Este campo � obrigat�rio."
            },
            quantidade_min: {
                required: "Este campo � obrigat�rio."
            },
            preco: {
                required: "Este campo � obrigat�rio."
            },
            preco_compra: {
                required: "Este campo � obrigat�rio."
            }
        }
    });
});
