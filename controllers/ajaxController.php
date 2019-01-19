<?php

class ajaxController extends controller
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

    }

    public function pesquisar_produtos()
    {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();

        $produto = new Produto();

        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);


            $produtos = $produto->pesquisarProduto($p);

            foreach ($produtos as $pitem) {
                $data[] = array(
                    'id' => $pitem['id'],
                    'nome' => $pitem['nome'],
                    'cod' => $pitem['cod_barras'],
                    'preco' => $pitem['preco'],
                    'preco_compra' => $pitem['preco_compra'],
                    'quantidade' => $pitem['quantidade']
                );
            }
        }
        echo json_encode($data);
    }

    public function pesquisar_fornecedores()
    {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();
        $f = new Fornecedor();

        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);


            $fornecedores = $f->pesquisarFornecedor($p);

            foreach ($fornecedores as $sitem) {
                $data[] = array(
                    'id' => $sitem['id'],
                    'razao_social' => $sitem['razao_social'],
                    'cnpj' => $sitem['cnpj'],
                    'link' => BASE_URL . 'fornecedor/fornecedor_editar/' . $sitem['id'],
                );
            }
        }

        echo json_encode($data);
    }

    public function pesquisar_clientes()
    {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();
        $c = new Cliente();

        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);

            $clientes = $c->pesquisarClientes($p);

            foreach ($clientes as $sitem) {
                $data[] = array(
                    'id' => $sitem['id'],
                    'nome' => $sitem['nome'],
                    'cpfCnpj' => $sitem['cpfCnpj'],
                    'link' => BASE_URL . 'cliente/cliente_editar/' . $sitem['id']
                );
            }
        }

        echo json_encode($data);
    }

    public function pesquisar_loteProdutos()
    {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();

        $l = new LoteProduto();

        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);
        }

        $lotes = $l->pesquisarLoteProdutos($p);

        foreach ($lotes as $sitem) {
            $data[] = array(
                'id' => $sitem['id'],
                'url'=> $sitem['url'],
                'preco' => $sitem['preco'],
                'preco_compra' => $sitem['preco_compra'],
                'quant' => $sitem['quantidade'],
                'produto' => $sitem['nome'],
                'numero' => $sitem['numero_lote'],
                'link' => BASE_URL . 'cliente/cliente_editar/' . $sitem['id']
            );
        }

        echo json_encode($data);
    }

    public function verificarCPF()
    {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();

        $f = new Funcionario();

        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);
        }

        $total = $f->verificarCPF($p);

        foreach ($total as $t) {
            $data[] = array(
                'total' => $t['total']
            );
        }

        echo json_encode($data);
    }

    public function verificarRG()
    {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();

        $f = new Funcionario();

        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);
        }

        $total = $f->verificarRG($p);

        foreach ($total as $t) {
            $data[] = array(
                'total' => $t['total']
            );
        }

        echo json_encode($data);

    }

    public function verificarCarteira()
    {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();

        $f = new Funcionario();

        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);
        }

        $total = $f->verificarCarteira($p);

        foreach ($total as $t) {
            $data[] = array(
                'total' => $t['total']
            );
        }

        echo json_encode($data);
    }

    public function verificarClienteCpfCnpj()
    {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();

        $c = new Cliente();

        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);
        }

        $total = $c->verificarClienteCpfCnpj($p);

        foreach ($total as $t) {
            $data[] = array(
                'total' => $t['total']
            );

        }
        echo json_encode($data);
    }

    public function verificarClienteRgIe()
    {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();

        $c = new Cliente();

        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);
        }

        $total = $c->verificarClienteRgIe($p);

        foreach ($total as $t) {
            $data[] = array(
                'total' => $t['total']
            );

        }
        echo json_encode($data);
    }

    public function verificarClienteEmail()
    {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();

        $c = new Cliente();

        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);
        }

        $total = $c->verificarClienteEmail($p);

        foreach ($total as $t) {
            $data[] = array(
                'total' => $t['total']
            );

        }
        echo json_encode($data);
    }

    public function verificarFornecedorCnpj()
    {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();

        $f = new Fornecedor();

        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);
        }

        $total = $f->verificarFornecedorCnpj($p);

        foreach ($total as $t) {
            $data[] = array(
                'total' => $t['total']
            );

        }
        echo json_encode($data);
    }

    public function verificarFornecedorIe()
    {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();

        $f = new Fornecedor();

        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);
        }

        $total = $f->verificarFornecedorIe($p);

        foreach ($total as $t) {
            $data[] = array(
                'total' => $t['total']
            );

        }
        echo json_encode($data);
    }

    public function verificarUsuarioEmail()
    {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();

        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $p = addslashes($_GET['p']);
        }

        $total = $u->verificarUsuarioEmail($p);

        foreach ($total as $t) {
            $data[] = array(
                'total' => $t['total']
            );
        }
        echo json_encode($data);
    }

    public function pegar_cidades()
    {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();

        if (isset($_POST['estado'])) {
            $id_estado = $_POST['estado'];

            $c = new Cidade();

            $cidades = $c->pegar_cidades($id_estado);

            foreach ($cidades as $c) {
                $data[] = array(
                    'id' => $c['id'],
                    'nome' => $c['nome']
                );
            }

        }

        echo json_encode($data);
    }

}

?>