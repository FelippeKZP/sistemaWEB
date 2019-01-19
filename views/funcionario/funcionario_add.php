<h1>Adicionar Funcionário</h1>

<div class="alert alert-info">
    <strong>Os campo em vermelho são obrigatório.</strong>
</div>

<br/>

<?php if (isset($msg_erro) && !empty($msg_erro)): ?>
    <script>swal("Ocorreu um erro salvar a funcionário.", "", "error");</script>
<?php endif; ?>

<?php if (isset($msg_sucesso) && !empty($msg_sucesso)): ?>
    <script>swal("Sucesso ao salvar a funcionário.", "", "success");</script>
<?php endif; ?>

<form id="form" method="POST">

    <div class="form-group col-sm-4">
        <label style="color:red;">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Nome."/>
    </div>

    <div class="form-group col-sm-4">
        <label style="color:red;">CPF:</label>
        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite o CPF."
               data-type="verificarCPF"/>
    </div>

    <div class="form-group col-sm-4">
        <label style="color:red;">RG:</label>
        <input type="text" class="form-control" id="rg" name="rg" placeholder="Digite o RG." data-type="verificarRG">
    </div>

    <div class="form-group col-sm-3">
        <label style="color:red;">Telefone:</label>
        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Digite o Telefone."/>
    </div>

    <div class="form-group col-sm-3">
        <label style="color:red;">Data de Admissão:</label>
        <input type="text" class="form-control" id="data_admissao" name="data_admissao"
               placeholder="Digite a Data de Admissão."/>
    </div>

    <div class="form-group col-sm-3">
        <label style="color:red;">Data de Aniversário:</label>
        <input type="text" class="form-control" id="data_aniversario" name="data_aniversario"
               placeholder="Digite a Data de Aniversário."/>
    </div>

    <div class="form-group col-sm-3">
        <label style="color:red;">Função:</label>
        <select id="funcao" name="id_funcao" class="form-control">
            <option value="">Selecione uma função.</option>
            <?php foreach ($funcao_list as $f): ?>
                <option value="<?php echo $f['id']; ?>"><?php echo $f['nome']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div style="padding-left: 0px;" class="form-group col-sm-12">
        <div class="form-group col-sm-3">
            <label style="color:red;">Carteira de Trabalho</label>
            <input type="text" class="form-control" id="carteira" name="carteira" placeholder="Digite a Carteira."
                   data-type="verificarCarteira"/>
        </div>

        <div class="form-group col-sm-3">
            <label style="color:red;">Salário:</label>
            <input type="text" class="form-control" id="salario" name="salario" placeholder="Digite o Salário."/>
        </div>
    </div>

    <div style="clear:both"></div>

    <fieldset class="form-group col-sm-12">

        <legend>Dados de Endereço</legend>

        <div class="form-group col-sm-3">
            <label style="color:red;">CEP:</label>
            <input type="text" class="form-control" id="cep" name="cep" placeholder="Digite o CEP."/>
        </div>
        <div class="form-group col-sm-3">
            <label style="color:red;">Bairro:</label>
            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Digite o Bairro."/>
        </div>
        <div class="form-group col-sm-3">
            <label style="color:red;">Rua:</label>
            <input type="text" class="form-control" id="rua" name="rua" placeholder="Digite a Rua."/>
        </div>
        <div class="form-group col-sm-3">
            <label style="color:red;">Número:</label>
            <input type="text" class="form-control" id="numero" name="numero" placeholder="Digite o Número."/>
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

    <div class=" form-group col-sm-12" style="float: right;">
        <button class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>funcionario"><span class="glyphicon glyphicon-repeat"
                                                                                   aria-hidden="true"></span> Voltar</a>
    </div>


</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/funcionario/script_funcionario.js"></script>