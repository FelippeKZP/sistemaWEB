<h1 class="h1">Contas a Pagar</h1>

<br/><br/>

<a class="btn btn-info" href="<?php echo BASE_URL; ?>contaPagar/conta_pagar_add">Adicionae Contas a Pagar</a>

<br/><br/>

<form method="GET">
    <input type="text" class="form-control" id="searchs" name="searchs" value="<?php echo (!empty($_GET['searchs'])) ? $_GET['searchs'] : ''; ?>" />
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
                               href="<?php echo BASE_URL; ?>contaPagar/conta_pagar_receber/<?php echo $c['id']; ?>">Pagar</a>
                           <?php else: ?>
                            <a class="btn btn-primary"
                               href="<?php echo BASE_URL; ?>contaPagar/conta_pagar_receber/<?php echo $c['id']; ?>">Vizualizar</a>
                           <?php endif; ?>
                        <a class="btn btn-danger"
                           onclick="return confirm('Deseja Excluir ?');"
                           href="<?php echo BASE_URL; ?>contaPagar/conta_pagar_excluir/<?php echo $c['id']; ?>">Excluir</a>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>