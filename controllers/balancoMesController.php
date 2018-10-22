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
        
        $b = new BalancoMes();
        
        $data['atual_list'] = $b->getAtualList(date('Y-m-01'), date('Y-m-t'));
        $data['anterior_list'] = $b->getAnteriorList(date('Y-m-01', strtotime('-1 month')), date('Y-m-t', strtotime('-1 month')));

        
        $this->loadTemplate('balancoMes/balanco_mes', $data);
    }
}

?>
