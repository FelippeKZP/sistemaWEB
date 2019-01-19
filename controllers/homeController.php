<?php

class homeController extends controller
{

    private $user;

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

        $h = new Home();

        $g = new GrupoPermissao();

        $data['dashboard'] = $u->hasPermission('dashboard');

        $data['status'] = array(
            '0' => 'Pendente',
            '1' => 'Pago');

        $data['total_clientes'] = $h->totalClientes(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'));

        $data['total_vendas'] = $h->totalVendas(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'));

        $data['receita'] = $h->receita(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'));

        $data['despesas'] = $h->despesas(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'));

        $data['lista_dia'] = array();
        for ($q = 30; $q > 0; $q--) {
            $data['lista_dia'][] = date('d/m', strtotime('-' . $q . 'days'));
        }

        $data['grafico_list'] = $h->getGrafico(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'));

        $data['grafico_compra_list'] = $h->getGraficoCompra(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'));

        $data['status_list'] = $h->getGraficoStatus(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'));

        $data['produto_estoque_baixo'] = $h->produtoEstoqueBaixo();


        $this->loadTemplate('home', $data);
    }

    public function sair()
    {
        $u = new Usuario();
        $u->sair();
        header("Location:" . BASE_URL);
    }

}
