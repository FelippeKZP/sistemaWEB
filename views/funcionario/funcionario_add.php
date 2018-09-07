<h1>Adicionar Funcion�rio</h1>

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
        <label>CPF:</label>
        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite o CPF." data-type="verificarCPF"/>
    </div>

    <div class="form-group col-sm-4">
        <label>RG:</label>
        <input type="text" class="form-control" id="rg" name="rg" placeholder="Digite o RG." data-type="verificarRG" >
    </div>

    <div class="form-group col-sm-3">
        <label>Telefone:</label>
        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Digite o Telefone."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Data de Admiss�o:</label>
        <input type="text" class="form-control" id="data_admissao" name="data_admissao" placeholder="Digite a Data de Admiss�o."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Data de Anivers�rio:</label>
        <input type="text" class="form-control" id="data_aniversario" name="data_aniversario" placeholder="Digite a Data de Anivers�rio."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Fun��o:</label>
        <select id="funcao" name="id_funcao" class="form-control">
            <?php foreach ($funcao_list as $f): ?>
                <option value="<?php echo $f['id']; ?>"><?php echo $f['nome']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div style="padding-left: 0px;" class="form-group col-sm-12">
        <div class="form-group col-sm-3">
            <label>Carteira de Trabalho</label>
            <input type="text" class="form-control" id="carteira" name="carteira" placeholder="Digite a Carteira." data-type="verificarCarteira"/>
        </div>

        <div class="form-group col-sm-3">
            <label>Sal�rio:</label>
            <input type="text" class="form-control" id="salario" name="salario" placeholder="Digite o Sal�rio."/>
        </div>
    </div>

    <fieldset  class="form-group col-sm-12">

        <legend>Dados de Endere�o</legend>

        <div class="form-group col-sm-3">
            <label>CEP:</label>
            <input type="text" class="form-control" id="cep" name="cep" placeholder="Digite o CEP."/>
        </div>
        <div class="form-group col-sm-3">
            <label>Bairro:</label>
            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Digite o Bairro."/>
        </div>
        <div class="form-group col-sm-3">
            <label>Rua:</label>
            <input type="text" class="form-control" id="rua" name="rua" placeholder="Digite a Rua."/>
        </div>
        <div class="form-group col-sm-3">
            <label>N�mero:</label>
            <input type="text" class="form-control" id="numero" name="numero" placeholder="Digite o N�mero."/>
        </div>
        <div class="form-group col-sm-3">
            <label>Cidade:</label>
            <input type="text" class="form-control" id="cidade" name="cidade"/>
        </div>
        <div class="form-group col-sm-3">
            <label>Estado:</label>
            <input type="text" class="form-control" id="estado" name="estado"/>
        </div>
        <div class="form-group col-sm-3">
            <label>Pa�s:</label>
            <input type="text" class="form-control" id="pais" name="pais"/>
        </div>
    </fieldset>

    <div class="form-group col-sm-12">
        <input type="submit" class="btn btn-success" value="Salvar"/>
        <a href="<?php echo BASE_URL; ?>funcionario" class="btn btn-warning">Voltar</a>
    </div>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/funcionario/script_funcionario_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/funcionario/script_funcionario_validacao.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/funcionario/script_funcionario_mascara.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/funcionario/script_funcionario_maskMoney.js"></script>