<?php

class relatorioController extends controller {

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

        $this->loadTemplate('relatorio/relatorio', $data);
    }

    public function relatorio_cliente() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());


        $this->loadTemplate('relatorio/relatorio_cliente', $data);
    }

    public function relatorio_cliente_pdf() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();

        
        $nome = addslashes($_GET['nome']);
        $periodo1 = addslashes($_GET['periodo1']);
        $periodo2 = addslashes($_GET['periodo2']);

        $c = new Cliente();
        
        $data['cliente_list'] = $c->getRelatorio($nome, $periodo1, $periodo2);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_cliente_pdf', $data);
        $html = ob_get_contents();
        $html = utf8_encode($html);
        ob_end_clean();

        $mpdf = new mPDF();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
       
    }

    public function relatorio_fornecedor() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $this->loadTemplate('relatorio/relatorio_fornecedor', $data);
    }

    public function relatorio_fornecedor_pdf() {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();


        $nome = addslashes($_GET['nome']);
        $periodo1 = addslashes($_GET['periodo1']);
        $periodo2 = addslashes($_GET['periodo2']);

        $f = new Fornecedor();

        $data['fornecedor_list'] = $f->getRelatorio($nome, $periodo1, $periodo2);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_fornecedor_pdf', $data);
        $html = ob_get_contents();
        $html = utf8_encode($html);
        ob_end_clean();

        $mpdf = new mPDF();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function relatorio_grupoPermissao() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());


        $this->loadTemplate('relatorio/relatorio_grupoPermissao', $data);
    }

    public function relatorio_grupoPermissao_pdf() {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();

        $nome = addslashes($_GET['nome']);

        $g = new GrupoPermissao();
        $data['grupo_permissao_list'] = $g->getRelatorio($nome);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_grupoPermissao_pdf', $data);
        $html = ob_get_contents();
        $html = utf8_encode($html);
        ob_end_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

    public function relatorio_grupoProduto() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());



        $this->loadTemplate('relatorio/relatorio_grupoProduto', $data);
    }

    public function relatorio_grupoProduto_pdf() {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();

        $nome = addslashes($_GET['nome']);

        $g = new GrupoProduto();
        $data['grupo_produto_list'] = $g->getRelatorio($nome);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_grupoProduto_pdf', $data);
        $html = ob_get_contents();
        $html = utf8_encode($html);
        ob_end_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

    public function relatorio_loteProdutos() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $this->loadTemplate('relatorio/relatorio_loteProduto', $data);
    }

    public function relatorio_loteProdutos_pdf() {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();

        $numero = addslashes($_GET['nome']);
        $periodo1 = addslashes($_GET['periodo1']);
        $periodo2 = addslashes($_GET['periodo2']);

        $l = new LoteProduto();

        $data['lote_produto_list'] = $l->getRelatorio($numero, $periodo1, $periodo2);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_loteProduto_pdf', $data);
        $html = ob_get_contents();
        $html = utf8_encode($html);
        ob_end_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

    public function relatorio_produto() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $this->loadTemplate('relatorio/relatorio_produto', $data);
    }

    public function relatorio_produto_pdf() {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();

        $numero = addslashes($_GET['nome']);


        $p = new Produto();

        $data['produto_list'] = $p->getRelatorio($numero);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_produto_pdf', $data);
        $html = ob_get_contents();
        $html = utf8_encode($html);
        ob_end_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

    public function relatorio_usuario() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $this->loadTemplate('relatorio/relatorio_usuario', $data);
    }

    public function relatorio_usuario_pdf() {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();

        $email = addslashes($_GET['nome']);

        $data['usuario_list'] = $u->getRelatorio($email);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_usuario_pdf', $data);
        $html = ob_get_contents();
        $html = utf8_encode($html);
        ob_end_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

    public function relatorio_loteProduto() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $this->loadTemplate('relatorio/relatorio_loteProduto', $data);
    }

    public function relatorio_loteProduto_pdf() {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();

        $numero = addslashes($_GET['nome']);
        $periodo1 = addslashes($_GET['periodo1']);
        $periodo2 = addslashes($_GET['periodo2']);

        $l = new LoteProduto();

        $data['lote_produto_list'] = $l->getRelatorio($numero, $periodo1, $periodo2);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_loteProduto_pdf', $data);
        $html = ob_get_contents();
        $html = utf8_encode($html);
        ob_end_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

    public function relatorio_estoqueBaixo() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $this->loadTemplate('relatorio/relatorio_estoqueBaixo', $data);
    }

    public function relatorio_estoquebaixo_pdf() {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();

        $p = new Produto();

        $data['produto_list'] = $p->getRelatorioEstoqueBaixo();

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_estoqueBaixo_pdf', $data);
        $html = ob_get_contents();
        $html = utf8_encode($html);
        ob_end_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

    public function relatorio_produtoMaisVendido() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $this->loadTemplate('relatorio/relatorio_produtoMaisVendido', $data);
    }

    public function relatorio_produtoMaisVendido_pdf() {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();

        $numero = addslashes($_GET['nome']);
        $periodo1 = addslashes($_GET['periodo1']);
        $periodo2 = addslashes($_GET['periodo2']);

        $p = new Produto();

        $data['produto_mais_vendido_list'] = $p->getRelatorioProdutoMaisVendido($numero, $periodo1, $periodo2);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_produtoMaisVendido_pdf', $data);
        $html = ob_get_contents();
        $html = utf8_encode($html);
        ob_end_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

    public function relatorio_historicoEstoque() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();
        $data['notificacao'] = $n->verificarNotificacao($u->getId());

        $this->loadTemplate('relatorio/relatorio_historicoEstoque', $data);
    }

    public function relatorio_historicoEstoque_pdf() {
        $data = array();
        $u = new Usuario();
        $u->setLoggedUser();

        $h = new HistoricoEstoque();

        $periodo1 = $_GET['periodo1'];
        $periodo2 = $_GET['periodo2'];

        $data['historico_estoque_list'] = $h->getRelatorio($periodo1, $periodo2);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');
        
        ob_start();
        $this->loadView('relatorio/relatorio_historicoEstoque_pdf', $data);
        $html = ob_get_contents();
        $html = utf8_encode($html);
        ob_clean();



        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

}
?>

