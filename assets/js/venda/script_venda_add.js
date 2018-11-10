/* global parseFloat */

$(document).ready(function () {

    $('form').validate({
        rules: {
            cliente_nome: {
                required: true
            }
        },
        messages: {
            cliente_nome: {
                required: "A Escolha do  Cliente é Obrigatório."
            }
        }
    });
});

$(document).ready(function(){
 
 $('#desconto').mask('000.000.000.000.000,00' , { reverse : true,placeholder:"0,00"});
 
});

$('#condicao_pag').on('change', function () {

    if ($(this).val() == 1) {
        $('#data_venc').show();
        $('#parcelas').show();
        $('#btGerar').show();
    } else {
        $('#data_venc').show();
        $('#parcelas').hide();
        $('.resultado_parcelas').hide();
        $('#btGerar').hide();
    }

});

$(function () {
    $('#btGerar').click(function () {
        $('.resultado_parcelas').show();
        $('#tabela_parcelas tbody tr').remove();

        var total_venda = $("#total_venda").val().replace(',', '.');
        

        var qtde_parcelas = $('#n_parcelas').val();

        var valorParcela = parseFloat(total_venda) / qtde_parcelas;

        /* Capture o tempo em milissegundos desde 01/01/1970 */
        var time = Date.parse($('#data_vencimento').val().split("-"));

        /* Instancia o objeto Date e define a data em milissegundos */
        vencimento = new Date();
        vencimento.setTime(time);

        for (i = 1; i <= qtde_parcelas; i++) {
            var data = vencimento;

            $('#tabela_parcelas tbody').append("<tr id=\"row_nf-" + i + "\" class=\"nf\"><td>" + i + " de " + qtde_parcelas + "</td><td title=\"vencimento\" class=\"text-center\">" + data.toLocaleString("pt-BR") + "</td><td>" + valorParcela.toFixed(2).replace('.',',') + "</td></tr>");

            /* Captura o dia do mês e soma mais 30 dias */
            vencimento.setMonth(data.getMonth() + 1);

        }

        return false;
    });
});


function desc() {
    var desconto = $('#desconto').val().replace(',', '.');
    var total = $('#total_venda').val().replace(',', '.');

    if (parseFloat(desconto) < parseFloat(total)) {

        var totalAtt = parseFloat(total) - parseFloat(desconto);

        $('#total_venda').val(totalAtt.toFixed(2).replace('.', ','));

    } else {

       bootbox.alert("Desconto tem que se menor que o  total da venda");
       $('#desconto').val('');
   }
}

function validacao() {

    var valor = document.getElementById("total_venda").value;

    if (valor <= 0) {
        bootbox.alert("Adicione Pelo Menos Um Produto Para Eftivar a Venda.");
        return false;
    } else {
        return true;
    }

}


function somenteNumero(e) {
    var tecla = (window.event) ? event.keyCode : e.which;
    if ((tecla > 47 && tecla < 58))
        return true;
    else {
        if (tecla == 8 || tecla == 0)
            return true;
        else
            return false;
    }
}

function atualizarTotal() {
    var total = 0;

    for (var q = 0; q < $('.p_quant').length; q++) {

        var quant = $('.p_quant').eq(q);

        var preco = quant.attr('data-preco');
        var subtotal = preco = parseFloat(preco).toFixed(2).replace(',', '.') * parseInt(quant.val());

        total += subtotal;

    }

    $('input[name=total_venda]').val(total.toFixed(2).replace('.', ','));
}

function delProd(obj) {
    $(obj).closest('tr').remove();
    atualizarTotal();
}


function atualizarSubTotal(obj) {
    var estoque = $(obj).attr('data-estoque');
    var quant = $(obj).val();

    var att = estoque - quant;

    if (quant <= 0) {
        $(obj).val(1);
        quant = 1;

    }

    if (att < 0) {
        bootbox.alert("Quantidade Insuficiente Do Lote de Produto, Quantidade no Estoque: " + estoque);
        quant = $(obj).val(1);
        subtotal = preco * 1;
        atualizarTotal();
        return false;

    } else {
        var preco = $(obj).attr('data-preco');
        preco = parseFloat(preco).toFixed(2).replace(',', ',');
        var subtotal = preco * quant;
        subtotal = parseFloat(subtotal).toFixed(2).replace('.', ',');

        $(obj).closest('tr').find('.subtotal').html('R$ ' + subtotal);

        atualizarTotal();

        return true;
    }


}

function selecionarCliente(obj) {

    var id = $(obj).attr('data-id');
    var nome = $(obj).html();

    $('.searchvenda').hide();
    $('#cliente_nome').val(nome);
    $('input[name=id_cliente]').val(id);

}

function addProd(obj) {
    $('#add_prod').val('');
    var id = $(obj).attr('data-id');
    var preco = $(obj).attr('data-preco');
    var quant = $(obj).attr('data-quant');
    var numero = $(obj).attr('data-lote');
    var preco = parseFloat(preco.replace(',', '.'));
    var nome = $(obj).html();
    $('.searchvenda').hide();

    if (quant > 0) {

        if ($('input[name="quant[' + id + ']"]').length == 0) {

            var tr = '<tr id="itens_vendas">\n\
            <td>' + numero + '</td>\n\
            <td>' + nome + '</td>\n\
            <td>\n\
            <input id="quant"  min="1" name="quant[' + id + ']" type="text" class="form-control p_quant" onkeypress="return somenteNumero(event);" onchange="atualizarSubTotal(this)"  value="1" data-preco="' + preco + '" data-estoque="' + quant + '" />\n\
            </td>\n\
            <td class="price">R$ ' + preco.toFixed(2) + '</td>\n\
            <td id="subtotal" class="subtotal">R$ ' + preco.toFixed(2) + '</td>\n\
            <td><a class="btn btn-danger"  href="javascript:;" onclick="delProd(this);"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a></td>\n\
            </tr>';
            $('#tabela_produtos').append(tr);
        }



    } else {
        bootbox.alert("Este Lote de Produto Contém Quantidade 0");

    }

    atualizarSubTotal();

}

$('#cliente_nome').on('keyup', function () {

    var datatype = $(this).attr('data-type');
    var p = $(this).val();

    if (datatype != '') {
        $.ajax({
            url: BASE_URL + 'ajax/' + datatype,
            type: 'GET',
            data: {p: p},
            dataType: 'json',
            success: function (json) {

                if ($('.searchvenda').length == 0) {
                    $('#cliente_nome').after('<div class="searchvenda"></div>');
                }

                $('.searchvenda').css('left', $('#cliente_nome').offset().left + 'px');
                $('.searchvenda').css('top', $('#cliente_nome').offset().top + $('#cliente_nome').height() + 3 + 'px');

                var html = '';
                for (var i in json) {
                    html += '<div class="si"><a id="auto" href="javascript:;" onclick="selecionarCliente(this);" data-id="' + json[i].id + '">' + json[i].nome + ' ' + 'CPF: ' + json[i].cpfCnpj + ' </a></div>';
                }

                $('.searchvenda').html(html);
                $('.searchvenda').show();
            }
        });
    }

});

$('#add_prod').on('keyup', function () {

    var datatype = $(this).attr('data-type');
    var p = $(this).val();

    if (datatype != '') {
        $.ajax({
            url: BASE_URL + 'ajax/' + datatype,
            type: 'GET',
            data: {p: p},
            dataType: 'json',
            success: function (json) {
                if ($('.searchvenda').length == 0) {
                    $('#add_prod').after('<div class="searchvenda"></div>');
                }
                $('.searchvenda').css('left', $('#add_prod').offset().left + 'px');
                $('.searchvenda').css('top', $('#add_prod').offset().top + $('#add_prod').height() + 3 + 'px');

                var html = '';
                for (var i in json) {
                    html += '<div class="si"><a id="auto" href="javascript:;" onclick="addProd(this)" data-id="' + json[i].id + '" data-preco="' + json[i].preco + '" data-quant="' + json[i].quant + '" data-lote="' + json[i].numero + '">' + json[i].produto + '  ' + ' Lote: ' + json[i].numero + '</a></div>';
                }

                $('.searchvenda').html(html);
                $('.searchvenda').show();

            }
        });
    }

});