<?php

class Venda extends model {

    public function getList($s = null, $offset, $limit) {
        $array = array();

        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT venda.id,cliente.nome,funcionario.nome as func,cliente.cpfCnpj, venda.data_venda, venda.total_venda
               FROM venda
               INNER JOIN funcionario on funcionario.id = venda.id_funcionario
               INNER JOIN cliente on cliente.id = venda.id_cliente
               WHERE cliente.nome LIKE :nome                   
               LIMIT $offset,$limit ");
            $sql->bindValue(":nome", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT venda.id, cliente.nome,funcionario.nome as func,cliente.cpfCnpj, venda.data_venda, venda.total_venda
                FROM venda
                INNER JOIN funcionario on funcionario.id = venda.id_funcionario
                INNER JOIN cliente on cliente.id = venda.id_cliente
                LIMIT $offset,$limit ");
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
            $sql = $this->db->prepare("SELECT venda.id,cliente.nome,funcionario.nome as func,cliente.cpfCnpj, venda.data_venda, venda.total_venda,venda.tipo_pag
               FROM venda
               INNER JOIN funcionario on funcionario.id = venda.id_funcionario
               INNER JOIN cliente on cliente.id = venda.id_cliente
               WHERE cliente.nome LIKE :nome");
            $sql->bindValue(":nome",'%', $nome.'%');
            $sql->execute();
        } elseif (!empty($periodo1 && $periodo2)) {
            $sql = $this->db->prepare("SELECT venda.id,cliente.nome,funcionario.nome as func,cliente.cpfCnpj, venda.data_venda, venda.total_venda,venda.tipo_pag
               FROM venda
               INNER JOIN funcionario on funcionario.id = venda.id_funcionario
               INNER JOIN cliente on cliente.id = venda.id_cliente
               WHERE venda.data_venda BETWEEN :periodo1 AND :periodo2");
            $sql->bindValue(":periodo1", $periodo1);
            $sql->bindValue(":periodo2", $periodo2);
            $sql->execute();
        } elseif (!empty($nome && $periodo1 && $periodo2)) {
            $sql = $this->db->prepare("SELECT venda.id,cliente.nome,funcionario.nome as func,cliente.cpfCnpj, venda.data_venda, venda.total_venda,venda.tipo_pag
               FROM venda
               INNER JOIN funcionario on funcionario.id = venda.id_funcionario
               INNER JOIN cliente on cliente.id = venda.id_cliente
               WHERE cliente.nome LIKE :nome venda.data_venda BETWEEN :periodo1 AND :periodo2");
            $sql->bindValue(":nome",'%'. $nome.'%');
            $sql->bindValue(":periodo1", $periodo1);
            $sql->bindValue(":periodo2", $periodo2);
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT venda.id,cliente.nome,funcionario.nome as func,cliente.cpfCnpj, venda.data_venda, venda.total_venda,venda.tipo_pag
             FROM venda
             INNER JOIN funcionario on funcionario.id = venda.id_funcionario
             INNER JOIN cliente on cliente.id = venda.id_cliente");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTotal($s) {
        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT COUNT(venda.id)as c FROM venda 
                INNER JOIN cliente on cliente.id = venda.id_cliente                    
                WHERE cliente.nome LIKE :nome");
            $sql->bindValue(":nome", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT COUNT(*)as c FROM venda");
            $sql->execute();
        }
        $sql = $sql->fetch();
        return $sql['c'];
    }

    public function venda_add($id_cliente, $id_funcionario, $quant, $desconto, $tipo_pag, $data_vencimento, $n_parcelas, $id_usuario) {

        $l = new LoteProduto();

        $sql = $this->db->prepare("INSERT INTO venda(id_cliente,id_funcionario,id_usuario,data_venda,total_venda,desconto,tipo_pag)
           VALUES(:id_cliente,:id_funcionario,:id_usuario,NOW(),:total_venda,:desconto,:tipo_pag)");
        $sql->bindValue(":id_cliente", $id_cliente);
        $sql->bindValue(":id_funcionario", $id_funcionario);
        $sql->bindValue(":id_usuario", $id_usuario);
        $sql->bindValue(":desconto", $desconto);
        $sql->bindValue(":tipo_pag", $tipo_pag);
        $sql->bindValue(":total_venda", '0');
        $sql->execute();

        $id_venda = $this->db->lastInsertId();

        $total_venda = 0;
        foreach ($quant as $id_prod => $quant_prod) {

            $sql = $this->db->prepare("SELECT produto.preco FROM lote_produto
                INNER JOIN produto on produto.id = lote_produto.id_produto WHERE lote_produto.id = :id");
            $sql->bindValue(":id", $id_prod);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $row = $sql->fetch();
                $preco = $row['preco'];

                $subtotal = $preco * $quant_prod;

                $sqlp = $this->db->prepare("INSERT INTO item_venda(id_venda,id_lote_produto,quantidade,total) VALUES(:id_venda,:id_lote_produto,:quantidade,:total)");
                $sqlp->bindValue(":id_venda", $id_venda);
                $sqlp->bindValue(":id_lote_produto", $id_prod);
                $sqlp->bindValue(":quantidade", $quant_prod);
                $sqlp->bindValue(":total", $subtotal);
                $sqlp->execute();

                $l->baixarEstoque($id_prod, $quant_prod);

                $total_venda += $preco * $quant_prod - $desconto;
            }
        }

        $sql = $this->db->prepare("UPDATE venda SET total_venda = :total_venda WHERE id = :id");
        $sql->bindValue(":total_venda", $total_venda);
        $sql->bindValue(":id", $id_venda);
        $sql->execute();


        if ($n_parcelas > 1) {
            $qtdParc = $n_parcelas;
            $valorTotal = $total_venda;
            $calculoParc = ($valorTotal / $qtdParc);
            $data = $data_vencimento;

            for ($i = 1; $i <= $qtdParc; $i++) {


                $sql = $this->db->prepare("INSERT INTO contas_receber(id_venda,data_vencimento,parcela,valor,status)
                    VALUES(:id_venda,:data_vencimento,:parcela,:valor, 0)");
                $sql->bindValue(":id_venda", $id_venda);
                $sql->bindValue(":data_vencimento", $data);
                $sql->bindValue(":parcela", $i . ' de ' . $n_parcelas);
                $sql->bindValue(":valor", $calculoParc);
                $sql->execute();

                $data = date('Y-m-d', strtotime($data . ' + 1 month'));
            }
        } else {
            $data_vista = $data_vencimento;

            $sql = $this->db->prepare("INSERT INTO contas_receber(id_venda,data_vencimento,parcela,valor,status)
               VALUES(:id_venda,:data_vencimento,:parcela,:valor, 0)");
            $sql->bindValue(":id_venda", $id_venda);
            $sql->bindValue(":data_vencimento", $data_vista);
            $sql->bindValue(":parcela", $n_parcelas . ' de ' . $n_parcelas);
            $sql->bindValue(":valor", $total_venda);
            $sql->execute();
        }
    }

    public function verificarId($id){

        $sql = $this->db->prepare("SELECT id FROM venda WHERE id = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function venda_vizualizar($id) {
        $array = array();

        $sql = $this->db->prepare("SELECT cliente.nome, cliente.cpfCnpj,venda.total_venda,venda.data_venda FROM venda
           INNER JOIN cliente on cliente.id = venda.id_cliente
           WHERE venda.id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array['info'] = $sql->fetch();
        }

        $sql = $this->db->prepare("SELECT lote_produto.numero_lote,produto.nome,produto.preco,item_venda.quantidade,item_venda.total 
           FROM item_venda
           INNER JOIN lote_produto on lote_produto.id = item_venda.id_lote_produto
           INNER JOIN produto on produto.id = lote_produto.id_produto
           WHERE item_venda.id_venda = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array['produtos'] = $sql->fetchAll();
        }

        return $array;
    }

    public function venda_cancelar($id) {

        $sql = $this->db->prepare("DELETE FROM contas_receber WHERE id_venda = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        $sql = $this->db->prepare("SELECT id_lote_produto FROM item_venda WHERE id_venda = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $id_lote_produto = $row['id_lote_produto'];
        }

        $sql = $this->db->prepare("SELECT quantidade FROM item_venda WHERE id_venda = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $quantidade = $row['quantidade'];
        }

        $l = new LoteProduto();

        $l->aumentarEstoque($quantidade, $id_lote_produto);

        $sql = $this->db->prepare("DELETE FROM item_venda WHERE id_venda = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        $sql = $this->db->prepare("DELETE FROM venda WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

}

?>
