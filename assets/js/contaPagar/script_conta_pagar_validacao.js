$(document).ready(function (){
	$('form').validate({
		rules:{
			descricao:{
				required:true
			},
			data_conta:{
				required:true
			},
			data_vencimento:{
				required:true
			},
			data_pagamento:{
				required:true
			},
			data_pagamento:{
				required:true
			},
			total:{
				required:true
			}
		},
		messages:{
			descricao:{
				required: "Este Campo é Obrigatório."
			},
			data_conta:{
				required: "Este Campo é Obrigatório."
			},
			data_vencimento:{
				required: "Este Campo é Obrigatório."
			},
			data_pagamento:{
				required: "Este Campo é Obrigatório."
			},
			data_pagamento:{
				required: "Este Campo é Obrigatório."
			},
			total:{
				required: "Este Campo é Obrigatório."
			}
		}
	});
});