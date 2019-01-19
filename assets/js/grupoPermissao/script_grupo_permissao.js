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
                    url: BASE_URL + 'grupoPermissao/grupo_permissao_deletar/' + id,
                    type: 'POST',
                    success: function () {
                        swal("Grupo de Permissão excluida com sucesso.", {
                            icon: "success",
                        });
                        setTimeout(window.location.href = window.location.href, 50000);                    }
                });
            } else {

            }
        });
}

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

