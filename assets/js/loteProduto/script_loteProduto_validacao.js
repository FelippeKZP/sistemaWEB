$(document).ready(function () {
    $('form').validate({
        rules: {
            numero_lote: {
                required: true
            },
            quantidade: {
                required: true
            },
            data_fabricacao: {
                required: true
            },
            data_vencimento: {
                required: true
            }
        },
        messages: {
            numero_lote: {
                required: "Este campo � obrigat�rio."
            },
            produto: {
                required: "Este campo � obrigat�rio."
            },
            fornecedor: {
                required: "Este campo � obrigat�rio."
            },
            quantidade: {
                required: "Este campo � obrigat�rio."
            },
            data_fabricacao: {
                required: "Este campo � obrigat�rio."
            },
            data_vencimento: {
                required: "Este campo � obrigat�rio."
            }
        }
    });
});


