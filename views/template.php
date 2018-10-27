<! DOCYTYPE html>
<html>
<head>

    <meta charset="utf-8">

    <title>FuzaFarma</title>

    <link type="text/css" rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css"/>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css"> 
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.mask.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootbox.min.js"></script>
    <script type="text/javascript">var BASE_URL = '<?php echo BASE_URL; ?>';</script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/javascript.js" ></script>



</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo BASE_URL; ?>">FuzaFarma</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo BASE_URL; ?>balancoMes">Balanço</a></li>
                    <li><a href="<?php echo BASE_URL; ?>backup">Backup</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Cadastros<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo BASE_URL; ?>cliente">Cliente</a></li>
                            <li><a href="<?php echo BASE_URL; ?>fornecedor">Fornecedor</a></li>
                            <li><a href="<?php echo BASE_URL; ?>funcaoFuncionario">Funcão de Funcionário</a></li>
                            <li><a href="<?php echo BASE_URL; ?>funcionario">Funcionário</a></li>
                            <li><a href="<?php echo BASE_URL; ?>grupoPermissao">Grupo de Permissão</a></li>
                            <li><a href="<?php echo BASE_URL; ?>grupoProduto">Grupo de Produto</a></li>
                            <li><a href="<?php echo BASE_URL; ?>produto">Produto</a></li>
                            <li><a href="<?php echo BASE_URL; ?>loteProduto">Lote de Produto</a></li>
                            <li><a href="<?php echo BASE_URL; ?>usuario">Usuário</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo BASE_URL; ?>contaPagar">Contas a Pagar</a></li>
                    <li><a href="<?php echo BASE_URL; ?>contaReceber">Contas a Receber</a></li>
                    <li><a href="<?php echo BASE_URL; ?>estoque">Estoque</a></li>  
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Movimento<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo BASE_URL; ?>compra">Compra</a></li>
                            <li><a href="<?php echo BASE_URL; ?>venda">Venda</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo BASE_URL; ?>perda">Perda</a></li>
                    <li><a href="<?php echo BASE_URL; ?>relatorio">Relatórios</a></li>
                    <li><a href="<?php echo BASE_URL; ?>suporte">Suporte</a></li>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><img src="<?php echo BASE_URL; ?>assets/imagens/usuarios/<?php echo $viewData['usuario_foto']; ?>" class="img-circle" alt="imagem de peril" height="35" style="margin-top: 8px;" /></li>
                <li><a style="color:#FFF;"><?php echo $viewData['usuario_nome']; ?></a></li>
                <?php if($viewData['notificacao'] > 0): ?>
                    <li role="presentation"><a href="<?php echo BASE_URL; ?>notificacao" title="notificações"><div class="notificacoes"><span class="badge" style="margin-top: -3px; color: rgb(250,62,101); background-color:rgb(255,193,7); width: 9px; font-size: 16px; padding-right: 2px;"><?php echo $viewData['notificacao']; ?></span></div></a></li>
                    <?php else: ?>
                       <li role="presentation"><a href="<?php echo BASE_URL; ?>notificacao" title="notificações"><div class="notificacoes"><span class="badge" style="margin-top: -3px; color: rgb(250,62,101); background-color:rgb(255,193,7); width: 9px; font-size: 16px; padding-right: 2px;"></span></div></a></li>
                   <?php endif;?>
                   <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo BASE_URL; ?>perfil">Trocar Senha</a></li>
                        <li><a href="<?php echo BASE_URL . 'login/sair'; ?>">Sair</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="area">

        <?php $this->loadViewInTemplate($viewName, $viewData); ?>
    </div>
</div>
</body>
</html>