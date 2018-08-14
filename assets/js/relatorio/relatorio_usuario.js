function openPopup(obj) {

    var data = $(obj).serialize();

    var url = BASE_URL + "relatorio/relatorio_usuario_pdf?" + data;

    window.open(url, "relatório de usuários", "width=700,height=500");

    return false;
}

