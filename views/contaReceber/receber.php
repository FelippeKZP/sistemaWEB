<script type="text/javascript">

    $(document).ready(function () {

        $('form').validate({
            rules: {
                dinheiro: {
                    required: true
                }
            },
            messages: {
                dinheiro: {
                    required: "Este Campo � Obrigat�rio."
                }
            }
        });

    });

    $(document).ready(function () {

        $('#dinheiro').mask('000.000.000.000.000,00', {reverse: true, placeholder: "0,00"});

        $('#troco').mask('000.000.000.000.000,00', {reverse: true, placeholder: "0,00"});

    });

    function soma() {

        var total_venda = $('#total').val().replace(',', '.');
        var dinheiro = $('#dinheiro').val().replace(',', '.');



        if (total_venda <= dinheiro) {

            var troco = parseFloat(dinheiro) - parseFloat(total_venda);

            $('#troco').val(troco.toFixed(2).replace('.', ','));

        } else {

            bootbox.alert("Dinheiro Tem Que Ser Maior Que O Total Da Venda");

            $('#dinheiro').val('');
            $('#troco').val('');



        }


    }


</script>

<h1>Receber Conta</h1>

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
        <input type="text" id="total" class="form-control" value="<?php echo number_format($info['total_venda'], 2, ',', '.'); ?>" disabled="true"/>
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
            <input type="submit" class="btn btn-success" value="Salvar"/>
        <?php endif; ?>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>contaReceber">Voltar</a>
    </div>


</form>
