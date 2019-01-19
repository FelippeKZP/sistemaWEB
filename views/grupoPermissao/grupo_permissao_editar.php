<h1>Editar Grupo de Permissão</h1>

<div class="alert alert-info">
    <strong>Os campo em vermelho são obrigatório.</strong>
</div>

<br/>

<?php if (isset($msg_erro) && !empty($msg_erro)): ?>
    <script>swal("Ocorreu um erro editar o grupo de permissão.", "", "error");</script>
<?php endif; ?>

<?php if (isset($msg_sucesso) && !empty($msg_sucesso)): ?>
    <script>swal("Sucesso ao editar o grupo de permissão.", "", "success");</script>
<?php endif; ?>

<form id="form" method="POST">

    <div class="form-group col-sm-7">
        <label style="color:red;" for="nome">Nome:</label>
        <input id="nome" class="form-control" type="text" name="nome"
               value="<?php echo $grupo_permissao_editar_list['nome']; ?>" placeholder="Digite um Nome."/>
    </div>

    <div style="clear:both;"></div>

    <div class="form-group col-sm-12">
        <label style="color:red;">Permissões:</label><br/>
        <?php foreach ($permissao_lista as $p): ?>
            <div class="checkbox" style="margin-left: 10px;">
                <label style="padding-left: 10px; padding-right: 2px;" for="<?php echo $p['id']; ?>"><input
                            type="checkbox" id="<?php echo $p['id']; ?>" name="permissao[]"
                            value="<?php echo $p['id']; ?>"
                        <?php echo (in_array($p['id'], $grupo_permissao_editar_list['id_permissao'])) ? 'checked="checked"' : ''; ?> /><?php echo $p['nome']; ?>
                </label>
            </div>
        <?php endforeach; ?>
    </div>

    <div class=" form-group col-sm-12" style="float: right;">
        <button class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>grupoPermissao"><span class="glyphicon glyphicon-repeat"
                                                                                      aria-hidden="true"></span> Voltar</a>
    </div>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/funcionario/script_funcionario.js"></script>