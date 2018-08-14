<?php

class LoteProduto extends model {

    public function getList($s = null) {

        $array = array();

        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT lote_produto.id, lote_produto.numero_lote, produto.nome, fornecedor.razao_social,lote_produto.quantidade, lote_produto.data_vencimento FROM lote_produto 
            INNER JOIN produto on produto.id = lote_produto.id_produto
            INNER JOIN fornecedor on fornecedor.id = lote_produto.id_fornecedor 
            WHERE lote_produto.numero_lote LIKE :numero_lote LIMIT 0,10");
            $sql->bindValue(":numero_lote", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT lote_produto.id, lote_produto.numero_lote, produto.nome, fornecedor.razao_social,lote_produto.quantidade, lote_produto.data_vencimento FROM lote_produto
            INNER JOIN produto on produto.id = lote_produto.id_produto 
            INNER JOIN fornecedor on fornecedor.id = lote_produto.id_fornecedor LIMIT 0,10 ");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTotal($s) {
        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT COUNT(lote_produto.id)as c FROM lote_produto7
                   INNER JOIN produto on produto.id = lote_produto.id_produto
                   +WHERE lote_produto.numero_lote LIKE :numero_lote ");
            $sql->bindValue(":numero_lote", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT COUNT(*)as c FROM lote_produto");
            $sql->execute();
        }
        $sql = $sql->fetch();
        return $sql['c'];
    }

    public function getRelatorio($numero, $periodo1, $periodo2) {
        $array = array();

        if (!empty($numero)) {
            $sql = $this->db->prepare("SELECT lote_produto.id, lote_produto.numero_lote, produto.nome, fornecedor.razao_social,lote_produto.quantidade, lote_produto.data_vencimento,lote_produto.data_fabricacao
            FROM lote_produto 
            INNER JOIN produto on produto.id = lote_produto.id_produto
            INNER JOIN fornecedor on fornecedor.id = lote_produto.id_fornecedor 
            WHERE lote_produto.numero_lote LIKE :numero");
            $sql->bindValue(":numero", '%' . $numero . '%');
            $sql->execute();
        } else if ($periodo1 && $periodo2) {
            $sql = $this->db->prepare("SELECT lote_produto.id, lote_produto.numero_lote, produto.nome, fornecedor.razao_social,lote_produto.quantidade, lote_produto.data_vencimento,lote_produto.data_fabricacao
            FROM lote_produto 
            INNER JOIN produto on produto.id = lote_produto.id_produto
            INNER JOIN fornecedor on fornecedor.id = lote_produto.id_fornecedor 
            WHERE  lote_produto.data_vencimento BETWEEN :periodo1 AND :periodo2 ");
            $sql->bindValue(":periodo1", $periodo1);
            $sql->bindValue(":periodo2", $periodo2);
            $sql->execute();
        } else if ($numero && $periodo1 && $periodo2) {
            $sql = $this->db->prepare("SELECT lote_produto.id, lote_produto.numero_lote, produto.nome, fornecedor.razao_social,lote_produto.quantidade, lote_produto.data_vencimento,lote_produto.data_fabricacao
            FROM lote_produto 
            INNER JOIN produto on produto.id = lote_produto.id_produto
            INNER JOIN fornecedor on fornecedor.id = lote_produto.id_fornecedor 
            WHERE lote_produto.numero.numero LIKE :numero AND lote_produto.data_vencimeto BETWEEN :periodo1 AND :periodo2 ");
            $sql->bindValue(":numero", '%' . $numero . '%');
            $sql->bindValue(":periodo1", $periodo1);
            $sql->bindValue(":periodo2", $periodo2);
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT lote_produto.id, lote_produto.numero_lote, produto.nome, fornecedor.razao_social,lote_produto.quantidade, lote_produto.data_vencimento,lote_produto.data_fabricacao
            FROM lote_produto 
            INNER JOIN produto on produto.id = lote_produto.id_produto
            INNER JOIN fornecedor on fornecedor.id = lote_produto.id_fornecedor");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getInfo($id) {
        $array = array();

        $sql = $this->db->prepare("SELECT lote_produto.id, lote_produto.numero_lote,lote_produto.id_produto,lote_produto.id_fornecedor,
            produto.nome, fornecedor.razao_social,lote_produto.quantidade, lote_produto.data_vencimento , lote_produto.data_fabricacao
            FROM lote_produto
            INNER JOIN produto on produto.id = lote_produto.id_produto 
            INNER JOIN fornecedor on fornecedor.id = lote_produto.id_fornecedor WHERE lote_produto.id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function pesquisarLoteProdutos($p) {
        $array = array();

        $sql = $this->db->prepare("SELECT lote_produto.id,produto.nome,produto.preco,lote_produto.quantidade, lote_produto.numero_lote
              FROM lote_produto
              INNER JOIN produto on produto.id = lote_produto.id_produto
              WHERE produto.nome LIKE :nome OR lote_produto.numero_lote LIKE :nome
              LIMIT 0,10");
        $sql->bindValue(":nome", '%' . $p . '%');
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function lote_produto_add($numero_lote, $id_produto, $id_fornecedor, $quantidade, $data_fabricacao, $data_vencimento, $id_usuario) {
        $sql = $this->db->prepare("SELECT id FROM lote_produto WHERE numero_lote = :numero_lote AND id_produto = :id_produto");
        $sql->bindValue(":numero_lote", $numero_lote);
        $sql->bindValue(":id_produto", $id_produto);
        $sql->execute();

        if ($sql->rowCount() == 0) {
            $sql = $this->db->prepare("INSERT INTO lote_produto(numero_lote,id_produto,id_fornecedor,quantidade,data_fabricacao,data_vencimento)
                VALUES(:numero_lote,:id_produto,:id_fornecedor,:quantidade,:data_fabricacao,:data_vencimento)");
            $sql->bindValue(":numero_lote", $numero_lote);
            $sql->bindValue(":id_produto", $id_produto);
            $sql->bindValue(":id_fornecedor", $id_fornecedor);
            $sql->bindValue(":quantidade", $quantidade);
            $sql->bindValue(":data_fabricacao", $data_fabricacao);
            $sql->bindValue(":data_vencimento", $data_vencimento);
            $sql->execute();

            $sql = $this->db->prepare("INSERT INTO historico_estoque(id_produto,id_usuario,acao,data_acao)
            VALUES(:id_produto,:id_usuario,:acao,NOW())");
            $sql->bindValue(":id_produto", $id_produto);
            $sql->bindValue(":id_usuario", $id_usuario);
            $sql->bindValue(":acao", "Cadastrar Lote de Produto");
            $sql->execute();



            $p = new Produto();

            $p->aumentoEstoque($id_produto, $quantidade);

            return true;
        } else {
            return false;
        }
    }

    public function lote_produto_editar($numero_lote, $id_produto, $id_fornecedor, $data_fabricacao, $data_vencimento, $id) {
        $sql = $this->db->prepare("UPDATE lote_produto SET numero_lote = :numero_lote, id_produto = :id_produto, id_fornecedor = :id_fornecedor, data_fabricacao = :data_fabricacao, data_vencimento = :data_vencimento WHERE id = :id");
        $sql->bindValue(":numero_lote", $numero_lote);
        $sql->bindValue(":id_produto", $id_produto);
        $sql->bindValue(":id_fornecedor", $id_fornecedor);
        $sql->bindValue(":data_fabricacao", $data_fabricacao);
        $sql->bindValue(":data_vencimento", $data_vencimento);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function lote_produto_deletar($id) {
        $sql = $this->db->prepare("SELECT id_produto, quantidade FROM lote_produto WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $id_produto = $row['id_produto'];
            $quantidade = $row['quantidade'];
        }
        $p = new Produto();

        $p->baixaEstoque($id_produto, $quantidade);

        $sql = $this->db->prepare("DELETE FROM lote_produto WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function totalDelete($id) {

        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM lote_produto WHERE id_produto = :id_produto");
        $sql->bindValue(":id_produto", $id);
        $sql->execute();
        $row = $sql->fetch();

        if ($row['c'] == '0') {
            return false;
        } else {
            return true;
        }
    }

    public function baixarEstoque($id_lote, $quant_prod) {

        $sql = $this->db->prepare("SELECT produto.id FROM lote_produto INNER JOIN produto on produto.id = lote_produto.id_produto WHERE lote_produto.id = :id");
        $sql->bindValue(":id", $id_lote);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $id = $row['id'];

            $sql = $this->db->prepare("UPDATE lote_produto SET quantidade =  quantidade - $quant_prod WHERE id = :id");
            $sql->bindValue(":id", $id_lote);
            $sql->execute();

            $sql = $this->db->prepare("UPDATE produto SET quantidade = quantidade - $quant_prod WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
        }
    }

    public function aumentarEstoque($quantidade, $id_lote_produto) {
        $sql = $this->db->prepare("SELECT produto.id FROM lote_produto INNER JOIN produto on produto.id =  lote_produto.id_produto WHERE lote_produto.id = :id");
        $sql->bindValue(":id", $id_lote_produto);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $id = $row['id'];
        }

        $sql = $this->db->prepare("UPDATE lote_produto SET quantidade = quantidade + $quantidade WHERE id = :id");
        $sql->bindValue(":id", $id_lote_produto);
        $sql->execute();

        $sql = $this->db->prepare("UPDATE produto SET quantidade = quantidade +  $quantidade WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

}

?>