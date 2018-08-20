<h1 class="h1">Adicionar Compra</h1>

<br/><br/>

<form method="POST">

    <label>Fornecedor:</label>
    <input type="hidden" id="id_fornecedor" name="id_fornecedor"/>
    <input type="text" class="form-control" id="fornecedor_razao" name="fornecedor_razao" data-type="pesquisar_fornecedores" autocomplete="off" />
    <div style="clear:both"></div>

    <br/><br/>

    <label style="float: right; margin-right: 37px;">Total da Compra:</label>
    <div style="clear: both"></div>
    <input type="text" class="form-control" id="total_compra" name="total_compra" disabled="true" placeholder="0,00"/>

    <br/><br/>

    <hr style="border: 1px solid #ccc;"/>

    <h4>Produtos</h4>

    <input type="text" class="form-control" id="add_prod_compra" name="id_add_compra" data-type="pesquisar_loteProdutos"/>

    <br/><br/><br/><br/>

    <div class="table-responsive">
        <table id="tabela_compra_produtos" class="table table-hover">
            <tr>
                <td>Lote</td>
                <td>Produto</td>
                <td>Quant.</td>
                <td>Preço Uni.</td>
                <td>Sub Total</td>
                <td>Ação</td>
            </tr>
        </table>
    </div>

    <hr style="border: 1px solid #CCC;"/>

    <div class="form-group col-sm-12">
        <input type="submit" class="btn btn-success" value="Salvar"/>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>compra">Voltar</a>
    </div>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/compra/compra_add.js"></script>