<?php

class Perda extends model{

	public function getList($s,$offset,$limit){
		$array = array();

		if(!empty($s)){
			$sql = $this->db->prepare("SELECT perda.id,lote_produto.numero_lote,produto.nome,perda.data_perda,perda.total
				FROM perda
				INNER JOIN  lote_produto on lote_produto.id = perda.id_lote_produto
				INNER JOIN  produto on produto.id = lote_produto.id_produto
				WHERE produto.nome LIKE :nome OR  lote_produto.numero_lote LIKE :nome LIMIT $offset,$limit");
			$sql->bindValue(":nome", '%'.$s.'%');
			$sql->execute();
		}else{
			$sql = $this->db->prepare("SELECT perda.id,lote_produto.numero_lote,produto.nome,perda.data_perda,perda.total
				FROM perda
				INNER JOIN lote_produto on lote_produto.id = perda.id_lote_produto
				INNER JOIN produto on produto.id = lote_produto.id_produto LIMIT $offset,$limit");
			$sql->execute();
		}

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getTotal($s){
		if(!empty($s)){
			$sql = $this->db->prepare("SELECT COUNT(perda.id) as c FROM perda
				INNER JOIN lote_produto on lote_produto.id = perda.id_lote_produto
				INNER JOIN produto on produto.id = lote_produto.id_produto
				WHERE produto.nome LIKE :nome OR lote_produto.numero_lote LIKE >nome");
			$sql->bindValue(":nome",'%'.$s.'%');
			$sql->execute();
		}else{
			$sql = $this->db->prepare("SELECT COUNT(id) as c FROM perda");
			$sql->execute();
		}
		$sql = $sql->fetch();
		return $sql['c'];

	}

	public function verificarId($id){
		$sql = $this->db->prepare("SELECT id FROM perda WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function getInfo($id){
		$array = array();

		$sql = $this->db->prepare("SELECT lote_produto.numero_lote,produto.nome,perda.data_perda,perda.quantidade,perda.motivo,perda.total
			FROM perda
			INNER JOIN lote_produto on lote_produto.id = perda.id_lote_produto
			INNER JOIN produto on produto.id = lote_produto.id_produto
			WHERE perda.id = :id");
		$sql->bindValue(":id",$id);
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}
		return $array;
	}

	public function perda_deletar($id){
		$sql = $this->db->prepare("SELECT id_lote_produto, quantidade FROM perda WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		$row = $sql->fetch();

		if($sql->rowCount() > 0){
			$id_lote_produto = $row['id_lote_produto'];
			$quantidade = $row['quantidade'];
		}

		$l = new LoteProduto();

		$l->aumentarEstoque($quantidade,$id_lote_produto);

		$sql = $this->db->prepare("DELETE FROM perda WHERE id = :id");
		$sql->bindValue(":id",$id);
		$sql->execute();
	}
	
}

?>