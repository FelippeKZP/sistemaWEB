<h1>Editar Função de Funcionário</h1>

<div class="alert alert-info">
    <strong>Os campo em vermelho são obrigatório.</strong>
</div>


<br/><br/>

<?php if (isset($msg_erro) && !empty($msg_erro)): ?>
    <script>swal("Ocorreu um erro editar a função de funcionário.", "", "error");</script>
<?php endif; ?>

<?php if (isset($msg_sucesso) && !empty($msg_sucesso)): ?>
    <script>swal("Sucesso ao editar a função de funcionário.", "", "success");</script>
<?php endif; ?>


<form id="form" method="POST">

    <div class="form-group col-sm-4">
        <label style="color:red;">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $funcao_list_edit['nome']; ?>"
               placeholder="Digite o Nome."/>
    </div>
    <div class="form-group col-sm-4">
        <label style="color:red;">Descrição:</label>
        <textarea class="form-control" id="descricao" name="descricao"
                  placeholder="Digite a Descrição."><?php echo $funcao_list_edit['descricao']; ?></textarea>
    </div>

    <div class=" form-group col-sm-12" style="float: right;">
        <button class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>funcaoFuncionario"><span
                    class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Voltar</a>
    </div>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/funcaoFuncionario/script_funcao_funcionario.js"></script>


