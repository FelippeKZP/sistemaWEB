<?php

class Cliente extends model
{

    public function getList($s = null, $offset, $limit)
    {
        $array = array();

        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT cliente.id,cliente.tipo_pessoa,cliente.nome,cliente.cpfCnpj,cliente.telefone,cidade.nome AS cidade
             FROM cliente
             INNER JOIN cidade on cidade.id = cliente.id_cidade
             WHERE cliente.nome LIKE :nome
             LIMIT $offset,$limit");
            $sql->bindValue(":nome", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT cliente.id,cliente.tipo_pessoa,cliente.nome,cliente.cpfCnpj,cliente.telefone,cidade.nome as cidade
            FROM cliente
            INNER JOIN cidade on cidade.id = cliente.id_cidade
            LIMIT $offset,$limit");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getInfo($id)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT cidade.id_estado,cliente.* 
        FROM cliente
        INNER JOIN  cidade on cidade.id = cliente.id_cidade
        WHERE cliente.id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getRelatorio($nome = null, $periodo1 = null, $periodo2 = null)
    {
        $array = array();

        if (!empty($nome && $periodo1 && $periodo2)) {
            $sql = $this->db->prepare("SELECT * FROM cliente WHERE nome LIKE :nome AND data_cadastro BETWEEN :periodo1 AND :periodo2 ORDER BY nome DESC ");
            $sql->bindValue(":nome", '%' . $nome . '%');
            $sql->bindValue(":periodo1", $periodo1);
            $sql->bindValue(":periodo2", $periodo2);
            $sql->execute();
        } elseif (!empty($nome)) {
            $sql = $this->db->prepare("SELECT *  FROM cliente WHERE nome LIKE :nome ORDER BY nome DESC");
            $sql->bindValue(":nome", '%' . $nome . '%');
            $sql->execute();
        } elseif (!empty($periodo1 && $periodo2)) {
            $sql = $this->db->prepare("SELECT * FROM cliente WHERE data_cadastro BETWEEN :periodo1 AND :periodo2 ORDER BY nome DESC");
            $sql->bindValue(":periodo1", $periodo1);
            $sql->bindValue(":periodo2", $periodo2);
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT *  FROM cliente ORDER BY nome DESC");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }


    public function pesquisarClientes($p)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT id,nome,cpfCnpj FROM cliente WHERE nome LIKE :nome LIMIT 0,10");
        $sql->bindValue(":nome", '%' . $p . '%');
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTotal($s)
    {
        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT COUNT(*)as c FROM cliente WHERE nome LIKE :nome");
            $sql->bindValue(":nome", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT COUNT(*)as c FROM cliente");
            $sql->execute();
        }
        $sql = $sql->fetch();
        return $sql['c'];
    }

    public function verificarId($id)
    {

        $sql = $this->db->prepare("SELECT id FROM cliente WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarClienteCpfCnpj($p)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT COUNT(id) as total FROM cliente where cpfCnpj = :cpfCnpj");
        $sql->bindValue(":cpfCnpj", $p);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function verificarClienteRgIe($p)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT COUNT(id) as total FROM cliente where rgIe = :rgIe");
        $sql->bindValue(":rgIe", $p);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function verificarClienteEmail($p)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT COUNT(id) as total FROM cliente where email = :email");
        $sql->bindValue(":email", $p);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }


    public function cliente_add($tipo_pessoa, $nome, $cpf, $rg, $telefone, $email, $data_cadastro, $data_aniversario, $cep, $bairro, $rua, $numero, $cidade)
    {

        $sql = $this->db->prepare("INSERT INTO cliente(tipo_pessoa,nome,cpfCnpj,rgIe,telefone,email,data_cadastro,data_aniversario,cep,bairro,rua,numero,id_cidade)
     VALUES(:tipo_pessoa,:nome,:cpf,:rg,:telefone,:email,:data_cadastro,:data_aniversario,:cep,:bairro,:rua,:numero,:cidade)");
        $sql->bindValue(":tipo_pessoa", $tipo_pessoa);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":cpf", $cpf);
        $sql->bindValue(":rg", $rg);
        $sql->bindValue(":telefone", $telefone);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":data_cadastro", $data_cadastro);
        $sql->bindValue(":data_aniversario", $data_aniversario);
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":bairro", $bairro);
        $sql->bindValue(":rua", $rua);
        $sql->bindValue(":numero", $numero);
        $sql->bindValue(":cidade", $cidade);
        $sql->execute();

    }

    public function cliente_editar($tipo_pessoa, $nome, $cpf, $rg, $telefone, $email, $data_cadastro, $data_aniversario, $cep, $bairro, $rua, $numero, $cidade,$id)
    {
        $sql = $this->db->prepare("UPDATE cliente SET tipo_pessoa = :tipo_pessoa, nome = :nome, cpfCnpj = :cpf, rgIe = :rg, telefone = :telefone,
     email = :email, data_cadastro = :data_cadastro, data_aniversario = :data_aniversario, cep = :cep, bairro = :bairro, rua = :rua, 
     numero = :numero, id_cidade = :cidade WHERE id = :id");
        $sql->bindValue(":tipo_pessoa", $tipo_pessoa);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":cpf", $cpf);
        $sql->bindValue(":rg", $rg);
        $sql->bindValue(":telefone", $telefone);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":data_cadastro", $data_cadastro);
        $sql->bindValue(":data_aniversario", $data_aniversario);
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":bairro", $bairro);
        $sql->bindValue(":rua", $rua);
        $sql->bindValue(":numero", $numero);
        $sql->bindValue(":cidade", $cidade);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function cliente_deletar($id)
    {
        $sql = $this->db->prepare("DELETE FROM cliente WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

}

?>