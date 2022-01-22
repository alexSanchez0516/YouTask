<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use Model\Users;


class Email
{
    public $email;
    public $token;
    public $name;

    public function __construct($token, $nombre, $email)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $nombre;
    }

    public function sendConfirmation()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '237de77e361c56';
        $mail->Password = '4f89c1677d3f71';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 2525;

        $mail->setFrom('support@youtask.es');
        $mail->addAddress('support@youtask.es', 'YouTask.es');
        $mail->Subject = 'Confirma tu cuenta';
    
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $content = "<html>";
        $content .= "<p><strong> Hola " . $this->name  ."</strong> Has creado tu cuenta en YouTask, solo debes confirmarla en el siguiente enlace</p>";
        $content .= "<p> Presiona aquí <a href='http://localhost:8080/login?token=" . $this->token . "'>Confirmar Cuenta</a> </p>";
        $content .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje.</p>";
        $content .= "</html>";

        $mail->Body = $content;
        if(!$mail->send()) {
            Users::setAlert($mail->ErrorInfo);
            return false;
        }
        return true;
    }
}
