<?php


class Suporte extends model{


	public function envioMensagem($assunto,$mensagem,$id_usuario){
		$sql =  $this->db->prepare("INSERT INTO suporte(id_usuario,assunto,mensagem,data) VALUES(:id_usuario,:assunto,:mensagem,NOW())");
		$sql->bindValue(":id_usuario", $id_usuario);
		$sql->bindValue(":assunto", $assunto);
		$sql->bindValue(":mensagem", $mensagem);
		$sql->execute();

		$numero = $this->db->lastInsertId();

		$sql = $this->db->prepare("SELECT email FROM usuario WHERE id = :id_usuario");
		$sql->bindValue(":id_usuario", $id_usuario);
		$sql->execute();

		if($sql->rowCount() > 0){
			$row =  $sql->fetch();
			$email =  $row['email'];
		}

		
		$tipo = array(
			'1' => 'Dúvida',
			'2' => 'Reclamação',
			'3' => 'Sugestão',
			'4' => 'Pedido'
		);


		require 'bibliotecas/PHPMailer/class.phpmailer.php';
		$mail = new PHPMailer();

		$mail->SetLanguage("br");
		$mail->IsSMTP();
		$mail->IsHTML(true);
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
		$mail->AuthType = 'NTLM';
		$mail->Host       = 'smtp.gmail.com';
		$mail->Port       = 465;
		$mail->Username   = 'felippe.s@edu.unipar.br'; 
		$mail->Password   = 'CAMARO123';
		$mail->CharSet = 'UTF-8';


		$mail->setFrom('felippe.s@edu.unipar.br','Felippe');
            //$mail->FromName('Felippe');
		$mail->AddAddress('felipekzp0@gmail.com');
		$mail->AddAddress($email);

		$mail->isHTML(true);
		$mail->Subject = 'Solicitação recebida: #'.$numero.' Assunto:'. $tipo[$assunto];
		$mail->Body    = $mensagem;
            //$mail->AltBody = 'Para visualizar essa mensagem acesse http://site.com.br/mail';

		$mail->send();

	}

}

?>