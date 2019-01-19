function openPopup(obj) {

    var data = $(obj).serialize();

    var url = BASE_URL + "relatorio/relatorio_contas_receber_pdf?" + data;
    window.open(url, "relatorio de contas a receber", "width=700,height=500");

    return false;

}