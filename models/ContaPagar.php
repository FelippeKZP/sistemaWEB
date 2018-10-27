<?php

class ContaPagar extends model {

    public function getList($s, $offset, $limit) {
        $array = array();

        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT * FROM contas_pagar WHERE descricao LIKE :descricao LIMIT $offset, $limit");
            $sql->bindValue(":descricao", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT * FROM contas_pagar LIMIT $offset, $limit");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getRelatorio($nome, $periodo1, $periodo2) {
        $array = array();

        if (!empty($nome)) {
            $sql = $this->db->prepare("SELECT * FROM contas_pagar WHERE descricao LIKE :nome");
            $sql->bindValue(":nome",'%', $nome.'%');
            $sql->execute();
        } elseif (!empty($periodo1 && $periodo2)) {
            $sql = $this->db->prepare("SELECT * FROM contas_pagar WHERE data_conta BETWEEN :periodo1 AND :periodo2");
            $sql->bindValue(":periodo1", $periodo1);
            $sql->bindValue(":periodo2", $periodo2);
            $sql->execute();
        } elseif (!empty($nome && $periodo1 && $periodo2)) {
            $sql = $this->db->prepare("SELECT * FROM contas_pagar WHERE descricao LIKE :nome  AND  data_conta BETWEEN :periodo1 AND :periodo2");
            $sql->bindValue(":nome",'%'. $nome.'%');
            $sql->bindValue(":periodo1", $periodo1);
            $sql->bindValue(":periodo2", $periodo2);
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT * FROM contas_pagar");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTotal($s){
        if(!empty($s)){
            $sql = $this->db->prepare("SELECT COUNT(id) as c FROM contas_pagar WHERE descricao LIKE :descricao");
            $sql->bindValue(":descricao". '%'. $s .'%');
            $sql->execute();
        }else{
            $sql = $this->db->prepare("SELECT COUNT(id) as c FROM contas_pagar");
            $sql->execute();
        }
        $sql = $sql->fetch();
        return $sql['c'];
    }

    public function getInfo($id){
        $array =  array();

        $sql = $this->db->prepare("SELECT * FROM contas_pagar WHERE id = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }

        return $array;
    }

    public function verificarId($id){

        $sql = $this->db->prepare("SELECT id FROM contas_pagar WHERE id = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function conta_pagar_add($tipo, $descricao, $data_conta, $data_vencimento, $data_pagamento, $total, $status, $id_usuario) {
        $sql = $this->db->prepare("INSERT INTO contas_pagar(tipo,descricao,data_conta,data_vencimento,data_pagamento,total,status,id_usuario)
            VALUES(:tipo,:descricao,:data_conta,:data_vencimento,:data_pagamento,:total,:status,:id_usuario)");
        $sql->bindValue(":tipo", $tipo);
        $sql->bindValue(":descricao", $descricao);
        $sql->bindValue(":data_conta", $data_conta);
        $sql->bindValue(":data_vencimento", $data_vencimento);
        $sql->bindValue(":data_pagamento", $data_pagamento);
        $sql->bindValue(":total", $total);
        $sql->bindValue(":status", $status);
        $sql->bindValue(":id_usuario", $id_usuario);
        $sql->execute();
        return true;
    }

    public function conta_pagar_receber($id){
        $sql = $this->db->prepare("SELECT id FROM contas_pagar WHERE id = :id AND status = 0");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $sql = $this->db->prepare("UPDATE contas_pagar SET data_pagamento = NOW(), status = 1 WHERE id = :id");
            $sql->bindValue(":id",$id);
            $sql->execute();
            return true;
        }else{
            return false;
        }
    }

    public function conta_pagar_excluir($id){
        $sql = $this->db->prepare("DELETE FROM contas_pagar WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
}

?>