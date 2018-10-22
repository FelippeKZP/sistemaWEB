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


		$this->loadTemplate('backup', $data);
	}


	public function gerar_backup(){

		$data = array();
		$u = new Usuario();
		$n = new Notificacao();
		$u->setLoggedUser();
		$data['usuario_nome'] = $u->getNome();
		$data['usuario_foto'] = $u->getFoto();
		$data['notificacao'] = $n->verificarNotificacao($u->getId());

		$b = new Backup();

		try{
			$b->gerarBackup();
			$data['msg_sucesso'] = "Sucesso ao gerar backup, o backup foi enviado para email.";
		}catch(Exception $e){
			$data['msg_erro'] = "Ocorreu um erro ao gerar backup.";
		}

		$this->loadTemplate('backup', $data);

	}

}

?>