<?php

class Compra extends model {

    public function getList($s,$offset,$limit) {
        $array = array();

        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT compra.id,compra.numero_nota,compra.data_compra,compra.total_compra,fornecedor.razao_social
               FROM compra
               INNER JOIN fornecedor on fornecedor.id = compra.id_fornecedor
               WHERE fornecedor.razao_social LIKE :razao_social LIMIT $offset,$limit ");
            $sql->bindValue(":razao_social", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT compra.id,compra.numero_nota,compra.data_compra,compra.total_compra,fornecedor.razao_social
              FROM compra
              INNER JOIN fornecedor on fornecedor.id =  compra.id_fornecedor LIMIT $offset,$limit");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTotal($s){
        if(!empty($s)){
            $sql = $this->db->prepare("SELECT COUNT(id) as c FROM compra 
                INNER JOIN fornecedor on fornecedor.id =  compra.id_fornecedor
                WHERE fornecedor.razao_social LIKE :nome");
            $sql->bindValue(":nome", '%'.$s.'%');
            $sql->execute();
        }else{
            $sql = $this->db->prepare("SELECT COUNT(id) as c FROM compra");
            $sql->execute();
        }

        $sql = $sql->fetch();
        return $sql['c'];
    }

    public function verificarId($id){

        $sql = $this->db->prepare("SELECT id FROM compra WHERE id = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function venda_vizualizar($id){
        $array =  array();

        $sql = $this->db->prepare("SELECT fornecedor.razao_social,fornecedor.cnpj,compra.numero_nota,compra.total_compra
            FROM compra
            INNER JOIN fornecedor on fornecedor.id =  compra.id_fornecedor
            WHERE compra.id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array['info'] = $sql->fetch();
        }

        $sql = $this->db->prepare("SELECT lote_produto.numero_lote,produto.nome,produto.preco_compra,item_compra.quantidade,item_compra.total
            FROM item_compra
            INNER JOIN lote_produto on lote_produto.id = item_compra.id_lote_produto
            INNER JOIN produto on produto.id = lote_produto.id_produto
            WHERE item_compra.id_compra = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array['produtos'] = $sql->fetchAll();
        }

        return $array;
    }

    public function compra_add($id_fornecedor, $numero_nota,$data_vencimento, $quant, $id_usuario) {

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

        $sql = $this->db->prepare("SELECT razao_social FROM fornecedor WHERE id = :id_fornecedor");
        $sql->bindValue(":id_fornecedor",$id_fornecedor);
        $sql->execute();

        if($sql->rowCount() > 0){
            $row =  $sql->fetch();
            $fornecedor =  $row['razao_social'];
        }

        $sql = $this->db->prepare("UPDATE compra SET total_compra = :total_compra WHERE id = :id");
        $sql->bindValue(":total_compra", $total_compra);
        $sql->bindValue(":id", $id_compra);
        $sql->execute();

        $sql = $this->db->prepare("INSERT INTO contas_pagar(tipo,descricao,data_conta,data_vencimento,total,status,id_usuario)
         VALUES(2,:descricao,NOW(),:data_vencimento,:total,0,:id_usuario)");
        $sql->bindValue(":descricao", $fornecedor);
        $sql->bindValue(":data_vencimento", $data_vencimento);
        $sql->bindValue(":total", $total_compra);
        $sql->bindValue(":id_usuario", $id_usuario);
        $sql->execute();
    }

}

?>