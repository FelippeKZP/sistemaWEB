<?php

class Compra extends model {

    public function getList($s = null) {
        $array = array();

        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT compra.id,compra.numero_nota,compra.data_compra,compra.total_compra,fornecedor.razao_social
                 FROM compra
                 INNER JOIN fornecedor on fornecedor.id = compra.id_fornecedor
                 WHERE fornecedor.razao_social LIKE :razao_social");
            $sql->bindValue(":razao_social", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT compra.id,compra.numero_nota,compra.data_compra,compra.total_compra,fornecedor.razao_social
                  FROM compra
                  INNER JOIN fornecedor on fornecedor.id =  compra.id_fornecedor");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function compra_add($id_fornecedor, $numero_nota, $quant, $id_usuario) {

        $l = new LoteProduto();

        $sql = $this->db->prepare("INSERT INTO compra(id_fornecedor,id_usuario,data_compra,numero_nota,total_compra)
              VALUES(:id_fornecedor,:id_usuario,NOW(),:numero_nota,:total_compra)");
        $sql->bindValue(":id_fornecedor", $id_fornecedor);
        $sql->bindValue(":id_usuario", $id_usuario);
        $sql->bindValue(":numero_nota", $numero_nota);
        $sql->bindValue(":numero_nota", $numero_nota);
        $sql->bindValue(":total_compra", '0');
        $sql->execute();

        $id_compra = $this->db->lastInsertId();

        $total_compra = 0;

        foreach ($quant as $id_prod => $quant_prod) {
            $sql = $this->db->prepare("SELECT produto.preco_compra FROM lote_produto
                   INNER JOIN produto on produto.id = lote_produto.id_produto 
                   WHERE lote_produto.id = :id");
            $sql->bindValue(":id", $id_prod);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $row = $sql->fetch();
                $preco_compra = $row['preco_compra'];

                $sub_total = $preco_compra * $quant_prod;

                $sqlp = $this->db->prepare("INSERT INTO item_compra(id_lote_produto,id_compra,quantidade,total)
                        VALUES(:id_lote_produto,:id_compra,:quantidade,:total)");
                $sqlp->bindValue(":id_lote_produto", $id_prod);
                $sqlp->bindValue(":id_compra", $id_compra);
                $sqlp->bindValue(":quantidade", $quant_prod);
                $sqlp->bindValue(":total", $sub_total);
                $sqlp->execute();

                $l->aumentarEstoque($quant_prod, $id_prod);

                $total_compra += $preco_compra * $quant_prod;
            }
        }

        $sql = $this->db->prepare("UPDATE compra SET total_compra = :total_compra WHERE id = :id");
        $sql->bindValue(":total_compra", $total_compra);
        $sql->bindValue(":id", $id_compra);
        $sql->execute();
        
        $sql = $this->db->prepare("INSERT INTO contas_pagar(id_compra,conta,status)
               VALUES(:id_compra,0,0)");
        $sql->bindValue(":id_compra", $id_compra);
        $sql->execute();
    }

}

?>