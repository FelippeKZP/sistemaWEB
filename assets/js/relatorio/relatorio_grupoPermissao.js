function openPopup(obj){
    
    
    var data = $(obj).serialize();
    
    var url =  BASE_URL+"relatorio/relatorio_grupoPermissao_pdf?"+data;
    window.open(url,"relatorio de Grupo de Permissão","width=700,height=500");
    
    return false;
}

