$(document).ready(function () {
    $('form').validate({
        rules: {
            nome: {
                required: true
            },
            cpf: {
                required: true
            },
            rg: {
                required: true
            },
            telefone: {
                required: true
            },
            email: {
                required: true,
                email:true
            },
            data_cadastro: {
                required: true
            },
            cep: {
                required: true
            },
            bairro: {
                required: true
            },
            rua: {
                required: true
            },
            numero: {
                required: true
            },
            cidade: {
                required: true
            },
            estado: {
                required: true
            },
            pais: {
                required: true
            }
        },
        messages: {
            nome: {
                required: "Este Campo � Obrigat�rio."
            },
            cpf: {
                required: "Este Campo � Obrigat�rio."
            },
            rg: {
                required: "Este Campo � Obrigat�rio."
            },
            telefone: {
                required: "Este Campo � Obrigat�rio."
            },
            email: {
                required: "Este Campo � Obrigat�rio.",
                email:"Este Campo � um Email."
            },
            data_cadastro: {
                required: "Este Campo � Obrigat�rio."
            },
            cep: {
                required: "Este Campo � Obrigat�rio."
            },
            bairro: {
                required: "Este Campo � Obrigat�rio."
            },
            rua: {
                required: "Este Campo � Obrigat�rio."
            },
            numero: {
                required: "Este Campo � Obrigat�rio."
            },
            cidade: {
                required: "Este Campo � Obrigat�rio."
            },
            estado: {
                required: "Este Campo � Obrigat�rio."
            },
            pais: {
                required: "Este Campo � Obrigat�rio."
            }
        }
    });
});

