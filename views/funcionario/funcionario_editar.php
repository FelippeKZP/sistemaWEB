<h1>Adicionar Funcionário</h1>

<br/>


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
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $funcionario_list_edit['nome']; ?>" placeholder="Digite o Nome."/>
    </div>

    <div class="form-group col-sm-4">
        <label>CPF:</label>
        <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $funcionario_list_edit['cpf']; ?>" placeholder="Digite o CPF." data-type="verificarCPF"/>
    </div>

    <div class="form-group col-sm-4">
        <label>RG:</label>
        <input type="text" class="form-control" id="rg" name="rg" value="<?php echo $funcionario_list_edit['rg']; ?>" placeholder="Digite o RG."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Telefone:</label>
        <input type="text" class="form-control" id="telefone" value="<?php echo $funcionario_list_edit['telefone']; ?>" name="telefone" placeholder="Digite o Telefone."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Data de Admissão:</label>
        <input type="text" class="form-control" id="data_admissao" name="data_admissao" value="<?php echo date('d/m/Y', strtotime($funcionario_list_edit['data_admissao'])); ?>" placeholder="Digite a Data de Admissão."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Data de Aniversário:</label>
        <input type="text" class="form-control" id="data_aniversario" name="data_aniversario" value="<?php echo date('d/m/Y', strtotime($funcionario_list_edit['data_aniversario'])); ?>" placeholder="Digite a Data de Aniversário."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Função:</label>
        <select id="funcao" name="id_funcao" class="form-control">
            <?php foreach ($funcao_list as $f): ?>
                <option value="<?php echo $f['id']; ?>"
                        <?php echo ($funcionario_list_edit['id_funcao'] == $f['id']) ? 'selected = "selected"' : ''; ?>><?php echo $f['nome']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group col-sm-3">
        <label>Carteira de Trabalho</label>
        <input type="text" class="form-control" id="carteira" name="carteira" value="<?php echo $funcionario_list_edit['carteira']; ?>" placeholder="Digite a Carteira."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Salário:</label>
        <input type="text" class="form-control" id="salario" name="salario" value="<?php echo number_format($funcionario_list_edit['salario'],2); ?>" placeholder="Digite o Salário."/>
    </div>

    <fieldset  class="form-group col-sm-12">

        <legend>Dados de Endereço</legend>

        <div class="form-group col-sm-3">
            <label>CEP:</label>
            <input type="text" class="form-control" id="cep" name="cep" value="<?php echo $funcionario_list_edit['cep']; ?>" placeholder="Digite o CEP."/>
        </div>
        <div class="form-group col-sm-3">
            <label>Bairro:</label>
            <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $funcionario_list_edit['bairro']; ?>" placeholder="Digite o Bairro."/>
        </div>
        <div class="form-group col-sm-3">
            <label>Rua:</label>
            <input type="text" class="form-control" id="rua" name="rua" value="<?php echo $funcionario_list_edit['rua']; ?>"  placeholder="Digite a Rua."/>
        </div>
        <div class="form-group col-sm-3">
            <label>Número:</label>
            <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $funcionario_list_edit['numero']; ?>" placeholder="Digite o Número."/>
        </div>
        <div class="form-group col-sm-3">
            <label>Cidade:</label>
            <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $funcionario_list_edit['cidade']; ?>"/>
        </div>
        <div class="form-group col-sm-3">
            <label>Estado:</label>
            <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $funcionario_list_edit['estado']; ?>"/>
        </div>
        <div class="form-group col-sm-3">
            <label>País:</label>
            <input type="text" class="form-control" id="pais" name="pais" value="<?php echo $funcionario_list_edit['pais']; ?>"/>
        </div>
    </fieldset>

    <div class=" form-group col-sm-12" style="float: right;">
        <button  class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>funcionario"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Voltar</a>
    </div>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/funcionario/script_funcionario_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/funcionario/script_funcionario_validacao.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/funcionario/script_funcionario_mascara.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/funcionario/script_funcionario_maskMoney.js"></script>
