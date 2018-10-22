<?php

class suporteController extends controller{

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

		$s = new suporte();

		if(isset($_POST['assunto']) && !empty($_POST['assunto'])){
			$assunto = addslashes($_POST['assunto']);
			$mensagem = addslashes($_POST['mensagem']);

			try{
				$s->envioMensagem($assunto,$mensagem,$u->getId());
				$data['msg_sucesso'] = 'Obrigado! Nossa equipe irá te responder em algumas horas.';
			}catch (Exception $ex) {
				$data['msg_erro'] = "Ocorreu um Erro ao enviar mensagem.";
			}
		}

		$this->loadTemplate('suporte', $data);
	}
}

?>