<?php

class loteProdutoController extends controller {

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

        $l = new LoteProduto();

        $s = '';
        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }

        $limit = 10;

        $data['limit'] = 1;

        $total = $l->getTotal($s);

        $data['total'] = $l->getTotal($s);

        $data['paginas'] = ceil($total / $limit);

        $data['paginaAtual'] = 1;
        if (!empty($_GET['p'])) {
            $data['paginaAtual'] = intval($_GET['p']);
        }

        $offset = ($data['paginaAtual'] * $limit) - $limit;

        $data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

        $data['max'] = 2;

        $data['lote_produto_list'] = $l->getList($s, $offset, $limit);


        $this->loadTemplate('loteProduto/lote_produto', $data);
    }

    public function lote_produto_add() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $l = new LoteProduto();

        if (isset($_POST['numero_lote']) && !empty($_POST['numero_lote'])) {
            $numero_lote = addslashes($_POST['numero_lote']);
            $id_produto = addslashes($_POST['id_produto']);
            $id_fornecedor = addslashes($_POST['id_fornecedor']);
            $quantidade = addslashes($_POST['quantidade']);
            $data_fabricacao = explode('/', addslashes($_POST['data_fabricacao']));
            $data_vencimento = explode('/', addslashes($_POST['data_vencimento']));

            $data_fabricacao = $data_fabricacao[2] . '-' . $data_fabricacao[1] . '-' . $data_fabricacao[0];
            $data_vencimento = $data_vencimento[2] . '-' . $data_vencimento[1] . '-' . $data_vencimento[0];

            if ($l->lote_produto_add($numero_lote, $id_produto, $id_fornecedor, $quantidade, $data_fabricacao, $data_vencimento, $u->getId())) {
                $data['msg_sucesso'] = "Lote de Produto Salvo Com Sucesso.";
            } else {
                $data['msg_erro'] = "J� Existe Este Lote de Produto.";
            }
        }

        $this->loadTemplate('loteProduto/lote_produto_add', $data);
    }

    public function lote_produto_editar($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $l = new LoteProduto();

        if (isset($_POST['numero_lote']) && !empty($_POST['numero_lote'])) {
            $numero_lote = addslashes($_POST['numero_lote']);
            $id_produto = addslashes($_POST['id_produto']);
            $id_fornecedor = addslashes($_POST['id_fornecedor']);
            $data_fabricacao = explode('/', addslashes($_POST['data_fabricacao']));
            $data_vencimento = explode('/', addslashes($_POST['data_vencimento']));

            $data_fabricacao = $data_fabricacao[2] . '-' . $data_fabricacao[1] . '-' . $data_fabricacao[0];
            $data_vencimento = $data_vencimento[2] . '-' . $data_vencimento[1] . '-' . $data_vencimento[0];

            try {
                $l->lote_produto_editar($numero_lote, $id_produto, $id_fornecedor, $data_fabricacao, $data_vencimento, $id);
                $data['msg_sucesso'] = "Sucesso ao Editar o Lote de Produto.";
            } catch (Exception $ex) {
                $data['msg_erro'] = "Ocorreu um Erro ao Editar o Lote de Produto";
            }
        }

        $data['lote_produto_editar_list'] = $l->getInfo($id);

        $this->loadTemplate('loteProduto/lote_produto_editar', $data);
    }

    public function lote_produto_deletar($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $l = new LoteProduto();

        try {
            $l->lote_produto_deletar($id);
            $data['msg_sucesso'] = "Sucesso ao Excluir o Lote de Produto.";
        } catch (Exception $e) {
            $data['msg_erro'] = "Este Lote de Produto J� Esta Associado.";
        }

        $s = '';
        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }

        $limit = 10;

        $data['limit'] = 1;

        $total = $l->getTotal($s);

        $data['total'] = $l->getTotal($s);

        $data['paginas'] = ceil($total / $limit);

        $data['paginaAtual'] = 1;
        if (!empty($_GET['p'])) {
            $data['paginaAtual'] = intval($_GET['p']);
        }

        $offset = ($data['paginaAtual'] * $limit) - $limit;

        $data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

        $data['max'] = 2;

        $data['lote_produto_list'] = $l->getList($s, $offset, $limit);


        $this->loadTemplate('loteProduto/lote_produto', $data);
    }

}

?>