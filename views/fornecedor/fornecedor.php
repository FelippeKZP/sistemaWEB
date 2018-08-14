<h1 class="h1">Fornecedores</h1>

<br/><br/>

<a class="btn btn-info" href="<?php echo BASE_URL; ?>fornecedor/fornecedor_add">Adicionar Fornecedor</a>

<br/><br/>

<form method="GET">
    <input type="text" class="form-control col-sm-s" id="searchs" name="searchs" value="<?php echo (!empty($_GET['searchs'])) ? $_GET['searchs'] : ''; ?>" />
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
    <div class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Razão Social</th>
                <th>CNPJ</th>
                <th>Telefone</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Ação</th>
            </tr>
        </thead>
        <?php foreach ($fornecedor_list as $f): ?>
            <tbody>
                <tr>
                    <td><?php echo $f['id']; ?></td>
                    <td><?php echo $f['razao_social']; ?></td>
                    <td><?php echo $f['cnpj']; ?></td>
                    <td><?php echo $f['telefone']; ?></td>
                    <td><?php echo $f['cidade']; ?></td>
                    <td><?php echo $f['estado']; ?></td>
                    <td>
                        <a class="btn btn-primary"
                           href="<?php echo BASE_URL; ?>fornecedor/fornecedor_editar/<?php echo $f['id']; ?>">Editar</a>

                        <a class="btn btn-danger"
                           onclick="return confirm('Deseja Excluir ?');"
                           href="<?php echo BASE_URL; ?>fornecedor/fornecedor_deletar/<?php echo $f['id']; ?>">Excluir</a>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </div>
</table>

<ul class="pagination">
    <?php if ($total > $limit): ?>
        <?php if ($paginaAtual != 1): ?>
            <li><a href="<?php echo BASE_URL; ?>fornecedor?p=1">Primeira Pagina</a></li>
        <?php endif; ?>
    <?php endif; ?>
    <?php for ($q = 1; $q <= $paginas; $q++): ?>
        <?php if ($paginaAtual == $q): ?>
            <li class="active"><a href="<?php echo BASE_URL; ?>fornecedor?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php else: ?>
            <li><a href="<?php echo BASE_URL; ?>fornecedor?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>
    <?php for ($q = $paginaAtual + $max; $q <= $paginaAtual + 1; $q++): ?>
        <li class="active"><a href="<?php echo BASE_URL; ?>fornecedor?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endfor; ?>
    <li><a href="<?php echo BASE_URL; ?>fornecedor?p=<?php echo $paginas; ?>">Ultima Pagina</a></li
</ul>