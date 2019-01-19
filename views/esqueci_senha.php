<title>Esqueci Minha Senha</title>

<div class="quadrado">
    <div class="container-aviso">
        <h2>Esqueceu sua senha de acesso ?</h2>
        <h4>Nós a renviaremos para seu e-mail</h4>
    </div>
    <div class="container-form">
        <p>Se você esqueceu sua senha para acesso ao site, não se preocupe.
            Apenas informe no campo a seguir o endereço de e-mail de cadastro que você possui no sistema e
            reenviaremos sua senha para o e-mail informado.</p>
    </div>
    <div class="container-email">

        <?php if (isset($msg_sucesso) && !empty($msg_sucesso)): ?>
            <div class="sucesso"><?php echo $msg_sucesso; ?></div>
        <?php endif; ?>

        <?php if (isset($msg_erro) && !empty($msg_erro)): ?>
            <div class="error"><?php echo $msg_erro; ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Email:</label><br/>
            <input type="email" id="email" name="email" placeholder="Digite Seu Email" autocomplete="off"/>

            <br/><br/>

            <input type="submit" id="bt" value="Enviar"/>
            <a href="<?php echo BASE_URL; ?>login" id="btVoltar">Voltar</a>
        </form>
    </div>

</div>

<style>
    * {
        font-family: arial;
    }

    .quadrado {
        width: 100%;
        height: 100%;
        margin: auto;
        border: 2px solid #CCC;

    }

    .container-aviso {

        height: 13%;
        background-color: rgb(235, 111, 0);
        padding-left: 20px;
    }

    .container-aviso h2 {
        color: #FFFFFF !important;
    }

    .container-aviso h4 {
        color: #FFFFFF;
        margin-top: 20px;
    }

    .container-form {
        font-size: 13px;
        color: #999999;
        padding-left: 20px;
        padding-right: 20px;
    }

    .container-email {
        font-size: 15px;
        color: #000000;
        padding-left: 20px;
    }

    .container-email #email {
        height: 5%;
        width: 50%;
        border-radius: 3px;
        border: 1px solid #CCC;
    }

    .container-email #bt {
        border: 0px;
        background-color: #5cb85c;
        height: 30px;
        color: #FFF;
        line-height: 30px;
        border-radius: 3px;
        padding-left: 10px;
        padding-right: 10px;
        cursor: pointer;
        font-size: 13px;
        display: inline-block;
        margin-top: 10px;
        text-decoration: none;
    }

    .container-email #btVoltar {
        border: 0px;
        background-color: #d58512;
        height: 30px;
        color: #FFF;
        line-height: 30px;
        border-radius: 3px;
        padding-left: 10px;
        padding-right: 10px;
        cursor: pointer;
        font-size: 13px;
        display: inline-block;
        margin-top: 10px;
        text-decoration: none;
    }

    .container-email .error {
        border: 2px solid #FFF;
        padding: 10px;
        background-color: #ff0000;
        border-radius: 5px;
        color: #FFF;
        margin-top: 10px;
        width: 73%;
        margin-bottom: 20px;

    }

    .container-email .sucesso {
        border: 2px solid #FFF;
        padding: 10px;
        background-color: #6699ff;
        border-radius: 5px;
        color: #FFF;
        margin-top: 10px;
        width: 73%;
        margin-bottom: 20px;
    }
</style>