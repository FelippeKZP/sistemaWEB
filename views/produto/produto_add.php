<h1>Adicionar Produto</h1>

<br/>

<?php if (isset($msg_erro) && !empty($msg_erro)): ?>
    <script>swal("Ocorreu um erro salvar o produto.", "", "error");</script>
<?php endif; ?>

<?php if (isset($msg_sucesso) && !empty($msg_sucesso)): ?>
    <script>swal("Sucesso ao salvar o produto.", "", "success");</script>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" id="form">

    <div class="form-group  col-sm-3">
        <label>Cód. Barras:</label>
        <input type="text" class="form-control" id="cod_barras" name="cod_barras"
               placeholder="Digite o Cód. de Barras;"/>
    </div>

    <div class="form-group col-sm-5">
        <label>Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite um Nome."/>
    </div>

    <div class="form-group col-sm-4">
        <label>Grupos de Produto:</label>
        <select id="id_grupo_produto" class="form-control" name="id_grupo_produto" required="true">
            <?php foreach ($grupo_produto_list as $g): ?>
                <option value="<?php echo $g['id']; ?>"><?php echo $g['nome']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div style="clear: both;"></div>

    <div class="form-group col-sm-3">
        <label>Quantidade Mínima:</label>
        <input type="text" class="form-control" id="quantidade_min" name="quantidade_min"
               placeholder="Digite a Quantidade Mínima."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Preço de Venda:</label>
        <input type="text" class="form-control" id="preco" name="preco" placeholder="Digite o Preço de Venda."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Preço de Compra:</label>
        <input type="text" class="form-control" id="preco_compra" name="preco_compra" onblur="lucro();"
               placeholder="Digite o Preço de Compra."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Lucro da Venda:</label>
        <input type="text" class="form-control" id="lucro_venda" name="lucro_venda" placeholder="0,00" readonly="true"/>
    </div>

    <div style="clear: both;"></div>

    <div class="form-group col-sm-3">
        <label>Margem Bruta:</label>
        <input type="text" class="form-control" id="margem_bruta" name="margem_bruta" placeholder="0.00%"
               readonly="true"/>
    </div>

    <div class="form-group col-sm-3">
        <label>Status:</label>
        <select id="status" class="form-control" name="status" required="true">
            <option value="1">Disponível</option>
            <option value="0">Indisponivel</option>
        </select>
    </div>

    <div class="form-group col-sm-3">
        <label>Fotos: (suporta apenas foto em png.)</label>
        <div class="fileUpload btn btn-primary">
            <span><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Upload</span>
            <input type="file" id="fotos" name="fotos[]" class="upload" multiple/>
        </div>
    </div>

    <div class=" form-group col-sm-12" style="float: right;">
        <button class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>produto"><span class="glyphicon glyphicon-repeat"
                                                                               aria-hidden="true"></span> Voltar</a>
    </div>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/produto/script_produto.js"></script>