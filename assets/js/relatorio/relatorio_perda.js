function openPopup(obj) {

    var data = $(obj).serialize();

    var url = BASE_URL + "relatorio/relatorio_perda_pdf?" + data;
    window.open(url, "relatorio de perdas", "width=700,height=500");

    return false;


}