<?php

class Permissao extends model{
    
    public function  getInfo(){
        
        $array  = array();
        
        $sql = $this->db->prepare("SELECT * FROM permissao");
        $sql->execute();
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        
        return $array;
        
    }
    
}

?>
