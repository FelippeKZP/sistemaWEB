<h1>Adicionar Grupo de Produto</h1>

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


<form id="form" method="POST">

    <div class="form-group col-sm-6">
        <label>Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite um Nome." />
    </div>

    <div class="form-group col-sm-12">
        <input type="submit" class="btn btn-success" value="Salvar" />
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>grupoProduto">Voltar</a>
    </div>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/grupoProduto/script_grupoProduto_validacao.js"></script>