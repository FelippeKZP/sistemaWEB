<?php

class balancoMesController extends controller{
    
    public function __construct() {
        parent::__construct();
        $u = new Usuario();
        if($u->isLogged() == false){
            header("Location:".BASE_URL.'login');
            exit;
        }
    }
    
    public function index(){
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());
        
        $this->loadTemplate('balancoMes/balanco_mes', $data);
    }
}

?>
