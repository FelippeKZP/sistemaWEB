<h1>Sitação do Estoque de Produtos</h1>

<br/>

<form method="GET">
    <div class="input-group">
        <span id="buscar" class="input-group-addon"><span class="glyphicon glyphicon-search " aria-hidden="true"></span></span>
        <input type="text" class="form-control" name="searchs"
               value="<?php echo (!empty($_GET['searchs'])) ? $_GET['searchs'] : ''; ?>" placeholder="Pesquisar"/>
    </div>
</form>

<?php
if (isset($filtros['searchs']) && !empty($filtros['searchs'])) {
    echo "Filtrado pelo produto: " . $filtros['searchs'] . "<br/>";
}
?>

<br/>

<div class="col-sm-2" style="float: right;">
    <label>Qtde. total em estoque:</label>
    <input type="text" class="form-control" id="quantidade_estoque" disabled="true"
           value="<?php echo $quantidade_estoque; ?>" placeholder="0"/>
</div>

<div class="col-sm-2" style="float: right;">
    <label>Valor total em estoque:</label>
    <input type="text" class="form-control" id="custo_estoque" disabled="true"
           value="R$ <?php echo number_format($valor_estoque, 2, ',', '.'); ?>" placeholder="0,00"/>
</div>

<div style="clear: both;"></div>

<br/>

<div class="table-responsive">
    <table id="tabela" class="table table-hover">
        <thead>
        <tr>
            <th>Cód. de Barras</th>
            <th>Nome</th>
            <th>Grupo de Prod.</th>
            <th>Qtde.</th>
            <th>Preço de Com.</th>
            <th>Preço de Ven.</th>
            <th>Lucro da Ven.</th>
            <th>Margem de Luc.</th>
        </tr>
        </thead>
        <?php foreach ($estoque_list as $e): ?>
            <tbody>
            <tr>
                <td><?php echo $e['cod_barras']; ?></td>
                <td><?php echo $e['nome']; ?></td>
                <td><?php echo $e['grupo']; ?></td>
                <td><?php echo $e['quantidade']; ?></td>
                <td><?php echo number_format($e['preco_compra'], 2, ',', '.'); ?></td>
                <td><?php echo number_format($e['preco'], 2, ',', '.'); ?></td>
                <td><?php echo number_format($e['lucro_venda'], 2, ',', '.'); ?></td>
                <td><?php echo $e['margem_bruta']; ?></td>
            </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>

<div style="clear: both;"></div>

<ul class="pagination">
    <?php if ($paginaAtual != 1): ?>
        <li><a href="<?php echo BASE_URL; ?>estoque?p=1">Primeira Pagina</a></li>
    <?php endif; ?>
    <?php if ($paginaAtual != 1): ?>
        <li><a href="<?php echo BASE_URL; ?>estoque?p=<?php echo $paginaAtual - 1; ?>"><span
                        class="glyphicon glyphicon-backward" aria-hidden="true" style="height: 20px;"></span></a></li>
    <?php endif; ?>
    <?php for ($q = 1; $q <= $paginas; $q++): ?>
        <?php if ($paginaAtual == $q): ?>
            <li class="active"><a href="<?php echo BASE_URL; ?>estoque?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php else: ?>
            <li><a href="<?php echo BASE_URL; ?>estoque?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>
    <?php if ($paginas > $paginaAtual): ?>
        <li><a href="<?php echo BASE_URL; ?>estoque?p=<?php echo $paginaAtual + 1; ?>"><span style="height: 20px;"
                                                                                             class="glyphicon glyphicon-forward"
                                                                                             aria-hidden="true"></span></a>
        </li>
    <?php endif; ?>
    <?php if ($paginas > 1): ?>
        <li><a href="<?php echo BASE_URL; ?>estoque?p=<?php echo $paginas; ?>">Ultima Pagina</a></li>
    <?php endif; ?>
</ul>