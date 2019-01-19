<?php

class produtoController extends controller
{

    public function __construct()
    {
        parent::__construct();
        $u = new Usuario();
        if ($u->isLogged() == FALSE) {
            header('Location:' . BASE_URL . 'login');
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

        if ($u->hasPermission('produto')) {

            $p = new Produto();

            $data['status'] = array(
                '0' => 'Indisponivel',
                '1' => 'Dísponivel',
            );

            $s = '';

            if (!empty($_GET['searchs'])) {
                $s = $_GET['searchs'];
            }

            $data['filtros'] = $_GET;

            $limit = 10;

            $data['limit'] = 1;

            $total = $p->getTotal($s);

            $data['total'] = $p->getTotal($s);

            $data['paginas'] = ceil($total / $limit);

            $data['paginaAtual'] = 1;
            if (!empty($_GET['p'])) {
                $data['paginaAtual'] = intval($_GET['p']);
            }

            $offset = ($data['paginaAtual'] * $limit) - $limit;

            $data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

            $data['max'] = 2;

            $data['produto_list'] = $p->getList($s, $offset, $limit);

            $this->loadTemplate('produto/produto', $data);

        } else {
            header("Location:" . BASE_URL);
            exit;
        }
    }

    public function produto_add()
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

        if ($u->hasPermission('produto')) {

            $p = new Produto();

            if (isset($_POST['cod_barras']) && !empty($_POST['cod_barras'])) {
                $cod_barras = addslashes($_POST['cod_barras']);
                $nome = addslashes($_POST['nome']);
                $id_grupo_produto = addslashes($_POST['id_grupo_produto']);
                $quantidade_min = addslashes($_POST['quantidade_min']);
                $preco = addslashes($_POST['preco']);
                $preco_compra = addslashes($_POST['preco_compra']);
                $lucro_venda = addslashes($_POST['lucro_venda']);
                $margem_bruta = addslashes($_POST['margem_bruta']);

                $status = addslashes($_POST['status']);

                if (isset($_FILES['fotos'])) {
                    $fotos = $_FILES['fotos'];
                } else {
                    $fotos = array();
                }

                $preco = str_replace(',', '.', $preco);
                $preco_compra = str_replace(',', '.', $preco_compra);
                $lucro_venda = str_replace(',', '.', $lucro_venda);

                try {
                    $p->produto_add($cod_barras, $nome, $id_grupo_produto, $quantidade_min, $preco, $preco_compra, $lucro_venda, $margem_bruta, $status, $fotos, $u->getId());
                    $data['msg_sucesso'] = "Sucesso.";
                } catch (Exception $e) {
                    $data['msg_erro'] = "Err.";
                }

            }

            $g = new GrupoProduto();

            $data['grupo_produto_list'] = $g->getGrupoProduto();

            $this->loadTemplate('produto/produto_add', $data);

        } else {
            header("Location:" . BASE_URL);
            exit;
        }

    }

    public function produto_editar($id)
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

        if ($u->hasPermission('produto')) {

            $p = new Produto();

            if (isset($id) && !empty($id)) {
                if ($p->verificarId($id)) {

                } else {
                    header("Location:" . BASE_URL . 'produto');
                }
            } else {
                header("Location:" . BASE_URL . 'produto');
            }

            if (isset($_POST['cod_barras']) && !empty($_POST['cod_barras'])) {
                $cod_barras = addslashes($_POST['cod_barras']);
                $nome = addslashes($_POST['nome']);
                $id_grupo_produto = addslashes($_POST['id_grupo_produto']);
                $quantidade_min = addslashes($_POST['quantidade_min']);
                $preco = addslashes($_POST['preco']);
                $preco_compra = addslashes($_POST['preco_compra']);
                $lucro_venda = addslashes($_POST['lucro_venda']);
                $margem_bruta = addslashes($_POST['margem_bruta']);

                if (isset($_FILES['fotos'])) {
                    $fotos = $_FILES['fotos'];
                } else {
                    $fotos = array();
                }

                $preco = str_replace('.', '', $preco);
                $preco = str_replace(',', '.', $preco);

                $preco_compra = str_replace('.', '', $preco_compra);
                $preco_compra = str_replace(',', '.', $preco_compra);

                $lucro_venda = str_replace('.', '', $lucro_venda);
                $lucro_venda = str_replace(',', '.', $lucro_venda);


                try {
                    $p->produto_editar($cod_barras, $nome, $id_grupo_produto, $quantidade_min, $preco, $preco_compra, $lucro_venda, $margem_bruta, $fotos, $u->getId(), $id);
                    $data['msg_sucesso'] = "Sucesso.";
                } catch (Exception $e) {
                    $data['msg_erro'] = "Erro.";
                }
            }

            $data['produto_editar_list'] = $p->getInfo($id);

            $g = new GrupoProduto();

            $data['grupo_produto_list'] = $g->getGrupoProduto();

            $this->loadTemplate('produto/produto_editar', $data);

        } else {
            header("Location:" . BASE_URL);
            exit;
        }

    }

    public function excluir_imagem($id)
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

        if ($u->hasPermission('produto')) {

            $p = new Produto();

            $id_produto = $p->excluir_imagem($id);

            if (isset($id_produto)) {
                header("Location:" . BASE_URL . 'produto/produto_editar/' . $id_produto);
            } else {
                header("Location:" . BASE_URL . 'produto');
            }

        } else {
            header("Location:" . BASE_URL);
            exit;
        }

    }

    public function produto_deletar($id)
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

        if ($u->hasPermission('produto')) {

            $p = new Produto();

            if (isset($id) && !empty($id)) {
                if ($p->verificarId($id)) {

                } else {
                    header("Location:" . BASE_URL . 'produto');
                }
            } else {
                header("Location:" . BASE_URL . 'produto');
            }

            try {
                $p->produto_deletar($id);
                $data['msg_sucesso'] = "Sucesso.";
            } catch (Exception $e) {
                $data['msg_erro'] = "Erro.";
            }
        } else {
            header("Location:" . BASE_URL);
            exit;
        }

    }

}

?>
