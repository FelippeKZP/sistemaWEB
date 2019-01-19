<?php

class Perfil extends model
{

    public function verificarSenha($senha_atual, $id_usuario)
    {
        $sql = $this->db->prepare("SELECT id FROM usuario WHERE senha = :senha_atual AND id = :id");
        $sql->bindValue(":senha_atual", md5($senha_atual));
        $sql->bindValue(":id", $id_usuario);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function trocarSenha($senha, $id_usuario)
    {
        $sql = $this->db->prepare("UPDATE usuario SET senha = :senha WHERE id = :id");
        $sql->bindValue(":senha", md5($senha));
        $sql->bindValue(":id", $id_usuario);
        $sql->execute();

    }

}

?>