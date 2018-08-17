<?php

class Compra extends model{
    
   public function getList($s =  null){
       $array = array();
       
       if(!empty($s)){
          $sql = $this->db->prepare("SELECT compra.id,compra.numero_nota,compra.data_compra,compra.total_compra,fornecedor.razao_social
                 FROM compra
                 INNER JOIN fornecedor on fornecedor.id = compra.id_fornecedor
                 WHERE fornecedor.razao_social LIKE :razao_social");
          $sql->bindValue(":razao_social",'%'.$s.'%');
          $sql->execute();
       }else{
           $sql = $this->db->prepare("SELECT compra.id,compra.numero_nota,compra.data_compra,compra.total_compra,fornecedor.razao_social
                  FROM compra
                  INNER JOIN fornecedor on fornecedor.id =  compra.id_fornecedor");
           $sql->execute();
       }
       
       if($sql->rowCount() > 0){
           $array = $sql->fetchAll();
       }
       
       return $array;
       
   }
    
}

?>