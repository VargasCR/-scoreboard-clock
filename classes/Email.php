<?php
namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Email {
    public $email;
    public $name;
    public $token;

    public function __construct($email, $name, $token) {
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
    }
    public function sendConfirm() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '57108f27bc503d';
        $mail->Password = 'ad3b907edbd320';

        $mail->setFrom('correo@correo.com');
        $mail->addAddress('jvjaviervargas2252@gmail.com', 'appsalon.com');
        $mail->Subject = 'Confirma tu Cuenta';
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $content = "<html>";
        $content .= "<p><strong>Hola ".$this->name."</strong> Has creado tu cuenta en App Salon, solo debes confirmar tu correo en el siguiente enlace:</p>";
        $content .= "<p>Presiona Aquí: <a href=http://localhost:3000/confirm?token=".$this->token.">Confirmar Cuenta</a></p>";
        $content .= "<p>Si tu solicitaste esto, por favor ignora el mensaje</p>";
        $content .= "</html>";

        $mail->Body = $content;
        
        $mail->send();
        
    }
    public function sendInstructions() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '57108f27bc503d';
        $mail->Password = 'ad3b907edbd320';

        $mail->setFrom('correo@correo.com');
        $mail->addAddress('jvjaviervargas2252@gmail.com', 'appsalon.com');
        $mail->Subject = 'Reestablecer la contraseña';
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $content = "<html>";
        $content .= "<p><strong>Hola ".$this->name."</strong> Has solicitado reestablecer tu contraseña, solo debes entrar en el siguiente enlace:</p>";
        $content .= "<p>Presiona Aquí: <a href=http://localhost:3000/recover?token=".$this->token.">Para reestablecer la contraseña</a></p>";
        $content .= "<p>Si tu solicitaste esto, por favor ignora el mensaje</p>";
        $content .= "</html>";

        $mail->Body = $content;
        
        $mail->send();
    }
    public function sendPassToken() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '57108f27bc503d';
        $mail->Password = 'ad3b907edbd320';

        $mail->setFrom('correo@correo.com');
        $mail->addAddress('jvjaviervargas2252@gmail.com', 'funcr.com');
        $mail->Subject = 'Cambiar la contraseña la contraseña';
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $content = "<html>";
        $content .= "<p><strong>Hola ".$this->name."</strong> Has solicitado cambiar tu contraseña, solo debes el siguiente codigo:</p>";
        $content .= "<h2>$this->token</h2>";
        $content .= "<p>Si tu no solicitaste esto, por favor ignora el mensaje</p>";
        $content .= "</html>";

        $mail->Body = $content;
        
        $mail->send();
    }
}