<h1>Relatório de Usuários</h1>

<br/><br/>

<a class="btn btn-primary" style="float: right;" href="<?php echo BASE_URL; ?>relatorio">Telas de Relatórios</a>

<br/><br/>

<form method="GET" onsubmit="return openPopup(this);">

    <div class="form-group col-sm-3">
        <label>Email:</label>
        <input type="email"class="form-control" name="nome"/>
    </div>

    <div style="clear: both;"></div>

    <div style="text-align: left; padding-left: 15px;">
        <input type="submit" class="btn btn-group-lg btn-success" value="Gerar Relatório"/>
    </div> 

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/relatorio/relatorio_usuario.js"/></script>
