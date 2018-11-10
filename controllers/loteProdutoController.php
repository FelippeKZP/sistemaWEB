<?php

class loteProdutoController extends controller {

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

        if($u->hasPermission('lote de produto')){

            $l = new LoteProduto();

            $data['status'] = array(
                '0' => 'Indisponivel',
                '1' => 'Dísponivel'
            );

            $s = '';

            if (!empty($_GET['searchs'])) {
                $s = $_GET['searchs'];
            }

            $data['filtros'] =  $_GET;

            $limit = 10;

            $data['limit'] = 1;

            $total = $l->getTotal($s);

            $data['total'] = $l->getTotal($s);

            $data['paginas'] = ceil($total / $limit);

            $data['paginaAtual'] = 1;
            if (!empty($_GET['p'])) {
                $data['paginaAtual'] = intval($_GET['p']);
            }

            $offset = ($data['paginaAtual'] * $limit) - $limit;

            $data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

            $data['max'] = 2;

            $data['lote_produto_list'] = $l->getList($s, $offset, $limit);

            $this->loadTemplate('loteProduto/lote_produto', $data);

        }else{
            header("Location:".BASE_URL);
            exit;
        }

    }

    public function lote_produto_add() {
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

        if($u->hasPermission('lote de produto')){

            $l = new LoteProduto();

            if (isset($_POST['numero_lote']) && !empty($_POST['numero_lote'])) {
                $numero_lote = addslashes($_POST['numero_lote']);
                $id_produto = addslashes($_POST['id_produto']);
                $id_fornecedor = addslashes($_POST['id_fornecedor']);
                $quantidade = addslashes($_POST['quantidade']);
                $data_fabricacao = explode('/', addslashes($_POST['data_fabricacao']));
                $data_vencimento = explode('/', addslashes($_POST['data_vencimento']));
                $status = addslashes($_POST['status']);

                $data_fabricacao = $data_fabricacao[2] . '-' . $data_fabricacao[1] . '-' . $data_fabricacao[0];
                $data_vencimento = $data_vencimento[2] . '-' . $data_vencimento[1] . '-' . $data_vencimento[0];

                try{
                    $l->lote_produto_add($numero_lote, $id_produto, $id_fornecedor, $quantidade, $data_fabricacao, $data_vencimento,$status, $u->getId());
                    $data['msg_sucesso'] = "Lote de Produto Salvo Com Sucesso.";
                } catch(Exception $e){
                    $data['msg_erro'] = "Já Existe Este Lote de Produto.";
                }
            }

            $this->loadTemplate('loteProduto/lote_produto_add', $data);

        }else{
            header("Location:".BASE_URL);
            exit;
        }

    }

    public function lote_produto_editar($id) {
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

        if($u->hasPermission('lote de produto')){

            $l = new LoteProduto();

            if(isset($id) && !empty($id)){
                if($l->verificarId($id)){

                }else{
                    header("Location:".BASE_URL.'loteProduto' );
                }
            }else{
                header("Location:".BASE_URL.'loteProduto' );
            }

            if (isset($_POST['numero_lote']) && !empty($_POST['numero_lote'])) {
                $numero_lote = addslashes($_POST['numero_lote']);
                $id_produto = addslashes($_POST['id_produto']);
                $id_fornecedor = addslashes($_POST['id_fornecedor']);
                $data_fabricacao = explode('/', addslashes($_POST['data_fabricacao']));
                $data_vencimento = explode('/', addslashes($_POST['data_vencimento']));
                $status = addslashes($_POST['status']);

                $data_fabricacao = $data_fabricacao[2] . '-' . $data_fabricacao[1] . '-' . $data_fabricacao[0];
                $data_vencimento = $data_vencimento[2] . '-' . $data_vencimento[1] . '-' . $data_vencimento[0];

                try {
                    $l->lote_produto_editar($numero_lote, $id_produto, $id_fornecedor, $data_fabricacao, $data_vencimento,$status, $id);
                    $data['msg_sucesso'] = "Sucesso ao Editar o Lote de Produto.";
                } catch (Exception $ex) {
                    $data['msg_erro'] = "Ocorreu um Erro ao Editar o Lote de Produto";
                }
            }

            $data['lote_produto_editar_list'] = $l->getInfo($id);

            $this->loadTemplate('loteProduto/lote_produto_editar', $data);

        }else{
            header("Location:".BASE_URL);
            exit;
        }

    }

    public function lote_produto_deletar($id) {
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

        if($u->hasPermission('lote de produto')){

            $l = new LoteProduto();

                $data['status'] = array(
                    '0' => 'Indisponivel',
                    '1' => 'Dísponivel'
                );

                if(isset($id) && !empty($id)){
                    if($l->verificarId($id)){

                    }else{
                        header("Location:".BASE_URL.'loteProduto' );
                    }
                }else{
                    header("Location:".BASE_URL.'loteProduto' );
                }

                try {
                    $l->lote_produto_deletar($id);
                    $data['msg_sucesso'] = "Sucesso ao Excluir o Lote de Produto.";
                } catch (Exception $e) {
                    $data['msg_erro'] = "Este Lote de Produto Já Esta Associado.";
                }

                $s = '';
                if (!empty($_GET['searchs'])) {
                    $s = $_GET['searchs'];
                }

                $data['filtros'] =  $_GET;

                $limit = 10;

                $data['limit'] = 1;

                $total = $l->getTotal($s);

                $data['total'] = $l->getTotal($s);

                $data['paginas'] = ceil($total / $limit);

                $data['paginaAtual'] = 1;
                if (!empty($_GET['p'])) {
                    $data['paginaAtual'] = intval($_GET['p']);
                }

                $offset = ($data['paginaAtual'] * $limit) - $limit;

                $data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

                $data['max'] = 2;

                $data['lote_produto_list'] = $l->getList($s, $offset, $limit);


                $this->loadTemplate('loteProduto/lote_produto', $data);

            }else{
                header("Location:".BASE_URL);
                exit;
            }
        }

        public function lote_produto_perda($id){
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

            if($u->hasPermission('lote de produto')){

                $l = new LoteProduto();

                if(isset($id) && !empty($id)){
                    if($l->verificarId($id)){

                    }else{
                        header("Location:".BASE_URL.'loteProduto' );
                    }
                }else{
                    header("Location:".BASE_URL.'loteProduto' );
                }

                if(isset($_POST['quantidade_perda']) && !empty($_POST['quantidade_perda'])){
                    $quantidade_perda = addslashes($_POST['quantidade_perda']);
                    $motivo = addslashes($_POST['motivo']);
                    $preco = addslashes($_POST['preco']);

                    $preco = str_replace(',','.',$preco);

                    try{
                        $l->lote_produto_perda($quantidade_perda,$motivo,$preco,$id,$u->getId());
                        $data['msg_sucesso'] = "Sucesso ao realizar perda do lote";

                    }catch(Exception $e){
                        $data['msg_erro'] = "Ocorreu um erro ao realizar a perda";
                    }
                }

                $data['lote_produto_editar_list'] = $l->getInfo($id);

                $this->loadTemplate('loteProduto/lote_produto_perda', $data);

            }else{
                header("Location:".BASE_URL);
                exit;
            }

        }

    }

    ?>