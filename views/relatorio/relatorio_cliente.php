<h1>Relat�rio de Clientes</h1>

<a class="btn btn-primary" style="float: right;" href="<?php echo BASE_URL; ?>relatorio">Telas de Relat�rios</a>

<br/><br/>

<form method="GET" onsubmit="return openPopup(this);">


    <div class="form-group col-sm-3">
        <label>Nome:</label>
        <input type="text" class="form-control" name="nome"/>
    </div>

    <div class="form-group col-sm-2"></div>

    <div class="form-group col-sm-3">
        <label style="padding-left: 100px;">Per�odo:</label>
        <div style="clear: both;"></div>
        <input type="date" class="form-control" name="periodo1"/>
        <label style="margin-top: 6px; padding-left: 120px;">At�:</label>
        <div style="clear: both;"></div>
        <input type="date" class="form-control" name="periodo2"/>
    </div>

    <div style="clear: both;"></div>

    <div style="text-align: left; padding-left: 15px;">
        <input type="submit" class="btn btn-group-lg btn-success" value="Gerar Relat�rio"/>
    </div> 

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/relatorio/relatorio_cliente.js"/></script>