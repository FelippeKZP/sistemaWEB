<?php

class ContaPagar extends model {

    public function getList($s) {
        $array = array();

        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT * FROM contas_pagar WHERE descricao LIKE :descricao ");
            $sql->bindValue(":descricao", '%' . $s . '%');
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
        $sql = $this->db->prepare("UPDATE contas_pagar SET data_pagamento = NOW(), status = 1 WHERE id = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();
    }

    public function conta_pagar_excluir($id){
        $sql = $this->db->prepare("DELETE FROM contas_pagar WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
}

?>