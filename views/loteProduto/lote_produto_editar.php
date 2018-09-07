<h1 class="h1">Editar Lote de Produto</h1>

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


<form id="form" method="POST">

    <div class=""
         <label>Número de Lote:</label><br/>
        <input type="text" id="numero_lote" name="numero_lote" value="<?php echo $lote_produto_editar_list['numero_lote']; ?>" placeholder="Digite o Número do Lote."/><br/><br/>

        <label>Produto:</label><br/>
        <input type="hidden" name="id_produto" value="<?php echo $lote_produto_editar_list['id_produto']; ?>"/>
        <input type="text" class="form-control" id="produto" name="produto" value="<?php echo $lote_produto_editar_list['nome']; ?>" data-type="pesquisar_produtos"/>
        <div style="clear: both"></div>
    </div>

    <label>Fornecedor:</label><br/>
    <input type="hidden" name="id_fornecedor" value="<?php echo $lote_produto_editar_list['id_fornecedor']; ?>"/>
    <input type="text" class="autocomplete" id="fornecedor" name="fornecedor" value="<?php echo $lote_produto_editar_list['razao_social']; ?>" data-type="pesquisar_fornecedores"/>
    <div style="clear: both"></div>
    <br/>

    <label>Quantidade:</label><br/>
    <input type="text" id="quantidade" name="quantidade" value="<?php echo $lote_produto_editar_list['quantidade']; ?>" placeholder="Digite a Quantidade" disabled="true"/><br/><br/>

    <label>Data de Fabricação:</label><br/>
    <input type="text" id="data_fabricacao" name="data_fabricacao" value="<?php echo date('d/m/Y', strtotime($lote_produto_editar_list['data_fabricacao'])); ?>" placeholder="Digite a Data de Fabricação."/><br/><br/>

    <label>Data de Vencimento:</label><br/>
    <input type="text" id="data_vencimento" name="data_vencimento" value="<?php echo date('d/m/Y', strtotime($lote_produto_editar_list['data_vencimento'])); ?>" placeholder="Digite a Data de Vencimento"/><br/><br/>

    <input type="submit" class="btn btn-success" value="Editar"/>
    <a class="btn btn-warning" href="<?php echo BASE_URL; ?>loteProduto">Voltar</a>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/loteProduto/script_lote_produto_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/loteProduto/script_loteProduto_validacao.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/loteProduto/script_loteProduto_mascara.js"></script>
