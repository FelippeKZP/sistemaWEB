<h1 class="h1">Contas a Pagar</h1>

<br/>

<a class="btn btn-info" href="<?php echo BASE_URL; ?>contaPagar/conta_pagar_add"><span class="glyphicon glyphicon-plus"
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
    echo "Filtrado pela Conta: " . $filtros['searchs'] . "<br/>";
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
            <th>Tipo</th>
            <th>Descrição</th>
            <th>Data de Vencimento</th>
            <th>Data de Pagamento</th>
            <th>Total</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        </thead>
        <?php foreach ($conta_pagar_list as $c): ?>
            <tbody>
            <tr>
                <td><?php echo $c['id']; ?></td>
                <td><?php echo $tipo[$c['tipo']]; ?></td>
                <td><?php echo $c['descricao']; ?></td>
                <td><?php echo date('d/m/Y', strtotime($c['data_vencimento'])); ?></td>
                <td>
                    <?php
                    if ($c['data_pagamento'] == 0000 - 00 - 00) {
                        echo '<span class="label label-danger">' . 'Conta Não Foi Paga' . '</span>';
                    } else {
                        echo date('d/m/Y', strtotime($c['data_pagamento']));
                    }
                    ?>
                </td>
                <td><?php echo number_format($c['total'], 2, ',', '.'); ?></td>
                <td>
                    <?php
                    if ($c['status'] == 0) {
                        echo '<span class="label label-danger">' . ($status[$c['status']]) . '</span>';
                    } else {
                        echo '<span class="label label-success">' . ($status[$c['status']]) . '</span>';
                    }
                    ?>
                </td>
                <td>
                    <?php if ($c['status'] == 0): ?>
                        <a class="btn  btn-success"
                           onclick="return confirm('Deseja Pagar Esta Compra ?');"
                           href="<?php echo BASE_URL; ?>contaPagar/conta_pagar_receber/<?php echo $c['id']; ?>"><span
                                    class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
                        </a>
                    <?php elseif ($c['status'] == 1): ?>
                        <a class="btn btn-primary"
                           href="<?php echo BASE_URL; ?>contaPagar/conta_pagar_vizualizar/<?php echo $c['id']; ?>"><span
                                    class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        </a>
                    <?php endif; ?>
                    <a class="btn btn-danger"
                       onclick="return confirm('Deseja Excluir ?');"
                       href="<?php echo BASE_URL; ?>contaPagar/conta_pagar_excluir/<?php echo $c['id']; ?>"><span
                                class="glyphicon glyphicon-trash" aria-hidden="true"></span>
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
        <li><a href="<?php echo BASE_URL; ?>contaPagar?p=1">´Primeira Pagina</a></li>
    <?php endif; ?>
    <?php if ($paginaAtual != 1): ?>
        <li><a href="<?php echo BASE_URL; ?>contaPagar?p=<?php echo $paginaAtual - 1 ?>"><span
                        class="glyphicon glyphicon-backward" aria-hidden="true" style="height: 20px;"></span></a></li>
    <?php endif; ?>
    <?php for ($q = 1; $q <= $paginas; $q++): ?>
        <?php if ($paginaAtual == $q): ?>
            <li class="active"><a href="<?php echo BASE_URL; ?>contaPagar?p=<?php echo $q; ?>"><?php echo $q; ?></a>
            </li>
        <?php else: ?>
            <li><a href="<?php echo BASE_URL; ?>contaPagar?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>
    <?php for ($q = $paginaAtual + $max; $q <= $paginaAtual + 1; $q++): ?>
        <li class="active"><a href="<?php echo BASE_URL; ?>contaPagar?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
    <?php endfor; ?>
    <?php if ($paginaAtual < $paginas): ?>
        <li><a href="<?php echo BASE_URL; ?>contaPagar?p=<?php echo $paginaAtual + 1; ?>"><span style="height: 20px;"
                                                                                                class="glyphicon glyphicon-forward"
                                                                                                aria-hidden="true"></span></a>
        </li>
    <?php endif; ?>
    <?php if ($paginas > 1): ?>
        <li><a href="<?php echo BASE_URL; ?>contaPagar?p=<?php echo $paginas; ?>">Ultima Pagina</a></li>
    <?php endif; ?>

</ul>