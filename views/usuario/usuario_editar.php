<h1>Editar Usuário</h1>

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


<form id="form" method="POST" enctype="multipart/form-data">

    <div class="form-group col-sm-4">
        <label>Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $usuario_editar_list['nome']; ?>" placeholder="Digite Seu Nome." />
    </div>

    <div class="form-group col-sm-4">
        <label>Email:</label>
        <input type="text" class="form-control" id="nome" name="email" value="<?php echo $usuario_editar_list['email']; ?>" placeholder="Digite Seu Email;" />
    </div>

    <div class="form-group col-sm-4">
        <label>Senha:</label>
        <input type="password" class="form-control" disabled="true" id="senha" name="senha" value="<?php echo $usuario_editar_list['senha']; ?>" placeholder="Digite Sua Senha."/>
    </div>

    <div class="form-group col-sm-5">
        <label>Grupo de Permissão:</label>
        <select id="grupo_permissao" class="form-control" name="id_grupo_permissao">
            <?php foreach ($grupo_permissao_list as $p): ?>
                <option value="<?php echo $p['id']; ?> "
                        <?php echo ($usuario_editar_list['id_grupo_permissao'] == $p['id']) ? '"selected = selected"' : ''; ?>>
                    <?php echo $p['nome']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group col-sm-4">
        <label>Fotos:  (suporta apenas imagem em png.)</label>
        <div class="fileUpload btn btn-primary">
            <span>Upload</span>
            <input type="file" id="fotos" name="fotos[]" class="upload"  multiple/>
        </div>
    </div>
    <div class="panel panel-default col-sm-12">
        <div class="panel-heading">Fotos do Produto</div>
        <div class="panel-body">
            <?php foreach ($usuario_editar_list['fotos'] as $fotos): ?>
                <div class="foto_item">
                    <img src="<?php echo BASE_URL; ?>assets/imagens/usuarios/<?php echo $fotos['url']; ?>" class="img-thumbnail" border="0" /><br/>
                    <a class="btn btn-danger" href="<?php echo BASE_URL; ?>usuario/excluir_imagem/<?php echo $fotos['id']; ?>">Excluir Imagem</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="form-group col-sm-12">
        <input type="submit" class="btn btn-success" value="Editar" />
        <a class="btn btn-warning" href="<?php echo BASE_URL; ?>usuario">Voltar</a>
    </div>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/usuario/script_usuario_validacao.js"></script>
