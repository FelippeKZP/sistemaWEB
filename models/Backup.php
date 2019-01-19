<?php

class Backup extends model
{

    public function gerarBackup()
    {

        $backupfile = 'farmacia_' . date("Y") . '.sql';
        $backupzip = $backupfile . '.tar.gz';
        system("C:/wamp64/bin/mysql/mysql5.7.21/bin/mysqldump -u root -proot farmacia > $backupfile");
        system("tar -czvf $backupzip $backupfile");

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

        $mail->setFrom('felipekzp0@gmail.com', 'Felippe');
        //$mail->FromName('Felippe');
        $mail->AddAddress('felipekzp0@gmail.com');

        $mail->isHTML(true);

        $mail->Subject = 'Backup do sistema ' . date('d/m/Y');
        $mail->Body = 'Backup do sistema';
        $mail->AddAttachment($backupzip, $backupzip);

        $mail->send();

        unlink($backupzip);
        unlink($backupfile);
    }

}

?>