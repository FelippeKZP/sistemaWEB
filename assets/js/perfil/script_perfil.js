$(document).ready(function(){
	$('form').validate({
		rules:{
			senha_atual:{
				required: true
			},
			senha:{
				required: true
			},
			senha_nov:{
				equalTo: "#senha"
			}
		},
		messages:{
			senha_atual:{
				 required: "Este campo é obrigatório."
			},
			senha:{
				 required: "Este campo é obrigatório."
			},
			senha_nov:{
				required: "Este campo é obrigatório ",
				 equalTo: "A senha são diferentes."
			}
		}
	});
});