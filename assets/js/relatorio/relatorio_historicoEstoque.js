function openPopup(obj) {

    var data = $(obj).serialize();

    var url = BASE_URL + "relatorio/relatorio_historicoEstoque_pdf?" + data;

    window.open(url, "relatorio de hist�rico de estoque", "width=700,height=500");

    return false;

}

