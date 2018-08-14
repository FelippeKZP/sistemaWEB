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

        $s = '';
        if (!empty($s)) {
            $s = $_GET['searchs'];
        }
        
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
    }

    public function usuario_add() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $p = new GrupoPermissao();

        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $id_grupo_permissao = addslashes($_POST['id_grupo_permissao']);

            if (isset($_FILES['fotos'])) {
                $fotos = $_FILES['fotos'];
            } else {
                $fotos = array();
            }

            if ($u->usuario_add($nome, $email, $senha, $id_grupo_permissao, $fotos)) {
                $data['msg_sucesso'] = "Usuário Salvo Com Sucesso.";
            } else {
                $data['msg_erro'] = "Já Existe Este Usuário Com Esse Email.";
            }
        }

        $data['grupo_permissao_list'] = $p->getGrupoPermissao();

        $this->loadTemplate('usuario/usuario_add', $data);
    }

    public function usuario_editar($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $p = new GrupoPermissao();

        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            // $senha = addslashes($_POST['senha']);
            $id_grupo_permissao = addslashes($_POST['id_grupo_permissao']);

            if (isset($_FILES['fotos'])) {
                $fotos = $_FILES['fotos'];
            } else {
                $fotos = array();
            }

            try {
                $u->usuario_editar($nome, $email, $id_grupo_permissao, $fotos, $id);
                $data['msg_sucesso'] = "Sucesso ao Editar o Usuário.";
            } catch (Exception $ex) {
                $data['msg_erro'] = "Ocorreu um Erro ao Editar o Usuário";
            }
        }

        $data['usuario_editar_list'] = $u->getInfo($id);
        $data['grupo_permissao_list'] = $p->getGrupoPermissao();

        $this->loadTemplate('usuario/usuario_editar', $data);
    }

    public function usuario_deletar($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

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
    }

    public function excluir_imagem($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        

        $id_usuario = $u->excluir_imagem($id);

        if (isset($id_usuario)) {
            header("Location:" . BASE_URL . 'usuario/usuario_editar/' . $id_usuario);
        } else {
            header("Location:" . BASE_URL . 'usuario');
        }
    }

}
?>

