<?php

class Permissao extends model
{

    public function getInfo()
    {

        $array = array();

        $sql = $this->db->prepare("SELECT * FROM permissao ORDER BY nome ASC");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;

    }

}

?>
