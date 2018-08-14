<h1>Adicionar Notifica��o</h1>

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
    <div class="form-group col-sm-3">
        <label>Usu�rio:</label>
        <select  class="form-control" name="usuarios[]">
            <?php foreach ($usuario_list as $u): ?>
                <option value="<?php echo $u['id']; ?>"><?php echo $u['nome']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group col-sm-3">
        <label>Tipo de Notifica��o:</label>
        <input type="text" class="form-control"id="tipo_notificacao" name="tipo_notificacao"/>
    </div>

    <div class="form-group col-sm-3">
        <label>Notifica��o:</label>
        <textarea class="form-control" name="notificacao"></textarea>
    </div>

    <div style="clear: both"></div>

    <div class="col-sm-3">
        <input type="submit" class="btn btn-success" value="Salvar"/>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>notificacao">Voltar</a>
    </div>

</form>
