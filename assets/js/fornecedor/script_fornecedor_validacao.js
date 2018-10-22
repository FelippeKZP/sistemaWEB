$(document).ready(function () {
    $('form').validate({
        rules: {
            razao_social: {
                required: true
            },
             nome_fantasia: {
                required: true
            },
            cnpj: {
                required: true
            },
            ie: {
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
            razao_social: {
                required: "Este Campo é Obrigatório."
            },
            nome_fantasia:{
                required: "Este Campo é Obrigatório."
            },
            cnpj: {
                required: "Este Campo é Obrigatório."
            },
            ie: {
                required: "Este Campo é Obrigatório."
            },
            telefone: {
                required: "Este Campo é Obrigatório."
            },
            email: {
                required: "Este Campo é Obrigatório.",
                email:"Este Campo é um Email."
            },
            data_cadastro: {
                required: "Este Campo é Obrigatório."
            },
            cep: {
                required: "Este Campo é Obrigatório."
            },
            bairro: {
                required: "Este Campo é Obrigatório."
            },
            rua: {
                required: "Este Campo é Obrigatório."
            },
            numero: {
                required: "Este Campo é Obrigatório."
            },
            cidade: {
                required: "Este Campo é Obrigatório."
            },
            estado: {
                required: "Este Campo é Obrigatório."
            },
            pais: {
                required: "Este Campo é Obrigatório."
            }
        }
    });
});

