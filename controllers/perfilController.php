<?php

class perfilController extends controller{

	public function __construct(){
		parent :: __construct();

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

		$p = new Perfil();

		if(isset($_POST['senha']) && !empty($_POST['senha'])){
			$senha_atual = addslashes($_POST['senha_atual']);
			$senha = addslashes($_POST['senha']);

			if($p->verificarSenha($senha_atual,$u->getId())){
				try{
					$p->trocarSenha($senha,$u->getId());
					$data['msg_sucesso'] = "Senha alterado com sucesso.";
				}catch(Exception $ex){
					$data['msg_erro'] = "Ocorreu um erro alterar sua senha.";
				}

			}else{
				$data['msg_erro'] =  "Senha atual é diferente a qual é informada.";
			}

		}

		$this->loadTemplate('perfil/perfil', $data);
	}
}

?>