<h1 class="h1">Funcionários</h1>

<br/><br/>

<a class="btn btn-info" href="<?php echo BASE_URL; ?>funcionario/funcionario_add">Adicionar Funcionário</a><br/><br/>

<form method="GET">
    <input type="text" class="form-control col-sm-5" id="searchs" name="searchs" value="<?php echo (!empty($_GET['searchs'])) ? $_GET['searchs'] : ''; ?>" /> 
</form>

<br/><br/>

<div class="table-responsive">
    <table id="tabela" class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Função</th>
                <th>Data de Admissão</th>
                <th>Salário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php foreach ($funcionario_list as $f): ?>
            <tbody>
                <tr>
                    <td><?php echo $f['id'] ?></td>
                    <td><?php echo $f['nome']; ?></td>
                    <td><?php echo $f['cpf']; ?></td>
                    <td><?php echo $f['funcao']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($f['data_admissao'])); ?></td>
                    <td><?php echo number_format($f['salario'], 2, ',', '.'); ?></td>
                    <td>
                        <a class="btn btn-primary"
                           href="<?php echo BASE_URL; ?>funcionario/funcionario_editar/<?php echo $f['id']; ?>">Editar</a>
                        <a class="btn btn-danger"
                           onclick="return confirm('Deseja Excluir ?');"
                           href="<?php echo BASE_URL; ?>funcionario/funcionario_deletar/<?php echo $f['id']; ?>">Excluir</a>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>