$(document).ready(function () {
    $('form').validate({
        rules: {
            nome: {
                required: true
            },
            email:{
                required:true,
                email:true
            },
            senha:{
                required:true
            }
        },
        messages: {
            nome: {
                required: "Este campo é obrigatório."
            },
             email: {
                required: "Este campo é obrigatório.",
                email: "Este campo é um Email."
            },
             senha: {
                required: "Este campo é obrigatório."
            }
        }
    });
});

