<?php

class GrupoPermissao extends model {

    private $group;
    private $permissions;

    public function getGrupoPermissao() {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM grupo_permissao");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function hasPermission($nome) {
        if(in_array($nome, $this->permissions)) {
            return true;
        } else {
            return false;
        }
    }
    public function getInfo($id) {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM grupo_permissao WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $array['id_permissao'] = explode(',', $array['id_permissao']);
        }

        return $array;
    }

    public function getList($s = null,$offset,$limit) {
        $array = array();

        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT * FROM grupo_permissao WHERE nome LIKE :nome  LIMIT $offset,$limit");
            $sql->bindValue(":nome", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT * FROM grupo_permissao  LIMIT $offset,$limit");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTotal($s) {
        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT COUNT(*)as c FROM grupo_permissao WHERE nome LIKE :nome");
            $sql->bindValue(":nome", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT COUNT(*)as c FROM grupo_permissao");
            $sql->execute();
        }
        $sql = $sql->fetch();
        return $sql['c'];
    }

    public function getRelatorio($nome) {
        $array = array();

        if (!empty($nome)) {
            $sql = $this->db->prepare("SELECT * FROM grupo_permissao WHERE nome LIKE :nome");
            $sql->bindValue(":nome", '%' . $nome . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT *  FROM grupo_permissao");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function verificarId($id){

        $sql = $this->db->prepare("SELECT id FROM grupo_permissao WHERE id = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }

    }

    public function grupo_permissao_add($nome, $id_permissao) {

        $params = implode(',', $id_permissao);

        $sql = $this->db->prepare("INSERT INTO grupo_permissao(nome,id_permissao) VALUES(:nome,:id_permissao)");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":id_permissao", $params);
        $sql->execute();

    }

    public function grupo_permissao_editar($nome, $id_permissao, $id) {
        $params = implode(',', $id_permissao);
        $sql = $this->db->prepare("UPDATE grupo_permissao SET nome = :nome, id_permissao = :id_permissao WHERE id = :id");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":id_permissao", $params);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function grupo_permissao_deletar($id) {
        $sql = $this->db->prepare("DELETE FROM grupo_permissao WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function setGroup($id) {
        $this->group = $id;
        $this->permissions = array();

        $sql = $this->db->prepare("SELECT id_permissao FROM grupo_permissao WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $row = $sql->fetch();

            if(empty($row['id_permissao'])) {
                $row['id_permissao'] = '0';
            }

            $id_permissao = $row['id_permissao'];

            $sql = $this->db->prepare("SELECT nome FROM permissao WHERE id IN ($id_permissao)");
            $sql->execute();

            if($sql->rowCount() > 0) {
                foreach($sql->fetchAll() as $item) {
                    $this->permissions[] = $item['nome'];
                }
            }
        }
    }

}

?>
