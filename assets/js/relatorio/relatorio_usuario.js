function openPopup(obj) {

    var data = $(obj).serialize();

    var url = BASE_URL + "relatorio/relatorio_usuario_pdf?" + data;

    window.open(url, "relat�rio de usu�rios", "width=700,height=500");

    return false;
}

