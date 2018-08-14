function openPopup(obj) {

    var data = $(obj).serialize();

    var url = BASE_URL + "relatorio/relatorio_fornecedor_pdf?" + data;
    window.open(url, "relatorio de fornecedor", "width=700,height=500");

    return false;
}
