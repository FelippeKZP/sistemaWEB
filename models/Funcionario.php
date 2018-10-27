<?php

class Funcionario extends model {

    public function getList($s,$offset,$limit) {
        $array = array();

        if (!empty($s)) {

            $sql = $this->db->prepare("SELECT funcionario.id,funcionario.nome,funcionario.cpf,funcao_funcionario.nome as funcao,funcionario.data_admissao,funcionario.salario
                FROM funcionario INNER JOIN funcao_funcionario on funcao_funcionario.id = funcionario.id_funcao 
                WHERE funcionario.nome LIKE :nome OR funcionario.cpf LIKE :nome LIMIT $offset, $limit");
            $sql->bindValue(":nome", '%'. $s.'%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT funcionario.id,funcionario.nome,funcionario.cpf,funcao_funcionario.nome as funcao,funcionario.data_admissao,funcionario.salario
               FROM funcionario INNER JOIN funcao_funcionario on funcao_funcionario.id = funcionario.id_funcao LIMIT $offset, $limit");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTotal($s){
        if(!empty($s)){
            $sql = $this->db->prepare("SELECT COUNT(id) as c FROM funcionario WHERE nome LIKE :nome");
            $sql->bindValue(":nome", '%'.$s.'%');
            $sql->execute();
        }else{
            $sql = $this->db->prepare("SELECT COUNT(id) as c FROM funcionario");
            $sql->execute();
        }

        $sql = $sql->fetch();
        return $sql['c'];
    }

    public function getInfo($id) {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM funcionario WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }
    
    public function getCombo(){
        $array = array();
        
        $sql = $this->db->prepare("SELECT * FROM funcionario ORDER BY nome ASC");
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        
        return $array;
    }

    public function funcionario_add($nome, $cpf, $rg, $telefone, $data_admissao, $data_aniversario, $id_funcao, $carteira_trabalho, $salario, $cep, $bairro, $rua, $numero, $estado, $cidade, $pais) {


     $sql = $this->db->prepare("INSERT INTO funcionario(nome,cpf,rg,telefone,data_admissao,data_aniversario,id_funcao,carteira,salario,cep,bairro,rua,numero,estado,cidade,pais)
       VALUES(:nome,:cpf,:rg,:telefone,:data_admissao,:data_aniversario,:id_funcao,:carteira_trabalho,:salario,:cep,:bairro,:rua,:numero,:estado,:cidade,:pais)");
     $sql->bindValue(":nome", $nome);
     $sql->bindValue(":cpf", $cpf);
     $sql->bindValue(":rg", $rg);
     $sql->bindValue(":telefone", $telefone);
     $sql->bindValue(":data_admissao", $data_admissao);
     $sql->bindValue(":data_aniversario", $data_aniversario);
     $sql->bindValue(":id_funcao", $id_funcao);
     $sql->bindValue(":carteira_trabalho", $carteira_trabalho);
     $sql->bindValue(":salario", $salario);
     $sql->bindValue(":cep", $cep);
     $sql->bindValue(":bairro", $bairro);
     $sql->bindValue(":rua", $rua);
     $sql->bindValue(":numero", $numero);
     $sql->bindValue(":estado", $estado);
     $sql->bindValue(":cidade", $cidade);
     $sql->bindValue(":pais", $pais);
     $sql->execute();


 }

 public function funcionario_editar($nome, $cpf, $rg, $telefone, $data_admissao, $data_aniversario, $id_funcao, $carteira_trabalho, $salario, $cep, $bairro, $rua, $numero, $estado, $cidade, $pais, $id) {
    $sql = $this->db->prepare("UPDATE funcionario SET nome = :nome, cpf = :cpf,rg = :rg,telefone=:telefone,data_admissao = :data_admissao,
       data_aniversario = :data_aniversario,id_funcao = :id_funcao,carteira = :carteira,salario = :salario,cep = :cep, bairro = :bairro,
       rua = :rua, numero = :numero,estado = :estado,cidade = :cidade,pais = :pais WHERE id = :id");
    $sql->bindValue(":nome", $nome);
    $sql->bindValue(":cpf", $cpf);
    $sql->bindValue(":rg", $rg);
    $sql->bindValue(":telefone", $telefone);
    $sql->bindValue(":data_admissao", $data_admissao);
    $sql->bindValue(":data_aniversario", $data_aniversario);
    $sql->bindValue(":id_funcao", $id_funcao);
    $sql->bindValue(":carteira", $carteira_trabalho);
    $sql->bindValue(":salario", $salario);
    $sql->bindValue(":cep", $cep);
    $sql->bindValue(":bairro", $bairro);
    $sql->bindValue(":rua", $rua);
    $sql->bindValue(":numero", $numero);
    $sql->bindValue(":estado", $estado);
    $sql->bindValue(":cidade", $cidade);
    $sql->bindValue(":pais", $pais);
    $sql->bindValue(":id", $id);
    $sql->execute();
}

public function funcionario_deletar($id) {
    $sql = $this->db->prepare("DELETE FROM funcionario WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();
}


public function verificarId($id){

    $sql = $this->db->prepare("SELECT id FROM funcionario WHERE id = :id");
    $sql->bindValue(":id",$id);
    $sql->execute();

    if($sql->rowCount() > 0){
        return true;
    }else{
        return false;
    }
}


public function verificarCPF($p) {
    $array = array();

    $sql = $this->db->prepare("SELECT COUNT(id) as total FROM funcionario WHERE cpf = :p");
    $sql->bindValue(":p", $p);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $array = $sql->fetchAll();
    }

    return $array;
}

public function verificarRG($p) {
    $array = array();

    $sql = $this->db->prepare("SELECT COUNT(id) as total FROM funcionario WHERE rg = :p");
    $sql->bindValue(":p", $p);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $array = $sql->fetchAll();
    }

    return $array;
}

public function verificarCarteira($p){
    $array = array();
    
    $sql = $this->db->prepare("SELECT COUNT(id) as total FROM funcionario WHERE carteira = :p");
    $sql->bindValue(":p", $p);
    $sql->execute();
    
    if($sql->rowCount() > 0){
        $array = $sql->fetchAll();
    }
    
    return $array;
}

public function getRelatorio($nome = null, $periodo1 = null, $periodo2 = null) {
    $array = array();

    if (!empty($nome && $periodo1 && $periodo2)) {
        $sql = $this->db->prepare("SELECT funcionario.id,funcionario.nome,funcionario.cpf,funcao_funcionario.nome as funcao,funcionario.data_admissao,funcionario.salario
            FROM funcionario
            INNER JOIN funcao_funcionario on funcao_funcionario.id = funcionario.id_funcao
            WHERE funcionario.nome LIKE :nome AND funcionario.data_admissao BETWEEN :periodo1 AND :periodo2 ");
        $sql->bindValue(":nome", '%' . $nome . '%');
        $sql->bindValue(":periodo1", $periodo1);
        $sql->bindValue(":periodo2", $periodo2);
        $sql->execute();
    } elseif (!empty($nome)) {
        $sql = $this->db->prepare("SELECT funcionario.id,funcionario.nome,funcionario.cpf,funcao_funcionario.nome as funcao,funcionario.data_admissao,funcionario.salario
            FROM funcionario
            INNER JOIN funcao_funcionario on funcao_funcionario.id = funcionario.id_funcao
            WHERE funcionario.nome LIKE :nome");
        $sql->bindValue(":nome", '%' . $nome . '%');
        $sql->execute();
    } elseif (!empty($periodo1 && $periodo2)) {
        $sql = $this->db->prepare("SELECT funcionario.id,funcionario.nome,funcionario.cpf,funcao_funcionario.nome as funcao,funcionario.data_admissao,funcionario.salario
            FROM funcionario
            INNER JOIN funcao_funcionario on funcao_funcionario.id = funcionario.id_funcao
            WHERE funcionario.data_admissao BETWEEN :periodo1 AND :periodo2");
        $sql->bindValue(":periodo1", $periodo1);
        $sql->bindValue(":periodo2", $periodo2);
        $sql->execute();
    } else {
        $sql = $this->db->prepare("SELECT funcionario.id,funcionario.nome,funcionario.cpf,funcao_funcionario.nome as funcao,funcionario.data_admissao,funcionario.salario
            FROM funcionario
            INNER JOIN funcao_funcionario on funcao_funcionario.id = funcionario.id_funcao");
        $sql->execute();
    }

    if ($sql->rowCount() > 0) {
        $array = $sql->fetchAll();
    }

    return $array;
}


}

?>