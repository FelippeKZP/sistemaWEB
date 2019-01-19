<h1>Editar Cliente</h1>

<div class="alert alert-info">
    <strong>Os campo em vermelho é obrigatório.</strong>
</div>

<?php if (isset($msg_erro) && !empty($msg_erro)): ?>
        <script>swal("Ocorreu um erro editar o cliente.", "", "error");</script>
<?php endif; ?>

<?php if (isset($msg_sucesso) && !empty($msg_sucesso)): ?>
    <script>swal("Sucesso ao editar o cliente.", "", "success");</script>
<?php endif; ?>

<br/>

<form id="form" method="POST">

    <div class="form-group col-sm-12">
        <div class="form-group col-sm-4" style="padding-left: 0px;">
            <label>Tipo de Pessoa:</label>
            <select name="tipo_pessoa" class="form-control">
                <option value="física" <?php echo ($cliente_editar_list['tipo_pessoa'] == 'física') ? 'selected="selected"' : ''; ?>>
                    Física
                </option>
                <option value="jurídica" <?php echo ($cliente_editar_list['tipo_pessoa'] == 'jurídica') ? 'selected="selected"' : ''; ?>>
                    Jurídica
                </option>
            </select>
        </div>
    </div>


    <div class="form-group col-sm-5">
        <label style="color:red;">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome"
               value="<?php echo $cliente_editar_list['nome']; ?>" placeholder="Digite o Nome."/>
    </div>


    <div class="form-group col-sm-4">
        <label style="color:red;">CPF/CNPJ:</label>
        <input type="text" class="form-control" id="cpf" name="cpf"
               value="<?php echo $cliente_editar_list['cpfCnpj']; ?>" placeholder="Digite o CPF ou CNPJ."/>
    </div>

    <div class="form-group col-sm-3">
        <label>RG/IE:</label>
        <input type="text" class="form-control" id="rg" name="rg" value="<?php echo $cliente_editar_list['rgIe']; ?>"
               placeholder="Digite o RG ou IE."/>
    </div>


    <div class="form-group col-sm-3">
        <label style="color:red;">Telefone:</label>
        <input type="text" class="form-control" id="telefone" name="telefone"
               value="<?php echo $cliente_editar_list['telefone']; ?>" placeholder="Digite o Telefone."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Email:</label>
        <input type="text" class="form-control" id="email" name="email"
               value="<?php echo $cliente_editar_list['email']; ?>" placeholder="Digite o Email."/>
    </div>

    <div class="form-group col-sm-3">
        <label style="color:red;">Data de Cadastro:</label>
        <input type="text" class="form-control" id="data_cadastro" name="data_cadastro"
               value="<?php echo date('d/m/Y', strtotime($cliente_editar_list['data_cadastro'])); ?>"
               placeholder="Digite a Data de Cadastro."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Data de Aniversário:</label>
        <input type="text" class="form-control" id="data_aniversario" name="data_aniversario"
               value="<?php echo date('d/m/Y', strtotime($cliente_editar_list['data_aniversario'])); ?>"
               placeholder="Digite a Data de Aniversário."/>
    </div>


    <div class="form-group col-sm-12">
        <fieldset>
            <legend>Dados de Endereço</legend>

            <div class="form-group col-sm-3">
                <label>CEP:</label>
                <input type="text" class="form-control" id="cep" name="cep"
                       value="<?php echo $cliente_editar_list['cep']; ?>" placeholder="Digite o CEP."/>
            </div>

            <div class="form-group col-sm-4">
                <label>Bairro:</label>
                <input type="text" class="form-control" id="bairro"
                       value="<?php echo $cliente_editar_list['bairro']; ?>" name="bairro"/>
            </div>

            <div class="form-group col-sm-5">
                <label>Rua:</label>
                <input type="text" class="form-control" id="rua" name="rua"
                       value="<?php echo $cliente_editar_list['rua']; ?>"/>
            </div>

            <div class="form-group col-sm-3">
                <label>Número:</label>
                <input type="text" class="form-control" id="numero" name="numero"
                       value="<?php echo $cliente_editar_list['numero']; ?>" placeholder="Digite o Numero"/>
            </div>

            <div class="form-group col-sm-3">
                <label style="color:red;">Estado:</label>
                <select id="estado" class="form-control" name="estado" onchange="pegarCidades(this);">
                    <option>Selecione um estado.</option>
                    <?php foreach ($estado_list as $e): ?>
                        <option value="<?php echo $e['id']; ?>"
                            <?php echo (!empty($e['id'] == $cliente_editar_list['id_estado'])) ? 'selected ="selected" ' : ''; ?> >
                            <?php echo $e['nome'] . ' - ' . $e['sigla']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group col-sm-3">
                <label style="color:red;">Cidade:</label>
                <select id="cidade" class="form-control" name="cidade">
                    <?php foreach ($cidade_list as $c): ?>
                        <option value="<?php echo $c['id']; ?>"
                            <?php echo (!empty($c['id'] == $cliente_editar_list['id_cidade'])) ? 'selected ="selected"' : ''; ?> >
                            <?php echo $c['nome']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </fieldset>
    </div>

    <div class="form-group col-sm-12">
        <button class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Editar</button>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>cliente"><span class="glyphicon glyphicon-repeat"
                                                                               aria-hidden="true"></span> Voltar</a>
    </div>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/cliente/script_cliente.js"></script>