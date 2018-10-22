<h1>Trocar Senha</h1>

<br/>

<?php if (isset($msg_sucesso) && !empty($msg_sucesso)): ?>
<script type="text/javascript">
	bootbox.alert("Senha alterada com sucesso, você será  redirecionado para login");
	setTimeout("document.location = BASE_URL + 'login' ",2000);
</script>
<?php endif; ?>

<?php if (isset($msg_erro) && !empty($msg_erro)): ?>
<div class="alert alert-danger alert-dismissible">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong><?php echo $msg_erro; ?></strong>
</div>
<?php endif; ?>

<form id="form" method="POST">

	<br/>

	<div class="col-sm-3">
		<label>Senha Atual:</label>
		<input type="password" class="form-control" name="senha_atual" id="senha_atual" placeholder="Digite a senha atual."/>
	</div>


	<div style="clear: both;"></div>

	<br/>

	<div class="col-sm-3">
		<label>Nova Senha</label>
		<input type="password" class="form-control" name="senha" id="senha" placeholder="Digite nova senha."/>
	</div>

	<div style="clear: both;"></div>

	<br/>

	<div class="col-sm-3">
		<label>Digite novamente a senha:</label>
		<input type="password" class="form-control" name="senha_nov" id="senha_nov" placeholder="Digite nova senha."/>
	</div>

	<div style="clear: both;"></div>

	<br/><br/>

	<div class="form-group col-sm-12">
		<button  class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
	</div>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/perfil/script_perfil.js"></script>