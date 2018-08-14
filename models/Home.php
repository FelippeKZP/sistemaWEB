<?php

class Home extends model {

    public function produtoEstoqueBaixo() {
        $array = array();

        $sql = $this->db->prepare("SELECT nome FROM produto WHERE quantidade_min >  quantidade");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function totalClientes($periodo1, $periodo2) {

        $sql = $this->db->prepare("SELECT COUNT(id) as c FROM cliente WHERE data_cadastro BETWEEN :periodo1 AND :periodo2");
        $sql->bindValue(":periodo1", $periodo1);
        $sql->bindValue(":periodo2", $periodo2);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
        }

        return $row['c'];
    }

    public function totalVendas($periodo1, $periodo2) {

        $sql = $this->db->prepare("SELECT COUNT(id) as c FROM venda WHERE data_venda  BETWEEN :periodo1 AND :periodo2");
        $sql->bindValue(":periodo1", $periodo1);
        $sql->bindValue(":periodo2", $periodo2);
        $sql->execute();


        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
        }

        return $row['c'];
    }

    public function receita($periodo1, $periodo2 = null) {
        $float = 0;

        $sql = $this->db->prepare("SELECT SUM(venda.total_venda) as c
                    FROM contas_receber
                    INNER JOIN venda on venda.id = contas_receber.id_venda
                    WHERE venda.data_venda BETWEEN :periodo1 AND :periodo2 AND contas_receber.status = 1 ");
        $sql->bindValue(":periodo1", $periodo1);
        $sql->bindValue(":periodo2", $periodo2);
        $sql->execute();


        $row = $sql->fetch();
        $float = $row['c'];

        return $float;
    }

    public function despesas($periodo1, $periodo2) {
        $float = 0;


        $sql = $this->db->prepare("SELECT SUM(compra.total_compra) as c
               FROM contas_pagar
               INNER JOIN compra on compra.id =  contas_pagar.id_compra
               WHERE compra.data_compra BETWEEN :periodo1 AND :periodo2 AND contas_pagar.status = 1");
        $sql->bindValue(":periodo1", $periodo1);
        $sql->bindValue(":periodo2", $periodo2);
        $sql->execute();


        $row = $sql->fetch();
        $float = $row['c'];

        return $float;
    }

}

?>