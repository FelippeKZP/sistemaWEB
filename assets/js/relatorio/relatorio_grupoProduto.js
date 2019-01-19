function openPopup(obj) {

    var data = $(obj).serialize();

    var url = BASE_URL + "relatorio/relatorio_grupoProduto_pdf?" + data;
    window.open(url, "Relatorio Grupos de Produto", "width=700,height=500");

    return false;

}
