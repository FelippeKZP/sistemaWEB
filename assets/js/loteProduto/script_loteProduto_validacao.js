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
                required: "Este campo é obrigatório."
            },
            produto: {
                required: "Este campo é obrigatório."
            },
            fornecedor: {
                required: "Este campo é obrigatório."
            },
            quantidade: {
                required: "Este campo é obrigatório."
            },
            data_fabricacao: {
                required: "Este campo é obrigatório."
            },
            data_vencimento: {
                required: "Este campo é obrigatório."
            }
        }
    });
});


