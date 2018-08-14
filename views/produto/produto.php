<h1 class="h1">Produtos</h1>

<br/><br/>

<a class="btn btn-info" href="<?php echo BASE_URL; ?>produto/produto_add">Adicionar Produto</a><br/>

<form method="GET">
    <input type="text"  class="form-control ool-sm-5"id="searchs" name="searchs" value="<?php echo (!empty($_GET['searchs'])) ? $_GET['searchs'] : ''; ?>" />
</form>

<br/><br/>

<?php if (isset($msg_erro) && !empty($msg_erro)): ?>
    <div class="alert alert-erro alert-dismissible">
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

<table id="tabela" class="table-responsive table-hover">
    <div class="table">
        <thead>
            <tr>
                <th>Imagem</th>
                <th>Cód. Barras</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Quant. Min</th>
                <th>Preço de Venda</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
        </thead>
        <?php foreach ($produto_list as $p): ?>
            <tbody>
                <tr>
                    <td>
                        <?php if (!empty($p['url'])): ?>
                            <img src="<?php echo BASE_URL; ?>assets/imagens/produtos/<?php echo $p['url']; ?>" height="50"  border="0" />
                        <?php else: ?>
                            <img src="<?php echo BASE_URL; ?>assets/imagens/padrao.jpg" height="50" border="0"/>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $p['cod_barras']; ?></td>
                    <td><?php echo $p['nome']; ?></td>
                    <td><?php echo $p['quantidade']; ?></td>
                    <td>
                        <?php
                        if ($p['quantidade_min'] > $p['quantidade']) {
                            echo '<span style="color:red">' . ($p['quantidade_min']) . '</span>';
                        } else {
                            echo $p['quantidade_min'];
                        }
                        ?>
                    </td>
                    <td><?php echo number_format($p['preco'], 2, ',', '.'); ?></td>
                    <td>
                        <?php
                        if($p['status'] == 0){
                            echo '<span style="color:red">'.($status[$p['status']]).'</span>';
                        }else{
                            echo '<span style="color:green">'.($status[$p['status']]).'</span>';
                        }
                        ?>   
                    </td>
                    <td>
                        <a class="btn btn-primary"
                           href="<?php echo BASE_URL; ?>produto/produto_editar/<?php echo $p['id']; ?>">Editar</a>
                        <a class="btn btn-danger"
                           onclick="return confirm('Deseja Confirmar ?');"
                           href="<?php echo BASE_URL; ?>produto/produto_deletar/<?php echo $p['id']; ?>">Excluir</a>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </div>
</table> 

<ul class="pagination">
    <?php if ($total > $limit): ?>
        <?php if ($paginaAtual != 1): ?>
            <li><a href="<?php echo BASE_URL; ?>produto?p=1">Primeira Pagina</a></li>
        <?php endif; ?>
    <?php endif; ?>
    <?php for ($q = 1; $q <= $paginas; $q++): ?>
        <?php if ($paginaAtual == $q): ?>
            <li class="active"><a href="<?php echo BASE_URL; ?>produto?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php else: ?>
            <li><a href="<?php echo BASE_URL; ?>produto?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>
    <?php for ($q = $paginaAtual + $max; $q <= $paginaAtual + 1; $q++): ?>
        <li class="active"><a href="<?php echo BASE_URL; ?>produto?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endfor; ?>
    <li><a href="<?php echo BASE_URL; ?>produto?p=<?php echo $paginas; ?>">Ultima Pagina</a></li
</ul>