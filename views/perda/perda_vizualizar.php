<h1>Vizualizar Perda</h1>

<br/>

<form id="form">

	<div class="form-group col-sm-3">
		<label>Numero do Lote:</label>
		<input type="text" class="form-control" id="numero_lote" name="numero_lote" value="<?php echo $perda_vizualizar_list['numero_lote']; ?>" />
	</div>

	<div class="form-group col-sm-3">
		<label>Produto:</label>
		<input type="text" class="form-control" id="produto" name="produto" value="<?php echo $perda_vizualizar_list['nome']; ?>" />
	</div>

	<div class="form-group col-sm-3">
		<label>Data:</label>
		<input type="text" class="form-control" id="data" name="data" value="<?php echo date('d/m/Y', strtotime($perda_vizualizar_list['data_perda'])); ?>" />
	</div>

	<div class="form-group col-sm-2">
		<label>Quantidade:</label>
		<input type="text" class="form-control" id="quantidade" name="quantidade" value="<?php echo $perda_vizualizar_list['quantidade']; ?>" />
	</div>

	<div class="form-group col-sm-4">
		<label>Motivo:</label>
		<textarea id="motivo" class="form-control" name="motivo"><?php echo $perda_vizualizar_list['motivo']; ?></textarea>
	</div>

	<div class="form-group col-sm-2">
		<label>Total:</label>
		<input type="text" class="form-control" id="total" name="total" value="<?php echo number_format($perda_vizualizar_list['total'],2,',','.'); ?>" />
	</div>

	<div class=" form-group col-sm-12">
		<a class="btn btn-warning" href="<?php echo BASE_URL; ?>perda"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Voltar</a>
	</div>

</form>