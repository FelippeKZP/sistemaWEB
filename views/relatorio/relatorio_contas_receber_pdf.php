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

<h1>Relatório de Contas a Receber</h1>

<hr/>

<fieldset>

    <?php
    if (isset($filtros['nome']) && !empty($filtros['nome'])) {
        echo "Filtrado pela Cliente: " . $filtros['nome'] . "<br/>";
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
        <th>#</th>
        <th>Cliente</th>
        <th>CPF/CNPJ</th>
        <th>Tipo de Pag.</th>
        <th>Parcela</th>
        <th>Data de Venc.</th>
        <th>Data de Rec.</th>
        <th>Total</th>
        <th>Status</th>
    </tr>
</thead>
<?php foreach ($conta_list as $c): ?>
    <tbody>
        <tr>
            <td><?php echo $c['id']; ?></td>
            <td><?php echo $c['nome']; ?></td>
            <td><?php echo $c['cpfCnpj']; ?></td>
            <td><?php echo $tipo_pag[$c['tipo_pag']]; ?></td>
            <td><?php echo $c['parcela']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($c['data_vencimento'])); ?></td>
            <td><?php
            if ($c['data_recebimento'] == 0000 - 00 - 00) {
                echo '<span style="color:red;">' . 'Conta Não Foi Recebida' . '</span>';
            } else {
                echo date('d/m/Y', strtotime($c['data_recebimento']));
            }
            ?></td>
            <td><?php echo number_format($c['valor'], 2, ',', '.'); ?></td>
            <td><?php
            if ($c['status'] == 0) {
                echo '<span style="color:red;">' . $status[$c['status']] . '<span>';
            } else {
                echo '<span style="color:green;">' . $status[$c['status']] . '</span>';
            }
            ?></td>
        </tr>
    </tbody>
<?php endforeach; ?>
</table>
