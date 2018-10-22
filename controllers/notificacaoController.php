<?php

class notificacaoController extends controller {

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

        $n = new Notificacao();

        $data['notificacao_list'] = $n->getList($u->getId());


        $data['status'] = array(
            '0' => 'Não Lido',
            '1' => 'Lido',
        );



        $this->loadTemplate('notificacao/notificacao', $data);
    }

    public function notificacao_add() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        if (isset($_POST['tipo_notificacao']) && !empty($_POST['tipo_notificacao'])) {
            $usuarios = $_POST['usuarios'];
            $tipo_notificacao = addslashes($_POST['tipo_notificacao']);
            $notificacao = addslashes($_POST['notificacao']);

            try {
                $n->notificacao_add($usuarios,$tipo_notificacao,$notificacao,$u->getId());
                $data['msg_sucesso'] = "Sucesso Ao Salvar A Notificação";
            } catch (Exception $ex) {
                $data['msg_erro'] = "Ocorreu Um Erro Ao Salvar A Notificação.";
            }
        }


        $data['usuario_list'] = $u->getCombo($u->getId());
        $this->loadTemplate('notificacao/notificacao_add', $data);
    }

}

?>