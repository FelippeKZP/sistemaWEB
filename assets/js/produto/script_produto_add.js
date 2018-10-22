function lucro() {


	var preco_venda = $('#preco').val().replace(',', '.');
	var preco_compra = $('#preco_compra').val().replace(',', '.');


	var lucro_venda = parseFloat(preco_venda) - parseFloat(preco_compra);

	var margem_bruta = parseFloat(lucro_venda) / parseFloat(preco_venda) * 100;

	$('#lucro_venda').val(lucro_venda.toFixed(2).replace('.', ','));
	$('#margem_bruta').val(margem_bruta.toFixed(2) + '%');
}