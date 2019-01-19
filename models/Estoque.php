<?php

class Estoque extends model
{


    public function getList($s, $offset, $limit)
    {
        $array = array();

        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT produto.cod_barras, produto.nome,grupo_produto.nome as grupo,produto.quantidade,produto.preco_compra,produto.preco,produto.lucro_venda,produto.margem_bruta
				FROM produto
				INNER JOIN grupo_produto on grupo_produto.id = produto.id_grupo_produto
				WHERE produto.status = 1 AND produto.nome LIKE :nome OR produto.cod_barras LIKE :nome
				ORDER BY produto.nome ASC LIMIT $offset,$limit");
            $sql->bindValue(":nome", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT produto.cod_barras, produto.nome,grupo_produto.nome as grupo,produto.quantidade,produto.preco_compra,produto.preco,produto.lucro_venda,produto.margem_bruta
				FROM produto
				INNER JOIN grupo_produto on grupo_produto.id = produto.id_grupo_produto
				WHERE produto.status = 1
				ORDER BY produto.nome ASC LIMIT $offset,$limit");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;

    }

    public function getTotal($s)
    {
        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT COUNT(id) as c FROM produto WHERE nome LIKE :nome OR cod_barras LIKE :nome");
            $sql->bindValue(':nome', '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT COUNT(id) as c FROM produto");
            $sql->execute();
        }
        $sql = $sql->fetch();
        return $sql['c'];
    }


    public function getValorEstoque($s)
    {
        $float = 0;
        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT SUM(quantidade * preco) as valor_estoque FROM produto WHERE status = 1 AND produto.nome LIKE :nome 
				OR produto.cod_barras LIKE :nome ");
            $sql->bindValue(":nome", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT SUM(quantidade * preco) as valor_estoque FROM produto WHERE status = 1");
            $sql->execute();
        }


        $row = $sql->fetch();
        $float = $row['valor_estoque'];

        return $float;

    }

    public function getQuantidadeEstoque($s)
    {
        $float = 0;

        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT SUM(quantidade) as quantidade_estoque FROM produto WHERE status = 1 AND produto.nome LIKE :nome 
				OR produto.cod_barras LIKE :nome ");
            $sql->bindValue(":nome", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT SUM(quantidade) as quantidade_estoque FROM produto WHERE status = 1");
            $sql->execute();
        }

        $row = $sql->fetch();
        $float = $row['quantidade_estoque'];

        return $float;

    }

}

?>