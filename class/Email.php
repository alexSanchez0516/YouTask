<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use Model\Users;


class Email
{
    public $email;
    public $token;
    public $name;
    public $emailDestination;

    public function __construct($token, $nombre, $emailDestination)
    {
        $this->token = $token;
        $this->emailDestination = $emailDestination;
        $this->name = $nombre;
        $this->mail = new PHPMailer();
    }
    public function setCredentials() {

        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.mailtrap.io';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = '237de77e361c56';
        $this->mail->Password = '4f89c1677d3f71';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 2525;

        $this->mail->setFrom('support@youtask.es');
        $this->mail->addAddress('support@youtask.es', 'YouTask.es');
    }

    public function sendConfirmation()
    {
        $this->setCredentials();
       
        $this->mail->Subject = 'Confirma tu cuenta';
    
        $this->mail->isHTML(TRUE);
        $this->mail->CharSet = 'UTF-8';

        $content = "<html>";
        $content .= "<p><strong> Hola " . $this->name  ."</strong> Has creado tu cuenta en YouTask, solo debes confirmarla en el siguiente enlace</p>";
        $content .= "<p> Presiona aquí <a href='http://localhost:8080/login?token=" . $this->token . "'>Confirmar Cuenta</a> </p>";
        $content .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje.</p>";
        $content .= "</html>";

        $this->mail->Body = $content;
        if(!$this->mail->send()) {
            Users::setAlert($this->mail->ErrorInfo);
            return false;
        }
        return true;
    }

    public function sendTokenRecovery() {
        $this->setCredentials();
       
        $this->mail->Subject = 'Cambio de contraseña';
    
        $this->mail->isHTML(TRUE);
        $this->mail->CharSet = 'UTF-8';

        $content = "<html>";
        $content .= "<p><strong> Hola " . $this->name  ."</strong> para recuperar tu contraseña, solo debes confirmarla en el siguiente enlace</p>";
        $content .= "<p> Presiona aquí <a href='http://localhost:8080/login?token=" . $this->token . "'>Confirmar Cuenta</a> </p>";
        $content .= "<p>Si tu no solicitaste esta acción, ponte en contacto con nostros a traves de este mismo email.</p>";
        $content .= "</html>";

        $this->mail->Body = $content;
        if(!$this->mail->send()) {
            Users::setAlert($this->mail->ErrorInfo);
            return false;
        }
        return true;
    }
}
