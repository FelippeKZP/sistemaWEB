<h1>Relat�rio de Grupos de Permiss�o</h1>

<a class="btn btn-primary" style="float: right;" href="<?php echo BASE_URL; ?>relatorio">Telas de Relat�rios</a>

<br/><br/>

<form method="GET" onsubmit="return openPopup(this);">

    <div class="form-group col-sm-3">
        <label>Nome:</label>
        <input type="text" class="form-control" name="nome"/>
    </div>

    <div style="clear: both"></div>
    
    <div style="text-align: left; padding-left: 15px;">
        <input type="submit" class="btn btn-group-lg btn-success" value="Gerar Relat�rio"/>
    </div>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/relatorio/relatorio_grupoPermissao.js"></script>