<h1>Adicionar Cliente</h1>

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
    <div class="form-group col-sm-12" style="padding-left: 0px;">
        <div class="form-group col-sm-4">
            <label>Tipo de Pessoa:</label>
            <select name="tipo_pessoa" class="form-control">
                <option value="f�sica">F�sica</option>
                <option value="jur�dica">Jur�dica</option>
            </select>
        </div>
    </div>

    <div class="form-group col-sm-5">
        <label>Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Nome."/>
    </div>

    <div class="form-group col-sm-4">
        <label>CPF/CNPJ:</label>
        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite o CPF ou CNPJ."/>
    </div>

    <div class="form-group col-sm-3">
        <label>RG/IE:</label>
        <input type="text" class="form-control" id="rg" name="rg" placeholder="Digite o RG ou IE."/>
    </div>

    <div class="form-group col-sm-4">
        <label>Telefone:</label>
        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Digite o Telefone."/><br/><br/>
    </div>

    <div class="form-group col-sm-5">
        <label>Email:</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Digite o Email."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Data de Cadastro:</label><br/>
        <input  type="text" class="form-control" id="data_cadastro" name="data_cadastro" placeholder="Digite a Data de Cadastro."/>
    </div>

    <br/><br/>

    <div class="form-group col-sm-12">
        <fieldset>
            <legend>Dados de Endere�o</legend>
            <div class="form-group col-sm-3">
                <label>CEP:</label>
                <input type="text" class="form-control"  id="cep" name="cep" placeholder="Digite o CEP."/>
            </div>
            <div class="form-group col-sm-4">
                <label>Bairro:</label>
                <input type="text" class="form-control" id="bairro" name="bairro"/>
            </div>
            <div class="form-group col-sm-5">
                <label>Rua:</label>
                <input type="text" class="form-control" id="rua" name="rua"/>
            </div>
            <div class="form-group col-sm-3">
                <label>N�mero:</label>
                <input type="text" class="form-control" id="numero" name="numero" placeholder="Digite o Numero"/>
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
    </div>


    <div class=" form-group col-sm-12" style="float: right;">
        <input type="submit" class="btn btn-success" value="Salvar"/>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>cliente">Voltar</a>
    </div>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/cliente/script_cliente_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/cliente/script_cliente_validacao.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/cliente/script_cliente_mascara.js"></script>