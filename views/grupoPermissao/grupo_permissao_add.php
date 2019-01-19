<h1>Adicionar Grupo de Permissão</h1>

<div class="alert alert-info">
    <strong>Os campo em vermelho são obrigatório.</strong>
</div>

<br/>

<?php if (isset($msg_erro) && !empty($msg_erro)): ?>
    <script>swal("Ocorreu um erro salvar o grupo de permissão.", "", "error");</script>
<?php endif; ?>

<?php if (isset($msg_sucesso) && !empty($msg_sucesso)): ?>
    <script>swal("Sucesso ao salvar o grupo de permissão.", "", "success");</script>
<?php endif; ?>


<form id="form" method="POST">

    <div class="form-group col-sm-5">
        <label  style="color:red;" for="nome">Nome:</label>
        <input id="nome" class="form-control" type="text" name="nome" placeholder="Digite um Nome."/>
    </div>

    <div style="clear:both;"></div>

    <div class="form-group col-sm-12">
        <label style="color:red;">Permissões:</label><br/>
        <p><input type="checkbox" id="checkTodos"> Selecionar Todos</p>
        <?php foreach ($permissao_lista as $p): ?>
            <div class="checkbox" style="margin-left: 10px;">
                <label style="padding-left: 10px; padding-right: 2px;" for="<?php echo $p['id']; ?>"><input
                            type="checkbox" class="permissao" id="<?php echo $p['id']; ?>" name="permissao[]"
                            value="<?php echo $p['id']; ?>"/><?php echo $p['nome']; ?></label>
            </div>
        <?php endforeach; ?>
    </div>

    <div class=" form-group col-sm-12" style="float: right;">
        <button class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>grupoPermissao"><span class="glyphicon glyphicon-repeat"
                                                                                      aria-hidden="true"></span> Voltar</a>
    </div>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/grupoPermissao/script_grupo_permissao.js"></script>

<script type="text/javascript">
    $("#checkTodos").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>

