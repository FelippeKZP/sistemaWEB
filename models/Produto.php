<?php

class Produto extends model {

    public function getList($s = null,$offset,$limit) {
        $array = array();

        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT *, (select produto_imagem.url from produto_imagem where produto_imagem.id_produto = produto.id limit 1) as url 
                   FROM produto WHERE nome LIKE :nome LIMIT $offset,$limit");
            $sql->bindValue(":nome", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT *, (select produto_imagem.url from produto_imagem where produto_imagem.id_produto = produto.id limit 1) as url 
                   FROM produto  LIMIT $offset,$limit");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTotal($s) {
        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT COUNT(*)as c FROM produto WHERE nome LIKE :nome");
            $sql->bindValue(":nome", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT COUNT(*)as c FROM produto");
            $sql->execute();
        }
        $sql = $sql->fetch();
        
        return $sql['c'];
    }

    public function getRelatorio($numero) {
        $array = array();

        if (!empty($numero)) {
            $sql = $this->db->prepare("SELECT * FROM produto WHERE cod_barras LIKE :numero ");
            $sql->bindValue(":numero", '%' . $numero . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT * FROM produto ");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }


        return $array;
    }

    public function getRelatorioEstoqueBaixo() {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM produto WHERE quantidade_min > quantidade");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getRelatorioProdutoMaisVendido($numero, $periodo1, $periodo2) {
        $array = array();

        if (!empty($numero)) {
            $sql = $this->db->prepare("select pro.nome,pro.cod_barras,pro.preco, sum(i.quantidade) as qtd, i.id_lote_produto
            from venda p 
            left join item_venda i on p.id = i.id_venda
            inner join lote_produto lot on i.id_lote_produto = lot.id 
            inner join produto pro on pro.id = lot.id_produto
            WHERE pro.cod_barras LIKE :numero
            group by i.id_lote_produto
            order by i.quantidade desc");
            $sql->bindValue(":numero", '&' . $numero . '%');
            $sql->execute();
        } else if (!empty($periodo1 && $periodo2)) {
            $sql = $this->db->prepare("select pro.nome, sum(i.quantidade) as qtd, i.id_lote_produto
            from venda p
            left join item_venda i on p.id = i.id_venda
            inner join lote_produto lot on i.id_lote_produto = lot.id
            inner join produto pro on pro.id = lot.id_produto
            WHERE p.data_venda BETWEEN :periodo1 AND :periodo2
            group by i.id_lote_produto
            order by i.quantidade desc ");
            $sql->bindValue(":periodo1", $periodo1);
            $sql->bindValue(":periodo2", $periodo2);
            $sql->execute();
        } else if (!empty($numero && $periodo1 && $periodo2)) {
            $sql = $this->db->prepare("select pro.nome, sum(i.quantidade) as qtd, i.id_lote_produto
            from venda p
            left join item_venda i on p.id = i.id_venda
            inner join lote_produto lot on i.id_lote_produto = lot.id
            inner join produto pro on pro.id = lot.id_produto
            WHERE p.numero LIKE :numero AND p.data_venda BETWEEN :periodo1 AND :periodo2
            group by i.id_lote_produto
            order by i.quantidade desc ");
            $sql->bindValue(":numero", '%' . $numero . '%');
            $sql->bindValue(":periodo1", $periodo1);
            $sql->bindValue(":periodo2", $periodo2);
            $sql->execute();
        } else {
            $sql = $this->db->prepare("select pro.nome, sum(i.quantidade) as qtd, i.id_lote_produto
            from venda p
            left join item_venda i on p.id = i.id_venda
            inner join lote_produto lot on i.id_lote_produto = lot.id
            inner join produto pro on pro.id = lot.id_produto
            group by i.id_lote_produto
            order by i.quantidade desc ");
            $sql->execute();
        }

        return $array;
    }

    public function getInfo($id) {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM produto WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $array['fotos'] = array();

            $sql = $this->db->prepare("SELECT id,url FROM produto_imagem WHERE id_produto = :id_produto");
            $sql->bindValue(":id_produto", $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $array['fotos'] = $sql->fetchAll();
            }
        }

        return $array;
    }

    public function pesquisarProduto($p) {
        $array = array();

        $sql = $this->db->prepare("SELECT id,nome,cod_barras,preco,preco_compra,quantidade FROM produto WHERE nome  LIKE :nome");
        $sql->bindValue(":nome", '%' . $p . '%');
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function produto_add($cod_barras, $nome, $id_grupo_produto, $quantidade_min, $preco, $preco_compra, $status, $fotos, $id_usuario) {
        $sql = $this->db->prepare("SELECT id FROM produto WHERE cod_barras = :cod_barras AND nome = :nome");
        $sql->bindValue(":cod_barras", $cod_barras);
        $sql->bindValue(":nome", $nome);
        $sql->execute();

        if ($sql->rowCount() == 0) {

            $sql = $this->db->prepare("INSERT INTO produto(cod_barras,nome,id_grupo_produto,quantidade,quantidade_min,preco,preco_compra,status)
            VALUES(:cod_barras,:nome,:id_grupo_produto,0,:quantidade_min,:preco,:preco_compra,:status)");
            $sql->bindValue(":cod_barras", $cod_barras);
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":id_grupo_produto", $id_grupo_produto);
            $sql->bindValue(":quantidade_min", $quantidade_min);
            $sql->bindValue(":preco", $preco);
            $sql->bindValue(":preco_compra", $preco_compra);
            $sql->bindValue(":status", $status);
            $sql->execute();

            $id_produto = $this->db->lastInsertId();

            $sql = $this->db->prepare("INSERT INTO historico_estoque(id_produto,id_usuario,acao,data_acao)
            VALUES(:id_produto,:id_usuario,:acao,NOW())");
            $sql->bindValue(":id_produto", $id_produto);
            $sql->bindValue(":id_usuario", $id_usuario);
            $sql->bindValue(":acao", "Cadastrar Produto");
            $sql->execute();

            if (count($fotos) > 0) {
                for ($q = 0; $q < count($fotos['tmp_name']); $q++) {
                    $tipo = $fotos['type'][$q];
                    if (in_array($tipo, array('image/jpeg', 'image/png'))) {
                        $tmpname = md5(time() . rand(0, 9999)) . '.jpg';
                        move_uploaded_file($fotos['tmp_name'][$q], 'assets/imagens/produtos/' . $tmpname);

                        list($width_orig, $height_orig) = getimagesize('assets/imagens/produtos/' . $tmpname);

                        $ratio = $width_orig / $height_orig;

                        $width = 500;
                        $height = 500;

                        if ($width / $height > $ratio) {
                            $width = $height * $ratio;
                        } else {
                            $height = $width / $ratio;
                        }

                        $img = imagecreatetruecolor($width, $height);

                        if ($tipo == 'image/jpeg') {
                            $origi = imagecreatefromjpeg('assets/imagens/produtos/' . $tmpname);
                        } elseif ($tipo == 'image/png') {
                            $origi = imagecreatefrompng('assets/imagens/produtos/' . $tmpname);
                        }

                        imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

                        imagejpeg($img, 'assets/imagens/produtos/' . $tmpname, 80);

                        $sql = $this->db->prepare("INSERT INTO produto_imagem(id_produto,url) VALUES(:id_produto,:url)");
                        $sql->bindValue(":id_produto", $id_produto);
                        $sql->bindValue(":url", $tmpname);
                        $sql->execute();
                    }
                }
            }

            return true;
        } else {
            return false;
        }
    }

    public function produto_editar($cod_barras, $nome, $id_grupo_produto, $quantidade_min, $preco, $preco_compra, $fotos, $id_usuario, $id) {
        $sql = $this->db->prepare("UPDATE produto SET cod_barras = :cod_barras, nome = :nome, id_grupo_produto = :id_grupo_produto,
        quantidade_min = :quantidade_min, preco = :preco, preco_compra = :preco_compra WHERE id = :id");
        $sql->bindValue(":cod_barras", $cod_barras);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":id_grupo_produto", $id_grupo_produto);
        $sql->bindValue(":quantidade_min", $quantidade_min);
        $sql->bindValue(":preco", $preco);
        $sql->bindValue(":preco_compra", $preco_compra);
        $sql->bindValue(":id", $id);
        $sql->execute();

        $sql = $this->db->prepare("INSERT INTO historico_estoque(id_produto,id_usuario,acao,data_acao)
               VALUES(:id_produto,:id_usuario,:acao,NOW())");
        $sql->bindValue(":id_produto", $id);
        $sql->bindValue(":id_usuario", $id_usuario);
        $sql->bindValue(":acao", "Editar Produto");
        $sql->execute();

        if (count($fotos) > 0) {
            for ($q = 0; $q < count($fotos['tmp_name']); $q++) {
                $tipo = $fotos['type'][$q];
                if (in_array($tipo, array('image/jpeg', 'image/png'))) {
                    $tmpname = md5(time() . rand(0, 9999)) . '.jpg';
                    move_uploaded_file($fotos['tmp_name'][$q], 'assets/imagens/produtos/' . $tmpname);

                    list($width_orig, $height_orig) = getimagesize('assets/imagens/produtos/' . $tmpname);

                    $ratio = $width_orig / $height_orig;

                    $width = 500;
                    $height = 500;

                    if ($width / $height > $ratio) {
                        $width = $height * $ratio;
                    } else {
                        $height = $width / $ratio;
                    }

                    $img = imagecreatetruecolor($width, $height);

                    if ($tipo == 'image/jpeg') {
                        $origi = imagecreatefromjpeg('assets/imagens/produtos/' . $tmpname);
                    } elseif ($tipo == 'image/png') {
                        $origi = imagecreatefrompng('assets/imagens/produtos/' . $tmpname);
                    }

                    imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

                    imagejpeg($img, 'assets/imagens/produtos/' . $tmpname, 80);

                    $sql = $this->db->prepare("INSERT INTO produto_imagem(id_produto,url) VALUES(:id_produto,:url)");
                    $sql->bindValue(":id_produto", $id);
                    $sql->bindValue(":url", $tmpname);
                    $sql->execute();
                }
            }
        }
    }

    public function excluir_imagem($id) {

        $id_produto = 0;

        $sql = $this->db->prepare("SELECT id_produto FROM produto_imagem WHERE id = :id ");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $id_produto = $row['id_produto'];
        }

        $sql = $this->db->prepare("DELETE FROM produto_imagem WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        return $id_produto;
    }

    public function produto_deletar($id) {
        $sql = $this->db->prepare("DELETE FROM produto_imagem WHERE id_produto = :id_produto");
        $sql->bindValue(":id_produto", $id);
        $sql->execute();

        $sql = $this->db->prepare("DELETE FROM produto WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function aumentoEstoque($id_produto, $quantidade) {
        $sql = $this->db->prepare("UPDATE produto SET quantidade = quantidade + $quantidade WHERE id = :id");
        $sql->bindValue(":id", $id_produto);
        $sql->execute();
    }

    public function baixaEstoque($id_produto, $quantidade) {
        $sql = $this->db->prepare("UPDATE produto SET quantidade = quantidade - $quantidade WHERE id = :id");
        $sql->bindValue(":id", $id_produto);
        $sql->execute();
    }

}
?>

