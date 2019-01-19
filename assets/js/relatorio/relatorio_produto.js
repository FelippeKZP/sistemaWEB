function openPopup(obj) {

    var data = $(obj).serialize();

    var url = BASE_URL + "relatorio/relatorio_produto_pdf?" + data;

    window.open(url, "relat�rio de produtos", "width=700,height=500");

    return false;

}