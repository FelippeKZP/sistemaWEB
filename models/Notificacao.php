<?php

class Notificacao extends model {

    public function verificarNotificacao($id_usuario) {

        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM notificacao WHERE id_usuarioEnviar = :id_usuario AND  status = 0");
        $sql->bindValue(":id_usuario", $id_usuario);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
        }

        return $row['c'];
    }

    public function getList($id_usuario) {
        $array = array();

        $sql = $this->db->prepare("SELECT notificacao.id, notificacao.tipo_notificacao,usuario.nome,notificacao.data_notificacao,notificacao.propriedades,notificacao.status
         FROM notificacao
         INNER JOIN usuario on usuario.id = notificacao.id_usuario
         WHERE notificacao.id_usuarioEnviar = :id_usuario AND notificacao.status = 0");
        $sql->bindValue(":id_usuario",$id_usuario);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        $sql = $this->db->prepare("UPDATE notificacao SET status = 1 WHERE id_usuarioEnviar = :id_usuario");
        $sql->bindValue(":id_usuario", $id_usuario);
        $sql->execute();

        return $array;
    }

    public function notificacao_add($usuarios, $tipo_notificacao, $notificacao, $id_usuario) {

        $id_usuarioEnviar = implode(',', $usuarios);

       $sql = $this->db->prepare("INSERT INTO notificacao(id_usuario,id_usuarioEnviar,data_notificacao,tipo_notificacao,propriedades,status)
         VALUES(:id_usuario,:id_usuarioEnviar,NOW(),:tipo_notificacao,:notificacao,0)");
       $sql->bindValue(":id_usuario", $id_usuario);
       $sql->bindValue(":id_usuarioEnviar", $id_usuarioEnviar);
       $sql->bindValue(":tipo_notificacao", $tipo_notificacao);
       $sql->bindValue(":notificacao", $notificacao);
       $sql->execute();
   }

}

?>