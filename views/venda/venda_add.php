<h1 class="h1">Adicionar Venda</h1>

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


<form id="form" method="POST" onsubmit="return validacao();">

    <label>Cliente:</label><br/>
    <input type="hidden" name="id_cliente"/>
    <input type="text" class="form-control" id="cliente_nome" name="cliente_nome" autocomplete="off"
           data-type="pesquisar_clientes"/>


    <div style="clear:both"></div>

    <br/><br/>

    <div class="form-group col-sm-4" style="padding-left: 0px;">
        <label>Vendendor:</label>
        <select id="id_funcionario" name="id_funcionario" class="form-control">
            <?php foreach ($funcionario_list as $f): ?>
                <option value="<?php echo $f['id']; ?>"><?php echo $f['nome']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group col-sm-2">
        <label>Desconto:</label>
        <input type="text" class="form-control" id="desconto" onblur="desc();" name="desconto" value="0,00"
               placeholder="0,00"/>
    </div>

    <div style="clear: both"></div>

    <label style="float: right; margin-right: 47px;">Total da Venda:</label><br/>
    <div style="clear: both"></div>
    <input type="text" class="form-control" id="total_venda" name="total_venda" disabled="true" placeholder="0,00"/>

    <br/>

    <div style="clear: both"></div>

    <div class="form-group col-sm-3">
        <label>Condição de Pagamento</label>
        <select id="condicao_pag" name="condicao_pag" class="form-control">
            <option value=0>À vista</option>
            <option value=1>À prazo</option>
        </select>
    </div>

    <div id="data_venc" class="form-group col-sm-3">
        <label>Data de Vencimento:</label>
        <input type="date" class="form-control" id="data_vencimento" name="data_vencimento" required="true"/>
    </div>

    <div id="parcelas" class="form-group col-sm-2" style="display: none;">
        <label>Número de Parcelas:</label>
        <input type="text" class="form-control" id="n_parcelas" name="n_parcelas"/>
    </div>

    <div id="btGerar" style="display: none; padding-top: 25px;" class="form-group col-sm-2">
        <button class="btn btn-primary" id="btnGerar"><span class="glyphicon glyphicon-plus-sign"
                                                            aria-hidden="true"></span> Gerar Parcelas
        </button>
    </div>

    <br/><br/>

    <div style="clear:both"></div>

    <div class="resultado_parcelas" style="display: none;">
        <div class="table-responsive">
            <table id="tabela_parcelas" class="table table-hover">
                <thead>
                <tr>
                    <th>Parcela</th>
                    <th class="text-center">Vencimento</th>
                    <th>Valor</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <hr style="border: 1px solid #CCC;"/>

    <h4>Produtos</h4>

    <input type="text" class="form-control" id="add_prod" name="add_prod" autocomplete="off"
           data-type="pesquisar_loteProdutos"/>

    <br/><br/><br/><br/>

    <div class="table-responsive">
        <table id="tabela_produtos" class="table">
            <tr>
                <th>Imagem</th>
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

    <div class="form-group col-sm-12" style="margin-left: -15px;">
        <button class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>venda"><span class="glyphicon glyphicon-repeat"
                                                                             aria-hidden="true"></span> Voltar</a>
    </div>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/venda/script_venda_add.js"></script>
