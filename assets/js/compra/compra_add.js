$(document).ready(function () {
    $('form').validate({
        rules: {
            fornecedor_razao: {
                required: true
            },
            numero_nota: {
                required: true
            },
            data_vencimento: {
                required: true
            }
        },
        messages: {
            fornecedor_razao: {
                required: "A Escolha do Fornecedor é Obrigatório."
            },
            numero_nota: {
                required: "Este campo é Obrigatório."
            },
            data_vencimento: {
                required: "Este campo é Obrigatório."
            }
        }
    });
});


jQuery(function ($) {

    $("#numero_nota").mask("99999999999999999");
    $('#data_vencimento').mask("99/99/9999");

});


function validacao() {
    var valor = document.getElementById('total_compra').value;

    if (valor <= 0) {
        bootbox.alert("Adicione Pelo Menos Um Produto Para Eftivar a Compra.");
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

function atualizarTotal(obj) {
    var total = 0;

    for (var q = 0; q < $('.p_quant').length; q++) {

        var quant = $('.p_quant').eq(q);
        var preco = quant.attr('data-precoCompra');

        var subtotal = preco = parseFloat(preco).toFixed(2).replace(',', '.') * parseInt(quant.val());

        total += subtotal;

    }

    $('input[name=total_compra]').val(total.toFixed(2).replace('.', ','));
}

function atualizarSubTotal(obj) {
    var quant = $(obj).val();

    if (quant <= 0) {
        $(obj).val(1);
        quant = 1;
    }

    var preco = $(obj).attr('data-precoCompra');
    preco = parseFloat(preco).toFixed(2).replace(',', ',');
    var subtotal = preco * quant;
    subtotal = parseFloat(subtotal).toFixed(2).replace('.', ',');

    $(obj).closest('tr').find('.subtotal').html('R$ ' + subtotal);

    atualizarTotal();

}

function delProd(obj) {
    $(obj).closest('tr').remove();
    atualizarTotal();
}


function selecionarFornecedor(obj) {
    var id = $(obj).attr('data-id');
    var nome = $(obj).html();
    $('.searchcompra').hide();
    $('#fornecedor_razao').val(nome);
    $('input[name=id_fornecedor]').val(id);
}

function addProdCompra(obj) {
    $('#add_prod_compra').val('');
    var url = $(obj).attr('data-url');
    var id = $(obj).attr('data-id');
    var preco = $(obj).attr('data-precoCompra');
    var numero = $(obj).attr('data-lote');
    var preco = parseFloat(preco.replace(',', '.'));
    var nome = $(obj).html();
    $('.searchcompra').hide();

    var caminho = '';

    if (url.value == '') {
        caminho = BASE_URL + 'assets/imagens/padrao.jpg';
    } else {
        caminho = BASE_URL + 'assets/imagens/produtos/' + url;
    }

    if ($('input [name="quant[' + id + ']"]').length == 0) {
        var tr = '<tr id="itens_compra">\n\
        <td><img src="'+caminho+'" height="50"></td>\n\
        <td>' + numero + '</td>\n\
        <td>' + nome + '</td>\n\
        <td>\n\
        <input id="quant"  min="1" name="quant[' + id + ']" type="text" class="form-control p_quant" onkeypress="return somenteNumero(event);" onchange="atualizarSubTotal(this)"  value="1" data-precoCompra="' + preco + '"  />\n\
        </td>\n\
        <td class="preco">R$ ' + preco.toFixed(2) + '</td>\n\
        <td class="subtotal">' + preco.toFixed(2) + '</td>\n\
        <td><a class="btn btn-danger" href="javascript:;" onclick="delProd(this);"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a></td>\n\
        </tr>';

        $('#tabela_produtos').append(tr);

    }

    atualizarSubTotal();
}


$('#fornecedor_razao').on('keyup', function () {
    var datatype = $(this).attr('data-type');
    var p = $(this).val();
    if (datatype != '') {
        $.ajax({
            url: BASE_URL + 'ajax/' + datatype,
            type: 'GET',
            data: {p: p},
            dataType: 'json',
            success: function (json) {
                if ($('.searchcompra').length == 0) {
                    $('#fornecedor_razao').after('<div class="searchcompra"><div>');
                }
                $('.searchcompra').css('left', $('#fornecedor_razao').offset().left + 'px');
                $('.searchcompra').css('top', $('#fornecedor_razao').offset().top + $('#fornecedor_razao').height() + 3 + 'px');
                var html = '';
                for (var i in json) {
                    html += '<div class="si"><a href="javascript:;" onclick="selecionarFornecedor(this);" data-id="' + json[i].id + '">' + json[i].razao_social + ' ' + 'CNPJ: ' + json[i].cnpj + '</a></div>';
                }

                $('.searchcompra').html(html);
                $('.searchcompra').show();
            }
        });
    }
});
$('#add_prod_compra').on('keyup', function () {
        var datatype = $(this).attr('data-type');
        var p = $(this).val();
        if (datatype != '') {
            $.ajax({
                url: BASE_URL + 'ajax/' + datatype,
                type: 'GET',
                data: {p: p},
                dataType: 'json',
                success: function (json) {
                    if ($('.searchcompra').length == 0) {
                        $('#add_prod_compra').after('<div class="searchcompra"><div>');
                    }
                    $('.searchcompra').css('left', $('#add_prod_compra').offset().left + 'px');
                    $('.searchcompra').css('top', $('#add_prod_compra').offset().top + $('#add_prod_compra').height() + 3 + 'px');
                    var html = '';
                    for (var i in json) {
                        html += '<div class="si"><a id="auto" href="javascript:;" onclick="addProdCompra(this)" data-url="'+json[i].url+'" data-id="' + json[i].id + '" data-precoCompra="' + json[i].preco_compra + '" data-quant="' + json[i].quant + '" data-lote="' + json[i].numero + '">' + json[i].produto + ' ' + 'Lote: ' + json[i].numero + '</a></div>';
                    }

                    $('.searchcompra').html(html);
                    $('.searchcompra').show();
                }
            });
        }
    }
);
