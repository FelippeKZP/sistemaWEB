<h1 class="h1">Perdas</h1>


<br/>


<form  method="GET">
	<div class="input-group">
		<span id="buscar" class="input-group-addon"><span class="glyphicon glyphicon-search " aria-hidden="true"></span></span>
		<input type="text" class="form-control" name="searchs" value="<?php echo (!empty($_GET['searchs'])) ? $_GET['searchs'] : '';  ?>" placeholder="Pesquisar"/>
	</div>
</form>


<?php
if (isset($filtros['searchs']) && !empty($filtros['searchs'])) {
	echo "Filtrado pelo produto: " . $filtros['searchs'] . "<br/>";
}
?>

<div style="clear: both;"></div>

<br/><br/>

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

<div class="table-responsive">
	<table id="tabela" class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Numero do Lote</th>
				<th>Produto</th>
				<th>Data</th>
				<th>Total</th>
				<th>Ação</th>
			</tr>
		</thead>
		<?php foreach($perda_list as $p): ?>
			<tbody>
				<tr>
					<td><?php echo $p['id']; ?></td>
					<td><?php echo $p['numero_lote']; ?></td>
					<td><?php echo $p['nome']; ?></td>
					<td><?php echo date('d/m/Y', strtotime($p['data_perda'])); ?></td>
					<td><?php echo number_format($p['total'],2,',','.');?></td>
					<td>
						<a class="btn btn-primary"
						href="<?php echo BASE_URL; ?>perda/perda_vizualizar/<?php echo $p['id']; ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
					</a>
					<a class="btn btn-danger"
					href="<?php echo BASE_URL; ?>perda/perda_deletar/<?php echo $p['id']; ?>"
					onclick="return confirm('Deseja Excluir ?');">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				</a>
			</td>
		</tr>
	</tbody>
<?php endforeach; ?>
</table>
</div>

<div style="clear:both;"></div>

<ul class="pagination">
	<?php if($paginaAtual != 1): ?>
		<li><a href="<?php echo BASE_URL; ?>perda?p=1">Primeira Pagina</a></li>
	<?php endif; ?>
	<?php if($paginaAtual != 1): ?>
		<li><a href="<?php echo BASE_URL; ?>perda?p=<?php echo $paginaAtual - 1; ?>"><span  class="glyphicon glyphicon-backward" aria-hidden="true" style="height: 20px;"></span></a></li>
	<?php endif; ?>
	<?php for($q = 1; $q <= $paginas; $q++): ?>
		<?php if($paginaAtual == $q): ?>
			<li class="active"><a href="<?php echo BASE_URL; ?>perda?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
			<?php else: ?>
				 <li><a href="<?php echo BASE_URL; ?>perda?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
			<?php endif; ?>
		<?php endfor; ?>
		<?php if($paginaAtual < $paginas): ?>
			<li><a href="<?php echo BASE_URL; ?>perda?p=<?php echo $paginaAtual + 1; ?>"><span style="height: 20px;" class="glyphicon glyphicon-forward" aria-hidden="true"></span></a></li>
		<?php endif; ?>
		<?php if($paginas > 1): ?>
			<li><a href="<?php echo BASE_URL; ?>perda?p=<?php echo $paginas; ?>">Ultima Pagina</a></li>
		<?php endif; ?>
	</ul>
