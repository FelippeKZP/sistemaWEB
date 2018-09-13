<h1>Adicionar Conta a Pagar</h1>

<br/><br/>

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

    <div class="col-sm-12">
        <input type="submit" class="btn btn-success" value="Salvar"/>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>contaPagar">Voltar</a>
    </div>
</form>