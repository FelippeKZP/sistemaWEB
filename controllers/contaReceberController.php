<?php

class contaReceberController extends controller {

    public function __construct() {
        parent::__construct();
        $u = new Usuario();
        if ($u->isLogged() == false) {
            header("Location:" . BASE_URL . "login");
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

        $c = new ContaReceber();

        $data['status'] = array(
            '0' => 'Pendente',
            '1' => 'Pago'
        );

        $s = '';

        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }

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


        $data['conta_list'] = $c->getList($s, $offset, $limit);


        $this->loadTemplate('contaReceber/conta_receber', $data);
    }

    public function receber($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $c = new ContaReceber();


        $data['status'] = array(
            '0' => 'Pendente',
            '1' => 'Pago'
        );

        if (isset($_POST['dinheiro']) && !empty($_POST['dinheiro'])) {

            $dinheiro = addslashes($_POST['dinheiro']);
            $troco = addslashes($_POST['troco']);

            $dinheiro = str_replace(',', '.', $dinheiro);
            $troco = str_replace(',', '.', $troco);

            try {

                $c->receber($dinheiro, $troco, $u->getId(), $id);
                $data['msg_sucesso'] = "Conta Recebida Com Sucesso.";
            } catch (Exception $e) {
                $data['msg_erro'] = "Erro Ao Receber Esta Conta.";
            }
        }

        $data['info'] = $c->getInfo($id);

        $this->loadTemplate('contaReceber/receber', $data);
    }

}
?>

