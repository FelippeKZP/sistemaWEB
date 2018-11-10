<?php

class grupoPermissaoController extends controller {

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
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());
        $data['balanço'] = $u->hasPermission('balanço');
        $data['backup'] = $u->hasPermission('backup');
        $data['cliente'] = $u->hasPermission('cliente');
        $data['fornecedor'] = $u->hasPermission('fornecedor');
        $data['função de funcionário'] = $u->hasPermission('função de funcionário');
        $data['funcionário'] = $u->hasPermission('funcionário');
        $data['grupo de permissão'] = $u->hasPermission('grupo de permissão');
        $data['grupo de produto'] = $u->hasPermission('grupo de produto');
        $data['lote de produto'] = $u->hasPermission('lote de produto');
        $data['produto'] = $u->hasPermission('produto');
        $data['usuário'] = $u->hasPermission('usuário');
        $data['contas a pagar'] = $u->hasPermission('contas a pagar');
        $data['contas a receber'] = $u->hasPermission('contas a receber');
        $data['estoque'] = $u->hasPermission('estoque');
        $data['compra'] = $u->hasPermission('compra');
        $data['venda'] = $u->hasPermission('venda');
        $data['perda'] = $u->hasPermission('perda');
        $data['relatório'] = $u->hasPermission('relatório');

        if($u->hasPermission('grupo de permissão')){

            $p = new GrupoPermissao();

            $s = '';

            if (!empty($_GET['searchs'])) {
                $s = $_GET['searchs'];
            }

            $data['filtros'] =  $_GET;

            $limit = 10;

            $data['limit'] = 1;

            $total = $p->getTotal($s);

            $data['total'] = $p->getTotal($s);

            $data['paginas'] = ceil($total / $limit);

            $data['paginaAtual'] = 1;
            if (!empty($_GET['p'])) {
                $data['paginaAtual'] = intval($_GET['p']);
            }

            $offset = ($data['paginaAtual'] * $limit) - $limit;

            $data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

            $data['max'] = 2;

            $data['grupo_permissao_list'] = $p->getList($s, $offset, $limit);

            $this->loadTemplate('grupoPermissao/grupo_permissao', $data);

        }else{
            header("Location:".BASE_URL);
            exit;
        }

    }

    public function grupo_permissao_add() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());
        $data['balanço'] = $u->hasPermission('balanço');
        $data['backup'] = $u->hasPermission('backup');
        $data['cliente'] = $u->hasPermission('cliente');
        $data['fornecedor'] = $u->hasPermission('fornecedor');
        $data['função de funcionário'] = $u->hasPermission('função de funcionário');
        $data['funcionário'] = $u->hasPermission('funcionário');
        $data['grupo de permissão'] = $u->hasPermission('grupo de permissão');
        $data['grupo de produto'] = $u->hasPermission('grupo de produto');
        $data['lote de produto'] = $u->hasPermission('lote de produto');
        $data['produto'] = $u->hasPermission('produto');
        $data['usuário'] = $u->hasPermission('usuário');
        $data['contas a pagar'] = $u->hasPermission('contas a pagar');
        $data['contas a receber'] = $u->hasPermission('contas a receber');
        $data['estoque'] = $u->hasPermission('estoque');
        $data['compra'] = $u->hasPermission('compra');
        $data['venda'] = $u->hasPermission('venda');
        $data['perda'] = $u->hasPermission('perda');
        $data['relatório'] = $u->hasPermission('relatório');

        if($u->hasPermission('grupo de permissão')){

            $p = new grupoPermissao();

            $permissao = new Permissao();

            if (isset($_POST['nome']) && !empty($_POST['nome'])) {
                $nome = addslashes($_POST['nome']);
                $id_permissao = $_POST['permissao'];

                try{
                    $p->grupo_permissao_add($nome, $id_permissao);
                    $data['msg_sucesso'] = "Grupo de Permissão Salvo Com Sucesso.";
                }catch(Exception $e){
                    $data['msg_erro'] = "Já Existe Este Grupo De Permissão.";
                }

            }
            $data['permissao_lista'] = $permissao->getInfo();
            $this->loadTemplate('grupoPermissao/grupo_permissao_add', $data);

        }else{
            header("Location:".BASE_URL);
            exit;
        }
    }

    public function grupo_permissao_editar($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());
        $data['balanço'] = $u->hasPermission('balanço');
        $data['backup'] = $u->hasPermission('backup');
        $data['cliente'] = $u->hasPermission('cliente');
        $data['fornecedor'] = $u->hasPermission('fornecedor');
        $data['função de funcionário'] = $u->hasPermission('função de funcionário');
        $data['funcionário'] = $u->hasPermission('funcionário');
        $data['grupo de permissão'] = $u->hasPermission('grupo de permissão');
        $data['grupo de produto'] = $u->hasPermission('grupo de produto');
        $data['lote de produto'] = $u->hasPermission('lote de produto');
        $data['produto'] = $u->hasPermission('produto');
        $data['usuário'] = $u->hasPermission('usuário');
        $data['contas a pagar'] = $u->hasPermission('contas a pagar');
        $data['contas a receber'] = $u->hasPermission('contas a receber');
        $data['estoque'] = $u->hasPermission('estoque');
        $data['compra'] = $u->hasPermission('compra');
        $data['venda'] = $u->hasPermission('venda');
        $data['perda'] = $u->hasPermission('perda');
        $data['relatório'] = $u->hasPermission('relatório');

        if($u->hasPermission('grupo de permissão')){

            $p = new GrupoPermissao();

            $permissao = new Permissao();


            if(isset($id) && !empty($id)){
                if($p->verificarId($id)){

                }else{
                    header("Location:".BASE_URL.'grupoPermissao' );
                }
            }else{
                header("Location:".BASE_URL.'grupoPermissao' );
            }


            if (isset($_POST['nome']) && !empty($_POST['nome'])) {
                $nome = addslashes($_POST['nome']);
                $id_permissao = $_POST['permissao'];

                try {
                    $p->grupo_permissao_editar($nome, $id_permissao, $id);
                    $data['msg_sucesso'] = "Sucesso ao Editar Grupo de Permissão";
                } catch (Exception $ex) {
                    $data['msg_erro'] = "Ocorreu um Erro ao Editar Grupo de Permissão";
                }
            }

            $data['grupo_permissao_editar_list'] = $p->getInfo($id);
            $data['permissao_lista'] = $permissao->getInfo();

            $this->loadTemplate('grupoPermissao/grupo_permissao_editar', $data);

        }else{
            header("Location:".BASE_URL);
            exit;
        }

    }

    public function grupo_permissao_deletar($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_foto'] = $u->getFoto();
        $data['usuario_nome'] = $u->getNome();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());
        $data['balanço'] = $u->hasPermission('balanço');
        $data['backup'] = $u->hasPermission('backup');
        $data['cliente'] = $u->hasPermission('cliente');
        $data['fornecedor'] = $u->hasPermission('fornecedor');
        $data['função de funcionário'] = $u->hasPermission('função de funcionário');
        $data['funcionário'] = $u->hasPermission('funcionário');
        $data['grupo de permissão'] = $u->hasPermission('grupo de permissão');
        $data['grupo de produto'] = $u->hasPermission('grupo de produto');
        $data['lote de produto'] = $u->hasPermission('lote de produto');
        $data['produto'] = $u->hasPermission('produto');
        $data['usuário'] = $u->hasPermission('usuário');
        $data['contas a pagar'] = $u->hasPermission('contas a pagar');
        $data['contas a receber'] = $u->hasPermission('contas a receber');
        $data['estoque'] = $u->hasPermission('estoque');
        $data['compra'] = $u->hasPermission('compra');
        $data['venda'] = $u->hasPermission('venda');
        $data['perda'] = $u->hasPermission('perda');
        $data['relatório'] = $u->hasPermission('relatório');

        if($u->hasPermission('grupo de permissão')){

            $p = new GrupoPermissao();

            if(isset($id) && !empty($id)){
                if($p->verificarId($id)){

                }else{
                    header("Location:".BASE_URL.'grupoPermissao' );
                }
            }else{
                header("Location:".BASE_URL.'grupoPermissao' );
            }

            try {
                $p->grupo_permissao_deletar($id);
                $data['msg_sucesso'] = "Sucesso ao Excluir Grupo de Permissão";
            } catch (Exception $e) {
                $data['msg_erro'] = "Este Grupo de Permissão Já Esta Associado";
            }

            $s = '';

            if (!empty($_GET['searchs'])) {
                $s = $_GET['searchs'];
            }

            $limit = 10;

            $data['filtros'] =  $_GET;

            $total = $p->getTotal($s);

            $data['total'] = $p->getTotal($s);

            $data['paginas'] = ceil($total / $limit);

            $data['paginaAtual'] = 1;
            if (!empty($_GET['p'])) {
                $data['paginaAtual'] = intval($_GET['p']);
            }

            $offset = ($data['paginaAtual'] * $limit) - $limit;

            $data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

            $data['max'] = 2;

            $data['grupo_permissao_list'] = $p->getList($s, $offset, $limit);

            $this->loadTemplate('grupoPermissao/grupo_permissao', $data);

        }else{
            header("Location:".BASE_URL);
            exit;
        }

    }

}

?>