
function soma(){

    var total_venda = $('#total').val().replace(',', '.');
    var dinheiro = $('#dinheiro').val().replace(',', '.');



    if (total_venda >= dinheiro) {

        var troco = parseFloat(dinheiro) - parseFloat(total_venda);

        $('#troco').val(troco.toFixed(2).replace('.', ','));

    } else {

        alert("teste");

    }


}
