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

        if($u->hasPermission('relatório')){

            $this->loadTemplate('relatorio/relatorio', $data);

        }else{
            header("Location:".BASE_URL);
            exit;
        }
    }

    public function relatorio_cliente() {
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

        if($u->hasPermission('relatório')){

            $this->loadTemplate('relatorio/relatorio_cliente', $data);

        }else{
            header("Location:".BASE_URL);
            exit;
        }
    }

    public function relatorio_cliente_pdf() {
        $data = array();
        $u = new Usuario();
        $n = new Notificacao();
        $u->setLoggedUser();
        $data['usuario_nome'] = $u->getNome();
        $data['usuario_foto'] = $u->getFoto();

        
        if($u->hasPermission('relatório')){

            $nome = addslashes($_GET['nome']);
            $periodo1 = addslashes($_GET['periodo1']);
            $periodo2 = addslashes($_GET['periodo2']);

            $c = new Cliente();

            if($c->getRelatorio($nome,$periodo1,$periodo2) == null){
                echo '<span style="color:red">Não foi encontrado nenhum registrado.</span>';
            }else{
               $data['cliente_list'] = $c->getRelatorio($nome, $periodo1, $periodo2);

               $data['filtros'] = $_GET;

               $this->loadLibrary('mpdf60/mpdf');

               ob_start();
               $this->loadView('relatorio/relatorio_cliente_pdf', $data);
               $html = ob_get_contents();
      //  $html = utf8_encode($html);
               ob_end_clean();

               $mpdf = new mPDF();
               $mpdf->WriteHTML($html);
               $mpdf->Output();

           }

       }else{
        header("Location:".BASE_URL);
        exit;
    }
}

public function relatorio_fornecedor() {
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
    $data['relatório'] = $u->hasPermission('relatório');

    if($u->hasPermission('relatório')){

        $this->loadTemplate('relatorio/relatorio_fornecedor', $data);

    }else{
        header("Location:".BASE_URL);
        exit;
    }
}

public function relatorio_fornecedor_pdf() {
    $data = array();
    $u = new Usuario();
    $u->setLoggedUser();
    $data['usuario_nome'] = $u->getNome();
    $data['usuario_foto'] = $u->getFoto();


    if($u->hasPermission('relatório')){

        $nome = addslashes($_GET['nome']);
        $periodo1 = addslashes($_GET['periodo1']);
        $periodo2 = addslashes($_GET['periodo2']);

        $f = new Fornecedor();

        if($f->getRelatorio($nome,$periodo1,$periodo2) == false){
         echo '<span style="color:red">Não foi encontrado nenhum registrado.</span>';
     }else{
        $data['fornecedor_list'] = $f->getRelatorio($nome, $periodo1, $periodo2);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_fornecedor_pdf', $data);
        $html = ob_get_contents();
       // $html = utf8_encode($html);
        ob_end_clean();

        $mpdf = new mPDF();
        $mpdf->WriteHTML($html);
        $mpdf->Output();

    }

}else{
    header("Location:".BASE_URL);
    exit;
}
}

public function relatorio_funcaoFuncionario() {
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

    if($u->hasPermission('relatório')){

        $this->loadTemplate('relatorio/relatorio_funcaoFuncionario', $data);

    }else{
        header("Location:".BASE_URL);
        exit;
    }
}

public function relatorio_funcaoFuncionario_pdf() {
    $data = array();
    $u = new Usuario();
    $u->setLoggedUser();

    if($u->hasPermission('relatório')){

        $nome = addslashes($_GET['nome']);

        $f = new FuncaoFuncionario();

        if($f->getRelatorio($nome) == null){
           echo '<span style="color:red">Não foi encontrado nenhum registrado.</span>';
       }else{

        $data['funcao_funcionario_list'] = $f->getRelatorio($nome);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_funcaoFuncionario_pdf', $data);
        $html = ob_get_contents();
       // $html = utf8_encode($html);
        ob_end_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

}else{
    header("Location:".BASE_URL);
    exit;
}
}

public function relatorio_funcionario() {
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

    if($u->hasPermission('relatório')){

        $this->loadTemplate('relatorio/relatorio_funcionario', $data);

    }else{
        header("Location:".BASE_URL);
        exit;
    }
}

public function relatorio_funcionario_pdf() {
    $data = array();
    $u = new Usuario();
    $n = new Notificacao();
    $u->setLoggedUser();

    if($u->hasPermission('relatório')){

        $nome = addslashes($_GET['nome']);
        $periodo1 = addslashes($_GET['periodo1']);
        $periodo2 = addslashes($_GET['periodo2']);

        $f = new Funcionario();

        if($f->getRelatorio($nome,$periodo1,$periodo2) == null){
         echo '<span style="color:red">Não foi encontrado nenhum registrado.</span>';
     }else{
        $data['funcionario_list'] = $f->getRelatorio($nome, $periodo1, $periodo2);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_funcionario_pdf', $data);
        $html = ob_get_contents();
      //  $html = utf8_encode($html);
        ob_end_clean();

        $mpdf = new mPDF();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

}else{
    header("Location:".BASE_URL);
    exit;
}

}


public function relatorio_grupoPermissao() {
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

    if($u->hasPermission('relatório')){

        $this->loadTemplate('relatorio/relatorio_grupoPermissao', $data);

    }else{
        header("Location:".BASE_URL);
        exit;
    }
}

public function relatorio_grupoPermissao_pdf() {
    $data = array();
    $u = new Usuario();
    $u->setLoggedUser();
    $data['usuario_nome'] = $u->getNome();
    $data['usuario_foto'] = $u->getFoto();

    if($u->hasPermission('relatório')){

        $nome = addslashes($_GET['nome']);

        $g = new GrupoPermissao();

        if($g->getRelatorio($nome) == null){
           echo '<span style="color:red">Não foi encontrado nenhum registrado.</span>';
       }else{

        $data['grupo_permissao_list'] = $g->getRelatorio($nome);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_grupoPermissao_pdf', $data);
        $html = ob_get_contents();
       // $html = utf8_encode($html);
        ob_end_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

}else{
    header("Location:".BASE_URL);
    exit;
}
}

public function relatorio_grupoProduto() {
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

    if($u->hasPermission('relatório')){

        $this->loadTemplate('relatorio/relatorio_grupoProduto', $data);
    }else{
        header("Location:".BASE_URL);
        exit;
    }
}

public function relatorio_grupoProduto_pdf() {
    $data = array();
    $u = new Usuario();
    $u->setLoggedUser();

    if($u->hasPermission('relatório')){

        $nome = addslashes($_GET['nome']);

        $g = new GrupoProduto();

        if($g->getRelatorio($nome) == null){
         echo '<span style="color:red">Não foi encontrado nenhum registrado.</span>';
     }else{

        $data['grupo_produto_list'] = $g->getRelatorio($nome);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_grupoProduto_pdf', $data);
        $html = ob_get_contents();
       // $html = utf8_encode($html);
        ob_end_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();

    }

}else{
    header("Location:".BASE_URL);
    exit;
}
}

public function relatorio_loteProdutos() {
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

    if($u->hasPermission('relatório')){

        $this->loadTemplate('relatorio/relatorio_loteProduto', $data);

    }else{
        header("Location:".BASE_URL);
        exit;
    }
}

public function relatorio_loteProdutos_pdf() {
    $data = array();
    $u = new Usuario();
    $u->setLoggedUser();
    $data['usuario_nome'] = $u->getNome();
    $data['usuario_foto'] = $u->getFoto();

    if($u->hasPermission('relatório')){

        $numero = addslashes($_GET['nome']);
        $periodo1 = addslashes($_GET['periodo1']);
        $periodo2 = addslashes($_GET['periodo2']);

        $l = new LoteProduto();

        if($l->getRelatorio($nome,$periodo1,$periodo1)){
           echo '<span style="color:red">Não foi encontrado nenhum registrado.</span>';
       }else{

        $data['lote_produto_list'] = $l->getRelatorio($numero, $periodo1, $periodo2);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_loteProduto_pdf', $data);
        $html = ob_get_contents();
       // $html = utf8_encode($html);
        ob_end_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();

    }

}else{
    header("Location:".BASE_URL);
    exit;
}
}

public function relatorio_produto() {
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

    if($u->hasPermission('relatório')){

        $this->loadTemplate('relatorio/relatorio_produto', $data);

    }else{
        header("Location:".BASE_URL);
        exit;
    }
}

public function relatorio_produto_pdf() {
    $data = array();
    $u = new Usuario();
    $u->setLoggedUser();
    $data['usuario_nome'] = $u->getNome();
    $data['usuario_foto'] = $u->getFoto();

    if($u->hasPermission('relatório')){

        $numero = addslashes($_GET['nome']);

        $p = new Produto();

        if($p->getRelatorio($numero) == null){
         echo '<span style="color:red">Não foi encontrado nenhum registrado.</span>';
     }else{

        $data['produto_list'] = $p->getRelatorio($numero);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_produto_pdf', $data);
        $html = ob_get_contents();
      //  $html = utf8_encode($html);
        ob_end_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();

    }

}else{
    header("Location:".BASE_URL);
    exit;
}
}

public function relatorio_usuario() {
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

    if($u->hasPermission('relatório')){

        $this->loadTemplate('relatorio/relatorio_usuario', $data);

    }else{
        header("Location:".BASE_URL);
        exit;
    }
}

public function relatorio_usuario_pdf() {
    $data = array();
    $u = new Usuario();
    $u->setLoggedUser();
    $data['usuario_nome'] = $u->getNome();
    $data['usuario_foto'] = $u->getFoto();

    if($u->hasPermission('relatório')){

        $email = addslashes($_GET['nome']);

        if($u->getRelatorio($email) == false){
         echo '<span style="color:red">Não foi encontrado nenhum registrado.</span>';
     }else{

        $data['usuario_list'] = $u->getRelatorio($email);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_usuario_pdf', $data);
        $html = ob_get_contents();
      //  $html = utf8_encode($html);
        ob_end_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

}else{
    header("Location:".BASE_URL);
    exit;
}
}

public function relatorio_loteProduto() {
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

    $this->loadTemplate('relatorio/relatorio_loteProduto', $data);
}

public function relatorio_loteProduto_pdf() {
    $data = array();
    $u = new Usuario();
    $u->setLoggedUser();
    $data['usuario_nome'] = $u->getNome();
    $data['usuario_foto'] = $u->getFoto();

    if($u->hasPermission('relatório')){

        $numero = addslashes($_GET['nome']);
        $periodo1 = addslashes($_GET['periodo1']);
        $periodo2 = addslashes($_GET['periodo2']);

        $l = new LoteProduto();

        if($l->getRelatorio($numero,$periodo1,$periodo2) == null){
           echo '<span style="color:red">Não foi encontrado nenhum registrado.</span>';
       }else{

        $data['lote_produto_list'] = $l->getRelatorio($numero, $periodo1, $periodo2);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_loteProduto_pdf', $data);
        $html = ob_get_contents();
        //$html = utf8_encode($html);
        ob_end_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

}else{
    header("Location:".BASE_URL);
    exit;
}
}

public function relatorio_estoqueBaixo() {
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

    if($u->hasPermission('relatório')){

        $this->loadTemplate('relatorio/relatorio_estoqueBaixo', $data);

    }else{
        header("Location:".BASE_URL);
        exit;
    }
}

public function relatorio_estoquebaixo_pdf() {
    $data = array();
    $u = new Usuario();
    $u->setLoggedUser();
    $data['usuario_nome'] = $u->getNome();
    $data['usuario_foto'] = $u->getFoto();

    if($u->hasPermission('relatório')){

        $p = new Produto();

        if($p->getRelatorioEstoqueBaixo() ==null){
         echo '<span style="color:red">Não foi encontrado nenhum registrado.</span>';
     }else{

        $data['produto_list'] = $p->getRelatorioEstoqueBaixo();

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_estoqueBaixo_pdf', $data);
        $html = ob_get_contents();
        //$html = utf8_encode($html);
        ob_end_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

}else{
    header("Location:".BASE_URL);
    exit;
}
}

public function relatorio_produtoMaisVendido() {
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

    if($u->hasPermission('relatório')){

        $this->loadTemplate('relatorio/relatorio_produtoMaisVendido', $data);

    }else{
        header("Location:".BASE_URL);
        exit;
    }
}

public function relatorio_produtoMaisVendido_pdf() {
    $data = array();
    $u = new Usuario();
    $u->setLoggedUser();
    $data['usuario_nome'] = $u->getNome();
    $data['usuario_foto'] = $u->getFoto();

    if($u->hasPermission('relatório')){

        $numero = addslashes($_GET['nome']);
        $periodo1 = addslashes($_GET['periodo1']);
        $periodo2 = addslashes($_GET['periodo2']);

        $p = new Produto();

        if($p->getRelatorioProdutoMaisVendido($numero,$periodo1,$periodo2) == null){
           echo '<span style="color:red">Não foi encontrado nenhum registrado.</span>';
       }else{

        $data['produto_mais_vendido_list'] = $p->getRelatorioProdutoMaisVendido($numero, $periodo1, $periodo2);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_produtoMaisVendido_pdf', $data);
        $html = ob_get_contents();
       // $html = utf8_encode($html);
        ob_end_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();

    }

}else{
    header("Location:".BASE_URL);
    exit;
}
}

public function relatorio_historicoEstoque() {
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

    if($U->hasPermission('relatório')){

        $this->loadTemplate('relatorio/relatorio_historicoEstoque', $data);

    }else{
        header("Location:".BASE_URL);
        exit;
    }
}

public function relatorio_historicoEstoque_pdf() {
    $data = array();
    $u = new Usuario();
    $u->setLoggedUser();


    if($u->hasPermission('relatório')){

        $h = new HistoricoEstoque();

        $periodo1 = addslashes($_GET['periodo1']);
        $periodo2 = addslashes($_GET['periodo2']);


        if($h->getRelatorio($periodo1,$periodo2) == null){
         echo '<span style="color:red">Não foi encontrado nenhum registrado.</span>';
     }else{
        $data['historico_estoque_list'] = $h->getRelatorio($periodo1, $periodo2);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_historicoEstoque_pdf', $data);
        $html = ob_get_contents();
        //$html = utf8_encode($html);
        ob_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

}else{
    header("Location:".BASE_URL);
    exit;
}
}

public function relatorio_compra() {
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

    $this->loadTemplate('relatorio/relatorio_compra', $data);
}

public function relatorio_compra_pdf() {
    $data = array();
    $u = new Usuario();
    $u->setLoggedUser();

    if($u->hasPermission('relatório')){

        $c = new Compra();

        $nome = addslashes($_GET['nome']);
        $periodo1 = addslashes($_GET['periodo1']);
        $periodo2 = addslashes($_GET['periodo2']);

        if($c->getRelatorio($nome,$periodo1,$periodo2) == null){
           echo '<span style="color:red">Não foi encontrado nenhum registrado.</span>';
       }else{

        $data['compra_list'] = $c->getRelatorio($nome,$periodo1, $periodo2);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_compra_pdf', $data);
        $html = ob_get_contents();
        //$html = utf8_encode($html);
        ob_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

}else{
    header("Location:".BASE_URL);
    exit;
}
}

public function relatorio_contas_pagar() {
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

    if($u->hasPermission('relatório')){

        $this->loadTemplate('relatorio/relatorio_contas_pagar', $data);

    }else{
        header("Location:".BASE_URL);
        exit;
    }
}

public function relatorio_contas_pagar_pdf() {
    $data = array();
    $u = new Usuario();
    $u->setLoggedUser();

    if($u->hasPermission('relatório')){

        $c = new ContaPagar();

        $data['tipo'] = array(
            '0' => 'Água',
            '1' => 'Aluguel',
            '2' => 'Compra',
            '3' => 'Internet',
            '4' => 'Telefone',
            '5' => 'Luz',
            '6' => 'Outros tipo de conta'
        );

        $data['status'] = array(
            '0' => 'Pendente',
            '1' => 'Pago'
        );

        $nome = addslashes($_GET['nome']);
        $periodo1 = addslashes($_GET['periodo1']);
        $periodo2 = addslashes($_GET['periodo2']);

        if($c->getRelatorio($nome,$periodo1,$periodo2) == null){
         echo '<span style="color:red">Não foi encontrado nenhum registrado.</span>';
     }else{

        $data['conta_pagar_list'] = $c->getRelatorio($nome,$periodo1, $periodo2);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_contas_pagar_pdf', $data);
        $html = ob_get_contents();
        //$html = utf8_encode($html);
        ob_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

}else{
    header("Location:".BASE_URL);
    exit;
}
}

public function relatorio_contas_receber() {
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

    if($u->hasPermission('relatório')){

        $this->loadTemplate('relatorio/relatorio_contas_receber', $data);

    }else{
        header("Location:".BASE_URL);
        exit;
    }
}

public function relatorio_contas_receber_pdf() {
    $data = array();
    $u = new Usuario();
    $u->setLoggedUser();

    if($u->hasPermission('relatório')){

        $c = new ContaReceber();

        $data['tipo_pag'] = array(
            '0' => 'Á Vista',
            '1' => 'A Prazo'
        );

        $data['status'] = array(
            '0' => 'Pendente',
            '1' => 'Pago'
        );

        $nome = addslashes($_GET['nome']);
        $periodo1 = addslashes($_GET['periodo1']);
        $periodo2 = addslashes($_GET['periodo2']);

        if($c->getRelatorio($nome,$periodo1,$periodo2) == null){
           echo '<span style="color:red">Não foi encontrado nenhum registrado.</span>';
       }else{

        $data['conta_list'] = $c->getRelatorio($nome,$periodo1, $periodo2);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_contas_receber_pdf', $data);
        $html = ob_get_contents();
        //$html = utf8_encode($html);
        ob_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

}else{
    header("Location:".BASE_URL);
    exit;
}

}

public function relatorio_venda() {
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

    if($u->hasPermission('relatório')){

        $this->loadTemplate('relatorio/relatorio_venda', $data);

    }else{
        header("Location:".BASE_URL);
        exit;
    }
}

public function relatorio_venda_pdf() {
    $data = array();
    $u = new Usuario();
    $u->setLoggedUser();

    if($u->hasPermissio('relatório')){

        $v = new Venda();

        $data['tipo'] = array(
            '0' => 'Á Vista',
            '1' => 'A Prazo');

        $nome = addslashes($_GET['nome']);
        $periodo1 = addslashes($_GET['periodo1']);
        $periodo2 = addslashes($_GET['periodo2']);

        if($v->getRelatorio($nome,$periodo1,$periodo2) == null){
           echo '<span style="color:red">Não foi encontrado nenhum registrado.</span>';
       }else{

        $data['venda_list'] = $v->getRelatorio($nome,$periodo1, $periodo2);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_venda_pdf', $data);
        $html = ob_get_contents();
        //$html = utf8_encode($html);
        ob_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();

    }

}else{
    header("Location:".BASE_URL);
    exit;
}
}

public function relatorio_perda() {
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

    if($u->hasPermission('relatório')){

        $this->loadTemplate('relatorio/relatorio_perda', $data);

    }else{
        header("Location:".BASE_URL);
        exit;
    }
}

public function relatorio_perda_pdf() {
    $data = array();
    $u = new Usuario();
    $u->setLoggedUser();

    if($u->hasPermission('relatório')){

        $p = new Perda();

        $nome = addslashes($_GET['nome']);
        $periodo1 = addslashes($_GET['periodo1']);
        $periodo2 = addslashes($_GET['periodo2']);

        if($p->getRelatorio($nome,$periodo1,$periodo2) == null){
           echo '<span style="color:red">Não foi encontrado nenhum registrado.</span>';
       }else{

        $data['perda_list'] = $p->getRelatorio($nome,$periodo1, $periodo2);
        $data['filtros'] = $_GET;

        $this->loadLibrary('mpdf60/mpdf');

        ob_start();
        $this->loadView('relatorio/relatorio_perda_pdf', $data);
        $html = ob_get_contents();
        //$html = utf8_encode($html);
        ob_clean();

        $m = new mPDF();
        $m->WriteHTML($html);
        $m->Output();
    }

}else{
    header("Location:".BASE_URL);
    exit;
}
}

}
?>

