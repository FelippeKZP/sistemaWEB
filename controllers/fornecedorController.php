<?php

class fornecedorController extends controller
{

    public function __construct()
    {
        parent::__construct();
        $u = new Usuario();
        if ($u->isLogged() == FALSE) {
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

        if ($u->hasPermission('fornecedor')) {

            $f = new Fornecedor();

            $s = '';

            if (!empty($_GET['searchs'])) {
                $s = $_GET['searchs'];
            }


            $data['filtros'] = $_GET;

            $limit = 10;

            $data['limit'] = 1;

            $total = $f->getTotal($s);

            $data['total'] = $f->getTotal($s);

            $data['paginas'] = ceil($total / $limit);

            $data['paginaAtual'] = 1;
            if (!empty($_GET['p'])) {
                $data['paginaAtual'] = intval($_GET['p']);
            }

            $offset = ($data['paginaAtual'] * $limit) - $limit;

            $data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

            $data['max'] = 2;

            $data['fornecedor_list'] = $f->getList($s, $offset, $limit);

            $this->loadTemplate('fornecedor/fornecedor', $data);

        } else {
            header("Location:" . BASE_URL);
            exit;
        }
    }

    public function fornecedor_add()
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

        if ($u->hasPermission('fornecedor')) {

            $f = new Fornecedor();

            if (isset($_POST['razao_social']) && !empty($_POST['razao_social'])) {
                $razao_social = addslashes($_POST['razao_social']);
                $nome_fantasia = addslashes($_POST['nome_fantasia']);
                $cnpj = addslashes($_POST['cnpj']);
                $ie = addslashes($_POST['ie']);
                $telefone = addslashes($_POST['telefone']);
                $data_cadastro = explode('/', addslashes($_POST['data_cadastro']));
                $cep = addslashes($_POST['cep']);
                $bairro = addslashes($_POST['bairro']);
                $rua = addslashes($_POST['rua']);
                $numero = addslashes($_POST['numero']);
                $cidade = addslashes($_POST['cidade']);

                $data_cadastro = $data_cadastro[2] . '-' . $data_cadastro[1] . '-' . $data_cadastro[0];

                try {
                    $f->fornecedor_add($razao_social, $nome_fantasia, $cnpj, $ie, $telefone, $data_cadastro, $cep, $bairro, $rua, $numero, $cidade);
                    $data['msg_sucesso'] = "sucesso.";
                } catch (Exception $e) {
                    $data['msg_erro'] = "erro.";
                }
            }

            $e = new Estado();

            $data['estado_list'] = $e->getCombo();

            $this->loadTemplate('fornecedor/fornecedor_add', $data);

        } else {
            header("Location:" . BASE_URL);
            exit;
        }
    }

    public function fornecedor_editar($id)
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

        if ($u->hasPermission('fornecedor')) {

            $f = new Fornecedor();

            if (isset($id) && !empty($id)) {
                if ($f->verificarId($id)) {

                } else {
                    header("Location:" . BASE_URL . 'fornecedor');
                }
            } else {
                header("Location:" . BASE_URL . 'fornecedor');
            }

            if (isset($_POST['razao_social']) && !empty($_POST['razao_social'])) {
                $razao_social = addslashes($_POST['razao_social']);
                $nome_fantasia = addslashes($_POST['nome_fantasia']);
                $cnpj = addslashes($_POST['cnpj']);
                $ie = addslashes($_POST['ie']);
                $telefone = addslashes($_POST['telefone']);
                $data_cadastro = explode('/', addslashes($_POST['data_cadastro']));
                $cep = addslashes($_POST['cep']);
                $bairro = addslashes($_POST['bairro']);
                $rua = addslashes($_POST['rua']);
                $numero = addslashes($_POST['numero']);
                $cidade = addslashes($_POST['cidade']);

                $data_cadastro = $data_cadastro[2] . '-' . $data_cadastro[1] . '-' . $data_cadastro[0];

                try {
                    $f->fornecedor_editar($razao_social, $nome_fantasia, $cnpj, $ie, $telefone, $data_cadastro, $cep, $bairro, $rua, $numero, $cidade, $id);
                    $data['msg_sucesso'] = "sucesso.";
                } catch (Exception $ex) {
                    $data['msg_erro'] = "erro.";
                }
            }

            $e = new Estado();

            $c = new Cidade();

            $id_estado = $f->getIdEstado($id);

            $data['estado_list'] = $e->getCombo();

            $data['cidade_list'] = $c->getCombo($id_estado);

            $data['fornecedor_editar_list'] = $f->getFornecedor($id);

            $this->loadTemplate('fornecedor/fornecedor_editar', $data);

        } else {
            header("Location:" . BASE_URL . 'fornecedor');
        }
    }

    public function fornecedor_deletar($id)
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

        if ($u->hasPermission('fornecedor')) {

            $f = new Fornecedor();

            if (isset($id) && !empty($id)) {
                if ($f->verificarId($id)) {

                } else {
                    header("Location:" . BASE_URL . 'fornecedor');
                }
            } else {
                header("Location:" . BASE_URL . 'fornecedor');
            }

            try {
                $f->fornecedor_deletar($id);
            } catch (Exception $e) {
            }


        } else {
            header("Location:" . BASE_URL);
            exit;
        }
    }

}

?>