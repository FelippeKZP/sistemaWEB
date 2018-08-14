<h1>Editar Produto</h1>

<br/><br/>

<?php if (isset($msg_erro) && !empty($msg_erro)): ?>
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?php echo $msg_erro; ?></strong>
    </div>
<?php endif; ?>

<?php if (isset($msg_sucesso) && !empty($msg_sucesso)): ?>
    <div class="alert alert-sucess alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?php echo $msg_sucesso; ?></strong>
    </div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data"  id="form">

    <div class="form-group col-sm-3">
        <label>C�d. Barras:</label>
        <input type="text" class="form-control" id="cod_barras" name="cod_barras" value="<?php echo $produto_editar_list['cod_barras']; ?>" placeholder="Digite o C�d. de Barras;"/>
    </div>

    <div class="form-group col-sm-5">
        <label>Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $produto_editar_list['nome'] ?>" placeholder="Digite um Nome."/>
    </div>

    <div class="form-group col-sm-4">
        <label>Grupos de Produto:</label>
        <select id="id_grupo_produto" class="form-control" name="id_grupo_produto">
            <?php foreach ($grupo_produto_list as $g): ?>
                <option value="<?php echo $g['id']; ?>"
                        <?php echo ($produto_editar_list['id_grupo_produto'] == $g['id']) ? 'selected = "selected"' : ''; ?>>
                    <?php echo $g['nome']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group col-sm-3">
        <label>Quantidade M�nima:</label>
        <input type="text" class="form-control" id="quantidade_min" name="quantidade_min" value="<?php echo $produto_editar_list['quantidade_min']; ?>" placeholder="Digite a Quantidade M�nima."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Pre�o de Venda:</label>
        <input type="text" class="form-control" id="preco" name="preco" value="<?php echo number_format($produto_editar_list['preco'], 2); ?>" placeholder="Digite o Pre�o de Venda."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Pre�o de Compra:</label>
        <input type="text" class="form-control" id="preco_compra" name="preco_compra" value="<?php echo number_format($produto_editar_list['preco_compra'], 2); ?>" placeholder="Digite o Pre�o de Compra."/>
    </div>
    <div class="form-group col-sm-3">
        <label>Status:</label>
        <select id="status" class="form-control" name="status" required="true">
            <option value="1" <?php echo ($produto_editar_list['status'] == '0') ? 'selected="selected"' : ''; ?>>Dispon�vel</option>
            <option value="0" <?php echo ($produto_editar_list['status'] == '0') ? 'selected="selected"' : ''; ?> >Indisponivel</option>
        </select>
    </div>

    <div class="form-group col-sm-3">
        <label>Fotos:  (suporta apenas foto png.)</label>
        <div class="fileUpload btn btn-primary">
            <span>Upload</span>
            <input type="file" id="fotos" name="fotos[]" class="upload"  multiple/>
        </div>
    </div>
    <div class="panel panel-default col-sm-12">
        <div class="panel-heading">Fotos do Produto</div>
        <div class="panel-body">
            <?php foreach ($produto_editar_list['fotos'] as $fotos): ?>
                <div class="foto_item">
                    <img src="<?php echo BASE_URL; ?>assets/imagens/produtos/<?php echo $fotos['url']; ?>" class="img-thumbnail" border="0" /><br/>
                    <a class="btn btn-danger" href="<?php echo BASE_URL; ?>produto/excluir_imagem/<?php echo $fotos['id']; ?>">Excluir Imagem</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="form-group col-sm-12">
        <input type="submit" class="btn btn-success" value="Editar"/>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>produto">Voltar</a>
    </div>


</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/produto/script_produto_validacao.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/produto/script_produto_mascara.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/produto/script_produto_maskMoney.js"></script>