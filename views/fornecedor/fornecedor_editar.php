<h1>Editar Fornecedor</h1>

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


<form method="POST" id="form">
    <div class="form-group col-sm-4">
        <label>Razão Social:</label>
        <input type="text" class="form-control" id="razao_social" name="razao_social" value="<?php echo $fornecedor_editar_list['razao_social']; ?>" placeholder="Digite a Razão Social."/>
    </div>

    <div class="form-group col-sm-4">
        <label>Nome Fantasia:</label>
        <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia" value="<?php echo $fornecedor_editar_list['nome_fantasia']; ?>" placeholder="Digite o Nome Fantasia." />
    </div>

    <div class="form-group col-sm-4">
        <label>CNPJ:</label>
        <input type="text" class="form-control" id="cnpj" name="cnpj" value="<?php echo $fornecedor_editar_list['cnpj']; ?>" placeholder="Digite o CNPJ." />
    </div>

    <div class="form-group col-sm-5">
        <label>IE:</label>
        <input type="text" class="form-control" id="ie" name="ie" value="<?php echo $fornecedor_editar_list['ie']; ?>" placeholder="Digite o IE" />
    </div>

    <div class="form-group col-sm-4">
        <label>Telefone:</label>
        <input type="text" class="form-control" id="telefone" value="<?php echo $fornecedor_editar_list['telefone']; ?>" name="telefone" placeholder="Digite o Telefone."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Data de Cadastro:</label>
        <input type="text" class="form-control" id="data_cadastro" name="data_cadastro" value="<?php echo date('d/m/Y', strtotime($fornecedor_editar_list['data_cadastro'])); ?>" placeholder="Digite a Data de Cadastro."/>
    </div>

    <div class="form-group col-sm-12">
        <fieldset>
            <legend>Dados de Endereço</legend>
            <div class="form-group col-sm-3">
                <label>CEP:</label>
                <input type="text" class="form-control" id="cep" name="cep" value="<?php echo $fornecedor_editar_list['cep']; ?>" placeholder="Digite o CEP."/>
            </div>

            <div class="form-group col-sm-4">
                <label>Bairro:</label>
                <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $fornecedor_editar_list['bairro']; ?>" />
            </div>

            <div class="form-group col-sm-5">
                <label>Rua:</label>
                <input type="text" class="form-control" id="rua" name="rua" value="<?php echo $fornecedor_editar_list['rua']; ?>" />
            </div>

            <div class="form-group col-sm-3">
                <label>Número:</label>
                <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $fornecedor_editar_list['numero']; ?>" placeholder="Digite o Número do Local." />
            </div>

            <div class="form-group col-sm-3">
                <label>Cidade:</label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $fornecedor_editar_list['cidade']; ?>" />
            </div>

            <div class="form-group col-sm-3">
                <label>Estado:</label>
                <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $fornecedor_editar_list['estado']; ?>" />
            </div>

            <div class="form-group col-sm-3">
                <label>País:</label>
                <input type="text" class="form-control"  id="cidade" name="pais" value="<?php echo $fornecedor_editar_list['pais']; ?>" />
            </div>
        </fieldset>
    </div>

    <div class=" form-group col-sm-12" style="float: right;">
        <button  class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Editar</button>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>fornecedor"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Voltar</a>
    </div>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/fornecedor/script_fornecedor_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/fornecedor/script_fornecedor_validacao.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/fornecedor/script_fornecedor_mascara.js"></script>