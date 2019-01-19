<h1>Adicionar Usuário</h1>

<?php if (isset($msg_erro) && !empty($msg_erro)): ?>
    <script>swal("Ocorreu um erro salvar o usuário.", "", "error");</script>
<?php endif; ?>

<?php if (isset($msg_sucesso) && !empty($msg_sucesso)): ?>
    <script>swal("Sucesso ao salvar o usuário.", "", "success");</script>
<?php endif; ?>

<br/>

<form id="form" method="POST" enctype="multipart/form-data">

    <div class="form-group col-sm-4">
        <label>Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite Seu Nome."/>
    </div>

    <div class="form-group col-sm-4">
        <label>Email:</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Digite Seu Email;"
               data-type="verificarUsuarioEmail"/>
    </div>

    <div class="form-group col-sm-4">
        <label>Senha:</label>
        <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite Sua Senha."/>
    </div>

    <div class="form-group col-sm-4">
        <label>Grupo de Permissão:</label>
        <select id="grupo_permissao" class="form-control" name="id_grupo_permissao">
            <option value="">Selecione um grupo de permissão.</option>
            <?php foreach ($grupo_permissao_list as $p): ?>
                <option value="<?php echo $p['id']; ?>"><?php echo $p['nome']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group col-sm-3">
        <label>Status:</label>
        <select id="status" class="form-control" name="status">
            <option value="">Selecione um status.</option>
            <option value="1">Ativo</option>
            <option value="0">Inativo</option>
        </select>
    </div>

    <div class="form-group col-sm-3">
        <label>Fotos:(suporta apenas foto em png.)</label>
        <div class="fileUpload btn btn-primary">
            <span><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Upload</span>
            <input type="file" accept="image/*" id="fotos" name="fotos[]" class="upload"/>
        </div>
    </div>

    <div style="clear: both"></div>

        <div class="col-sm-2">
            <img src="<?php echo BASE_URL; ?>assets/imagens/avatar.png"
                 class="avatar img-circle img-thumbnail"
                 alt="avatar">
        </div>

    <div class=" form-group col-sm-12">
        <button class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>usuario"><span class="glyphicon glyphicon-repeat"
                                                                               aria-hidden="true"></span> Voltar</a>
    </div>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/usuario/script_usuario.js"></script>
