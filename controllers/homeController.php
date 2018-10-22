<?php

class homeController extends controller {

    private $user;

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

        $h = new Home();

        $data['status'] = array(
            '0' => 'Pendente',
            '1' => 'Pago');

        $data['total_clientes'] = $h->totalClientes(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'));

        $data['total_vendas'] = $h->totalVendas(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'));

        $data['receita'] = $h->receita(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'));

        $data['despesas'] = $h->despesas(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'));

        $data['lista_dia'] = array();
        for($q=30;$q>0;$q--){
            $data['lista_dia'][] = date('d/m',strtotime('-'.$q.'days'));
        }

        $data['grafico_list'] = $h->getGrafico(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'));

        $data['grafico_compra_list'] = $h->getGraficoCompra(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'));

        $data['status_list'] = $h->getGraficoStatus(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'));

        $data['produto_estoque_baixo'] = $h->produtoEstoqueBaixo();


        $this->loadTemplate('home', $data);
    }

    public function sair() {
        $u = new Usuario();
        $u->sair();
        header("Location:" . BASE_URL);
    }

}
