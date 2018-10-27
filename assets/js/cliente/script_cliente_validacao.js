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
            data_aniversario:{
                required:true
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
                required: "Este Campo é Obrigatório."
            },
            cpf: {
                required: "Este Campo é Obrigatório."
            },
            rg: {
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
            data_aniversario:{
                required: "Este campo é Obrigatório"
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

