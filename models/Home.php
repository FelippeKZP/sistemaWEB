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

        $sql = $this->db->prepare("SELECT SUM(contas_receber.valor) as c
            FROM contas_receber
            WHERE contas_receber.data_recebimento BETWEEN :periodo1 AND :periodo2 AND contas_receber.status = 1 ");
        $sql->bindValue(":periodo1", $periodo1);
        $sql->bindValue(":periodo2", $periodo2);
        $sql->execute();


        $row = $sql->fetch();
        $float = $row['c'];

        return $float;
    }

    public function despesas($periodo1, $periodo2) {
        $float = 0;


        $sql = $this->db->prepare("SELECT SUM(contas_pagar.total) as c
         FROM contas_pagar
         WHERE contas_pagar.data_pagamento BETWEEN :periodo1 AND :periodo2 AND contas_pagar.status = 1");
        $sql->bindValue(":periodo1", $periodo1);
        $sql->bindValue(":periodo2", $periodo2);
        $sql->execute();


        $row = $sql->fetch();
        $float = $row['c'];

        return $float;
    }

    public function getGrafico($periodo1, $periodo2){
        $array = array();
        $diaCorrente = $periodo1;

        while($periodo2 != $diaCorrente){
            $array[$diaCorrente] = 0;
            $diaCorrente = date('Y-m-d',strtotime("+ 1 days", strtotime($diaCorrente)));
        }

        $sql = $this->db->prepare("SELECT data_venda, COUNT(id) as total FROM venda WHERE data_venda BETWEEN :periodo1 AND :periodo2
            GROUP BY data_venda");
        $sql->bindValue(":periodo1",$periodo1);
        $sql->bindValue(":periodo2", $periodo2);
        $sql->execute();


        if($sql->rowCount() > 0){
            $row = $sql->fetchAll();

            foreach ($row as $venda_itens) {
                $array[$venda_itens['data_venda']] = $venda_itens['total'];
            }
        }

        return $array;
    }

    public function getGraficoCompra($periodo1,$periodo2){
        $array = array();
        $diaCorrente = $periodo1;

        while($periodo2 != $diaCorrente){
            $array[$diaCorrente] = 0;
            $diaCorrente = date('Y-m-d',strtotime("+ 1 days", strtotime($diaCorrente)));
        }

        $sql = $this->db->prepare("SELECT data_compra, COUNT(id) as total FROM compra WHERE data_compra BETWEEN :periodo1 AND :periodo2
            GROUP BY data_compra");
        $sql->bindValue(":periodo1", $periodo1);
        $sql->bindValue(":periodo2", $periodo2);
        $sql->execute();

        if($sql->rowCount() > 0){
            $row = $sql->fetchAll();

            foreach($row as $compra_itens){
                $array[$compra_itens['data_compra']] = $compra_itens['total'];
            }
        }

        return $array;
    }

    public function getGraficoStatus($periodo1,$periodo2){
        $array = array('0' => 0,'1' =>0);

        $sql = $this->db->prepare("SELECT contas_receber.status, COUNT(contas_receber.id) as total FROM contas_receber
            INNER JOIN venda on venda.id = contas_receber.id_venda
            WHERE venda.data_venda BETWEEN :periodo1 AND :periodo2
            GROUP BY contas_receber.status
            ORDER BY contas_receber.status ASC");
        $sql->bindValue(":periodo1", $periodo1);
        $sql->bindValue(":periodo2", $periodo2);
        $sql->execute();

        if($sql->rowCount() > 0){
            $row = $sql->fetchAll();

            foreach($row as $venda_status){
                $array[$venda_status['status']] = $venda_status['total'];
            }

        }

        return $array;
    }

}

?>