<?php

class funcaoFuncionarioController extends controller {

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

        $f = new FuncaoFuncionario();

        $s = '';

        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }

        $data['filtros'] =  $_GET;

        $limit = 10;

        $data['limit'] = 10;

        $total = $f->getTotal($s);

        $data['paginas'] = ceil($total / $limit);

        $data['paginaAtual'] = 1;
        if(!empty($_GET['p'])){
            $data['paginaAtual'] = intval($_GET['p']);
        }

        $offset = ($data['paginaAtual'] * $limit) - $limit;

        $data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

        $data['max'] = 2;

        $data['funcao_list'] = $f->getList($s,$limit,$offset);

        $this->loadTemplate('funcaoFuncionario/funcao_funcionario', $data);
    }

    public function funcao_funcionario_add() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $f = new FuncaoFuncionario();

        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $descricao = addslashes($_POST['descricao']);


            try {
                $f->funcao_funcionario_add($nome, $descricao);

                $data['msg_sucesso'] = "Função de Funcionário Salvo Com Sucesso.";
            } catch (Exception $ex) {
                $data['msg_erro'] = "Já Existe Esta Função de Funcionário.";
            }
        }



        $this->loadTemplate('funcaoFuncionario/funcao_funcionario_add', $data);
    }

    public function funcao_funcionario_editar($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $f = new FuncaoFuncionario();

        if(isset($id) && !empty($id)){
            if($f->verificarId($id)){

            }else{
                header("Location:".BASE_URL.'funcaoFuncionario' );
            }
        }else{
            header("Location:".BASE_URL.'funcaoFuncionario' );
        }


        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $descricao = addslashes($_POST['descricao']);

            try {
                $f->funcao_funcionario_editar($nome, $descricao, $id);

                $data['msg_sucesso'] = "Sucesso Ao Editar Função de Funcionário.";
            } catch (Exception $ex) {
                $data['msg_erro'] = "Ocorreu Um Erro Ao Editar Função de Funcionário.";
            }
        }
        
        $data['funcao_list_edit'] =  $f->getInfo($id);


        $this->loadTemplate('funcaoFuncionario/funcao_funcionario_editar', $data);
    }

    public function funcao_funcionario_deletar($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $f = new FuncaoFuncionario();

        if(isset($id) && !empty($id)){
            if($c->verificarId($id)){

            }else{
                header("Location:".BASE_URL.'funcaoFuncionario' );
            }
        }else{
            header("Location:".BASE_URL.'funcaoFuncionario' );
        }

        try {
            $f->funcao_funcionario_deletar($id);

            $data['msg_sucesso'] = "Sucesso ao Excluir a Função de Funcionário.";
        } catch (Exception $ex) {
            $data['msg_erro'] = "Esta Função de Funcionário Já Esta Associado.";
        }

        $s = '';

        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }

        $data['filtros'] =  $_GET;

        $data['funcao_list'] = $f->getList($s);



        $this->loadTemplate('funcaoFuncionario/funcao_funcionario', $data);
    }

}

?>