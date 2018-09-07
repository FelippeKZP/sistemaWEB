<h1>Adicionar Grupo de Permissão</h1>

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

    <div class="form-group col-sm-7">
        <label for="nome">Nome:</label>
        <input id="nome" class="form-control" type="text" name="nome" placeholder="Digite um Nome." />
    </div>

    <div class="form-group col-sm-6">
        <label>Permissões:</label>
        <?php foreach ($permissao_lista as $p): ?>
            <div class="checkbox ">
                <label  for="<?php echo $p['id']; ?>"><input type="checkbox" class="permissao" id="<?php echo $p['id']; ?>" name="permissao[]" value="<?php echo $p['id']; ?>"/><?php echo $p['nome']; ?></label>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="form-group col-sm-12">
        <input type="submit" class="btn btn-success" value="Salvar"/>
        <a class="btn btn-warning"href="<?php echo BASE_URL; ?>grupoPermissao">Voltar</a>
    </div>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/grupoPermissao/script_grupoPermissao_validacao.js"></script>