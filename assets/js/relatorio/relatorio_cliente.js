function openPopup(obj){
    
	var data = $(obj).serialize();

	var url = BASE_URL+"relatorio/relatorio_cliente_pdf?"+data;
	window.open(url, "relatorio de cliente", "width=700,height=500");

	return false;

   
}