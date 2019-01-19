<h1 class="h1">Contas a Receber</h1>

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
    echo "Filtrado pela Cliente: " . $filtros['searchs'] . "<br/>";
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
    <table id="tabela" class="table table-hover" border="0" width="100%">
        <thead>
        <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>CPF/CNPJ</th>
            <th>Tipo de Pag.</th>
            <th>Parcela</th>
            <th>Data de Venc.</th>
            <th>Data de Rec.</th>
            <th>Total</th>
            <th>Status</th>
            <th>Ação</th>
        </tr>
        </thead>
        <?php foreach ($conta_list as $c): ?>
            <tbody>
            <tr>
                <td><?php echo $c['id']; ?></td>
                <td><?php echo $c['nome']; ?></td>
                <td><?php echo $c['cpfCnpj']; ?></td>
                <td><?php echo $tipo_pag[$c['tipo_pag']]; ?></td>
                <td><?php echo $c['parcela']; ?></td>
                <td><?php echo date('d/m/Y', strtotime($c['data_vencimento'])); ?></td>
                <td><?php
                    if ($c['data_recebimento'] == 0000 - 00 - 00) {
                        echo '<span class="label label-danger">' . 'Conta Não Foi Recebida' . '</span>';
                    } else {
                        echo date('d/m/Y', strtotime($c['data_recebimento']));
                    }
                    ?></td>
                <td><?php echo number_format($c['valor'], 2, ',', '.'); ?></td>
                <td><?php
                    if ($c['status'] == 0) {
                        echo '<span class="label label-danger">' . $status[$c['status']] . '<span>';
                    } else {
                        echo '<span class ="label label-success">' . $status[$c['status']] . '</span>';
                    }
                    ?></td>
                <td>
                    <?php if ($c['status'] == 0): ?>
                        <a class="btn btn-success"
                           href="<?php echo BASE_URL; ?>contaReceber/receber/<?php echo $c['id']; ?>"><span
                                    class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
                        </a>
                    <?php elseif ($c['status'] == 1): ?>
                        <a class="btn btn-primary"
                           href="<?php echo BASE_URL; ?>contaReceber/receber/<?php echo $c['id']; ?>"><span
                                    class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>

<div style="clear:both"></div>

<ul class="pagination">
    <?php if ($paginaAtual != 1): ?>
        <li><a href="<?php echo BASE_URL; ?>contaReceber?p=1">Primeira Pagina</a></li>
    <?php endif; ?>
    <?php if ($paginaAtual != 1): ?>
        <li><a href="<?php echo BASE_URL; ?>contaReceber?p=<?php echo $paginaAtual - 1 ?>"><span
                        class="glyphicon glyphicon-backward" aria-hidden="true" style="height: 20px;"></span></a></li>
    <?php endif; ?>
    <?php for ($q = 1; $q <= $paginas; $q++): ?>
        <?php if ($paginaAtual == $q): ?>
            <li class="active"><a href="<?php echo BASE_URL; ?>contaReceber?p=<?php echo $q; ?>"><?php echo $q; ?></a>
            </li>
        <?php else: ?>
            <li><a href="<?php echo BASE_URL; ?>contaReceber?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>
    <?php if ($paginaAtual < $paginas): ?>
        <li><a href="<?php echo BASE_URL; ?>contaReceber?p=<?php echo $paginaAtual + 1 ?>"><span style="height: 20px;"
                                                                                                 class="glyphicon glyphicon-forward"
                                                                                                 aria-hidden="true"></span></a>
        </li>
    <?php endif; ?>
    <?php if ($paginas > 1): ?>
        <li><a href="<?php echo BASE_URL; ?>contaReceber?p=<?php echo $paginas; ?>">Ultima Pagina</a></li>
    <?php endif; ?>
</ul>