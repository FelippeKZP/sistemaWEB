<?php

class perfilController extends controller
{

    public function __construct()
    {
        parent:: __construct();

        $u = new Usuario();
        if ($u->isLogged() == false) {
            header("Location:" . BASE_URL . 'login');
            exit;
        }
    }

    public function index()
    {
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

        $p = new Perfil();

        if (isset($_POST['senha']) && !empty($_POST['senha'])) {
            $senha_atual = addslashes($_POST['senha_atual']);
            $senha = addslashes($_POST['senha']);

            if ($p->verificarSenha($senha_atual, $u->getId())) {
                try {
                    $p->trocarSenha($senha, $u->getId());
                    $data['msg_sucesso'] = "Senha alterado com sucesso.";
                } catch (Exception $ex) {
                    $data['msg_erro'] = "Ocorreu um erro alterar sua senha.";
                }

            } else {
                $data['msg_erro'] = "Senha atual é diferente a qual é informada.";
            }

        }

        $this->loadTemplate('perfil/perfil', $data);
    }
}

?>