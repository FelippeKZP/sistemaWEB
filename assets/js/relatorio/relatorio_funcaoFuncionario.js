function openPopup(obj) {


    var data = $(obj).serialize();

    var url = BASE_URL + "relatorio/relatorio_funcaoFuncionario_pdf?" + data;
    window.open(url, "relatorio de Função de Funcionário", "width=700,height=500");

    return false;
}

