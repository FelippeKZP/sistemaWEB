$('input[name=cep]').on('blur', function () {
     var cep = $(this).val();
     
     $.ajax({
         url: 'http://api.postmon.com.br/v1/cep/' + cep,
         type: 'GET',
         dataType: 'json',
         success: function(json){
             if(typeof json.logradouro != 'undefined'){
                 $('input[name=rua]').val(json.logradouro);
                 $('input[name=bairro]').val(json.bairro);
                 $('input[name=cidade]').val(json.cidade);
                 $('input[name=estado]').val(json.estado);
                 $('input[name=pais]').val("Brasil");
                 $('input[name=numero]').focus();
                 
             }
         }
     });
});
