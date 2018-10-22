<?php

class Fornecedor extends model {

    public function getList($s = null,$offset,$limit) {
        $array = array();

        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT * FROM fornecedor WHERE razao_social LIKE :razao_social  LIMIT $offset,$limit");
            $sql->bindValue(":razao_social", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT * FROM fornecedor  LIMIT $offset,$limit");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTotal($s) {
        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT COUNT(*)as c FROM fornecedor WHERE razao_social LIKE :nome");
            $sql->bindValue(":nome", '%' . $s . '%');
            $sql->execute();
            $sql = $sql->fetch();
        } else {
            $sql = $this->db->prepare("SELECT COUNT(*)as c FROM fornecedor");
            $sql->execute();
            $sql = $sql->fetch();
        }
        return $sql['c'];
    }

    public function getFornecedor($id) {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM fornecedor WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function pesquisarFornecedor($p) {
        $array = array();

        $sql = $this->db->prepare("SELECT id, razao_social,cnpj FROM fornecedor WHERE razao_social LIKE :razao_social");
        $sql->bindValue(":razao_social", '%' . $p . '%');
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getRelatorio($nome, $periodo1, $periodo2) {
        $array = array();

        if (!empty($nome)) {
            $sql = $this->db->prepare("SELECT *  FROM fornecedor WHERE razao_social LIKE :nome");
            $sql->bindValue(":nome", $nome);
            $sql->execute();
        } elseif (!empty($periodo1 && $periodo2)) {
            $sql = $this->db->prepare("SELECT * FROM fornecedor WHERE data_cadastro BETWEEN :periodo1 AND :periodo2");
            $sql->bindValue(":periodo1", $periodo1);
            $sql->bindValue(":periodo2", $periodo2);
            $sql->execute();
        } elseif (!empty($nome && $periodo1 && $periodo2)) {
            $sql = $this->db->prepare("SELECT *  FROM fornecedor WHERE razao_social LIKE :nome AND data_cadastro BETWEEN :periodo1 AND :periodo2");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":periodo1", $periodo1);
            $sql->bindValue(":periodo2", $periodo2);
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT *  FROM fornecedor ");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function verificarId($id){

        $sql = $this->db->prepare("SELECT id FROM fornecedor WHERE id = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }

    }

    public function verificarFornecedorCnpj($p){
        $array =  array();
        $sql =  $this->db->prepare("SELECT COUNT(id) as total FROM fornecedor WHERE cnpj = :cnpj");
        $sql->bindValue(":cnpj", $p);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array =  $sql->fetchAll();
        }

        return $array;

    }


    public function verificarFornecedorIe($p){
        $array =  array();
        $sql =  $this->db->prepare("SELECT COUNT(id) as total FROM fornecedor WHERE ie = :ie");
        $sql->bindValue(":ie", $p);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array =  $sql->fetchAll();
        }

        return $array;

    }


    public function fornecedor_add($razao_social, $nome_fantasia, $cnpj, $ie, $telefone, $data_cadastro, $cep, $bairro, $rua, $numero, $cidade, $estado, $pais) {

        $sql = $this->db->prepare("SELECT id FROM fornecedor WHERE cnpj = :cnpj");
        $sql->bindValue(":cnpj", $cnpj);
        $sql->execute();

        if ($sql->rowCount() == 0) {

            $sql = $this->db->prepare("INSERT INTO fornecedor(razao_social,nome_fantasia,cnpj,ie,telefone,data_cadastro,cep,bairro,rua,numero,cidade,estado,pais)
                VALUES(:razao_social,:nome_fantasia,:cnpj,:ie,:telefone,:data_cadastro,:cep,:bairro,:rua,:numero,:cidade,:estado,:pais)");
            $sql->bindValue(":razao_social", $razao_social);
            $sql->bindValue(":nome_fantasia", $nome_fantasia);
            $sql->bindValue(":cnpj", $cnpj);
            $sql->bindValue(":ie", $ie);
            $sql->bindValue("telefone", $telefone);
            $sql->bindValue(":data_cadastro", $data_cadastro);
            $sql->bindValue(":cep", $cep);
            $sql->bindValue(":bairro", $bairro);
            $sql->bindValue(":rua", $rua);
            $sql->bindValue(":numero", $numero);
            $sql->bindValue(":cidade", $cidade);
            $sql->bindValue(":estado", $estado);
            $sql->bindValue(":pais", $pais);
            $sql->execute();

            return true;
        } else {
            return false;
        }
    }

    public function fornecedor_editar($razao_social, $nome_fantasia, $cnpj, $ie, $telefone, $data_cadastro, $cep, $bairro, $rua, $numero, $cidade, $estado, $pais, $id) {
        $sql = $this->db->prepare("UPDATE fornecedor SET razao_social = :razao_social, nome_fantasia = :nome_fantasia, cnpj = :cnpj, ie = :ie, telefone = :telefone, data_cadastro = :data_cadastro, cep = :cep, bairro = :bairro, rua = :rua, numero = :numero, cidade = :cidade, estado = :estado, pais = :pais WHERE id = :id");
        $sql->bindValue(":razao_social", $razao_social);
        $sql->bindValue(":nome_fantasia", $nome_fantasia);
        $sql->bindValue(":cnpj", $cnpj);
        $sql->bindValue(":ie", $ie);
        $sql->bindValue(":telefone", $telefone);
        $sql->bindValue(":data_cadastro", $data_cadastro);
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":bairro", $bairro);
        $sql->bindValue(":rua", $rua);
        $sql->bindValue(":numero", $numero);
        $sql->bindValue(":cidade", $cidade);
        $sql->bindValue(":estado", $estado);
        $sql->bindValue(":pais", $pais);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function fornecedor_deletar($id) {
        $sql = $this->db->prepare("DELETE FROM fornecedor WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        return true;
    }

}
?>

