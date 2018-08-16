<h1 class="h1">Clientes</h1>

<br/><br/>

<a class="btn btn-info" href="<?php echo BASE_URL; ?>cliente/cliente_add">Adicionar Cliente</a><br/><br/>

<form method="GET">
    <input type="text" class="form-control col-sm-5" id="searchs" name="searchs" value="<?php echo(!empty($_GET['searchs'])) ? $_GET['searchs'] : ''; ?>" />
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
                <th>#</th>
                <th>Tipo de Pessoa</th>
                <th>Nome</th>
                <th>CPF/CNPJ</th>
                <th>Telefone</th>
                <th>Cidade</th>
                <th>Ação</th>
            </tr>
        </thead>
        <?php foreach ($cliente_list as $c): ?>
            <tbody>
                <tr>
                    <td><?php echo $c['id']; ?></td>
                    <td><?php echo $c['tipo_pessoa']; ?></td>
                    <td><?php echo $c['nome']; ?></td>
                    <td><?php echo $c['cpfCnpj']; ?></td>
                    <td><?php echo $c['telefone']; ?></td>
                    <td><?php echo $c['cidade']; ?></td>
                    <td>
                        <a class="btn btn-primary" 
                           href="<?php echo BASE_URL; ?>cliente/cliente_editar/<?php echo $c['id']; ?>">Editar</a>
                        <a class="btn btn-danger"
                           onclick="return confirm('Deseja Excluir ?');"
                           href="<?php echo BASE_URL; ?>cliente/cliente_deletar/<?php echo $c['id']; ?>">Excluir</a>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>
<ul class="pagination">
    <?php if ($total > $limit): ?>
        <?php if ($paginaAtual != 1): ?>
            <li><a href="<?php echo BASE_URL; ?>cliente?p=1">Primeira Pagina</a></li>
        <?php endif; ?>
    <?php endif; ?>
    <?php for ($q = 1; $q <= $paginas; $q++): ?>
        <?php if ($paginaAtual == $q): ?>
            <li class="active"><a href="<?php echo BASE_URL; ?>cliente?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php else: ?>
            <li><a href="<?php echo BASE_URL; ?>ciente?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>
    <?php for ($q = $paginaAtual + $max; $q <= $paginaAtual + 1; $q++): ?>
        <li class="active"><a href="<?php echo BASE_URL; ?>cliente?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endfor; ?>
    <li><a href="<?php echo BASE_URL; ?>cliente?p=<?php echo $paginas; ?>">Ultima Pagina</a></li
</ul>