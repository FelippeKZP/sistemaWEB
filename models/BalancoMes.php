<?php

class BalancoMes extends model {

    public function getAtualList($periodo1, $periodo2) {

        $sql = $this->db->prepare("SELECT SUM(venda.total_venda) as venda,
               (select SUM(compra.total_compra) FROM contas_pagar 
               INNER JOIN compra on compra.id = contas_pagar.id_compra
               WHERE contas_pagar.conta = 'compra' and contas_pagar.status = 1 AND contas_pagar.data_pagamento BETWEEN :periodo1 AND :periodo2 ) as compra,
               (select SUM(perda.total_perda) FROM perda WHERE perda.data_perda BETWEEN :periodo1 AND :periodo2) as perda,
               (select SUM(contas_pagar.total) FROM contas_pagar WHERE contas_pagar.status = 1 AND contas_pagar.data_pagamento BETWEEN :periodo1 AND :periodo2) as outras
               FROM contas_receber
               INNER JOIN venda on venda.id = contas_receber.id_venda
               WHERE contas_receber.status = 1 AND contas_receber.data_recebimento BETWEEN :periodo1 AND :periodo2");
        $sql->bindValue(":periodo1", $periodo1);
        $sql->bindValue(":periodo2", $periodo2);
        $sql->execute();

        $row = $sql->fetch();

        return $row;
    }

    public function getAnteriorList($periodo1, $periodo2) {


        $sql = $this->db->prepare("SELECT SUM(venda.total_venda) as venda,
               (select SUM(compra.total_compra) FROM contas_pagar 
               INNER JOIN compra on compra.id = contas_pagar.id_compra
               WHERE contas_pagar.conta = 'compra' and contas_pagar.status = 1 AND contas_pagar.data_pagamento BETWEEN :periodo1 AND :periodo2 ) as compra,
               (select SUM(perda.total_perda) FROM perda WHERE perda.data_perda BETWEEN :periodo1 AND :periodo2) as perda,
               (select SUM(contas_pagar.total) FROM contas_pagar WHERE contas_pagar.status = 1 AND contas_pagar.data_pagamento BETWEEN :periodo1 AND :periodo2) as outras
               FROM contas_receber
               INNER JOIN venda on venda.id = contas_receber.id_venda
               WHERE contas_receber.status = 1 AND contas_receber.data_recebimento BETWEEN :periodo1 AND :periodo2");
        $sql->bindValue(":periodo1", $periodo1);
        $sql->bindValue(":periodo2", $periodo2);
        $sql->execute();

        $row = $sql->fetch();

        return $row;
    }

}

?>