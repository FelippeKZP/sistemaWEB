<?php

class funcionarioController extends controller
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

        if ($u->hasPermission('funcionário')) {

            $f = new Funcionario();

            $s = '';

            if (!empty($_GET['searchs'])) {
                $s = $_GET['searchs'];
            }

            $data['filtros'] = $_GET;

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

            $data['funcionario_list'] = $f->getList($s, $offset, $limit);

            $data['funcionario_list'] = $f->getList($s, $offset, $limit);

            $this->loadTemplate('funcionario/funcionario', $data);

        } else {
            header("Location:" . BASE_URL);
            exit;
        }
    }

    public function funcionario_add()
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
        $data['venda'] = $u->hasPermission('venda');
        $data['perda'] = $u->hasPermission('perda');
        $data['relatório'] = $u->hasPermission('relatório');

        if ($u->hasPermission('funcionário')) {

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

                $data_admissao = $data_admissao[2] . '-' . $data_admissao[1] . '-' . $data_admissao[0];
                $data_aniversario = $data_aniversario[2] . '-' . $data_aniversario[1] . '-' . $data_aniversario[0];

                $salario = str_replace('.', '', $salario);
                $salario = str_replace(',', '.', $salario);

                try {
                    $f->funcionario_add($nome, $cpf, $rg, $telefone, $data_admissao, $data_aniversario, $id_funcao, $carteira_trabalho, $salario, $cep, $bairro, $rua, $numero, $cidade);

                    $data['msg_sucesso'] = "sucesso.";
                } catch (Exception $ex) {
                    $data['msg_erro'] = "erro.";
                }
            }

            $funcao = new FuncaoFuncionario();

            $e = new Estado();

            $data['estado_list'] = $e->getCombo();

            $data['funcao_list'] = $funcao->getCombo();

            $this->loadTemplate('funcionario/funcionario_add', $data);

        } else {
            header("Location:" . BASE_URL);
            exit;
        }
    }

    public function funcionario_editar($id)
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

        if ($u->hasPermission('funcionário')) {

            $f = new Funcionario();

            if (isset($id) && !empty($id)) {
                if ($f->verificarId($id)) {

                } else {
                    header("Location:" . BASE_URL . 'funcionario');
                }
            } else {
                header("Location:" . BASE_URL . 'funcionario');
            }

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

                $data_admissao = $data_admissao[2] . '-' . $data_admissao[1] . '-' . $data_admissao[0];
                $data_aniversario = $data_aniversario[2] . '-' . $data_aniversario[1] . '-' . $data_aniversario[0];

                $salario = str_replace('.', '', $salario);
                $salario = str_replace(',', '.', $salario);

                try {
                    $f->funcionario_editar($nome, $cpf, $rg, $telefone, $data_admissao, $data_aniversario, $id_funcao, $carteira_trabalho, $salario, $cep, $bairro, $rua, $numero, $cidade, $id);

                    $data['msg_sucesso'] = "sucesso.";
                } catch (Exception $ex) {
                    $data['msg_erro'] = "erro.";
                }
            }

            $e = new Estado();

            $c = new Cidade();

            $funcao = new FuncaoFuncionario();

            $id_estado = $f->getIdEstado($id);

            $data['estado_list'] = $e->getCombo();

            $data['cidade_list'] = $c->getCombo($id_estado);

            $data['funcao_list'] = $funcao->getCombo();

            $data['funcionario_list_edit'] = $f->getInfo($id);

            $this->loadTemplate('funcionario/funcionario_editar', $data);

        } else {
            header("Location:" . BASE_URL);
            exit;
        }

    }

    public function funcionario_deletar($id)
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

        if ($u->hasPermission('funcionário')) {

            $f = new Funcionario();

            if (isset($id) && !empty($id)) {
                if ($f->verificarId($id)) {

                } else {
                    header("Location:" . BASE_URL . 'funcionario');
                }
            } else {
                header("Location:" . BASE_URL . 'funcionario');
            }


            try {
                $f->funcionario_deletar($id);
            } catch (Exception $ex) {
            }

        } else {
            header("Location:" . BASE_URL);
            exit;
        }

    }

}

?>