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
	}

}

?>