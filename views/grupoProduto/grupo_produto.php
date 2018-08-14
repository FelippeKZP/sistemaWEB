<h1 class="h1">Grupos De Produto</h1>

<br/><br/>

<a class="btn btn-info" href="<?php echo BASE_URL; ?>grupoProduto/grupo_produto_add">Adicionar Grupo de Produto</a>

<form method="GET">
    <input type="text" class="form-control col-sm-s" id="searchs" name="searchs" value="<?php echo(!empty($_GET['searchs'])) ? $_GET['searchs'] : ''; ?>" />
</form>

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

<table id="tabela" class="table-responsive table-hover">
    <div class="tabela">
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
                           href="<?php echo BASE_URL; ?>grupoProduto/grupo_produto_editar/<?php echo $g['id']; ?>">Editar</a>
                        <a class="btn btn-danger"
                           onclick="return confirm('Deseja Excluir ?');"
                           href="<?php echo BASE_URL; ?>grupoProduto/grupo_produto_deletar/<?php echo $g['id']; ?>">Excluir</a>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </div>
</table>

<ul class="pagination">
    <?php if ($total > $limit): ?>
        <?php if ($paginaAtual != 1): ?>
            <li><a href="<?php echo BASE_URL; ?>grupoProduto?p=1">Primeira Pagina</a></li>
        <?php endif; ?>
    <?php endif; ?>
    <?php for ($q = 1; $q <= $paginas; $q++): ?>
        <?php if ($paginaAtual == $q): ?>
            <li class="active"><a href="<?php echo BASE_URL; ?>grupoProduto?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php else: ?>
            <li><a href="<?php echo BASE_URL; ?>grupoProduto?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>
    <?php for ($q = $paginaAtual + $max; $q <= $paginaAtual + 1; $q++): ?>
        <li class="active"><a href="<?php echo BASE_URL; ?>grupoProduto?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endfor; ?>
    <li><a href="<?php echo BASE_URL; ?>grupoProduto?p=<?php echo $paginas; ?>">Ultima Pagina</a></li
</ul>