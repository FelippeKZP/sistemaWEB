<h1>Adicionar Cliente</h1>

<div class="alert alert-info">
    <strong>Os campo em vermelho é obrigatório.</strong>
</div>

<br/>

<?php if (isset($msg_erro) && !empty($msg_erro)): ?>
        <script>swal("Ocorreu um erro salvar o cliente.", "", "error");</script>
<?php endif; ?>

<?php if (isset($msg_sucesso) && !empty($msg_sucesso)): ?>
    <script>swal("Sucesso ao salvar o cliente.", "", "success");</script>
<?php endif; ?>


<form id="form" method="POST">
    <div class="form-group col-sm-12" style="padding-left: 0px;">
        <div class="form-group col-sm-4">
            <label>Tipo de Pessoa:</label>
            <select name="tipo_pessoa" class="form-control">
                <option value="física">Física</option>
                <option value="jurídica">Jurídica</option>
            </select>
        </div>
    </div>

    <div class="form-group col-sm-5">
        <label style="color:red;">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Nome."/>
    </div>

    <div class="form-group col-sm-4">
        <label style="color:red;">CPF/CNPJ:</label>
        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite o CPF ou CNPJ."
               data-type="verificarClienteCpfCnpj"/>
    </div>

    <div class="form-group col-sm-3">
        <label>RG/IE:</label>
        <input type="text" class="form-control" id="rg" name="rg" placeholder="Digite o RG ou IE."
               data-type="verificarClienteRgIe"/>
    </div>

    <div class="form-group col-sm-3">
        <label style="color:red;">Telefone:</label>
        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Digite o Telefone."/>
    </div>

    
    <div class="form-group col-sm-3">
        <label>Email:</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Digite o Email."
               data-type="verificarClienteEmail"/>
    </div>

    <div class="form-group col-sm-3">
        <label style="color:red;">Data de Cadastro:</label><br/>
        <input type="text" class="form-control" id="data_cadastro" name="data_cadastro"
               placeholder="Digite a Data de Cadastro."/>
    </div>

    <div class="form-group col-sm-3">
        <label>Data de Aniversário:</label><br/>
        <input type="text" class="form-control" id="data_aniversario" name="data_aniversario"
               placeholder="Digite a Data de Aniversário."/>
    </div>

    <div style="clear: both;"></div>

    <br/><br/>

    <div class="form-group col-sm-12">
        <fieldset>
            <legend>Dados de Endereço</legend>
            <div class="form-group col-sm-3">
                <label>CEP:</label>
                <input type="text" class="form-control" id="cep" name="cep" placeholder="Digite o CEP."/>
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
                <label>Número:</label>
                <input type="text" class="form-control" id="numero" name="numero" placeholder="Digite o Numero"/>
            </div>

            <div class="form-group col-sm-3">
                <label style="color:red;">Estado:</label>
                <select id="estado" class="form-control" name="estado" onchange="pegarCidades(this);">
                    <option value="">Selecione um estado.</option>
                    <?php foreach ($estado_list as $e): ?>
                        <option value="<?php echo $e['id']; ?>"><?php echo $e['nome'] . ' - ' . $e['sigla']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group col-sm-3">
                <label style="color:red;">Cidade:</label>
                <select id="cidade" class="form-control" name="cidade">
                    <option value="">Selecione um estado para selecionar um cidade.</option>
                </select>
            </div>

        </fieldset>
    </div>


    <div class=" form-group col-sm-12" style="float: right;">
        <button class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>cliente"><span class="glyphicon glyphicon-repeat"
                                                                               aria-hidden="true"></span> Voltar</a>
    </div>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/cliente/script_cliente.js"></script>