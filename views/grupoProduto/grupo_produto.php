<h1 class="h1">Grupos De Produtos</h1>

<br/>

<a class="btn btn-info" href="<?php echo BASE_URL; ?>grupoProduto/grupo_produto_add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar</a>

<br/><br/>

<form  method="GET">
    <div class="input-group">
        <span id="buscar" class="input-group-addon"><span class="glyphicon glyphicon-search " aria-hidden="true"></span></span>
        <input type="text" class="form-control" name="searchs" value="<?php echo (!empty($_GET['searchs'])) ? $_GET['searchs'] : ''; ?>" placeholder="Pesquisar"/>
    </div>
</form>

<?php
if (isset($filtros['searchs']) && !empty($filtros['searchs'])) {
    echo "Filtrado pelo Grupo: " . $filtros['searchs'] . "<br/>";
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
                <th>Nome</th>
                <th>Ação</th>
            </tr>
        </thead>
        <?php foreach ($grupo_produto_list as $g): ?>
            <tbody>
                <tr>
                    <td><?php echo $g['id']; ?></td>
                    <td><?php echo $g['nome']; ?></td>
                    <td>
                        <a class="btn btn-primary"
                        href="<?php echo BASE_URL; ?>grupoProduto/grupo_produto_editar/<?php echo $g['id']; ?>">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    <a class="btn btn-danger"
                    onclick="return confirm('Deseja Excluir ?');"
                    href="<?php echo BASE_URL; ?>grupoProduto/grupo_produto_deletar/<?php echo $g['id']; ?>">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </a>
            </td>
        </tr>
    </tbody>
<?php endforeach; ?>
</table>
</div>

<ul class="pagination">
 <?php if ($paginaAtual != 1): ?>
    <li><a href="<?php echo BASE_URL; ?>grupoProduto?p=1">Primeira Pagina</a></li>
<?php endif; ?>
<?php if ($paginaAtual != 1): ?>
    <li><a href="<?php echo BASE_URL; ?>grupoProduto?p=<?php echo $paginaAtual - 1?>"><span  class="glyphicon glyphicon-backward" aria-hidden="true" style="height: 20px;"></span></a></li>
<?php endif;?>
<?php for ($q = 1; $q <= $paginas; $q++): ?>
    <?php if ($paginaAtual == $q): ?>
        <li class="active"><a href="<?php echo BASE_URL; ?>grupoProduto?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php else: ?>
            <li><a href="<?php echo BASE_URL; ?>cliente?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>
    <?php for ($q = $paginaAtual + $max; $q <= $paginaAtual + 1; $q++): ?>
        <li class="active"><a href="<?php echo BASE_URL; ?>cliente?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
    <?php endfor; ?>
    <?php if($paginaAtual < $paginas): ?>
        <li><a href="<?php echo BASE_URL; ?>cleinte?p=<?php echo $paginaAtual + 1?>"><span style="height: 20px;" class="glyphicon glyphicon-forward" aria-hidden="true"></span></a></li>
    <?php endif; ?>
    <?php if($paginas > 1): ?>
        <li><a href="<?php echo BASE_URL; ?>cliente?p=<?php echo $paginas; ?>">Ultima Pagina</a></li>
    <?php endif; ?>
</ul>