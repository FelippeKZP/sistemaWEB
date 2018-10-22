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
            data_admissao: {
                required: true
            },
            data_aniversario: {
                required: true
            },
            carteira: {
                required: true
            },
            salario: {
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
            data_admissao: {
                required: "Este Campo é Obrigatório."
            },
            data_aniversario: {
                required: "Este Campo é Obrigatório."
            },
            carteira: {
                required: "Este Campo é Obrigatório."
            },
            salario: {
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