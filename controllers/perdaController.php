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

		if($u->hasPermission('perda')){

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

		}else{
			header("Location:".BASE_URL);
			exit;
		}
	}

	public function perda_vizualizar($id){
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

		if($u->hasPermission('perda')){

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

		}else{
			header("Location:".BASE_URL);
			exit;
		}
	}

	public function perda_deletar($id){
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

		if($u->hasPermission('perda')){

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

		}else{
			header("Location:".BASE_URL);
			exit;
		}

	}
}

?>