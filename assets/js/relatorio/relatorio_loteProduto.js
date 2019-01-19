function openPopup(obj) {

    var data = $(obj).serialize();

    var url = BASE_URL + "relatorio/relatorio_loteProdutos_pdf?" + data;

    window.open(url, "relat�rio de lote de produto", "width=700,height=500");

    return false;

}


