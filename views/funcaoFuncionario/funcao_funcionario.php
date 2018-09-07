<h1 class="h1">Funções de Funcionário</h1>

<br/><br/>

<a class="btn btn-info" href="<?php echo BASE_URL; ?>funcaoFuncionario/funcao_funcionario_add" >Adicionar Função de Funcionário</a><br/><br/>

<form method="GET">
    <input  type="text" class="form-control col-sm-5" id="searchs" name="searchs" value="<?php echo(!empty($_GET['searchs'])) ? $_GET['searchs'] : ''; ?>"/>
</form>

<br/><br/>

<div class="table-responsive">
    <table id="tabela" class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php foreach ($funcao_list as $f): ?>
            <tbody>
                <tr>
                    <td><?php echo $f['id']; ?></td>
                    <td><?php echo $f['nome']; ?></td>
                    <td>
                        <a class="btn btn-primary"
                           href="<?php echo BASE_URL; ?>funcaoFuncionario/funcao_funcionario_editar/<?php echo $f['id']; ?>">Editar</a>
                        <a class="btn btn-danger"
                           onclick="return confirm('Deseja Excluir ?');"
                           href="<?php echo BASE_URL; ?>funcaoFuncionario/funcao_funcionario_deletar/<?php echo $f['id']; ?>">Excluir</a>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>