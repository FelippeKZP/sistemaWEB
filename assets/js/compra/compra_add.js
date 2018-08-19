function selecionarFornecedor(obj) {
    var id = $(obj).attr('data-id');
    var nome = $(obj).html();

    $('.searchcompra').hide();
    $('#fornecedor_razao').val(nome);
    $('input[name=id_fornecedor]').val(id);
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

