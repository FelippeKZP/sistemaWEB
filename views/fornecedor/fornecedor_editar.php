<h1>Editar Fornecedor</h1>

<div class="alert alert-info">
    <strong>Os campo em vermelho são obrigatório.</strong>
</div>

<br/>

<?php if (isset($msg_erro) && !empty($msg_erro)): ?>
    <script>swal("Ocorreu um erro editar o fornecedor.", "", "error");</script>
<?php endif; ?>

<?php if (isset($msg_sucesso) && !empty($msg_sucesso)): ?>
    <script>swal("Sucesso ao editar o fornecedor.", "", "success");</script>
<?php endif; ?>

<form method="POST" id="form">
    <div class="form-group col-sm-4">
        <label style="color:red;">Razão Social:</label>
        <input type="text" class="form-control" id="razao_social" name="razao_social"
               value="<?php echo $fornecedor_editar_list['razao_social']; ?>" placeholder="Digite a Razão Social."/>
    </div>

    <div class="form-group col-sm-4">
        <label style="color:red;">Nome Fantasia:</label>
        <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia"
               value="<?php echo $fornecedor_editar_list['nome_fantasia']; ?>" placeholder="Digite o Nome Fantasia."/>
    </div>

    <div class="form-group col-sm-4">
        <label style="color:red;">CNPJ:</label>
        <input type="text" class="form-control" id="cnpj" name="cnpj"
               value="<?php echo $fornecedor_editar_list['cnpj']; ?>" placeholder="Digite o CNPJ."/>
    </div>

    <div class="form-group col-sm-5">
        <label>IE:</label>
        <input type="text" class="form-control" id="ie" name="ie" value="<?php echo $fornecedor_editar_list['ie']; ?>"
               placeholder="Digite o IE"/>
    </div>

    <div class="form-group col-sm-4">
        <label style="color:red;">Telefone:</label>
        <input type="text" class="form-control" id="telefone" value="<?php echo $fornecedor_editar_list['telefone']; ?>"
               name="telefone" placeholder="Digite o Telefone."/>
    </div>

    <div class="form-group col-sm-3">
        <label style="color:red;">Data de Cadastro:</label>
        <input type="text" class="form-control" id="data_cadastro" name="data_cadastro"
               value="<?php echo date('d/m/Y', strtotime($fornecedor_editar_list['data_cadastro'])); ?>"
               placeholder="Digite a Data de Cadastro."/>
    </div>

    <div style="clear:both;"></div>

    <div class="form-group col-sm-12">
        <fieldset>
            <legend>Dados de Endereço</legend>
            <div class="form-group col-sm-3">
                <label>CEP:</label>
                <input type="text" class="form-control" id="cep" name="cep"
                       value="<?php echo $fornecedor_editar_list['cep']; ?>" placeholder="Digite o CEP."/>
            </div>

            <div class="form-group col-sm-4">
                <label>Bairro:</label>
                <input type="text" class="form-control" id="bairro" name="bairro"
                       value="<?php echo $fornecedor_editar_list['bairro']; ?>"/>
            </div>

            <div class="form-group col-sm-5">
                <label>Rua:</label>
                <input type="text" class="form-control" id="rua" name="rua"
                       value="<?php echo $fornecedor_editar_list['rua']; ?>"/>
            </div>

            <div class="form-group col-sm-3">
                <label>Número:</label>
                <input type="text" class="form-control" id="numero" name="numero"
                       value="<?php echo $fornecedor_editar_list['numero']; ?>"
                       placeholder="Digite o Número do Local."/>
            </div>

            <div class="form-group col-sm-3">
                <label style="color:red;">Estado:</label>
                <select id="estado" class="form-control" name="estado" onchange="pegarCidades(this);">
                    <option>Selecione um estado.</option>
                    <?php foreach ($estado_list as $e): ?>
                        <option value="<?php echo $e['id']; ?>"
                            <?php echo (!empty($e['id'] == $fornecedor_editar_list['id_estado'])) ? 'selected ="selected" ' : ''; ?> >
                            <?php echo $e['nome'] . ' - ' . $e['sigla']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group col-sm-3">
                <label style="color:red;">Cidade:</label>
                <select id="cidade" class="form-control" name="cidade">
                    <?php foreach ($cidade_list as $c): ?>
                        <option value="<?php echo $c['id']; ?>"
                            <?php echo (!empty($c['id'] == $fornecedor_editar_list['id_cidade'])) ? 'selected ="selected"' : ''; ?> >
                            <?php echo $c['nome']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

        </fieldset>
    </div>

    <div class=" form-group col-sm-12" style="float: right;">
        <button class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Editar</button>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>fornecedor"><span class="glyphicon glyphicon-repeat"
                                                                                  aria-hidden="true"></span> Voltar</a>
    </div>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/fornecedor/script_fornecedor.js"></script>
