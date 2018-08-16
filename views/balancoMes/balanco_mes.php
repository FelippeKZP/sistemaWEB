<h1>Balanço Mês</h1>

<br/><br/>

<div class="col-sm-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Mês Atual</h3>
        </div>
        <div class="panel-body">
            <label>Receita:</label>
            <input type="text" class="form-control" disabled="true" id="receita"  name="receita" style="color:blue;" value="<?php echo number_format($atual_list['venda'], 2, ',', '.'); ?>" />
            <label>Compra:</label>
            <input type="text" class="form-control" disabled="true" id="compra" name="compra" style="color:red;" value="<?php echo number_format($atual_list['compra'], 2, ',', '.'); ?>" />
            <label>Perda:</label>
            <input type="text" class="form-control" disabled="true" id="perda" name="perda" style="color:red;" value="<?php echo number_format($atual_list['perda'], 2, ',', '.'); ?>" />
            <label>Outras Desp:</label>
            <input type="text" class="form-control" disabled="true" id="outraDespesas" name="outraDespesas" style="color:red;" value="<?php echo number_format($atual_list['outras'], 2, ',', '.'); ?>" />

            <hr style="border: 4px solid #444; border-radius: 2px;"/>

            <label>Lucro Líq:</label>
            <input type="text" class="form-control" disabled="true" id="lucro" name="lucro" style="color:blue;" value="<?php echo number_format($atual_list['venda'] - $atual_list['compra'] - $atual_list['perda'] - $atual_list['outras'], 2, ',', '.'); ?>" />
        </div>
    </div>

</div>

<div class="col-sm-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Mês Anterior</h3>
        </div>
        <div class="panel-body">
            <label>Receita:</label>
            <input type="text" class="form-control" disabled="true" id="receita"  name="receita" style="color:blue;" value="<?php echo number_format($anterior_list['venda'],2,',','.'); ?>" />
            <label>Compra:</label>
            <input type="text" class="form-control" disabled="true" id="compra" name="compra" style="color:red;" value="<?php echo number_format($anterior_list['compra'],2,',','.'); ?>" />
            <label>Perda:</label>
            <input type="text" class="form-control" disabled="true" id="perda" name="perda" style="color:red;" value="<?php echo number_format($anterior_list['perda'],2,',','.'); ?>" />
            <label>Outras Desp:</label>
            <input type="text" class="form-control" disabled="true" id="outraDespesas" name="outraDespesas" style="color:red;" value="<?php echo number_format($anterior_list['outras'],2,',','.'); ?>" />

            <hr style="border: 4px solid #444; border-radius: 2px;"/>

            <label>Lucro Líq:</label>
            <input type="text" class="form-control" disabled="true" id="lucro" name="lucro" style="color:blue;" value="<?php echo number_format($anterior_list['venda'] - $atual_list['compra'] - $atual_list['perda'] - $atual_list['outras'], 2, ',', '.'); ?>" />
        </div>
    </div>
</div>