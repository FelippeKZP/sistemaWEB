function selectProduto(obj) {
    var id = $(obj).attr('data-id');
    var nome = $(obj).html();

    $('.searchresults').hide();
    $('#produto').val(nome);
    $('input[name=id_produto]').val(id);
}

function selectFornecedor(obj){
    var id = $(obj).attr('data-id');
    var nome = $(obj).html();
    
    $('.searchresults').hide();
    $('#fornecedor').val(nome);
    $('input[name=id_fornecedor]').val(id);
}

$('#produto').on('keyup', function(){
    var datatype = $(this).attr('data-type');
    var p = $(this).val();
    if(datatype != ''){
        $.ajax({
            url: BASE_URL + 'ajax/' + datatype,
            type: 'GET',
            data : {p:p},
            dataType: 'json',
            success: function(json){
                if($('.searchresults').length == 0){
                    $('#produto').after('<div class="searchresults"><div>');
                }
                $('.searchresults').css('left', $('#produto').offset().left + 'px');
                $('.searchresults').css('top', $('#produto').offset().top +  $('#produto').height() + 3 + 'px');
                var html = '';
                for(var i in json){
                    html += '<div class="si"><a href="javascript:;" onclick="selectProduto(this);" data-id="'+ json[i].id +'">'+ json[i].nome +' ' + 'Cód: ' + json[i].cod + '</a></div>';
                }
                
                $('.searchresults').html(html);
                $('.searchresults').show();
            }
        });
    }
});


$('#fornecedor').on('keyup', function(){
    var datatype = $(this).attr('data-type');
    var p = $(this).val();
    if(datatype != ''){
        $.ajax({
            url: BASE_URL + 'ajax/' + datatype,
            type: 'GET',
            data : {p:p},
            dataType: 'json',
            success: function(json){
                if($('.searchresults').length == 0){
                    $('#fornecedor').after('<div class="searchresults"><div>');
                }
                $('.searchresults').css('left', $('#fornecedor').offset().left + 'px');
                $('.searchresults').css('top', $('#fornecedor').offset().top +  $('#fornecedor').height() + 3 + 'px');
                var html = '';
                for(var i in json){
                    html += '<div class="si"><a href="javascript:;" onclick="selectFornecedor(this);" data-id="'+ json[i].id +'">'+ json[i].razao_social +' ' + 'CNPJ: ' + json[i].cnpj + '</a></div>';
                }
                
                $('.searchresults').html(html);
                $('.searchresults').show();
            }
        });
    }
});

