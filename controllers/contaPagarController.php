<?php

class contaPagarController extends controller
{

    public function __construct()
    {
        parent::__construct();
        $u = new Usuario();
        if ($u->isLogged() == false) {
            header("Location:" . BASE_URL . 'login');
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

        if ($u->hasPermission('contas a pagar')) {

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

            $data['filtros'] = $_GET;

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

            if (!empty($_GET['searchs'])) {
                $s = $_GET['searchs'];
            }

            $data['conta_pagar_list'] = $c->getList($s, $offset, $limit);

            $this->loadTemplate('contaPagar/conta_pagar', $data);

        } else {
            header("Location:" . BASE_URL);
            exit;
        }

    }

    public function conta_pagar_add()
    {
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

        if ($u->hasPermission('contas a pagar')) {

            $c = new ContaPagar();

            if (isset($_POST['tipo']) && !empty($_POST['tipo'])) {
                $tipo = addslashes($_POST['tipo']);
                $descricao = addslashes($_POST['descricao']);
                $data_conta = explode('/', addslashes($_POST['data_conta']));
                $data_vencimento = explode('/', addslashes($_POST['data_vencimento']));
                $total = addslashes($_POST['total']);
                $status = addslashes($_POST['status']);

                $data_conta = $data_conta[2] . '-' . $data_conta[1] . '-' . $data_conta[0];
                $data_vencimento = $data_vencimento[2] . '-' . $data_vencimento[1] . '-' . $data_vencimento[0];


                if ($_POST['data_pagamento'] == null) {
                    $data_pagamento = null;
                } else {
                    $data_pagamento = explode('/', addslashes($_POST['data_pagamento']));
                    $data_pagamento = $data_pagamento[2] . '-' . $data_pagamento[1] . '-' . $data_pagamento[0];

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

        } else {
            header("Location:" . BASE_URL);
            exit;
        }

    }

    public function conta_pagar_receber($id)
    {
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

        if ($u->hasPermission('contas a pagar')) {

            $c = new ContaPagar();

            if (isset($id) && !empty($id)) {
                if ($c->verificarId($id)) {

                } else {
                    header("Location:" . BASE_URL . 'contaPagar');
                }
            } else {
                header("Location:" . BASE_URL . 'contaPagar');
            }

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

            $data['filtros'] = $_GET;

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

            if (!empty($_GET['searchs'])) {
                $s = $_GET['searchs'];
            }

            $data['conta_pagar_list'] = $c->getList($s, $offset, $limit);


            $this->loadTemplate('contaPagar/conta_pagar', $data);

        } else {
            header("Location:" . BASE_URL);
            exit;
        }

    }

    public function conta_pagar_excluir($id)
    {
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

        if ($u->hasPermission('contas a pagar')) {

            $c = new ContaPagar();

            if (isset($id) && !empty($id)) {
                if ($c->verificarId($id)) {

                } else {
                    header("Location:" . BASE_URL . 'contaPagar');
                }
            } else {
                header("Location:" . BASE_URL . 'contaPagar');
            }

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

            $data['filtros'] = $_GET;

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

            if (!empty($_GET['searchs'])) {
                $s = $_GET['searchs'];
            }

            $data['conta_pagar_list'] = $c->getList($s, $offset, $limit);


            $this->loadTemplate('contaPagar/conta_pagar', $data);

        } else {
            header("Location:" . BASE_URL);
            exit;
        }

    }

    public function conta_pagar_vizualizar($id)
    {
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

        if ($u->hasPermission('contas a pagar')) {

            $c = new ContaPagar();

            if (isset($id) && !empty($id)) {
                if ($c->verificarId($id)) {

                } else {
                    header("Location:" . BASE_URL . 'contaPagar');
                }
            } else {
                header("Location:" . BASE_URL . 'contaPagar');
            }

            $data['conta_pagar_info'] = $c->getInfo($id);

            $this->loadTemplate('contaPagar/conta_pagar_vizualizar', $data);

        } else {
            header("Location:" . BASE_URL);
            exit;
        }

    }

}

?>