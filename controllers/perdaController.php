<?php

class perdaController extends controller{
	
	public function __construct(){
		parent ::__construct();
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
		$data['usuario_foto'] = $u->getFoto();
		$data['usuario_nome'] = $u->getNome();
		$data['notificacao'] = $n->verificarNotificacao($u->getId());

		$p = new Perda();

		$s = '';

		$data['filtros'] = $_GET;

		$limit = 10;

		$data['limit'] = 10;

		$total =  $p->getTotal($s);

		$data['paginas'] =ceil($total / $limit);

		$data['paginaAtual'] = 1;
		if(!empty($_GET['p'])){
			$data['paginaAtual'] = intval($_GET['p']);
		}

		$offset = ($data['paginaAtual'] * $limit) - $limit;


		if(!empty($_GET['searchs'])){
			$s = addslashes($_GET['searchs']);
		}

		$data['perda_list'] = $p->getList($s, $offset,$limit);

		$this->loadTemplate('perda/perda',$data);
	}

	public function perda_vizualizar($id){
		$data = array();
		$u = new Usuario();
		$n = new Notificacao();
		$u->setLoggedUser();
		$data['usuario_nome'] = $u->getNome();
		$data['usuario_foto'] = $u->getFoto();
		$data['notificacao'] = $n->verificarNotificacao($u->getId());

		$p = new Perda();

		if(isset($id) && !empty($id)){
			if($p->verificarId($id)){

			}else{
				header("Location:".BASE_URL.'perda');
			}
		}else{
			header("Location:".BASE_URL.'perda');
		}

		$data['perda_vizualizar_list'] = $p->getInfo($id);


		$this->loadTemplate('perda/perda_vizualizar', $data);
	}

	public function perda_deletar($id){
		$data = array();
		$u = new Usuario();
		$n = new Notificacao();
		$u->setLoggedUser();
		$data['usuario_nome'] = $u->getNome();
		$data['usuario_foto'] = $u->getFoto();
		$data['notificacao'] = $n->verificarNotificacao($u->getId());


		$p = new Perda();


		if(isset($id) && !empty($id)){
			if($p->verificarId($id)){

			}else{
				header("Location:".BASE_URL.'perda');
			}
		}else{
			header("Location:".BASE_URL.'perda');
		}

		try{
			$p->perda_deletar($id);
			$data['msg_sucesso'] = "Sucesso ao excluir a perda";
		}catch(Exception $e){
			$data['msg_erro'] = "Esta Função de Funcionário Já Esta Associado.";
		}
		

		$s = '';

		$data['filtros'] = $_GET;

		$limit = 10;

		$data['limit'] = 10;

		$total =  $p->getTotal($s);

		$data['paginas'] =ceil($total / $limit);

		$data['paginaAtual'] = 1;
		if(!empty($_GET['p'])){
			$data['paginaAtual'] = intval($_GET['p']);
		}

		$offset = ($data['paginaAtual'] * $limit) - $limit;


		if(!empty($_GET['searchs'])){
			$s = addslashes($_GET['searchs']);
		}

		$data['perda_list'] = $p->getList($s, $offset,$limit);

		$this->loadTemplate('perda/perda',$data);

	}
}

?>