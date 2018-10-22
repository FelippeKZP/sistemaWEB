<?php

class compraController extends controller {

    public function __construct() {
        parent::__construct();
        $u = new Usuario();
        if ($u->isLogged() == FALSE) {
            header("Location:" . BASE_URL . 'login');
            exit;
        }
    }

    public function index() {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();
        $n = new Notificacao();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $c = new Compra();

        $s = '';

        $data['filtros'] =  $_GET;

        $limit = 10;

        $data['limit'] = 10;

        $total = $c->getTotal($s);

        $data['total'] = $c->getTotal($s);

        $data['paginas'] = ceil($total / $limit);

        $data['paginaAtual'] = 1;
        if (!empty($_GET['p'])) {
            $data['paginaAtual'] = intval($_GET['p']);
        }

        $offset = ($data['paginaAtual'] * $limit) - $limit;

        $data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

        $data['max'] = 2;

        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }

        $data['compra_list'] = $c->getList($s, $offset, $limit);

        $this->loadTemplate('compra/compra', $data);
    }

    public function compra_add() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $c = new Compra();

        if (isset($_POST['id_fornecedor']) && !empty($_POST['id_fornecedor'])) {
            $id_fornecedor = addslashes($_POST['id_fornecedor']);
            $numero_nota = addslashes($_POST['numero_nota']);
            $data_vencimento  = explode('/', addslashes($_POST['data_vencimento']));
            $quant = $_POST['quant'];

            $data_vencimento = $data_vencimento[2].'-'.$data_vencimento[1].'-'.$data_vencimento[0];


            $c->compra_add($id_fornecedor, $numero_nota, $data_vencimento, $quant, $u->getId());
        }

        $this->loadTemplate('compra/compra_add', $data);
    }

    public function compra_vizualizar($id){
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $c = new Compra();

        if(isset($id) && !empty($id)){
            if($c->verificarId($id)){

            }else{
                header("Location:".BASE_URL.'compra' );
            }
        }else{
            header("Location:".BASE_URL.'compra' );
        }

        $data['info'] = $c->venda_vizualizar($id);

        $this->loadTemplate('compra/compra_vizualizar', $data);
    }

}
?>

