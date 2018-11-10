<?php


class backupController extends controller{

	public function __construct(){
		parent::__construct();
		$u = new Usuario();
		if($u->isLogged() == false){
			header("Location:".BASE_URL.'login');
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


		if($u->hasPermission('backup')){

			$this->loadTemplate('backup', $data);

		}else{
			header("Location:".BASE_URL);
			exit;
		}

	}


	public function gerar_backup(){

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

		if($u->hasPermission('backup')){

			$b = new Backup();

			try{
				$b->gerarBackup();
				$data['msg_sucesso'] = "Sucesso ao gerar backup, o backup foi enviado para email.";
			}catch(Exception $e){
				$data['msg_erro'] = "Ocorreu um erro ao gerar backup.";
			}

			$this->loadTemplate('backup', $data);

		}else{
			header("Location:".BASE_URL);
			exit;
		}

	}

}

?>