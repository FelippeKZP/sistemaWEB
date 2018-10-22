<?php

class ContaReceber extends model {

  public function getList($s, $offset, $limit) {

    $array = array();

    if (!empty($s)) {
      $sql = $this->db->prepare("SELECT contas_receber.id, cliente.nome,cliente.cpfCnpj,venda.tipo_pag,contas_receber.parcela,
       contas_receber.valor, contas_receber.data_vencimento,contas_receber.data_recebimento,contas_receber.status
       FROM contas_receber
       INNER JOIN venda on venda.id = contas_receber.id_venda
       INNER JOIN cliente on cliente.id = venda.id_cliente
       WHERE cliente.nome LIKE :nome OR cliente.cpfCnpj LIKE :nome
       ORDER BY contas_receber.id ASC
       LIMIT $offset,$limit");
      $sql->bindValue(":nome", '%' . $s . '%');
      $sql->execute();
    } else {
      $sql = $this->db->prepare("SELECT contas_receber.id, cliente.nome,cliente.cpfCnpj, venda.tipo_pag,contas_receber.parcela,
       contas_receber.valor,contas_receber.data_vencimento,contas_receber.data_recebimento,contas_receber.status
       FROM contas_receber
       INNER JOIN venda on venda.id = contas_receber.id_venda
       INNER JOIN cliente on cliente.id = venda.id_cliente
       ORDER BY contas_receber.id ASC
       LIMIT $offset,$limit");
      $sql->execute();
    }

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }

    return $array;
  }

  public function getTotal($s) {
    if (!empty($s)) {
      $sql = $this->db->prepare("SELECT COUNT(*)as c 
        FROM contas_receber
        INNER JOIN venda on venda.id = contas_receber.id_venda
        INNER JOIN cliente on cliente.id = venda.id_cliente
        WHERE cliente.nome LIKE :nome OR cliente.cpfCnpj LIKE :nome ");
      $sql->bindValue(":nome", '%' . $s . '%');
      $sql->execute();
    } else {
      $sql = $this->db->prepare("SELECT COUNT(*)as c FROM contas_receber");
      $sql->execute();
    }
    $sql = $sql->fetch();
    return $sql['c'];
  }

  public function getInfo($id) {

    $array = array();

    $sql = $this->db->prepare("SELECT cliente.nome,cliente.cpfCnpj,venda.data_venda,
     contas_receber.valor,contas_receber.data_vencimento,contas_receber.status,contas_receber.dinheiro,contas_receber.troco
     FROM contas_receber
     INNER JOIN venda on venda.id = contas_receber.id_venda
     INNER JOIN cliente on cliente.id = venda.id_cliente
     WHERE contas_receber.id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $array = $sql->fetch();
    }

    return $array;
  }

  public function verificarId($id){

    $sql = $this->db->prepare("SELECT id FROM contas_receber WHERE id = :id");
    $sql->bindValue(":id",$id);
    $sql->execute();

    if($sql->rowCount() > 0){
      return true;
    }else{
      return false;
    }
  }

  public function receber($dinheiro,$troco,$id_usuario,$id){
    $sql = $this->db->prepare("UPDATE contas_receber SET dinheiro = :dinheiro,troco = :troco,data_recebimento = NOW(), id_usuario = :id_usuario, status = 1 WHERE id = :id");
    $sql->bindValue(":dinheiro", $dinheiro);
    $sql->bindValue(":troco", $troco);
    $sql->bindValue(":id_usuario", $id_usuario);
    $sql->bindValue(":id", $id);
    $sql->execute();
  }

}

?>