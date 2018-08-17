<h1 class="h1">Compras</h1>

<br/><br/>

<a class="btn btn-info" href="<?php echo BASE_URL; ?>compra/compra_add">Adicionar Compra</a>

<br/><br/>

<form method="GET">
    <input type="text" id="searchs" name="searchs" class="form-control" value="<?php echo(!empty($_GET['searchs'])) ? $_GET['searchs'] : ''; ?>" />
</form>

<br/><br/>

<div class="table-responsive">
    <table id="tabela" class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Num. da Nota</th>
                <th>Fornecedor</th>
                <th>Data da Compra</th>
                <th>Total da Compra</th>
                <th>Ação</th>
            </tr>
        </thead>
        <?php foreach ($compra_list as $c): ?>
            <tbody>
                <tr>
                    <td><?php echo $c['id']; ?></td>
                    <td><?php echo $c['numero_nota']; ?></td>
                    <td><?php echo $c['razao_social']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($c['data_compra'])); ?></td>
                    <td><?php echo number_format($c['total_compra'], 2, ',', '.'); ?></td>
                    <td>
                        <a class="btn btn-primary"
                           href="<?php echo BASE_URL; ?>compra/vizualizar_compra/<?php echo $c['id']; ?>">Vizualizar</a>
                        <a class="btn btn-danger"
                           onclick="return confirm('Deseja Mesmo Cancelar A Compra');"
                           href="<?php echo BASE_URL; ?>compra/cancelar_venda/<?php echo $c['id']; ?>"
                           >Cancelar</a>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>