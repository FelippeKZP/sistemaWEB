function excluir(id) {
    swal({
        title: "Deseja Realmente Excluir ?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        buttons: ["Fechar", "Confirmar"],
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: BASE_URL + 'usuario/usuario_deletar/' + id,
                    type: 'POST',
                    success: function () {
                        swal("Usuário excluido com sucesso.", {
                            icon: "success",
                        });
                        setTimeout(window.location.href = window.location.href, 50000);
                    }
                });
            } else {

            }
        });
}

function excluirImagem(id) {
    swal({
        title: "Deseja Realmente Excluir ?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        buttons: ["Fechar", "Confirmar"],
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: BASE_URL + 'usuario/excluir_imagem/' + id,
                    type: 'POST',
                    success: function () {
                        swal("Foto do usuário excluido com sucesso.", {
                            icon: "success",
                        });
                        setTimeout(window.location.href = window.location.href, 50000);
                    }
                });
            } else {

            }
        });
}


$('#email').on('change', function () {
    var datatype = $(this).attr('data-type');
    var p = $(this).val();

    if (p != '') {
        $.ajax({
            url: BASE_URL + 'ajax/' + datatype,
            type: 'GET',
            data: {p: p},
            dataType: 'json',
            success: function (json) {
                var total;
                for (var i in json) {
                    total = json[i].total;
                }
                if (total == 0) {
                    return true;
                } else {
                    bootbox.alert('O Email informado já existe no banco de dados.');
                    $('#email').val('');
                }
            }
        });
    }
});

$(document).ready(function () {
    $('form').validate({
        rules: {
            nome: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            senha: {
                required: true
            },
            id_grupo_permissao: {
                required: true
            },
            status: {
                required: true
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
            },
            id_grupo_permissao: {
                required: "Este campo é obrigatório."
            },
            status: {
                required: "Este campo é obrigatório."
            }
        }
    });
});



$(document).ready(function() {

        var readUrl = function(input) {

            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.readAsDataURL(input.files[0]);

                reader.onload = function(e) {
                    $(".avatar").attr('src', e.target.result);
                }

            }
        }

        $(".upload").on('change', function() {
            readUrl(this);
        });

        $(".avatar").click(function() {
            var btn = $(".upload");
            btn.trigger('click');
        });
    }
);