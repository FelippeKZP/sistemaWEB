<h1 class="h1">Suas Notificações</h1>

<br/><br/>

<a class="btn btn-success" href="<?php echo BASE_URL; ?>notificacao/notificacao_add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Notificação</a>

<br/><br/>

<?php if ($notificacao_list == null): ?>
<div class="alert alert-info">
    <span>Você Não Contém Nenhuma Notificação.</span>
</div>
<?php endif; ?>

<?php foreach ($notificacao_list as $n): ?>
    <div class="col-sm-3">
        <div class="panel panel-primary">
            <div class="panel-heading" style="height:64px;">
                <h3 class="panel-title"><?php echo $n['tipo_notificacao']; ?></h3>
                <p style="margin-top: 5px; font-size: 7pt;padding-left: 150px;">Enviado Por: <?php echo $n['nome']; ?></p>
            </div>
            <div class="panel-body">
                <h5 style="margin-top: 0px; font-size: 7pt; padding-left: 168px;">Data:<?php echo date('d/m/Y', strtotime($n['data_notificacao'])); ?></h5>
                <p><?php echo $n['propriedades']; ?></p>
                <h6 style="padding-left: 168px; font-size: 7pt;">Status: <span style="color:red;"><?php echo $status[$n['status']]; ?></span></h6>
            </div>
        </div>
    </div>
<?php endforeach; ?>

