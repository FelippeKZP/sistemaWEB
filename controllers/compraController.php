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

        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }

        $data['compra_list'] = $c->getList($s);

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
            $quant = $_POST['quant'];


            $c->compra_add($id_fornecedor, $numero_nota, $quant, $u->getId());
        }

        $this->loadTemplate('compra/compra_add', $data);
    }

}
?>

