<?php

class vendaController extends controller {

    public function __construct() {
        parent::__construct();
        $u = new Usuario();
        if ($u->isLogged() == false) {
            header("Location:" . BASE_URL . 'login');
            exit;
        }
    }

    public function index() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $v = new Venda();

        $s = '';

        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }
        
         $limit = 10;

        $data['limit'] = 1;

        $total = $v->getTotal($s);

        $data['total'] = $v->getTotal($s);

        $data['paginas'] = ceil($total / $limit);

        $data['paginaAtual'] = 1;
        if (!empty($_GET['p'])) {
            $data['paginaAtual'] = intval($_GET['p']);
        }

        $offset = ($data['paginaAtual'] * $limit) - $limit;

        $data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

        $data['max'] = 2;


        $data['venda_list'] = $v->getList($s,$offset,$limit);

        $this->loadTemplate('venda/venda', $data);
    }

    public function venda_add() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $v = new Venda();

        if (isset($_POST['id_cliente']) && !empty($_POST['id_cliente'])) {
            $id_cliente = addslashes($_POST['id_cliente']);
            $quant = $_POST['quant'];

            try {
                $v->venda_add($id_cliente, $quant, $u->getId());
                $data['msg_sucesso'] = "Sucesso em Salvar a Venda.";
            } catch (Exception $ex) {
                $data['msg_erro'] = "Ocorreu um Erro ao Salvar a Venda.";
            }
        }

        $this->loadTemplate('venda/venda_add', $data);
    }

    public function venda_vizualizar($id){
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());
        
        $v = new Venda();
        
        $data['info'] = $v->venda_vizualizar($id);
        
        $this->loadTemplate('venda/venda_vizualizar', $data);
    }
    
    public function venda_cancelar($id){
        $data = array ();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] =  $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());
        
        $v = new Venda();
        
        try{
            $v->venda_cancelar($id);
            $data['msg_sucesso'] = "Esta Venda Foi Cancelada, Junto Com Conta A Receber.";
        } catch (Exception $ex) {
            $data['msg_erro'] = "Ocorreu Um Erro Ao Cancelar A Venda";
        }
        
         $s = '';

        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }
        
         $limit = 10;

        $data['limit'] = 1;

        $total = $v->getTotal($s);

        $data['total'] = $v->getTotal($s);

        $data['paginas'] = ceil($total / $limit);

        $data['paginaAtual'] = 1;
        if (!empty($_GET['p'])) {
            $data['paginaAtual'] = intval($_GET['p']);
        }

        $offset = ($data['paginaAtual'] * $limit) - $limit;

        $data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

        $data['max'] = 2;


        $data['venda_list'] = $v->getList($s,$offset,$limit);
        
        $this->loadTemplate('venda/venda', $data);
    }
}

?>