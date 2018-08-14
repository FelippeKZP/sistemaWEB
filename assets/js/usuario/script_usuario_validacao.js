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
                required: "Este campo � obrigat�rio."
            },
             email: {
                required: "Este campo � obrigat�rio.",
                email: "Este campo � um Email."
            },
             senha: {
                required: "Este campo � obrigat�rio."
            }
        }
    });
});

