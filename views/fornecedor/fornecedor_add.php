<h1>Adicionar Fornecedor</h1>

<br/> <br/>

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

    <div class="form-group  col-sm-4">
        <label>Razão Social:</label>
        <input type="text" class="form-control" id="razao_social" name="razao_social" placeholder="Digite a Razão Social."/>
    </div>

    <div class="form-group col-sm-4">
        <label>Nome Fantasia:</label><br/>
        <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia" placeholder="Digite o Nome Fantasia." />
    </div>

    <div class="form-group col-sm-4">
        <label>CNPJ:</label><br/>
        <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="Digite o CNPJ." />
    </div>

    <div class="form-group col-sm-5">
        <label>IE:</label>
        <input type="text" class="form-control" id="ie" name="ie" placeholder="Digite o IE" />
    </div>

    <div class="form-group col-sm-4">
        <label>Telefone:</label><br/>
        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Digite o Telefone."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Data de Cadastro:</label>
        <input type="text" class="form-control" id="data_cadastro" name="data_cadastro" placeholder="Digite a Data de Cadastro."/>
    </div>

    <div class="form col-sm-12">
        <fieldset>
            <legend>Dados de Endereço</legend>

            <div class="form-group col-sm-3">
                <label>CEP:</label>
                <input type="text" class="form-control" id="cep" name="cep" placeholder="Digite o CEP."/>
            </div>

            <div class="form-group col-sm-4">
                <label>Bairro:</label>
                <input type="text" class="form-control" id="bairro" name="bairro" />
            </div>

            <div class="form-group col-sm-5">
                <label>Rua:</label>
                <input type="text" class="form-control" id="rua" name="rua" />
            </div>

            <div class="form-group col-sm-3">
                <label>Número:</label>
                <input type="text" class="form-control" id="numero" name="numero" placeholder="Digite o Número do Local." />
            </div>

            <div class="form-group col-sm-3">
                <label>Cidade:</label>
                <input type="text" class="form-control" id="cidade" name="cidade" />
            </div>

            <div class="form-group col-sm-3">
                <label>Estado:</label>
                <input type="text" class="form-control" id="estado" name="estado" />
            </div>

            <div class="form-group col-sm-3">
                <label>País:</label>
                <input type="text" class="form-control"  id="pais" name="pais" />
            </div>
        </fieldset>
    </div>

    <div class="form-group col-sm-12">
        <input type="submit" class="btn btn-success" value="Salvar"/>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>fornecedor">Voltar</a>
    </div>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/fornecedor/script_fornecedor_add.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/fornecedor/script_fornecedor_validacao.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/fornecedor/script_fornecedor_mascara.js"></script>