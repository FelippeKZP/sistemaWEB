<h1 class="h1">Clientes</h1>

<br/>

<a class="btn btn-info" href="<?php echo BASE_URL; ?>cliente/cliente_add"><span class="glyphicon glyphicon-plus"
                                                                                aria-hidden="true"></span> Adicionar</a>

<br/><br/>

<form method="GET">
    <div class="input-group">
        <span id="buscar" class="input-group-addon"><span class="glyphicon glyphicon-search " aria-hidden="true"></span></span>
        <input type="text" class="form-control" name="searchs"
               value="<?php echo (!empty($_GET['searchs'])) ? $_GET['searchs'] : ''; ?>" placeholder="Pesquisar"/>
    </div>
</form>

<?php
if (isset($filtros['searchs']) && !empty($filtros['searchs'])) {
    echo "Filtrado pelo cliente: " . $filtros['searchs'] . "<br/>";
}
?>

<div style="clear: both;"></div>

<br/><br/>

<?php if ($cliente_list == null): ?>

    <div class="alert alert-info"><strong>Nenhum registro encontrado.</strong></div>

<?php else: ?>

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
                           href="<?php echo BASE_URL; ?>cliente/cliente_editar/<?php echo $c['id']; ?>">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>
                        <a class="btn btn-danger"
                           href="javascript:;"
                           onclick="excluir('<?php echo $c['id']; ?>');">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>

<?php endif; ?>

<ul class="pagination">
    <?php if ($paginaAtual != 1): ?>
        <li><a href="<?php echo BASE_URL; ?>cliente?p=1">Primeira Pagina</a></li>
    <?php endif; ?>
    <?php if ($paginaAtual != 1): ?>
        <li><a href="<?php echo BASE_URL; ?>cliente?p=<?php echo $paginaAtual - 1 ?>"><span
                        class="glyphicon glyphicon-backward" aria-hidden="true" style="height: 20px;"></span></a></li>
    <?php endif; ?>
    <?php for ($q = 1; $q <= $paginas; $q++): ?>
        <?php if ($paginaAtual == $q): ?>
            <li class="active"><a href="<?php echo BASE_URL; ?>cliente?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php else: ?>
            <li><a href="<?php echo BASE_URL; ?>cliente?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>
    <?php if ($paginaAtual < $paginas): ?>
        <li><a href="<?php echo BASE_URL; ?>cliente?p=<?php echo $paginaAtual + 1 ?>"><span style="height: 20px;"
                                                                                            class="glyphicon glyphicon-forward"
                                                                                            aria-hidden="true"></span></a>
        </li>
    <?php endif; ?>
    <?php if ($paginas > 1): ?>
        <li><a href="<?php echo BASE_URL; ?>cliente?p=<?php echo $paginas; ?>">Ultima Pagina</a></li>
    <?php endif; ?>
</ul>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/cliente/script_cliente.js"></script>