<?php

class fornecedorController extends controller {

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
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());
        $f = new Fornecedor();

        $s = '';

        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }

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
        
        $data['fornecedor_list'] = $f->getList($s,$offset,$limit);

        $this->loadTemplate('fornecedor/fornecedor', $data);
    }

    public function fornecedor_add() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());
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
            $estado = addslashes($_POST['estado']);
            $pais = addslashes($_POST['pais']);

            $data_cadastro = $data_cadastro[2] . '-' . $data_cadastro[1] . '-' . $data_cadastro[0];

            if ($f->fornecedor_add($razao_social, $nome_fantasia, $cnpj, $ie, $telefone, $data_cadastro, $cep, $bairro, $rua, $numero, $cidade, $estado, $pais)) {
                $data['msg_sucesso'] = "Fornecedor Salvo Com Sucesso.";
            } else {
                $data['msg_erro'] = "Já Existe Este Fornecedor";
            }
        }

        $this->loadTemplate('fornecedor/fornecedor_add', $data);
    }

    public function fornecedor_editar($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());
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
            $estado = addslashes($_POST['estado']);
            $pais = addslashes($_POST['pais']);

            $data_cadastro = $data_cadastro[2] . '-' . $data_cadastro[1] . '-' . $data_cadastro[0];

            try {
                $f->fornecedor_editar($razao_social, $nome_fantasia, $cnpj, $ie, $telefone, $data_cadastro, $cep, $bairro, $rua, $numero, $cidade, $estado, $pais, $id);
                $data['msg_sucesso'] = "Sucesso ao Editar o Fornecedor";
            } catch (Exception $ex) {
                $data['msg_erro'] = "Ocorreu um Erro ao Editar o Fornecedor";
            }
        }

        $data['fornecedor_editar_list'] = $f->getFornecedor($id);

        $this->loadTemplate('fornecedor/fornecedor_editar', $data);
    }

    public function fornecedor_deletar($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());
        $f = new Fornecedor();

        try {
            $f->fornecedor_deletar($id);
            $data['msg_sucesso'] = "Sucesso ao Excluir o Fornecedor";
        } catch (Exception $e) {
            $data['msg_erro'] = "Este Fornecedor Já Esta Associado";
        }


        $s = '';

        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }

        $data['fornecedor_list'] = $f->getList($s);

        $this->loadTemplate('fornecedor/fornecedor', $data);
    }

}

?>