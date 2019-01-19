<h1>Editar Grupo de Produto</h1>

<div class="alert alert-info">
    <strong>Os campo em vermelho são obrigatório.</strong>
</div>

<br/>

<?php if (isset($msg_erro) && !empty($msg_erro)): ?>
    <script>swal("Ocorreu um erro editar o grupo de produto", "", "error");</script>
<?php endif; ?>

<?php if (isset($msg_sucesso) && !empty($msg_sucesso)): ?>
    <script>swal("Sucesso ao editar o grupo de produto", "", "success");</script>
<?php endif; ?>


<form id="form" method="POST">

    <div class="form-group col-sm-6">
        <label style="color:red;">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome"
               value="<?php echo $grupo_produto_editar_list['nome']; ?>" placeholder="Digite um Nome."/>
    </div>

    <div class=" form-group col-sm-12" style="float: right;">
        <button class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>grupoProduto"><span class="glyphicon glyphicon-repeat"
                                                                                    aria-hidden="true"></span>
            Voltar</a>
    </div>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/grupoProduto/script_grupo_produto.js"></script>