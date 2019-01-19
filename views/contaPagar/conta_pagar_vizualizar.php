<h1>Vizualizar Conta a Pagar</h1>

<br/><br/>

<form id="form" method="POST">
    <div class="form-group col-sm-3">
        <label>Tipo de Conta:</label>
        <select name="tipo" class="form-control" disabled="true">
            <option value="0" <?php echo ($conta_pagar_info['tipo'] == '0') ? 'selected="selected"' : ''; ?>>Água
            </option>
            <option value="1" <?php echo ($conta_pagar_info['tipo'] == '1') ? 'selected="selected"' : ''; ?>>Aluguel
            </option>
            <option value="2" <?php echo ($conta_pagar_info['tipo'] == '2') ? 'selected="selected"' : ''; ?>>Compra
            </option>
            <option value="3" <?php echo ($conta_pagar_info['tipo'] == '3') ? 'selected="selected"' : ''; ?>>Internet
            </option>
            <option value="4" <?php echo ($conta_pagar_info['tipo'] == '4') ? 'selected="selected"' : ''; ?>>Telefone
            </option>
            <option value="5" <?php echo ($conta_pagar_info['tipo'] == '5') ? 'selected="selected"' : ''; ?>>Luz
            </option>
            <option value="6" <?php echo ($conta_pagar_info['tipo'] == '6') ? 'selected="selected"' : ''; ?>>Outros
                Tipos de Conta
            </option>
        </select>
    </div>
    <div class="form-group col-sm-3">
        <label>Descrição:</label>
        <input type="text" class="form-control" id="descricao" name="descricao"
               value="<?php echo $conta_pagar_info['descricao']; ?>" placeholder="Digite a descrição" disabled="true"/>
    </div>
    <div class="form-group col-sm-2">
        <label>Data da Conta:</label>
        <input type="text" class="form-control" id="data_conta" name="data_conta"
               value="<?php echo date('d/m/Y', strtotime($conta_pagar_info['data_conta'])); ?>" placeholder="00/00/0000"
               disabled="true"/>
    </div>
    <div class="form-group col-sm-2">
        <label>Data de Vencimento:</label>
        <input type="text" class="form-control" id="data_vencimento" name="data_vencimento"
               value="<?php echo date('d/m/Y', strtotime($conta_pagar_info['data_vencimento'])); ?>"
               placeholder="00/00/0000" disabled="true"/>
    </div>
    <div class="form-group col-sm-2">
        <label>Data de Pagamento:</label>
        <input type="text" class="form-control" id="data_pagamento" name="data_pagamento"
               value="<?php echo date('d/m/Y', strtotime($conta_pagar_info['data_pagamento'])); ?>"
               placeholder="00/00/0000" disabled="true"/>
    </div>
    <div class="form-group col-sm-2">
        <label>Total:</label>
        <input type="text" class="form-control" id="total" name="total"
               value="<?php echo number_format($conta_pagar_info['total'], 2, ',', '.'); ?>" placeholder="0,00"
               disabled="true"/>
    </div>
    <div class="form-group col-sm-3">
        <label>Status:</label>
        <select name="status" class="form-control" disabled="true">
            <option value="0" <?php echo ($conta_pagar_info['status'] == '0') ? 'selected="selected"' : ''; ?>>
                Pendente
            </option>
            <option value="1" <?php echo ($conta_pagar_info['status'] == '1') ? 'selected="selected"' : ''; ?>>Pago
            </option>
        </select>
    </div>

    <div class=" form-group col-sm-12">
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>contaPagar"><span class="glyphicon glyphicon-repeat"
                                                                                  aria-hidden="true"></span> Voltar</a>
    </div>
    </div>
</form>

