<?php

class loginController extends controller {

    public function index() {
        $data = array();

        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);

            $u = new Usuario();

            if ($u->Login($email, $senha)) {
                header("Location:" . BASE_URL . 'home');
                exit;
            } else {
                $data['error'] = 'E-mail e/ou senha incorretos.';
            }
        }
        $this->loadView('login', $data);
    }
    
    public function esqueci_senha(){
        $data = array();
        
        
        $this->loadView('esqueci_senha', $data);
    }
    
    public function sair(){
        $u = new Usuario();
        $u->sair();
        header("Location:".BASE_URL);
    }

}

?>
