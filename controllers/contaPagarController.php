<?php

class contaPagarController extends controller {

    public function __construct() {
        parent::__construct();
        $u = new Usuario();
        if ($u->isLogged() == false) {
            header("Location" . BASE_URL . 'login');
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

        $c = new ContaPagar();

        $data['tipo'] = array(
            '0' => 'Água',
            '1' => 'Aluguel',
            '2' => 'Compra',
            '3' => 'Internet',
            '4' => 'Telefone',
            '5' => 'Luz',
            '6' => 'Outros tipo de conta'
        );

        $data['status'] = array(
            '0' => 'Pendente',
            '1' => 'Pago'
        );

        $s = '';

        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }

        $data['conta_pagar_list'] = $c->getList($s);

        $this->loadTemplate('contaPagar/conta_pagar', $data);
    }

    public function conta_pagar_add() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $c = new ContaPagar();

        if (isset($_POST['tipo']) && !empty($_POST['tipo'])) {
            $tipo = addslashes($_POST['tipo']);
            $descricao = addslashes($_POST['descricao']);
            $data_conta = explode('/', addslashes($_POST['data_conta']));
            $data_vencimento = explode('/', addslashes($_POST['data_vencimento']));
            $data_pagamento = explode('/', addslashes($_POST['data_pagamento']));
            $total = addslashes($_POST['total']);
            $status = addslashes($_POST['status']);

            $data_conta = $data_conta[2] . '-' . $data_conta[1] . '-' . $data_conta[0];
            $data_vencimento = $data_vencimento[2] . '-' . $data_vencimento[1] . '-' . $data_vencimento[0];
            


            if ($_POST['data_pagamento'] == null) {
                $data_pagamento = 0000 - 00 - 00;
            } else {
                $data_pagamento = $data_pagamento[2] . '-' . $$data_pagamento[1] . '-' . $data_pagamento[0];
            }

            $total = str_replace(',', '.', $total);

            try {
                $c->conta_pagar_add($tipo, $descricao, $data_conta, $data_vencimento, $data_pagamento, $total, $status, $u->getId());
                $data['msg_sucesso'] = "Sucesso Ao Salvar Contas a Pagar.";
            } catch (Exception $ex) {
                $data['msg_erro'] = "Ocorreu Um Erro ao Salvar Contas a Pagar";
            }
        }

        $this->loadTemplate('contaPagar/conta_pagar_add', $data);
    }

    public function conta_pagar_receber($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $c = new ContaPagar();


        try {
            $c->conta_pagar_receber($id);
           $data['msg_sucesso'] = "Sucesso Ao Pagar A Conta.";
        } catch (Exception $ex) {
           $data['msg_erro'] = "Ocorreu Um Erro Ao Pagar a Conta.";
        }

        $data['tipo'] = array(
            '0' => 'Água',
            '1' => 'Aluguel',
            '2' => 'Compra',
            '3' => 'Internet',
            '4' => 'Telefone',
            '5' => 'Luz',
            '6' => 'Outros tipo de conta'
        );

        $data['status'] = array(
            '0' => 'Pendente',
            '1' => 'Pago'
        );

        $s = '';

        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }

        $data['conta_pagar_list'] = $c->getList($s);


        $this->loadTemplate('contaPagar/conta_pagar', $data);
    }

    public function conta_pagar_excluir($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $c = new ContaPagar();

        try {
            $c->conta_pagar_excluir($id);
            $data['msg_sucesso'] = "Sucesso Ao Excluir Conta A Pagar";
        } catch (Exception $ex) {
            $data['msg_erro'] = "Ocorreu ao Excluir Conta A Pagar";
        }

        $data['tipo'] = array(
            '0' => 'Água',
            '1' => 'Aluguel',
            '2' => 'Compra',
            '3' => 'Internet',
            '4' => 'Telefone',
            '5' => 'Luz',
            '6' => 'Outros tipo de conta'
        );

        $data['status'] = array(
            '0' => 'Pendente',
            '1' => 'Pago'
        );

        $s = '';

        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }

        $data['conta_pagar_list'] = $c->getList($s);



        $this->loadTemplate('contaPagar/conta_pagar', $data);
    }

}

?>