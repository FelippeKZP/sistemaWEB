<h1 class="h1">Lotes de Produto</h1>

<br/><br/>

<a class="btn btn-info" href="<?php echo BASE_URL; ?>loteProduto/lote_produto_add">Adicionar Lote de Produto</a><br/><br/>

<form method="GET">
    <input id="searchs" class="form-control col-sm-s" type="text" value="<?php echo(!empty($_GET['searchs'])) ? $_GET['searchs'] : ''; ?>" name="searchs" />
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

<div class="table-responsive">
    <table id="tabela" class="table table-hover">
        <thead>
            <tr>
                <th>Numero do Lote</th>
                <th>Produto</th>
                <th>Fornecedor</th>
                <th>Quantidade</th>
                <th>Data de Vencimento</th>
                <th>Ação</th>
            </tr>
        </thead>
        <?php foreach ($lote_produto_list as $l): ?>
            <tbody>
                <tr>
                    <td><?php echo $l['numero_lote']; ?></td>
                    <td><?php echo $l ['nome']; ?></td>
                    <td><?php echo $l['razao_social'] ?></td>
                    <td><?php echo $l['quantidade']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($l['data_vencimento'])); ?></td>
                    <td>
                        <a class="btn btn-primary"
                           href="<?php echo BASE_URL; ?>loteProduto/lote_produto_editar/<?php echo $l['id']; ?>">Editar</a>
                        <a class="btn btn-danger"
                           onclick="return confirm('Deseja Excluir ?');"
                           href="<?php echo BASE_URL; ?>loteProduto/lote_produto_deletar/<?php echo $l['id']; ?>">Excluir</a>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>

<ul class="pagination">
    <?php if ($total > $limit): ?>
        <?php if ($paginaAtual != 1): ?>
            <li><a href="<?php echo BASE_URL; ?>loteProduto?p=1">Primeira Pagina</a></li>
        <?php endif; ?>
    <?php endif; ?>
    <?php for ($q = 1; $q <= $paginas; $q++): ?>
        <?php if ($paginaAtual == $q): ?>
            <li class="active"><a href="<?php echo BASE_URL; ?>loteProduto?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php else: ?>
            <li><a href="<?php echo BASE_URL; ?>loteProduto?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>
    <?php for ($q = $paginaAtual + $max; $q <= $paginaAtual + 1; $q++): ?>
        <li class="active"><a href="<?php echo BASE_URL; ?>loteProduto?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endfor; ?>
    <li><a href="<?php echo BASE_URL; ?>loteProduto?p=<?php echo $paginas; ?>">Ultima Pagina</a></li
</ul>