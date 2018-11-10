<?php

class contaReceberController extends controller {

    public function __construct() {
        parent::__construct();
        $u = new Usuario();
        if ($u->isLogged() == false) {
            header("Location:" . BASE_URL . "login");
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

        if($u->hasPermission('contas a receber')){

            $c = new ContaReceber();

            $data['receber'] = $u->hasPermission('receber contas a receber');

            $data['status'] = array(
                '0' => 'Pendente',
                '1' => 'Pago'
            );

            $data['tipo_pag'] = array(
                '0' => 'Á Vista',
                '1' => 'Á Prazo'
            );

            $s = '';

            if (!empty($_GET['searchs'])) {
                $s = $_GET['searchs'];
            }

            $data['filtros'] =  $_GET;

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


            $data['conta_list'] = $c->getList($s, $offset, $limit);


            $this->loadTemplate('contaReceber/conta_receber', $data);

        }else{
            header("Location:".BASE_URL);
            exit;
        }

    }

    public function receber($id) {
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

        if($u->hasPermission('contas a receber')){

            $c = new ContaReceber();

            if(isset($id) && !empty($id)){
                if($c->verificarId($id)){

                }else{
                    header("Location:".BASE_URL.'contaReceber' );
                }
            }else{
                header("Location:".BASE_URL.'contaReceber' );
            }


            $data['status'] = array(
                '0' => 'Pendente',
                '1' => 'Pago'
            );

            if (isset($_POST['dinheiro']) && !empty($_POST['dinheiro'])) {

                $dinheiro = addslashes($_POST['dinheiro']);
                $troco = addslashes($_POST['troco']);

                $dinheiro = str_replace(',', '.', $dinheiro);
                $troco = str_replace(',', '.', $troco);

                try {

                    $c->receber($dinheiro, $troco, $u->getId(), $id);
                    $data['msg_sucesso'] = "Conta Recebida Com Sucesso.";
                } catch (Exception $e) {
                    $data['msg_erro'] = "Erro Ao Receber Esta Conta.";
                }
            }

            $data['info'] = $c->getInfo($id);

            $this->loadTemplate('contaReceber/receber', $data);

        }else{
            header("Location:".BASE_URL);
            exit;
        }

    }
}
?>

