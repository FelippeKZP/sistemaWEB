<h1>Adicionar Função de Funcionário</h1>

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

    <div class="form-group col-sm-4">
        <label>Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Nome."/>
    </div>
    <div class="form-group col-sm-4">
        <label>Descrição:</label>
        <textarea class="form-control" id="descricao" name="descricao" placeholder="Digite a Descrição."></textarea>
    </div>

    <div class=" form-group col-sm-12" style="float: right;">
        <button  class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>funcaoFuncionario"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Voltar</a>
    </div>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/funcaoFuncionario/script_funcao_funcionario_validacao.js"></script>

