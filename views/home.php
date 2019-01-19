<?php if (isset($produto_estoque_baixo) && !empty($produto_estoque_baixo)): ?>
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Contém Produto Com Estoque Baixo, Verifique o Relatório de Produtos Com Estoque Baixo.</strong>
    </div>
<?php endif; ?>

<div style="clear: both"></div>

<?php if ($dashboard): ?>

    <h3 style="margin-left: 10px;">Dados Gerais Nos Últimos 30 Dias</h3>

    <div class="col-sm-3" style="margin-top: 10px;">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Total de Clientes</h3>
            </div>
            <div class="panel-body">
                <img title="total de clientes" src="<?php echo BASE_URL; ?>assets/imagens/dashboardClientes.png"/>
                <h4 style="float: right; padding-right: 50px;"><?php echo $total_clientes; ?></h4>
            </div>
        </div>
    </div>

    <div class="col-sm-3" style="margin-top: 10px;">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title">Total de Vendas</h3>
            </div>
            <div class="panel-body">
                <img title="total de vendas" src="<?php echo BASE_URL; ?>assets/imagens/dashboardTotalVendas.png"/>
                <h4 style="float: right; padding-right: 50px;"><?php echo $total_vendas; ?></h4>
            </div>
        </div>
    </div>

    <div class="col-sm-3" style="margin-top: 10px;">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Receita</h3>
            </div>
            <div class="panel-body">
                <img title="total da receita" src="<?php echo BASE_URL; ?>assets/imagens/dashboardVendas.png"/>
                <h4 style="float: right;  padding-right: 30px;">
                    R$ <?php echo number_format($receita, 2, ',', '.'); ?></h4>
            </div>
        </div>
    </div>

    <div class="col-sm-3" style="margin-top: 10px;">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Despesas</h3>
            </div>
            <div class="panel-body">
                <img title="total da despesas" src="<?php echo BASE_URL; ?>assets/imagens/dashboardDespesas.png"/>
                <h4 style="float: right; padding-right: 30px;">
                    R$ <?php echo number_format($despesas, 2, ',', '.'); ?></h4>
            </div>
        </div>
    </div>


    <div class="col-sm-8" style="margin-top: 10px;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Gráfico de Total de Vendas e Compras</h3>
            </div>
            <div class="panel-body">
                <canvas id="rel1" height="96px"></canvas>
            </div>
        </div>
    </div>

    <div class="col-sm-4" style="margin-top: 10px;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Contas a Receber Status de Pgto.</h3>
            </div>
            <div class="panel-body">
                <canvas id="rel2" height="210px"></canvas>
            </div>
        </div>
    </div>

<?php else: ?>

    <img src="<?php echo BASE_URL; ?>assets/imagens/fuzafarma.jpg" class="img-responsive img-rounded">

<?php endif; ?>

<script type="text/javascript">
    var lista_dia = <?php echo json_encode($lista_dia); ?>;
    var grafico_list = <?php echo json_encode(array_values($grafico_list)); ?>;
    var grafico_compra_list = <?php echo json_encode(array_values($grafico_compra_list)); ?>;
    var status_nome_list = <?php echo json_encode(array_values($status)); ?>;
    var status_list = <?php echo json_encode(array_values($status_list));  ?>
</script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/Chart.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/home.js"></script>
