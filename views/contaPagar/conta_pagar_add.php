<h1>Adicionar Conta a Pagar</h1>

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
        <label>Tipo de Conta:</label>
        <select name="tipo" class="form-control">
            <option value="0">Água</option>
            <option value="1">Aluguel</option>
            <option value="2">Compra</option>
            <option value="3">Internet</option>
            <option value="4">Telefone</option>
            <option value="5">Luz</option>
            <option value="6">Outros Tipos de Conta</option>
        </select>
    </div>
    <div class="form-group col-sm-3">
        <label>Descrição:</label>
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite a descrição"/>
    </div>
    <div class="form-group col-sm-2">
        <label>Data da Conta:</label>
        <input type="text" class="form-control" id="data_conta" name="data_conta" placeholder="00/00/0000"/>
    </div>
    <div class="form-group col-sm-2">
        <label>Data de Vencimento:</label>
        <input type="text" class="form-control" id="data_vencimento" name="data_vencimento" placeholder="00/00/0000"/>
    </div>
    <div class="form-group col-sm-2">
        <label>Data de Pagamento:</label>
        <input type="text" class="form-control" id="data_pagamento" name="data_pagamento" placeholder="00/00/0000"/>
    </div>
    <div class="form-group col-sm-2">
        <label>Total:</label>
        <input type="text" class="form-control" id="total" name="total" placeholder="0,00"/>
    </div>
    <div class="form-group col-sm-3">
        <label>Status:</label>
        <select name="status" class="form-control">
            <option value="0">Pendente</option>
            <option value="1">Pago</option>
        </select>
    </div>

    <div class="form-group col-sm-12">
        <button  class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>contaPagar"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Voltar</a>
    </div>
    
</form>