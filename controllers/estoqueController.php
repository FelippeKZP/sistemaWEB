<?php 

class estoqueController extends controller{

	public function __construct(){
		parent::__construct();

		$u = new Usuario();

		if($u->isLogged() == false){
			header("Location:".BASE_URL.'login');
			exit;
		}
	}

	public function index(){
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

		if($u->hasPermission('estoque')){

			$e = new  Estoque();

			$s = '';

			$data['filtros'] =  $_GET;

			$limit = 10;

			$data['limit'] = 10;

			$total =  $e->getTotal($s);

			$data['total'] =  $e->getTotal($s);

			$data['paginas'] = ceil($total /  $limit);

			$data['paginaAtual'] = 1;
			if(!empty($_GET['p'])){
				$data['paginaAtual'] = intval($_GET['p']);
			}

			$offset = ($data['paginaAtual'] * $limit) - $limit;

			$data['offset'] = ($data['paginaAtual'] * $limit) - $limit;

			$data['max'] = 2;

			if(!empty($_GET['searchs'])){
				$s =  addslashes($_GET['searchs']);
			}

			$data['estoque_list'] =  $e->getList($s,$offset,$limit);

			$data['valor_estoque'] = $e->getValorEstoque($s);

			$data['quantidade_estoque'] =  $e->getQuantidadeEstoque($s);

			$this->loadTemplate('estoque/estoque', $data);

		}else{
			header("Location:".BASE_URL);
			exit;
		}

	}

}

?>