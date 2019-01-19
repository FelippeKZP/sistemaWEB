<!DOCTYPE html>
<html>
<head>
    <title>Login do Sistema</title>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/login.css" type="text/css"/>


</head>
<body>

<div class="login">

    <!-- Inicio Formulário -->
    <form method="POST">

        <!-- Inicio Logo -->
        <div class="icone">
            <?php if (isset($error) && !empty($error)): ?>
                <div><strong style="color: red;"><?php echo $error; ?></strong></div>
            <?php endif; ?>

        </div>
        <!-- Fim Logo -->

        <!-- Inicio Form Email -->
        <div class="form-group">
            <input class="form-control" type="email" name="email" placeholder="Email" autofocus="on">
        </div>
        <!-- Fim Form Email -->

        <!--Pular linha -->
        <br>
        <!-- Pular linha -->

        <!-- Inicio Form Senha -->
        <div class="form-group">
            <input class="form-control" type="password" name="senha" placeholder="Senha" autofocus="on">
        </div>
        <!-- Fim Form Senha -->

        <!-- Inicio Form Submit -->
        <div class="form-group">
            <input class="enviar" type="submit" value="Entrar" style="color: white">
        </div>
        <!-- Fim Form Submit -->
        <div class="form-group" style="padding-right: 30px; float: right;">
            <a id="esqueci" class="esqueci" style="font-size: 12px; text-decoration: none; color:#72afd2;"
               href="<?php echo BASE_URL; ?>login/esqueci_senha">ESQUECI MINHA SENHA</a>
        </div>

    </form>
    <!-- Fim do Formulário-->
</div>

</body>
</html>