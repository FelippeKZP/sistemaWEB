$(document).ready(function () {
    $('form').validate({
        rules: {
            nome: {
                required: true
            }
        },
        messages: {
            nome: {
                required: "Este campo é obrigatório."
            }
        }
    });
});

