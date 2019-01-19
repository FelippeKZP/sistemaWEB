<?php

class Usuario extends model
{

    private $permissions;
    private $userInfo;

    public function getList($s = null, $offset, $limit)
    {
        $array = array();

        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT *,(select url from usuario_imagem WHERE usuario_imagem.id_usuario = usuario.id limit 1) as url
               FROM usuario WHERE nome LIKE :nome LIMIT $offset,$limit");
            $sql->bindValue(":nome", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT *, (select url from usuario_imagem WHERE usuario_imagem.id_usuario = usuario.id limit 1) as url
               FROM usuario LIMIT $offset,$limit");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTotal($s)
    {
        if (!empty($s)) {
            $sql = $this->db->prepare("SELECT COUNT(*)as c FROM usuario WHERE nome LIKE :nome");
            $sql->bindValue(":nome", '%' . $s . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT COUNT(*)as c FROM usuario");
            $sql->execute();
        }
        $sql = $sql->fetch();
        return $sql['c'];
    }

    public function getRelatorio($email)
    {
        $array = array();


        if (!empty($email)) {
            $sql = $this->db->prepare("SELECT usuario.id,usuario.nome,usuario.email,grupo_permissao.nome as grupo_permissao
                FROM usuario
                INNER JOIN grupo_permissao ON grupo_permissao.id = usuario.id_grupo_permissao
                WHERE usuario.email LIKE :email");
            $sql->bindValue(":email", '%' . $email . '%');
            $sql->execute();
        } else {
            $sql = $this->db->prepare("SELECT usuario.id,usuario.nome,usuario.email,grupo_permissao.nome as grupo_permissao 
                FROM usuario 
                INNER JOIN grupo_permissao ON grupo_permissao.id = usuario.id_grupo_permissao ");
            $sql->execute();
        }

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }


    public function verificarId($id)
    {

        $sql = $this->db->prepare("SELECT id FROM usuario WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarUsuarioEmail($p)
    {
        $array = array();
        $sql = $this->db->prepare("SELECT COUNT(id) as total FROM usuario WHERE email = :email");
        $sql->bindValue(":email", $p);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;

    }


    public function getInfo($id)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM usuario WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $array['fotos'] = array();

            $sql = $this->db->prepare("SELECT id,url FROM usuario_imagem WHERE usuario_imagem.id_usuario = :id_usuario");
            $sql->bindValue(":id_usuario", $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $array['fotos'] = $sql->fetchAll();
            }
        }
        return $array;
    }

    public function usuario_add($nome, $email, $senha, $id_grupo_permissao, $status, $fotos)
    {

        $sql = $this->db->prepare("INSERT INTO usuario(nome,email,senha,id_grupo_permissao,status) 
            VALUES(:nome,:email,:senha,:id_grupo_permissao,:status)");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", md5($senha));
        $sql->bindValue(":id_grupo_permissao", $id_grupo_permissao);
        $sql->bindValue(":status", $status);
        $sql->execute();

        $id_usuario = $this->db->lastInsertId();

        if (count($fotos) > 0) {
            for ($q = 0; $q < count($fotos['tmp_name']); $q++) {
                $tipo = $fotos['type'][$q];
                if (in_array($tipo, array('image/jpeg', 'image/png'))) {
                    $tmpname = md5(time() . rand(0, 9999)) . '.jpg';
                    move_uploaded_file($fotos['tmp_name'][$q], 'assets/imagens/usuarios/' . $tmpname);

                    list($width_orig, $height_orig) = getimagesize('assets/imagens/usuarios/' . $tmpname);

                    $ratio = $width_orig / $height_orig;

                    $width = 500;
                    $height = 500;

                    if ($width / $height > $ratio) {
                        $width = $height * $ratio;
                    } else {
                        $height = $width / $ratio;
                    }

                    $img = imagecreatetruecolor($width, $height);

                    if ($tipo == 'image/jpeg') {
                        $origi = imagecreatefromjpeg('assets/imagens/usuarios/' . $tmpname);
                    } elseif ($tipo == 'image/png') {
                        $origi = imagecreatefrompng('assets/imagens/usuarios/' . $tmpname);
                    }

                    imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

                    imagejpeg($img, 'assets/imagens/usuarios/' . $tmpname, 80);

                    $sql = $this->db->prepare("INSERT INTO usuario_imagem(id_usuario,url) VALUES(:id_usuario,:url)");
                    $sql->bindValue(":id_usuario", $id_usuario);
                    $sql->bindValue(":url", $tmpname);
                    $sql->execute();
                }
            }
        }

    }

    public function usuario_editar($nome, $email, $id_grupo_permissao, $status, $fotos, $id)
    {
        $sql = $this->db->prepare("UPDATE usuario SET nome = :nome, email = :email, id_grupo_permissao = :id_grupo_permissao, status = :status WHERE id = :id");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":email", $email);
        //$sql->bindValue(":senha", md5($senha));
        $sql->bindValue(":id_grupo_permissao", $id_grupo_permissao);
        $sql->bindValue(":status", $status);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if (count($fotos) > 0) {
            for ($q = 0; $q < count($fotos['tmp_name']); $q++) {
                $tipo = $fotos['type'][$q];
                if (in_array($tipo, array('image/jpeg', 'image/png'))) {
                    $tmpname = md5(time() . rand(0, 9999)) . '.jpg';
                    move_uploaded_file($fotos['tmp_name'][$q], 'assets/imagens/usuarios/' . $tmpname);

                    list($width_orig, $height_orig) = getimagesize('assets/imagens/usuarios/' . $tmpname);
                    $ratio = $width_orig / $height_orig;

                    $width = 500;
                    $height = 500;

                    if ($width / $height > $ratio) {
                        $width = $height * $ratio;
                    } else {
                        $height = $width / $ratio;
                    }

                    $img = imagecreatetruecolor($width, $height);

                    if ($tipo == 'image/jpeg') {
                        $origi = imagecreatefromjpeg('assets/imagens/usuarios/' . $tmpname);
                    } elseif ($tipo == 'image/png') {
                        $origi = imagecreatefrompng('assets/imagens/usuarios/' . $tmpname);
                    }

                    imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

                    imagejpeg($img, 'assets/imagens/usuarios/' . $tmpname, 80);

                    $sql = $this->db->prepare("INSERT INTO usuario_imagem(id_usuario,url) VALUES(:id_usuario,:url)");
                    $sql->bindValue(":id_usuario", $id);
                    $sql->bindValue(":url", $tmpname);
                    $sql->execute();
                }
            }
        }
    }

    public function usuario_deletar($id)
    {

        $sql = $this->db->prepare("DELETE FROM usuario_imagem WHERE id_usuario = :id_usuario");
        $sql->bindValue(":id_usuario", $id);
        $sql->execute();

        $sql = $this->db->prepare("DELETE FROM usuario WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function excluir_imagem($id)
    {
        $id_usuario = 0;

        $sql = $this->db->prepare("SELECT id_usuario FROM usuario_imagem WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $id_usuario = $row['id_usuario'];
        }

        $sql = $this->db->prepare("DELETE FROM usuario_imagem WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        return $id_usuario;
    }

    public function isLogged()
    {

        if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
            return true;
        } else {
            return false;
        }
    }

    public function sair()
    {
        unset($_SESSION['ccUser']);
    }

    public function Login($email, $senha)
    {
        $sql = $this->db->prepare("SELECT * FROM usuario WHERE email = :email AND senha = :senha AND status = 1");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", md5($senha));
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $_SESSION['ccUser'] = $row['id'];
            return true;
        } else {
            return false;
        }
    }

    public function setLoggedUser()
    {
        if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
            $id = $_SESSION['ccUser'];

            $sql = $this->db->prepare("SELECT *,(select url from usuario_imagem WHERE id_usuario =  :id_usuario LIMIT 1) as url FROM usuario WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->bindValue(":id_usuario", $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $this->userInfo = $sql->fetch();
                $this->permissions = new GrupoPermissao();
                $this->permissions->setGroup($this->userInfo['id_grupo_permissao']);
            }
        }
    }

    public function getNome()
    {
        if (isset($this->userInfo['nome'])) {
            return $this->userInfo['nome'];
        } else {
            return '';
        }
    }

    public function getFoto()
    {
        if (isset($this->userInfo['url'])) {
            return $this->userInfo['url'];
        } else {
            return '';
        }
    }

    public function getId()
    {
        if (isset($this->userInfo['id'])) {
            return $this->userInfo['id'];
        } else {
            return '';
        }
    }


    public function hasPermission($nome)
    {
        return $this->permissions->hasPermission($nome);
    }

    public function getCombo($id)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM usuario WHERE id NOT IN(:id)");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function esqueciSenha($email)
    {

        $sql = $this->db->prepare("SELECT id FROM usuario WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {

            $row = $sql->fetch();
            $id_usuario = $row['id'];

            $token = md5(time() . rand(0, 99999) . rand(0, 99999));

            $sql = $this->db->prepare("INSERT INTO usuario_token(id_usuario,hash,data,status)
             VALUES(:id_usuario,:hash,:data,0)");
            $sql->bindValue(":id_usuario", $id_usuario);
            $sql->bindValue(":hash", $token);
            $sql->bindValue(":data", date('Y-m-d H:i', strtotime('+2 months')));
            $sql->execute();


            require 'bibliotecas/PHPMailer/class.phpmailer.php';
            $mail = new PHPMailer();

            $mail->SetLanguage("br");
            $mail->IsSMTP();
            $mail->IsHTML(true);
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->AuthType = 'NTLM';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->Username = 'felippe.s@edu.unipar.br';
            $mail->Password = 'CAMARO123';
            $mail->CharSet = 'UTF-8';


            $mail->setFrom('felipekzp0@gmail.com', 'Felippe');
            //$mail->FromName('Felippe');
            $mail->AddAddress($email);

            $mail->isHTML(true);
            $link = "http://localhost/sistema/login/redefinir?token=" . $token;
            $mail->Subject = 'Redefinição De Senha Do Dia ' . date('d/m/Y');
            $mail->Body = 'Click no link para redefinir sua senha:' . $link;


            $mail->send();


            return true;
        } else {
            return false;
        }
    }

    public function verificarToken($token)
    {
        $sql = $this->db->prepare("SELECT * FROM usuario_token WHERE hash = :hash AND status = 0 AND data > NOW()");
        $sql->bindValue(":hash", $token);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function mudarSenha($senha, $token)
    {
        $sql = $this->db->prepare("SELECT id_usuario FROM usuario_token WHERE hash = :hash");
        $sql->bindValue(":hash", $token);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $id_usuario = $sql['id_usuario'];
        }

        $sql = $this->db->prepare("UPDATE usuario SET senha = :senha WHERE id = :id");
        $sql->bindValue(":senha", md5($senha));
        $sql->bindValue(":id", $id_usuario);
        $sql->execute();

        $sql = $this->db->prepare("UPDATE usuario_token  SET status = 1 WHERE hash = :hash");
        $sql->bindValue(":hash", $token);
        $sql->execute();
    }

}

?>
