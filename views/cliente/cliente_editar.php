<h1>Editar Cliente</h1>

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

<br/><br/>

<form id="form" method="POST">

    <div class="form-group col-sm-12">
        <div class="form-group col-sm-4" style="padding-left: 0px;">
            <label>Tipo de Pessoa:</label>
            <select name="tipo_pessoa" class="form-control">
                <option value="física" <?php echo ($cliente_editar_list['tipo_pessoa'] == 'física') ? 'selected="selected"' : ''; ?>>Física</option>
                <option value="jurídica" <?php echo ($cliente_editar_list['tipo_pessoa'] == 'jurídica') ? 'selected="selected"' : ''; ?>>Jurídica</option>
            </select>
        </div>
    </div>


    <div class="form-group col-sm-5">
        <label>Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $cliente_editar_list['nome']; ?>" placeholder="Digite o Nome."/>
    </div>

    
        <div class="form-group col-sm-4">
            <label>CPF/CNPJ:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $cliente_editar_list['cpfCnpj']; ?>" placeholder="Digite o CPF ou CNPJ."/>
        </div>

        <div class="form-group col-sm-3">
            <label>RG/IE:</label>
            <input type="text" class="form-control" id="rg" name="rg" value="<?php echo $cliente_editar_list['rgIe']; ?>" placeholder="Digite o RG ou IE."/>
        </div>
    

    <div class="form-group col-sm-4">
        <label>Telefone:</label>
        <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $cliente_editar_list['telefone']; ?>" placeholder="Digite o Telefone."/>
    </div>

    <div class="form-group col-sm-5">
        <label>Email:</label>
        <input type="text" class="form-control"  id="email" name="email" value="<?php echo $cliente_editar_list['email']; ?>"  placeholder="Digite o Email."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Data de Cadastro:</label>
        <input  type="text" class="form-control" id="data_cadastro" name="data_cadastro" value="<?php echo date('d/m/Y', strtotime($cliente_editar_list['data_cadastro'])); ?>" placeholder="Digite a Data de Cadastro."/>
    </div>



    <div class="form-group col-sm-12">
        <fieldset>
            <legend>Dados de Endereço</legend>

            <div class="form-group col-sm-3">
                <label>CEP:</label>
                <input type="text"class="form-control" id="cep" name="cep" value="<?php echo $cliente_editar_list['cep']; ?>" placeholder="Digite o CEP."/>
            </div>

            <div class="form-group col-sm-4">
                <label>Bairro:</label>
                <input type="text" class="form-control" id="bairro" value="<?php echo $cliente_editar_list['bairro']; ?>" name="bairro"/>
            </div>

            <div class="form-group col-sm-5">
                <label>Rua:</label>
                <input type="text" class="form-control" id="rua" name="rua" value="<?php echo $cliente_editar_list['rua']; ?>"/>
            </div>

            <div class="form-group col-sm-3">
                <label>Número:</label>
                <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $cliente_editar_list['numero']; ?>" placeholder="Digite o Numero"/>
            </div>

            <div class="form-group col-sm-3">
                <label>Cidade:</label>
                <input type="text" class="form-control" id="cidade" value="<?php echo $cliente_editar_list['cidade']; ?>" name="cidade"/>
            </div>

            <div class="form-group col-sm-3">
                <label>Estado:</label>
                <input type="text" class="form-control" id="estado" value="<?php echo $cliente_editar_list['estado']; ?>" name="estado"/>
            </div>

            <div class="form-group col-sm-3">
                <label>País:</label>
                <input type="text" class="form-control" id="pais" value="<?php echo $cliente_editar_list['pais']; ?>" name="pais"/>
            </div>
        </fieldset>
    </div>

    <div class="form-group col-sm-12">
        <input type="submit" class="btn btn-success" value="Editar"/>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>cliente">Voltar</a>
    </div>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/cliente/script_cliente_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/cliente/script_cliente_validacao.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/cliente/script_cliente_mascara.js"></script>