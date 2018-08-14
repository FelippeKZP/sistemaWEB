<style type="text/css">
    table {
        border-collapse: collapse;
        width: 50em;
        border: 1px solid #666;
    }
    thead {
        background: #ccc url(https://www.devfuria.com.br/html-css/tabelas/bar.gif) repeat-x left center;
        border-top: 1px solid #a5a5a5;
        border-bottom: 1px solid #a5a5a5;
    }
    tr:hover {
        background-color:#3d80df;
        color: #fff;
    }
    thead tr:hover {
        background-color: transparent;
        color: inherit;
    }
    tr:nth-child(even) {
        background-color: #edf5ff;
    }
    th {
        font-weight: normal;
        text-align: left;
    }
    th, td {
        padding: 0.1em 1em;
    }

</style>


<fieldset>
    <h1 style="padding-left: 170px;">Drogaria FuzaFarma</h1>
    <h4 style="padding-left: 350px; padding-top: -25px;">preço baixo sempre!</h4>


    <h6>CNPJ:</h6>
    <h6 style="padding-top: -20px;">24.426.418/0001-23</h6>

    <h6 style="padding-left: 570px;">Telefone:</h6>
    <h6 style="padding-left: 570px; padding-top: -20px;">(67) 3461-1830</h6>

    <h6>Endereço:</h6>
    <h6 style="padding-top: -20px;">Rua Ámelia Fukuda, 359 - Centro, Naviraí,MS</h6>


</fieldset>

<hr/>

<h1>Relatório de Lote de Produtos</h1>



<hr/>

<fieldset>

    <?php
    if (isset($filtros['nome']) && !empty($filtros['nome'])) {
        echo "Filtrado pelo número : " . $filtros['nome'] . "<br/>";
    }

    if (!empty($filtros['periodo1']) && !empty($filtros['periodo2'])) {
        echo "Filtrado no período: " . date('d/m/Y', strtotime($filtros['periodo1'])) . " a " . date('d/m/Y', strtotime($filtros['periodo2'])) . "<br/>";
    }
    ?>


</fieldset>

<br/>

<table id="tabela">
  <thead>
        <tr>
            <th>Numero do Lote</th>
            <th>Produto</th>
            <th>Fornecedor</th>
            <th>Quantidade</th>
            <th>Data de Fabricação</th>
            <th>Data de Vencimento</th>
        </tr>
    </thead>
<?php foreach ($lote_produto_list as $l): ?>
        <tbody>
            <tr>
                <td><?php echo $l['numero_lote']; ?></td>
                <td><?php echo $l ['nome']; ?></td>
                <td><?php echo $l['razao_social'] ?></td>
                <td><?php echo $l['quantidade']; ?></td>
                <td><?php echo date('d/m/Y', strtotime($l['data_fabricacao'])); ?></td>
                <td><?php echo date('d/m/Y', strtotime($l['data_vencimento'])); ?></td>
            </tr>
        </tbody>
<?php endforeach; ?>
</table>

