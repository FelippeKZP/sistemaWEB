<?php

class HistoricoEstoque extends model
{

    public function getRelatorio($periodo1, $periodo2)
    {
        $array = array();

        if (!empty($periodo1 && $periodo2)) {
            $sql = $this->db->prepare("SELECT historico_estoque.id,produto.nome as produto,usuario.nome as usuario,historico_estoque.acao,
            historico_estoque.data_acao FROM historico_estoque
            INNER JOIN produto on produto.id = historico_estoque.id_produto
            INNER JOIN usuario on usuario.id = historico_estoque.id_usuario
            WHERE historico_estoque.data_acao BETWEEN :periodo1 AND :periodo2");
            $sql->bindValue(":periodo1", $periodo1);
            $sql->bindValue(":periodo2", $periodo2);
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT historico_estoque.id,produto.nome as produto,usuario.nome as usuario,historico_estoque.acao,
            historico_estoque.data_acao FROM historico_estoque
            INNER JOIN produto on produto.id = historico_estoque.id_produto
            INNER JOIN usuario on usuario.id = historico_estoque.id_usuario");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

}

?>