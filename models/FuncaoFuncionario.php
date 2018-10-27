<?php

class FuncaoFuncionario extends model {

    public function getList($s,$limit,$offset) {
        $array = array();

        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT * FROM funcao_funcionario WHERE nome LIKE :nome LIMIT $offset, $limit");
            $sql->bindValue(":nome", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT * FROM funcao_funcionario LIMIT $offset, $limit");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTotal($s){
        if(!empty($s)){
            $sql = $this->db->prepare("SELECT COUNT(id) as c FROM funcao_funcionario WHERE nome LIKE :nome");
            $sql->bindValue(":nome". '%'. $s.'%');
            $sql->execute();
        }else{
            $sql = $this->db->prepare("SELECT COUNT(id) as c FROM funcao_funcionario");
            $sql->execute();
        }

        $sql = $sql->fetch();
        return $sql['c'];
    }

    public function getInfo($id) {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM funcao_funcionario WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function verificarId($id){

        $sql = $this->db->prepare("SELECT id FROM funcao_funcionario WHERE id = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }


    public function getCombo(){
        $array = array();

        $sql = $this->db->prepare("SELECT id,nome FROM funcao_funcionario ORDER BY nome ASC");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }


    public function getRelatorio($nome) {
        $array = array();

        if (!empty($nome)) {
            $sql = $this->db->prepare("SELECT * FROM funcao_funcionario WHERE nome LIKE :nome ");
            $sql->bindValue(":nome", '%' . $nome . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT *FROM funcao_funcionario");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function funcao_funcionario_add($nome, $descricao) {

     $sql = $this->db->prepare("INSERT INTO funcao_funcionario(nome,descricao) VALUES(:nome,:descricao)");
     $sql->bindValue(":nome", $nome);
     $sql->bindValue(":descricao", $descricao);
     $sql->execute();
 }

 public function funcao_funcionario_deletar($id) {
    $sql = $this->db->prepare("DELETE FROM funcao_funcionario WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();
}

public function funcao_funcionario_editar($nome, $descricao, $id) {
    $sql = $this->db->prepare("UPDATE funcao_funcionario SET nome = :nome, descricao = :descricao WHERE id = :id");
    $sql->bindValue(":nome", $nome);
    $sql->bindValue(":descricao", $descricao);
    $sql->bindValue(":id", $id);
    $sql->execute();
}



}

?>