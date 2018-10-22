<h1 class="h1">Vizualizar Venda</h1>

<br/>

<div class="form-group col-sm-3" style="margin-left: -15px;">
    <label>Cliente:</label>
    <p class="form-control-static"><?php echo $info['info']['nome']; ?></p>
    <div style="clear: both"></div>
</div>

<div class="form-group col-sm-3" style="margin-left: -15px;">
    <label>CPF/CNPJ:</label>
    <p class="form-control-static"><?php echo $info['info']['cpfCnpj']; ?></p>
    <div style="clear: both"></div>
</div>

<div class="form-group col-sm-3" style="margin-left: -15px;">
    <label>Data:</label><br/>
    <p class="form-control-static"><?php echo date('d/m/Y', strtotime($info['info']['data_venda'])); ?></p>
    <div style="clear: both"></div>
</div>

<div style="clear: both;"></div>

<br/>

<label style="float: right; margin-right: 47px;">Total da Venda:</label><br/>
<div style="clear: both"></div>
<p class="form-control-static" id="total_venda">R$ <?php echo number_format($info['info']['total_venda'], 2, ',', '.'); ?></p>
<br/>

<h4>Produtos</h4>

<div class="table-responsive">
    <table id="tabela" class="table table-hover">
        <thead>
            <tr>
                <th>Lote</th>
                <th>Produto</th>
                <th>Preço Venda</th>
                <th>Quant.</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <?php foreach ($info['produtos'] as $prod): ?>
            <tbody>
                <tr>
                    <td><?php echo $prod['numero_lote']; ?></td>
                    <td><?php echo $prod['nome']; ?></td>
                    <td><?php echo number_format($prod['preco'], 2, ',', '.'); ?></td>
                    <td><?php echo $prod['quantidade']; ?></td>
                    <td>R$ <?php echo number_format($prod['total'], 2, ',', '.'); ?></td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>

<br/>

<div class="form-group col-sm-12" style="margin-left: -15px;">
    <a class="btn btn-warning" href="<?php echo BASE_URL; ?>venda"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Voltar</a>
</div>

