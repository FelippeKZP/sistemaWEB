<h1 class="h1">Vizualizar Compra</h1>

<br/>

<div class="form-group col-sm-3" style="float: left; margin-left: -8px;">
	<label>Fornecedor:</label>
	<p class="form-control-static"><?php echo $info['info']['razao_social']; ?></p>
	<div style="clear: both"></div>
</div>

<div class="form-group col-sm-3" style="float: left; margin-left: -8px;">
	<label>CNPJ:</label>
	<p class="form-control-static"><?php echo $info['info']['cnpj']; ?></p>
	<div style="clear: both"></div>
</div>

<div class="form-group col-sm-3" style="float: left; margin-left: -8px;">
	<label>Número da Nota:</label>
	<p class="form-control-static"><?php echo $info['info']['numero_nota']; ?></p>
	<div style="clear: both"></div>
</div>

<div style="clear: both;"></div>

<br/>

<label style="float: right; margin-right: 47px;">Total da Compra:</label><br/>
<div style="clear: both"></div>
<p class="form-control-static" id="total_compra" style="float: right; margin-right: 10px;">R$ <?php echo number_format($info['info']['total_compra'], 2, ',', '.'); ?></p>

<br/>

<h4>Produtos</h4>

<div class="table-responsive">
	<table id="tabela" class="table table-hover">
		<thead>
			<tr>
				<th>Lote</th>
				<th>Produto</th>
				<th>Preço de Compra</th>
				<th>Quant.</th>
				<th>Sub Total</th>
			</tr>
		</thead>
		<?php foreach ($info['produtos'] as $prod): ?>
			<tbody>
				<tr>
                    <td><?php echo $prod['numero_lote']; ?></td>
                    <td><?php echo $prod['nome']; ?></td>
                    <td><?php echo number_format($prod['preco_compra'], 2, ',', '.'); ?></td>
                    <td><?php echo $prod['quantidade']; ?></td>
                    <td>R$ <?php echo number_format($prod['total'], 2, ',', '.'); ?></td>
				</tr>
			</tbody>
		<?php endforeach; ?>
	</table>
</div>

<br/>

<div class="form-group col-sm-12" style="margin-left: -15px;">
    <a class="btn btn-warning" href="<?php echo BASE_URL; ?>compra"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Voltar</a>
</div>