<?php

class clienteController extends controller {

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

        $c = new Cliente();

        $s = '';

        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }

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

        $data['cliente_list'] = $c->getList($s, $offset, $limit);

        $this->loadTemplate('cliente/cliente', $data);
    }

    public function cliente_add() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $c = new Cliente();

        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $tipo_pessoa = addslashes($_POST['tipo_pessoa']);
            $nome = addslashes($_POST['nome']);
            $cpf = addslashes($_POST['cpf']);
            $rg = addslashes($_POST['rg']);
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);
            $data_cadastro = explode('/', addslashes($_POST['data_cadastro']));
            $cep = addslashes($_POST['cep']);
            $bairro = addslashes($_POST['bairro']);
            $rua = addslashes($_POST['rua']);
            $numero = addslashes($_POST['numero']);
            $cidade = addslashes($_POST['cidade']);
            $estado = addslashes($_POST['estado']);
            $pais = addslashes($_POST['pais']);
            
           

            $data_cadastro = $data_cadastro[2] . '-' . $data_cadastro[1] . '-' . $data_cadastro[0];

            if ($c->cliente_add($tipo_pessoa, $nome, $cpf, $rg, $telefone, $email, $data_cadastro, $cep, $bairro, $rua, $numero, $cidade, $estado, $pais)) {
                $data['msg_sucesso'] = "Cliente Salvo Com Sucesso.";
            } else {
                $data['msg_erro'] = "J� Existe Este Cliente";
            }
        }

        $this->loadTemplate('cliente/cliente_add', $data);
    }

    public function cliente_editar($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $c = new Cliente();

        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $tipo_pessoa = addslashes($_POST['tipo_pessoa']);
            $nome = addslashes($_POST['nome']);
            $cpf = addslashes($_POST['cpf']);
            $rg = addslashes($_POST['rg']);
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);
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
                $c->cliente_editar($tipo_pessoa, $nome, $cpf, $rg, $telefone, $email, $data_cadastro, $cep, $bairro, $rua, $numero, $cidade, $estado, $pais, $id);
                $data['msg_sucesso'] = "Sucesso ao Editar o Cliente.";
            } catch (Exception $ex) {
                $data['msg_erro'] = "Ocorreu um Erro ao Editar o Cliente";
            }
        }

        $data['cliente_editar_list'] = $c->getInfo($id);

        $this->loadTemplate('cliente/cliente_editar', $data);
    }

    public function cliente_deletar($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $c = new Cliente();

        try {
            $c->cliente_deletar($id);
            $data['msg_sucesso'] = "Sucesso ao Excluir o Cliente.";
        } catch (Exception $e) {
            $data['msg_erro'] = "Este Cliente J� Esta Associado.";
        }

        $s = '';

        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }

        $limit = 10;

        $data['limit'] = 1;

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

        $data['cliente_list'] = $c->getList($s, $offset, $limit);

        $this->loadTemplate('cliente/cliente', $data);
    }

}
?>



