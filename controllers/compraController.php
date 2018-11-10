<?php

class compraController extends controller {

    public function __construct() {
        parent::__construct();
        $u = new Usuario();
        if ($u->isLogged() == FALSE) {
            header("Location:" . BASE_URL . 'login');
            exit;
        }
    }

    public function index() {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();
        $n = new Notificacao();
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

        if($u->hasPermission('compra')){

            $c = new Compra();

            $s = '';

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

            if (!empty($_GET['searchs'])) {
                $s = $_GET['searchs'];
            }

            $data['compra_list'] = $c->getList($s, $offset, $limit);

            $this->loadTemplate('compra/compra', $data);

        }else{
            header("Location:".BASE_URL);
            exit;
        }

    }

    public function compra_add() {
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

        if($u->hasPermission('compra')){

            $c = new Compra();

            if (isset($_POST['id_fornecedor']) && !empty($_POST['id_fornecedor'])) {
                $id_fornecedor = addslashes($_POST['id_fornecedor']);
                $numero_nota = addslashes($_POST['numero_nota']);
                $data_vencimento  = explode('/', addslashes($_POST['data_vencimento']));
                $quant = $_POST['quant'];

                $data_vencimento = $data_vencimento[2].'-'.$data_vencimento[1].'-'.$data_vencimento[0];

                try{
                    $c->compra_add($id_fornecedor, $numero_nota, $data_vencimento, $quant, $u->getId());
                    $data['msg_sucesso'] = "Sucesso Ao Salvar Contas a Pagar.";
                } catch (Exception $ex) {
                 $data['msg_erro'] = "Ocorreu Um Erro ao Salvar Contas a Pagar";
             }

         }

         $this->loadTemplate('compra/compra_add', $data);

     }else{
        header("Location:".BASE_URL);
        exit;
    }

}

public function compra_vizualizar($id){
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

    if($u->hasPermission('compra')){

        $c = new Compra();

        if(isset($id) && !empty($id)){
            if($c->verificarId($id)){

            }else{
                header("Location:".BASE_URL.'compra' );
            }
        }else{
            header("Location:".BASE_URL.'compra' );
        }

        $data['info'] = $c->venda_vizualizar($id);

        $this->loadTemplate('compra/compra_vizualizar', $data);

    }else{
        header("Location:".BASE_URL);
        exit;
    }

}

}
?>

