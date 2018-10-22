
<h1>Receber Conta</h1>

<br/>

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

<form id="form" method="POST">

    <div class="form-group col-sm-3">
        <label>Cliente:</label>
        <input type="text" class="form-control" value="<?php echo $info['nome']; ?>" disabled="true"/>
    </div>

    <div class="form-group col-sm-3">
        <label>CPF/CNPJ:</label>
        <input type="text" class="form-control" value="<?php echo $info['cpfCnpj']; ?>" disabled="true"/>
    </div>

    <div class="form-group col-sm-3">
        <label>Data da Venda:</label>
        <input type="text" class="form-control" value="<?php echo date('d/m/Y', strtotime($info['data_venda'])); ?>" disabled="true"/>
    </div>

    <div class="form-group col-sm-3">
        <label>Data do Vencimento:</label>
        <input type="text" class="form-control" value="<?php echo date('d/m/y', strtotime($info['data_vencimento'])); ?>" disabled="true"/>
    </div>

    <div class="form-group col-sm-2">
        <label>Total da Venda:</label>
        <input type="text" id="total" class="form-control" value="<?php echo number_format($info['valor'], 2, ',', '.'); ?>" disabled="true"/>
    </div>


    <div class="form-group col-sm-2">
        <label>Dinheiro:</label>
        <?php if ($info['status'] == 0): ?>
            <input type="text" id="dinheiro" name="dinheiro"  class="form-control" onblur="soma();"/>
        <?php else: ?>
            <input type="text" value="<?php echo number_format($info['dinheiro'], 2, ',', '.'); ?>"  class="form-control" disabled="true"/>
        <?php endif; ?>
    </div>

    <div class="form-group col-sm-2" style="margin-right: 40px;">
        <label>Troco:</label>
        <?php if ($info['status'] == 0): ?>
            <input type="text" id="troco" name="troco" class="form-control" readonly="true" />
        <?php else: ?>
            <input type="text" value="<?php echo number_format($info['troco'], 2, ',', '.'); ?>" class="form-control" disabled="true" />
        <?php endif; ?>
    </div>


    <div class="form-group col-sm-2">
        <label>Status:</label>
        <?php if ($info['status'] == 0): ?>
            <input type="text" class="form-control" style="color:red;" value="<?php echo $status[$info['status']]; ?>" disabled="true"/>
        <?php else: ?>
            <input type="text" class="form-control" style="color:green;" value="<?php echo $status[$info['status']]; ?>" disabled="true"/>
        <?php endif; ?>

    </div>

    <div class="form-group col-sm-12">
        <?php if ($info['status'] == 0): ?>
            <button class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
        <?php endif; ?>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>contaReceber"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Voltar</a>
    </div>


</form>

<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/contaReceber/script_receber_add.js"></script>