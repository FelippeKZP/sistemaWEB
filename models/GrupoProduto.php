<?php

class GrupoProduto extends model {

    public function getList($s = null, $offset, $limit) {
        $array = array();

        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT * FROM grupo_produto WHERE nome LIKE :nome LIMIT $offset,$limit");
            $sql->bindValue(":nome", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT * FROM grupo_produto LIMIT $offset,$limit");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getGrupoProduto() {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM grupo_produto");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $array;
    }

    public function getTotal($s) {
        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT COUNT(*)as c FROM grupo_produto WHERE nome LIKE :nome");
            $sql->bindValue(":nome", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT COUNT(*)as c FROM grupo_produto");
            $sql->execute();
        }
        $sql = $sql->fetch();

        return $sql['c'];
    }

    public function getRelatorio($nome) {
        $array = array();

        if (!empty($nome)) {
            $sql = $this->db->prepare("SELECT * FROM grupo_produto WHERE nome LIKE :nome ");
            $sql->bindValue(":nome", '%' . $nome . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT *FROM grupo_produto ");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function grupo_produto_add($nome) {
        $sql = $this->db->prepare("SELECT id FROM grupo_produto WHERE nome = :nome");
        $sql->bindValue(":nome", $nome);
        $sql->execute();

        if ($sql->rowCount() == 0) {
            $sql = $this->db->prepare("INSERT INTO grupo_produto(nome) VALUES(:nome)");
            $sql->bindValue(":nome", $nome);
            $sql->execute();
            return true;
        } else {
            return false;
        }
    }


    public function verificarId($id){

        $sql = $this->db->prepare("SELECT id FROM grupo_produto WHERE id = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function grupo_produto_editar($nome, $id) {
        $sql = $this->db->prepare("UPDATE grupo_produto SET nome = :nome WHERE id = :id");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function getInfo($id) {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM grupo_produto WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function grupo_produto_deletar($id) {
        $sql = $this->db->prepare("DELETE FROM grupo_produto WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

}

?>