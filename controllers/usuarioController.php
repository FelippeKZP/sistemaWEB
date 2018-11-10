<?php

class usuarioController extends controller {

    public function __construct() {
        parent::__construct();

        $u = new Usuario();
        if ($u->isLogged() == false) {
            header("Location:" . BASE_URL . 'login');
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

        if($u->hasPermission('usuário')){

            $data['adicionar'] = $u->hasPermission('adicionar usuário');
            $data['editar'] = $u->hasPermission('editar usuário');
            $data['excluir'] = $u->hasPermission('excluir usuário');

            $s = '';

            if (!empty($s)) {
                $s = $_GET['searchs'];
            }

            $data['status'] = array(
                '0' => 'Inativo',
                '1' => 'Ativo');

            $data['filtros'] =  $_GET;

            $limit = 10;

            $data['limit'] = 1;

            $total = $u->getTotal($s);

            $data['total'] = $u->getTotal($s);

            $data['paginas'] = ceil($total / $limit);

            $data['paginaAtual'] = 1;
            if (!empty($_GET['p'])) {
                $data['paginaAtual'] = intval($_GET['p']);
            }

            $offset = ($data['paginaAtual'] * $limit) - $limit;

            $data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

            $data['max'] = 2;


            $data['usuario_list'] = $u->getList($s,$offset,$limit);

            $this->loadTemplate('usuario/usuario', $data);

        }else{
            header("Location:".BASE_URL);
            exit;
        }
    }

    public function usuario_add() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
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

        $p = new GrupoPermissao();

        if($u->hasPermission('usuário')){

            if (isset($_POST['nome']) && !empty($_POST['nome'])) {
                $nome = addslashes($_POST['nome']);
                $email = addslashes($_POST['email']);
                $senha = addslashes($_POST['senha']);
                $id_grupo_permissao = addslashes($_POST['id_grupo_permissao']);
                $status = addslashes($_POST['status']);

                if (isset($_FILES['fotos'])) {
                    $fotos = $_FILES['fotos'];
                } else {
                    $fotos = array();
                }

                try{
                    $u->usuario_add($nome, $email, $senha, $id_grupo_permissao,$status, $fotos);
                    $data['msg_sucesso'] = "Usuário Salvo Com Sucesso.";
                } catch(Exception $ex){
                    $data['msg_erro'] = "Já Existe Este Usuário Com Esse Email.";
                }

            }

            $data['grupo_permissao_list'] = $p->getGrupoPermissao();

            $this->loadTemplate('usuario/usuario_add', $data);

        }else{
            header("Location:".BASE_URL);
            exit;
        }
    }

    public function usuario_editar($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
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

        if($u->hasPermission('usuário')){

            $p = new GrupoPermissao();

            if(isset($id) && !empty($id)){
                if($u->verificarId($id)){

                }else{
                    header("Location:".BASE_URL.'usuario' );
                }
            }else{
                header("Location:".BASE_URL.'usuario' );
            }


            if (isset($_POST['nome']) && !empty($_POST['nome'])) {
                $nome = addslashes($_POST['nome']);
                $email = addslashes($_POST['email']);
            // $senha = addslashes($_POST['senha']);
                $id_grupo_permissao = addslashes($_POST['id_grupo_permissao']);
                $status = addslashes($_POST['status']);

                if (isset($_FILES['fotos'])) {
                    $fotos = $_FILES['fotos'];
                } else {
                    $fotos = array();
                }

                try {
                    $u->usuario_editar($nome, $email, $id_grupo_permissao,$status, $fotos, $id);
                    $data['msg_sucesso'] = "Sucesso ao Editar o Usuário.";
                } catch (Exception $ex) {
                    $data['msg_erro'] = "Ocorreu um Erro ao Editar o Usuário";
                }
            }

            $data['usuario_editar_list'] = $u->getInfo($id);
            $data['grupo_permissao_list'] = $p->getGrupoPermissao();

            $this->loadTemplate('usuario/usuario_editar', $data);

        }else{
            header("Location:".BASE_URL);
            exit;
        }
    }

    public function usuario_deletar($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
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

        if($u->hasPermission('usuário')){

            $data['status'] = array(
                '0' => 'Inativo',
                '1' => 'Ativo');


            if(isset($id) && !empty($id)){
                if($u->verificarId($id)){

                }else{
                    header("Location:".BASE_URL.'usuario' );
                }
            }else{
                header("Location:".BASE_URL.'usuario' );
            }


            try {
                $u->usuario_deletar($id);
                $data['msg_sucesso'] = "Sucesso ao Excluir o Usuário";
            } catch (Exception $e) {
                $data['msg_erro'] = "Este Usuário Já Esta Associado";
            }

            $s = '';
            if (!empty($s)) {
                $s = $_GET['searchs'];
            }

            $data['filtros'] =  $_GET;

            $limit = 10;

            $data['limit'] = 1;

            $total = $u->getTotal($s);

            $data['total'] = $u->getTotal($s);

            $data['paginas'] = ceil($total / $limit);

            $data['paginaAtual'] = 1;
            if (!empty($_GET['p'])) {
                $data['paginaAtual'] = intval($_GET['p']);
            }

            $offset = ($data['paginaAtual'] * $limit) - $limit;

            $data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

            $data['max'] = 2;


            $data['usuario_list'] = $u->getList($s,$offset,$limit);

            $this->loadTemplate('usuario/usuario', $data);

        }else{
            header("Location:");
            exit;
        }
    }

    public function excluir_imagem($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
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

        if($u->hasPermission('usuário')){

            if (isset($id_usuario)) {
                header("Location:" . BASE_URL . 'usuario/usuario_editar/' . $id_usuario);
            } else {
                header("Location:" . BASE_URL . 'usuario');
            }

            $id_usuario = $u->excluir_imagem($id);

        }else{
            header("Location:".BASE_URL);
            exit;
        }
    }

}
?>

