<?php

class funcionarioController extends controller {

    public function __construct() {
        parent::__construct();
        $u = new Usuario();
        if ($u->isLogged() == false) {
            header("Location:" . BASE_URL . 'login');
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


        $f = new Funcionario();

        $s = '';

        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }

        $data['filtros'] =  $_GET;

        $limit = 10;

        $data['limit'] = 10;

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

        $data['funcionario_list'] = $f->getList($s,$offset,$limit);


        $data['funcionario_list'] = $f->getList($s,$offset,$limit);

        $this->loadTemplate('funcionario/funcionario', $data);
    }

    public function funcionario_add() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $f = new Funcionario();

        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $cpf = addslashes($_POST['cpf']);
            $rg = addslashes($_POST['rg']);
            $telefone = addslashes($_POST['telefone']);
            $data_admissao = explode('/', addslashes($_POST['data_admissao']));
            $data_aniversario = explode('/', addslashes($_POST['data_aniversario']));
            $id_funcao = addslashes($_POST['id_funcao']);
            $carteira_trabalho = addslashes($_POST['carteira']);
            $salario = addslashes($_POST['salario']);
            $cep = addslashes($_POST['cep']);
            $bairro = addslashes($_POST['bairro']);
            $rua = addslashes($_POST['rua']);
            $numero = addslashes($_POST['numero']);
            $cidade = addslashes($_POST['cidade']);
            $estado = addslashes($_POST['estado']);
            $pais = addslashes($_POST['pais']);

            $data_admissao = $data_admissao[2] . '-' . $data_admissao[1] . '-' . $data_admissao[0];
            $data_aniversario = $data_aniversario[2] . '-' . $data_aniversario[1] . '-' . $data_aniversario[0];

            $salario = str_replace('.', '', $salario);
            $salario = str_replace(',', '.', $salario);

            try {
                $f->funcionario_add($nome, $cpf, $rg, $telefone, $data_admissao, $data_aniversario, $id_funcao, $carteira_trabalho, $salario, $cep, $bairro, $rua, $numero, $estado, $cidade, $pais);

                $data['msg_sucesso'] = "Sucesso Ao Salvar Funcionário";
            } catch (Exception $ex) {
                $data['msg_erro'] = "Já Existe Este Funcionário";
            }
        }


        $funcao = new FuncaoFuncionario();
        $data['funcao_list'] = $funcao->getCombo();

        $this->loadTemplate('funcionario/funcionario_add', $data);
    }

    public function funcionario_editar($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $f = new Funcionario();

        if(isset($id) && !empty($id)){
            if($f->verificarId($id)){

            }else{
                header("Location:".BASE_URL.'funcionario' );
            }
        }else{
            header("Location:".BASE_URL.'funcionario' );
        }


        $data['funcionario_list_edit'] = $f->getInfo($id);

        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $cpf = addslashes($_POST['cpf']);
            $rg = addslashes($_POST['rg']);
            $telefone = addslashes($_POST['telefone']);
            $data_admissao = explode('/', addslashes($_POST['data_admissao']));
            $data_aniversario = explode('/', addslashes($_POST['data_aniversario']));
            $id_funcao = addslashes($_POST['id_funcao']);
            $carteira_trabalho = addslashes($_POST['carteira']);
            $salario = addslashes($_POST['salario']);
            $cep = addslashes($_POST['cep']);
            $bairro = addslashes($_POST['bairro']);
            $rua = addslashes($_POST['rua']);
            $numero = addslashes($_POST['numero']);
            $cidade = addslashes($_POST['cidade']);
            $estado = addslashes($_POST['estado']);
            $pais = addslashes($_POST['pais']);

            $data_admissao = $data_admissao[2] . '-' . $data_admissao[1] . '-' . $data_admissao[0];
            $data_aniversario = $data_aniversario[2] . '-' . $data_aniversario[1] . '-' . $data_aniversario[0];

            $salario = str_replace('.', '', $salario);
            $salario = str_replace(',', '.', $salario);


            try {
                $f->funcionario_editar($nome, $cpf, $rg, $telefone, $data_admissao, $data_aniversario, $id_funcao, $carteira_trabalho, $salario, $cep, $bairro, $rua, $numero, $estado, $cidade, $pais, $id);

                $data['msg_sucesso'] = "Sucesso Ao Editar Funcionário";
            } catch (Exception $ex) {
                $data['msg_erro'] = "Ocorreu Um Erro Ao Editar Funcionário.";
            }
        }


        $funcao = new FuncaoFuncionario();

        $data['funcao_list'] = $funcao->getCombo();

        $this->loadTemplate('funcionario/funcionario_editar', $data);
    }

    public function funcionario_deletar($id) {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());


        $f = new Funcionario();

        
        if(isset($id) && !empty($id)){
            if($f->verificarId($id)){

            }else{
                header("Location:".BASE_URL.'funcionario' );
            }
        }else{
            header("Location:".BASE_URL.'funcionario' );
        }


        try {
            $f->funcionario_deletar($id);

            $data['msg_sucesso'] = "Sucesso Ao Excluir Funcionário.";
        } catch (Exception $ex) {
            $data['msg_erro'] = "Este Funcionário Já Esta Associado.";
        }

        $s = '';

        if (!empty($_GET['searchs'])) {
            $s = $_GET['searchs'];
        }

        $data['filtros'] =  $_GET;
        
        $data['funcionario_list'] = $f->getList($s);

        $this->loadTemplate('funcionario/funcionario', $data);
    }

}

?>