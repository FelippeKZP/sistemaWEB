<h1>Editar Usuário</h1>

<?php if (isset($msg_erro) && !empty($msg_erro)): ?>
    <script>swal("Ocorreu um erro editar o usuário.", "", "error");</script>
<?php endif; ?>

<?php if (isset($msg_sucesso) && !empty($msg_sucesso)): ?>
    <script>swal("Sucesso ao editar o usuário.", "", "success");</script>
<?php endif; ?>

<br/>

<form id="form" method="POST" enctype="multipart/form-data">

    <div class="form-group col-sm-4">
        <label>Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome"
               value="<?php echo $usuario_editar_list['nome']; ?>" placeholder="Digite Seu Nome."/>
    </div>

    <div class="form-group col-sm-4">
        <label>Email:</label>
        <input type="text" class="form-control" id="nome" name="email"
               value="<?php echo $usuario_editar_list['email']; ?>" placeholder="Digite Seu Email;"/>
    </div>

    <div class="form-group col-sm-4">
        <label>Senha:</label>
        <input type="password" class="form-control" disabled="true" id="senha" name="senha"
               value="<?php echo $usuario_editar_list['senha']; ?>" placeholder="Digite Sua Senha."/>
    </div>

    <div class="form-group col-sm-5">
        <label>Grupo de Permissão:</label>
        <select id="grupo_permissao" class="form-control" name="id_grupo_permissao">
            <option value="">Selecione um grupo de permissão.</option>
            <?php foreach ($grupo_permissao_list as $p): ?>
                <option value="<?php echo $p['id']; ?> "
                    <?php echo ($usuario_editar_list['id_grupo_permissao'] == $p['id']) ? 'selected = "selected"' : ''; ?>>
                    <?php echo $p['nome']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group col-sm-3">
        <label>Status:</label>
        <select id="status" class="form-control" name="status">
            <option value="">Selecione um status.</option>
            <option value="1" <?php echo ($usuario_editar_list['status'] == 1) ? 'selected = "selected"' : ''; ?>>
                Ativo
            </option>
            <option value="0" <?php echo ($usuario_editar_list['status'] == 0) ? 'selected = "selected"' : ''; ?>>
                Inativo
            </option>
        </select>
    </div>

    <div class="form-group col-sm-4">
        <label>Fotos: (suporta apenas imagem em png.)</label>
        <div class="fileUpload btn btn-primary">
            <span><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Upload</span>
            <input type="file" id="fotos" name="fotos[]" class="upload"/>
        </div>
    </div>
    <div class="panel panel-default col-sm-12">
        <div class="panel-heading">Fotos do Produto</div>
        <div class="panel-body">
            <?php foreach ($usuario_editar_list['fotos'] as $fotos): ?>
                <div class="foto_item">
                    <img src="<?php echo BASE_URL; ?>assets/imagens/usuarios/<?php echo $fotos['url']; ?>"
                         class="img-thumbnail" border="0"/><br/>
                    <a class="btn btn-danger"
                       href="javascript:;"
                       onclick="excluirImagem('<?php echo $fotos['id']; ?>');">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class=" form-group col-sm-12">
        <button class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvar</button>
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>usuario"><span class="glyphicon glyphicon-repeat"
                                                                               aria-hidden="true"></span> Voltar</a>
    </div>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/usuario/script_usuario.js"></script>
