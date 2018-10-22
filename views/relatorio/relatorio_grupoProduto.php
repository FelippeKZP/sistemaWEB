<h1>Relatório de Grupos de Produto</h1>

<a class="btn btn-primary" style="float: right;" href="<?php echo BASE_URL; ?>relatorio"><span class="glyphicon glyphicon-th" aria-hidden="true"></span> Telas de Relatórios</a>

<br/><br/>

<form method="GET" onsubmit="return openPopup(this);">

    <div class="form-group col-sm-3">
        <label>Nome:</label>
        <input type="text" class="form-control" name="nome"/>
    </div>

    <div style="clear: both"></div>
    
    <div style="text-align: left; padding-left: 15px;">
        <button class="btn btn-group-lg btn-success"><span class="glyphicon glyphicon-open-file" aria-hidden="true"></span> Gerar</button>
    </div>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/relatorio/relatorio_grupoProduto.js"></script>