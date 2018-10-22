<title>Redefinição De Senha</title>

<h1>Redefinição De Senha</h1>

<br/><br/>

<div class="formulario">

 <?php if (isset($msg_sucesso) && !empty($msg_sucesso)): ?>
    <div class="sucesso"><?php echo $msg_sucesso; ?></div>
<?php endif; ?>

<?php if (isset($msg_erro) && !empty($msg_erro)): ?>
    <div class="error"><?php echo $msg_erro; ?></div>
<?php endif; ?>

<form method="POST">
    <div class="form">
        <label>Digite A Nova Senha:</label>
        <input type="password" name="senha" placeholder="Digite a nova senha."  autofocus="on"><br/><br/>
        <label>Digite Novamente A Senha:</label>
        <input type="password" id="digite" placeholder="Digite novamente a senha." autocomplete="off" /><br/><br/>

        <input type="submit" id="btMudar" value="Mudar Senha"/>
        <a id="btVoltar" href="<?php echo BASE_URL; ?>login">Voltar</a>
    </div>
</form>
</div>

<style>
* {
    font-family: arial;
}
body{
    background-color: #f5f5f5;
}
h1{
    text-align:  center;
    color: #000;
}
.form{
    height: 28%;
    margin-left: 20px;
    margin-right: 20px;
    padding-top: 30px;
    padding-left: 7px;
    background-color:#70a1ff;
    border: 1px solid #CCC;

}

.form label{
    color:#FFF;
}
.form input{
    width: 50%;
    height: 30px;
    border-radius: 2px;
}
.form #digite{
    width: 46.5%;
}
.form #btMudar{
    width: 110px;
    border: 0px;
    background-color:#7bed9f;
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
.form #btVoltar{
    border: 0px;
    background-color:#ffa502 ;
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

.error{
    border: 2px solid #FFF;
    padding: 10px;
    background-color: #ff0000;
    border-radius: 5px;
    color: #FFF;
    margin-top: 10px;
    width: 73%;
    margin-bottom: 20px;

}

.sucesso{
    border: 2px solid #FFF;
    padding: 10px;
    background-color:#6699ff;
    border-radius: 5px;
    color: #FFF;
    margin-top: 10px;
    width: 73%;
    margin-bottom: 20px;
}


</style>