<h1 class="h1">Perda do Lote de Produto</h1>

<br/>

<?php if (isset($msg_erro) && !empty($msg_erro)): ?>
<div class="alert alert-danger alert-dismissible">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong><?php echo $msg_erro; ?></strong>
</div>
<?php endif; ?>

<?php if (isset($msg_sucesso) && !empty($msg_sucesso)): ?>
<div class="alert alert-success alert-dismissible">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong><?php echo $msg_sucesso; ?></strong>
</div>
<?php endif; ?>

<form id="form" method="POST">


	<label>Número de Lote:</label>
	<input type="text" id="numero_lote" class="form-control" name="numero_lote" value="<?php echo $lote_produto_editar_list['numero_lote']; ?>" placeholder="Digite o Número do Lote."/>

	<br/>

	<label>Produto:</label>
	<input type="hidden" name="id_produto" value="<?php echo $lote_produto_editar_list['id_produto']; ?>"/>
	<input type="text" class="form-control autocomplete" id="produto" name="produto" value="<?php echo $lote_produto_editar_list['nome']; ?>" data-type="pesquisar_produtos"/>

	<div style="clear: both"></div>

	<br/>

	<label>Fornecedor:</label>
	<input type="hidden" name="id_fornecedor" value="<?php echo $lote_produto_editar_list['id_fornecedor']; ?>"/>
	<input type="text" class="form-control autocomplete" id="fornecedor" name="fornecedor" value="<?php echo $lote_produto_editar_list['razao_social']; ?>" data-type="pesquisar_fornecedores"/>

	<input type="hidden" name="preco" id="preco" value="<?php echo number_format($lote_produto_editar_list['preco_compra'],2,',','.'); ?>"/>

	<div style="clear: both"></div>

	<br/>

	<div class="form-group col-sm-2" style="padding-left: 0px;">
		<label>Quantidade:</label>
		<input type="text" id="quantidade"  class="form-control" name="quantidade" value="<?php echo $lote_produto_editar_list['quantidade']; ?>" placeholder="Digite a Quantidade" disabled="true"/>
	</div>

	<div class="form-group col-sm-2">
		<label>Data da Perda:</label>
		<input type="text" id="data_perda" class="form-control" disabled="true" name="data_perda" value="<?php echo date('d/m/Y'); ?>" />

	</div>

	<div class="form-group col-sm-2">
		<label>Quantidade da Perda:</label>
		<input type="text" id="quantidade_perda" class="form-control" name="quantidade_perda" onblur="soma();" />
	</div>


	<div class="form-group col-sm-2">
		<label>Total da Perda:</label>
		<input type="text" id="total_perda" class="form-control" disabled="true"  name="total_perda" placeholder="0,00" />
	</div>

	<div class="form-group col-sm-2">
		<label>Motivo:</label>
		<textarea id="motivo" name="motivo" class="form-control"></textarea>
	</div>


	<div class=" form-group col-sm-12" style="margin-left: -15px;">
		<button  class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
		<a class="btn btn-warning" href="<?php echo BASE_URL; ?>loteProduto"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Voltar</a>
	</div>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/loteProduto/script_loteProduto_perda.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/loteProduto/script_loteProduto_validacao.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/loteProduto/script_loteProduto_mascara.js"></script>