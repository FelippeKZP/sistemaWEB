$(document).ready(function () {
    $('form').validate({
        rules: {
            nome: {
                required: true
            },
            descricao:{
                required:true
            }
        },
        messages: {
            nome: {
                required: "Este campo é obrigatório."
            },
            descricao:{
                required: "Este campo é obrigatório."
            }
        }
    });
});

