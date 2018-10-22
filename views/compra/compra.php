<h1 class="h1">Compras</h1>

<br/>

<a class="btn btn-info" href="<?php echo BASE_URL; ?>compra/compra_add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar </a>

<br/><br/>

<form  method="GET">
    <div class="input-group">
        <span id="buscar" class="input-group-addon"><span class="glyphicon glyphicon-search " aria-hidden="true"></span></span>
        <input type="text" class="form-control" name="searchs" value="<?php echo (!empty($_GET['searchs'])) ? $_GET['searchs'] : ''; ?>" placeholder="Pesquisar"/>
    </div>
</form>

<?php
if (isset($filtros['searchs']) && !empty($filtros['searchs'])) {
    echo "Filtrado pelo Fornecedor: " . $filtros['searchs'] . "<br/>";
}
?>

<div style="clear: both;"></div>

<br/><br/>

<div class="table-responsive">
    <table id="tabela" class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Num. da Nota</th>
                <th>Fornecedor</th>
                <th>Data da Compra</th>
                <th>Total da Compra</th>
                <th>Ação</th>
            </tr>
        </thead>
        <?php foreach ($compra_list as $c): ?>
            <tbody>
                <tr>
                    <td><?php echo $c['id']; ?></td>
                    <td><?php echo $c['numero_nota']; ?></td>
                    <td><?php echo $c['razao_social']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($c['data_compra'])); ?></td>
                    <td><?php echo number_format($c['total_compra'], 2, ',', '.'); ?></td>
                    <td>
                        <a class="btn btn-primary"
                        href="<?php echo BASE_URL; ?>compra/compra_vizualizar/<?php echo $c['id']; ?>">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </a>
                </td>
            </tr>
        </tbody>
    <?php endforeach; ?>
</table>
</div>

<div style="clear: both;"></div>

<ul class="pagination">
 <?php if ($paginaAtual != 1): ?>
    <li><a href="<?php echo BASE_URL; ?>compra?p=1">Primeira Pagina</a></li>
<?php endif; ?>
<?php if ($paginaAtual != 1): ?>
    <li><a href="<?php echo BASE_URL; ?>compra?p=<?php echo $paginaAtual - 1?>"><span  class="glyphicon glyphicon-backward" aria-hidden="true" style="height: 20px;"></span></a></li>
<?php endif;?>
<?php for ($q = 1; $q <= $paginas; $q++): ?>
    <?php if ($paginaAtual == $q): ?>
        <li class="active"><a href="<?php echo BASE_URL; ?>compra?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php else: ?>
            <li><a href="<?php echo BASE_URL; ?>compra?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>
    <?php for ($q = $paginaAtual + $max; $q <= $paginaAtual + 1; $q++): ?>
        <li class="active"><a href="<?php echo BASE_URL; ?>compra?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
    <?php endfor; ?>
    <?php if($paginaAtual < $paginas): ?>
        <li><a href="<?php echo BASE_URL; ?>compra?p=<?php echo $paginaAtual + 1?>"><span style="height: 20px;" class="glyphicon glyphicon-forward" aria-hidden="true"></span></a></li>
    <?php endif; ?>
    <?php if($paginas > 1): ?>
        <li><a href="<?php echo BASE_URL; ?>compra?p=<?php echo $paginas; ?>">Ultima Pagina</a></li>
    <?php endif; ?>
</ul>