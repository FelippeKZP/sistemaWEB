<h1 class="h1">Adicionar Lote de Produto</h1>

<div class="alert alert-info">
    <strong>Os campo em vermelho são obrigatório.</strong>
</div>

<br/>

<?php if (isset($msg_erro) && !empty($msg_erro)): ?>
    <script>swal("Ocorreu um erro salvar o lote de produto.", "", "error");</script>
<?php endif; ?>

<?php if (isset($msg_sucesso) && !empty($msg_sucesso)): ?>
    <script>swal("Sucesso ao salvar o lote de produto.", "", "success");</script>
<?php endif; ?>

<form method="POST" id="form">


    <label>Número de Lote:</label>
    <input type="text" class="form-control" id="numero_lote" name="numero_lote" placeholder="Digite o Número do Lote."/>

    <br/>

    <label>Produto:</label>
    <input type="hidden" name="id_produto"/>
    <input type="text" class="form-control  autocomplete" id="produto" name="produto" data-type="pesquisar_produtos"
           required="true"/>

    <div style="clear: both"></div>

    <br/>

    <label>Fornecedor:</label>
    <input type="hidden" name="id_fornecedor"/>
    <input type="text" class="form-control autocomplete" id="fornecedor" name="fornecedor"
           data-type="pesquisar_fornecedores" required="true"/>

    <div style="clear: both"></div>

    <br/>

    <div class="form-group col-sm-2" style="padding-left: 0px;">
        <label>Quantidade:</label>
        <input type="text" class="form-control" id="quantidade" name="quantidade" placeholder="Digite a Quantidade"/>
    </div>

    <div class="form-group col-sm-2">
        <label>Data de Fabricação:</label>
        <input type="text" class="form-control" id="data_fabricacao" name="data_fabricacao"
               placeholder="Digite a Data de Fabricação."/>
    </div>

    <div class="form-group col-sm-2">
        <label>Data de Vencimento:</label>
        <input type="text" class="form-control" id="data_vencimento" name="data_vencimento"
               placeholder="Digite a Data de Vencimento"/>
    </div>

    <div class="form-group col-sm-3">
        <label>Status:</label>
        <select id="status" name="status" class="form-control">
            <option value="">Selecione um status.</option>
            <option value="1">Diposnível</option>
            <option value="0">Indisponivel</option>
        </select>
    </div>


    <div class=" form-group col-sm-12" style="margin-left: -15px;">
        <button class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>loteProduto"><span class="glyphicon glyphicon-repeat"
                                                                                   aria-hidden="true"></span> Voltar</a>
    </div>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/loteProduto/script_lote_produto.js"></script>