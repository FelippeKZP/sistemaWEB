<h1 class="h1">Funcionários</h1>

<br/>

<a class="btn btn-info" href="<?php echo BASE_URL; ?>funcionario/funcionario_add"><span class="glyphicon glyphicon-plus"
                                                                                        aria-hidden="true"></span>
    Adicionar</a>

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
    echo "Filtrado pelo funcionário: " . $filtros['searchs'] . "<br/>";
}
?>

<div style="clear: both;"></div>

<br/><br/>

<?php if ($funcionario_list == null): ?>

    <div class="alert alert-info"><strong>Nenhum registro encontrado.</strong></div>

<?php else: ?>

    <div class="table-responsive">
        <table id="tabela" class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Função</th>
                <th>Data de Admissão</th>
                <th>Salário</th>
                <th>Ações</th>
            </tr>
            </thead>
            <?php foreach ($funcionario_list as $f): ?>
                <tbody>
                <tr>
                    <td><?php echo $f['id'] ?></td>
                    <td><?php echo $f['nome']; ?></td>
                    <td><?php echo $f['cpf']; ?></td>
                    <td><?php echo $f['funcao']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($f['data_admissao'])); ?></td>
                    <td><?php echo number_format($f['salario'], 2, ',', '.'); ?></td>
                    <td>
                        <a class="btn btn-primary"
                           href="<?php echo BASE_URL; ?>funcionario/funcionario_editar/<?php echo $f['id']; ?>">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>
                        <a class="btn btn-danger"
                           href="javascript:;"
                           onclick="excluir('<?php echo $f['id']; ?>')">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </a>
                    </td>
                </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>

<?php endif; ?>

<div style="clear:both;"></div>

<ul class="pagination">
    <ul class="pagination">
        <?php if ($paginaAtual != 1): ?>
            <li><a href="<?php echo BASE_URL; ?>funcionario?p=1">Primeira Pagina</a></li>
        <?php endif; ?>
        <?php if ($paginaAtual != 1): ?>
            <li><a href="<?php echo BASE_URL; ?>funcionario?p=<?php echo $paginaAtual - 1 ?>"><span
                            class="glyphicon glyphicon-backward" aria-hidden="true" style="height: 20px;"></span></a>
            </li>
        <?php endif; ?>
        <?php for ($q = 1; $q <= $paginas; $q++): ?>
            <?php if ($paginaAtual == $q): ?>
                <li class="active"><a
                            href="<?php echo BASE_URL; ?>funcionario?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
            <?php else: ?>
                <li><a href="<?php echo BASE_URL; ?>funcionario?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
            <?php endif; ?>
        <?php endfor; ?>
        <?php for ($q = $paginaAtual + $max; $q <= $paginaAtual + 1; $q++): ?>
            <li class="active"><a href="<?php echo BASE_URL; ?>funcionario?p=<?php echo $q; ?>"><?php echo $q; ?></a>
            </li>
        <?php endfor; ?>
        <?php if ($paginaAtual < $paginas): ?>
            <li><a href="<?php echo BASE_URL; ?>funcionario?p=<?php echo $paginaAtual + 1 ?>"><span
                            style="height: 20px;" class="glyphicon glyphicon-forward" aria-hidden="true"></span></a>
            </li>
        <?php endif; ?>
        <?php if ($paginas > 1): ?>
            <li><a href="<?php echo BASE_URL; ?>funcionario?p=<?php echo $paginas; ?>">Ultima Pagina</a></li>
        <?php endif; ?>
    </ul>

    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/funcionario/script_funcionario.js"></script>