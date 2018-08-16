<h1 class="h1">Contas a Receber</h1>

<br/><br/>

<form method="GET">
    <input type="text" class="form-control col-sm-5" id="searchs" name="searchs" value="<?php echo (!empty($_GET['searchs'])) ? $_GET['searchs'] : ''; ?>"/>
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
    <table id="tabela" class="table table-hover" border="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>CPF/CNPJ</th>
                <th>Data da Venda</th>
                <th>Data de Vencimento</th>
                <th>Data de Recebimento</th>
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
                    <td><?php echo date('d/m/Y', strtotime($c['data_venda'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($c['data_vencimento'])); ?></td>
                    <td><?php
                        if ($c['data_recebimento'] == 0000 - 00 - 00) {
                            echo '<span style="color:red;">' . 'Conta Não Foi Recebida' . '</span>';
                        } else {
                            echo date('d/m/Y', strtotime($c['data_recebimento']));
                        }
                        ?></td>
                    <td><?php echo number_format($c['total_venda'], 2, ',', '.'); ?></td>
                    <td><?php
                        if ($c['status'] == 0) {
                            echo '<span style="color:red;">' . $status[$c['status']] . '<span>';
                        } else {
                            echo '<span style ="color:green;">' . $status[$c['status']] . '</span>';
                        }
                        ?></td>
                    <td>
                        <?php if ($c['status'] == 0): ?>
                            <a class="btn btn-success"
                               href="<?php echo BASE_URL; ?>contaReceber/receber/<?php echo $c['id']; ?>">Pagar</a>
                           <?php elseif ($c['status'] == 1): ?>
                            <a class="btn btn-primary"
                               href="<?php echo BASE_URL; ?>contaReceber/receber/<?php echo $c['id']; ?>">Vizualizar</a>
                           <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>

<ul class="pagination">
    <?php if ($total > $limit): ?>
        <?php if ($paginaAtual != 1): ?>
            <li><a href="<?php echo BASE_URL; ?>contaReceber?p=1">Primeira Pagina</a></li>
        <?php endif; ?>
    <?php endif; ?>
    <?php for ($q = 1; $q <= $paginas; $q++): ?>
        <?php if ($paginaAtual == $q): ?>
            <li class="active"><a href="<?php echo BASE_URL; ?>contaReceber?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php else: ?>
            <li><a href="<?php echo BASE_URL; ?>contaReceber?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>
    <?php for ($q = $paginaAtual + $max; $q <= $paginaAtual + 1; $q++): ?>
        <li class="active"><a href="<?php echo BASE_URL; ?>contaReceber?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endfor; ?>
    <li><a href="<?php echo BASE_URL; ?>contaReceber?p=<?php echo $paginas; ?>">Ultima Pagina</a></li
</ul>


