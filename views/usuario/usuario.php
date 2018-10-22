<h1 class="h1">Usuários</h1>

<br/>

<a class="btn btn-info" href="<?php echo BASE_URL; ?>usuario/usuario_add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Adicionar </a>

<br/><br/>

<form  method="GET">
    <div class="input-group">
        <span id="buscar" class="input-group-addon"><span class="glyphicon glyphicon-search " aria-hidden="true"></span></span>
        <input type="text" class="form-control" name="searchs" value="<?php echo (!empty($_GET['searchs'])) ? $_GET['searchs'] : ''; ?>" placeholder="Pesquisar"/>
    </div>
</form>

<?php
if (isset($filtros['searchs']) && !empty($filtros['searchs'])) {
    echo "Filtrado pelo Usuário: " . $filtros['searchs'] . "<br/>";
}
?>

<div style="clear: both;"></div>

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

<br/><br/>

<div class="table-responsive">
    <table id="tabela" class="table  table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php foreach ($usuario_list as $u): ?>
            <tbody>
                <tr>
                    <td><?php echo $u['id']; ?></td>
                    <td>
                        <?php if (!empty($u['url'])): ?>
                            <img src="<?php echo BASE_URL; ?>assets/imagens/usuarios/<?php echo $u['url']; ?>" height="50" border="0" />
                            <?php else: ?>
                                <img src="<?php echo BASE_URL; ?>assets/imagens/padrao.jpg" height="50" border="0"/>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $u['nome']; ?></td>
                        <td><?php echo $u['email']; ?></td>
                        <td>
                           <?php
                           if ($u['status'] == 0) {
                            echo '<span class="label label-danger">' . ($status[$u['status']]) . '</span>';
                        } else {
                            echo '<span class="label label-success">' . ($status[$u['status']]) . '</span>';
                        }
                        ?>
                    </td>
                    <td>
                        <a class="btn btn-primary" 
                        href="<?php echo BASE_URL; ?>usuario/usuario_editar/<?php echo $u['id']; ?>">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    <a  class="btn btn-danger" onclick="return confirm('Deseja Excluir ?');"
                    href="<?php echo BASE_URL; ?>usuario/usuario_deletar/<?php echo $u['id']; ?>">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </a>
            </td>
        </tr>
    </tbody>
<?php endforeach; ?>
</table>
</div>

<ul class="pagination">
    <?php if ($total > $limit): ?>
        <?php if ($paginaAtual != 1): ?>
            <li><a href="<?php echo BASE_URL; ?>usuario?p=1">Primeira Pagina</a></li>
        <?php endif; ?>
    <?php endif; ?>
    <?php if ($paginaAtual != 1): ?>
        <li><a href="<?php echo BASE_URL; ?>usuario?p=<?php echo $paginaAtual - 1?>"><span  class="glyphicon glyphicon-backward" aria-hidden="true" style="height: 20px;"></span></a></li>
    <?php endif;?>
    <?php for ($q = 1; $q <= $paginas; $q++): ?>
        <?php if ($paginaAtual == $q): ?>
            <li class="active"><a href="<?php echo BASE_URL; ?>usuario?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
            <?php else: ?>
                <li><a href="<?php echo BASE_URL; ?>usuario?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
            <?php endif; ?>
        <?php endfor; ?>
        <?php for ($q = $paginaAtual + $max; $q <= $paginaAtual + 1; $q++): ?>
            <li class="active"><a href="<?php echo BASE_URL; ?>usuario?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endfor; ?>
        <?php if($paginaAtual < $paginas): ?>
            <li><a href="<?php echo BASE_URL; ?>usuario?p=<?php echo $paginaAtual + 1?>"><span style="height: 20px;" class="glyphicon glyphicon-forward" aria-hidden="true"></span></a></li>
        <?php endif; ?>
        <?php if($paginaAtual > 1): ?>
            <li><a href="<?php echo BASE_URL; ?>usuario?p=<?php echo $paginas; ?>">Ultima Pagina</a></li>
        <?php endif; ?>
    </ul>