<h1 class="h1">Adicionar Compra</h1>

<br/>

<form id="form" method="POST" onsubmit="return validacao();">

    <label>Fornecedor:</label><br/>
    <input type="hidden" name="id_fornecedor"/>
    <input type="text" class="form-control" id="fornecedor_razao" autocomplete="off" name="fornecedor_razao" data-type="pesquisar_fornecedores"/>
    <div style="clear: both"></div>

    <br/><br/>

    <div style="padding-left: 0px;" class="form-group col-sm-2">
        <label>N�mero da Nota:</label>
        <input type="text" class="form-control" id="numero_nota" name="numero_nota" placeholder="Digite o n�mero da nota."/>
    </div>

    <div style="clear:both"></div>

    <label style="float: right; margin-right: 36px;">Total da Compra:</label><br/>
    <div style="clear: both"></div>
    <input type="text" class="form-control" id="total_compra" autocomplete="off" name="total_compra" placeholder="0,00" disabled="true"/>

    <br/><br/>

    <hr style="border: 1px solid #CCC;"/>

    <h4>Produtos</h4>

    <input type="text" class="form-control" id="add_prod_compra"  name="add_prod_compra" data-type="pesquisar_loteProdutos"/>


    <br/><br/><br/><br/>

    <div class="table-responsive">
        <table id="tabela_produtos" class="table">
            <tr>
                <th>Lote</th>
                <th>Produto</th>
                <th>Quant.</th>
                <th>Pre�o Unit.</th>
                <th>Sub Total</th>
                <th>A��o</th>
            </tr>
        </table>
    </div>
    <hr style="border: 1px solid #CCC;"/>

    <div class="col-sm-12">
        <input type="submit" class="btn btn-success" value="Salvar"  />
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>compra">Voltar</a>
    </div>
</form>


<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/compra/compra_add.js"></script>