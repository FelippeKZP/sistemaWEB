<?php

class grupoProdutoController extends controller {

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
        $g = new GrupoProduto();

        $s = '';

        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }

        $data['filtros'] =  $_GET;

        $limit = 10;

        $data['limit'] = 1;

        $total = $g->getTotal($s);

        $data['total'] = $g->getTotal($s);

        $data['paginas'] = ceil($total / $limit);

        $data['paginaAtual'] = 1;
        if (!empty($_GET['p'])) {
            $data['paginaAtual'] = intval($_GET['p']);
        }

        $offset = ($data['paginaAtual'] * $limit) - $limit;

        $data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

        $data['max'] = 2;

        $data['grupo_produto_list'] = $g->getList($s, $offset, $limit);


        $this->loadTemplate('grupoProduto/grupo_produto', $data);
    }

    public function grupo_produto_add() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $g = new GrupoProduto();

        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);

            try{
                $g->grupo_produto_add($nome);
                $data['msg_sucesso'] = "Grupo de Produto Salvo Com Sucesso.";
            } catch(Exception $e){
                $data['msg_erro'] = "Já Existe Este Grupo de Produto.";
            }
        }
        

        $this->loadTemplate('grupoProduto/grupo_produto_add', $data);
    }

    public function grupo_produto_editar($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $g = new GrupoProduto();

        if(isset($id) && !empty($id)){
            if($g->verificarId($id)){

            }else{
                header("Location:".BASE_URL.'grupoProduto' );
            }
        }else{
            header("Location:".BASE_URL.'grupoProduto' );
        }

        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);

            try {
                $g->grupo_produto_editar($nome, $id);
                $data['msg_sucesso'] = "Sucesso ao Editar Grupo de Produto.";
            } catch (Exception $ex) {
                $data['msg_erro'] = "Ocorreu um Erro ao Editar Grupo de Produto";
            }
        }

        $data['grupo_produto_editar_list'] = $g->getInfo($id);

        $this->loadTemplate('grupoProduto/grupo_produto_editar', $data);
    }

    public function grupo_produto_deletar($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $g = new GrupoProduto();

        
        if(isset($id) && !empty($id)){
            if($g->verificarId($id)){

            }else{
                header("Location:".BASE_URL.'grupoProduto' );
            }
        }else{
            header("Location:".BASE_URL.'grupoProduto' );
        }

        try {
            $g->grupo_produto_deletar($id);
            $data['msg_sucesso'] = "Sucesso ao Excluir Grupo de Produto.";
        } catch (Exception $e) {
            $data['msg_erro'] = "Este Grupo de Produto Já Esta Associado";
        }

        $s = '';
        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }

        $data['filtros'] =  $_GET;

        $limit = 10;

        $data['limit'] = 1;

        $total = $g->getTotal($s);

        $data['total'] = $g->getTotal($s);

        $data['paginas'] = ceil($total / $limit);

        $data['paginaAtual'] = 1;
        if (!empty($_GET['p'])) {
            $data['paginaAtual'] = intval($_GET['p']);
        }

        $offset = ($data['paginaAtual'] * $limit) - $limit;

        $data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

        $data['max'] = 2;

        $data['grupo_produto_list'] = $g->getList($s, $offset, $limit);


        $this->loadTemplate('grupoProduto/grupo_produto', $data);
    }

}
?>

