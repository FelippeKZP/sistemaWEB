<h1>Suporte</h1>

<br/>

<p style="margin-left: 15px;">Este é o seu canal direto com nossa equipe. Ou ligue para (44) 99757-3847.</p>


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

<br/>

<form method="POST">
    <div class="form-group col-sm-12">
        <label>Assunto</label>
        <select id="assunto" name="assunto" class="form-control">
            <option value="1">Dúvida</option>
            <option value="2">Reclamação</option>
            <option value="3">Sugestão</option>
            <option value="4">Pedidio</option>
        </select>
    </div>

    <div class="form-group col-sm-12">
        <label>Mensagem:</label>
        <textarea class="form-control" rows="5" id="mensagem" name="mensagem"></textarea>
    </div>

    <div class="form-group col-sm-12">
        <button class="btn btn-success"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Enviar
            Mensagem
        </button>
    </div>
</form>