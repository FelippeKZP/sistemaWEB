function openPopup(obj) {

    var data = $(obj).serialize();

    var url = BASE_URL + "relatorio/relatorio_contas_pagar_pdf?" + data;
    window.open(url, "relatorio de contas a pagar", "width=700,height=500");

    return false;


}