<h1 class="h1">Editar Lote de Produto</h1>

<div class="alert alert-info">
    <strong>Os campo em vermelho são obrigatório.</strong>
</div>

<br/>

<?php if (isset($msg_erro) && !empty($msg_erro)): ?>
    <script>swal("Ocorreu um erro editar o lote de produto.", "", "error");</script>
<?php endif; ?>

<?php if (isset($msg_sucesso) && !empty($msg_sucesso)): ?>
    <script>swal("Sucesso ao editar o lote de produto.", "", "success");</script>
<?php endif; ?>

<form id="form" method="POST">


    <label>Número de Lote:</label>
    <input type="text" id="numero_lote" class="form-control" name="numero_lote"
           value="<?php echo $lote_produto_editar_list['numero_lote']; ?>" placeholder="Digite o Número do Lote."/>

    <br/>

    <label>Produto:</label>
    <input type="hidden" name="id_produto" value="<?php echo $lote_produto_editar_list['id_produto']; ?>"/>
    <input type="text" class="form-control autocomplete" id="produto" name="produto"
           value="<?php echo $lote_produto_editar_list['nome']; ?>" data-type="pesquisar_produtos"/>

    <div style="clear: both"></div>

    <br/>

    <label>Fornecedor:</label>
    <input type="hidden" name="id_fornecedor" value="<?php echo $lote_produto_editar_list['id_fornecedor']; ?>"/>
    <input type="text" class="form-control autocomplete" id="fornecedor" name="fornecedor"
           value="<?php echo $lote_produto_editar_list['razao_social']; ?>" data-type="pesquisar_fornecedores"/>

    <div style="clear: both"></div>

    <br/>

    <div class="form-group col-sm-2" style="padding-left: 0px;">
        <label>Quantidade:</label>
        <input type="text" id="quantidade" class="form-control" name="quantidade"
               value="<?php echo $lote_produto_editar_list['quantidade']; ?>" placeholder="Digite a Quantidade"
               disabled="true"/>
    </div>

    <div class="form-group col-sm-2">
        <label>Data de Fabricação:</label>
        <input type="text" id="data_fabricacao" class="form-control" name="data_fabricacao"
               value="<?php echo date('d/m/Y', strtotime($lote_produto_editar_list['data_fabricacao'])); ?>"
               placeholder="Digite a Data de Fabricação."/>
    </div>

    <div class="form-group col-sm-2">
        <label>Data de Vencimento:</label>
        <input type="text" id="data_vencimento" name="data_vencimento" class="form-control"
               value="<?php echo date('d/m/Y', strtotime($lote_produto_editar_list['data_vencimento'])); ?>"
               placeholder="Digite a Data de Vencimento"/>
    </div>

    <div class="form-group col-sm-3">
        <label>Status:</label>
        <select id="status" name="status" class="form-control">
            <option value="">Selecione um status.</option>
            <option value="1" <?php echo ($lote_produto_editar_list['status'] == '1') ? 'selected ="selected"' : ''; ?>>
                Dísponivel
            </option>
            <option value="0" <?php echo ($lote_produto_editar_list['status'] == '0') ? 'selected="selected"' : ''; ?>>
                Indisponivel
            </option>
        </select>
    </div>

    <div class=" form-group col-sm-12" style="margin-left: -15px;">
        <button class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>loteProduto"><span class="glyphicon glyphicon-repeat"
                                                                                   aria-hidden="true"></span> Voltar</a>
    </div>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/loteProduto/script_lote_produto.js"></script>
