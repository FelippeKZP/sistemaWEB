<h1 class="h1">Adicionar Venda</h1>

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


<form id="form" method="POST" onsubmit="return validacao();">

    <label>Cliente:</label><br/>
    <input type="hidden" name="id_cliente"/>
    <input type="text" class="form-control" id="cliente_nome" name="cliente_nome" data-type="pesquisar_clientes"/>
    <div style="clear: both"></div>

    <br/><br/>

    <label style="float: right; margin-right: 47px;">Total da Venda:</label><br/>
    <div style="clear: both"></div>
    <input type="text" class="form-control" id="total_venda" name="total_venda" disabled="true"/>

    <br/><br/>

    <hr style="border: 1px solid #CCC;"/>

    <h4>Produtos</h4>

    <input type="text" class="form-control" id="add_prod"  name="add_prod" data-type="pesquisar_loteProdutos"/>

    <br/>    <br/>    <br/>    <br/>

    <div class="table-responsive">
        <table id="tabela_produtos" class="table">
            <tr>
                <th>Lote</th>
                <th>Produto</th>
                <th>Quant.</th>
                <th>Preço Unit.</th>
                <th>Sub Total</th>
                <th>Ação</th>
            </tr>
        </table>
    </div>
    <hr style="border: 1px solid #CCC;"/>

    <div class="col-sm-12">
        <input type="submit" class="btn btn-success" value="Salvar"  />
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>venda">Voltar</a>
    </div>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/venda/script_venda_add.js"></script>