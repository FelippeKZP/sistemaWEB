function openPopup(obj) {

    var data = $(obj).serialize();

    var url = BASE_URL + "relatorio/relatorio_produtoMaisVendido_pdf?" + data;

    window.open(url, "relat�rio de produtos mais vendido", "width=700,height=500");

    return false;

}
