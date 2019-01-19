<?php

class vendaController extends controller
{

    public function __construct()
    {
        parent::__construct();
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

        if ($u->hasPermission('venda')) {

            $v = new Venda();

            $data['adicionar'] = $u->hasPermission('adicionar venda');
            $data['visualizar'] = $u->hasPermission('visualizar venda');
            $data['excluir'] = $u->hasPermission('excluir venda');

            $s = '';

            if (!empty($_GET['searchs'])) {
                $s = $_GET['searchs'];
            }

            $data['filtros'] = $_GET;

            $limit = 10;

            $data['limit'] = 1;

            $total = $v->getTotal($s);

            $data['total'] = $v->getTotal($s);

            $data['paginas'] = ceil($total / $limit);

            $data['paginaAtual'] = 1;
            if (!empty($_GET['p'])) {
                $data['paginaAtual'] = intval($_GET['p']);
            }

            $offset = ($data['paginaAtual'] * $limit) - $limit;

            $data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

            $data['max'] = 2;


            $data['venda_list'] = $v->getList($s, $offset, $limit);

            $this->loadTemplate('venda/venda', $data);

        } else {
            header("Location:" . BASE_URL);
            exit;
        }
    }

    public function venda_add()
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

        if ($u->hasPermission('venda')) {

            $v = new Venda();

            if (isset($_POST['id_cliente']) && !empty($_POST['id_cliente'])) {
                $id_cliente = addslashes($_POST['id_cliente']);
                $quant = $_POST['quant'];
                $id_funcionario = addslashes($_POST['id_funcionario']);
                $desconto = addslashes($_POST['desconto']);
                $tipo_pag = addslashes($_POST['condicao_pag']);
                $data_vencimento = addslashes($_POST['data_vencimento']);
                $n_parcelas = '';

                $desconto = str_replace('.', '', $desconto);
                $desconto = str_replace(',', '.', $desconto);
                // $data_vencimento = $data_vencimento[2] . '-' . $data_vencimento[1] . '-' . $data_vencimento[0];

                if (!empty($_POST['n_parcelas'])) {
                    $n_parcelas = addslashes($_POST['n_parcelas']);
                } else {
                    $n_parcelas = 1;
                }

                try {
                    $v->venda_add($id_cliente, $id_funcionario, $quant, $desconto, $tipo_pag, $data_vencimento, $n_parcelas, $u->getId());
                    $data['msg_sucesso'] = "Sucesso em Salvar a Venda.";
                } catch (Exception $ex) {
                    $data['msg_erro'] = "Ocorreu um Erro ao Salvar a Venda.";
                }
            }

            $f = new Funcionario();

            $data['funcionario_list'] = $f->getCombo();

            $this->loadTemplate('venda/venda_add', $data);

        } else {
            header("Location:" . BASE_URL);
            exit;
        }
    }

    public function venda_vizualizar($id)
    {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
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

        if ($u->hasPermission('venda')) {

            $v = new Venda();

            if (isset($id) && !empty($id)) {
                if ($v->verificarId($id)) {

                } else {
                    header("Location:" . BASE_URL . 'venda');
                }
            } else {
                header("Location:" . BASE_URL . 'venda');
            }


            $data['info'] = $v->venda_vizualizar($id);

            $this->loadTemplate('venda/venda_vizualizar', $data);

        } else {
            header("Location:" . BASE_URL);
            exit;
        }
    }

    public function venda_cancelar($id)
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

        if ($u->hasPermission('venda')) {

            $v = new Venda();

            if (isset($id) && !empty($id)) {
                if ($v->verificarId($id)) {

                } else {
                    header("Location:" . BASE_URL . 'venda');
                }
            } else {
                header("Location:" . BASE_URL . 'venda');
            }


            try {
                $v->venda_cancelar($id);
                $data['msg_sucesso'] = "Esta Venda Foi Cancelada, Junto Com Conta A Receber.";
            } catch (Exception $ex) {
                $data['msg_erro'] = "Ocorreu Um Erro Ao Cancelar A Venda";
            }

            $s = '';

            if (!empty($_GET['searchs'])) {
                $s = $_GET['searchs'];
            }

            $data['filtros'] = $_GET;

            $limit = 10;

            $data['limit'] = 1;

            $total = $v->getTotal($s);

            $data['total'] = $v->getTotal($s);

            $data['paginas'] = ceil($total / $limit);

            $data['paginaAtual'] = 1;
            if (!empty($_GET['p'])) {
                $data['paginaAtual'] = intval($_GET['p']);
            }

            $offset = ($data['paginaAtual'] * $limit) - $limit;

            $data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

            $data['max'] = 2;


            $data['venda_list'] = $v->getList($s, $offset, $limit);

            $this->loadTemplate('venda/venda', $data);

        } else {
            header("Location:" . BASE_URL);
            exit;
        }
    }

}

?>