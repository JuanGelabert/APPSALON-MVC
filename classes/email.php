<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        // Crear el objeto de email
        $mail = new PHPMailer();

        // Configurar el servidor
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'b89d89e01dd782';
        $mail->Password = '310e563c29e28d';
        $mail->SMTPSecure = 'tls';

        $mail->setFrom('admin@appsalon.com');
        $mail->addAddress($this->email, $this->nombre);

        $mail->Subject = 'Confirma tu cuenta';

        // Set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';


        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>" . $this->nombre . "</strong>, has creado tu cuenta en AppSalon. Confirma tu cuenta haciendo click en el siguiente enlace de validación</p>";
        $contenido .= "<p><a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Confirmar cuenta</a></p>";
        $contenido .= "<p>Si no has solicitado la creación de esta cuenta, puedes ignorar el mensaje";
        $contenido .= "</html>";

        $mail->Body = $contenido;
        $mail->AltBody = 'Texto alternativo';

        // Enviar email
        $mail->send();
    }

    public function enviarInstrucciones()
    {
                // Crear el objeto de email
                $mail = new PHPMailer();

                // Configurar el servidor
                $mail->isSMTP();
                $mail->Host = 'smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Port = 2525;
                $mail->Username = 'b89d89e01dd782';
                $mail->Password = '310e563c29e28d';
                $mail->SMTPSecure = 'tls';
        
                $mail->setFrom('admin@appsalon.com');
                $mail->addAddress($this->email, $this->nombre);
        
                $mail->Subject = 'Reestablece tu password';
        
                // Set HTML
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
        
        
                $contenido = "<html>";
                $contenido .= "<p>Hola <strong>" . $this->nombre . "</strong>, has solicitado reestablecer tu password, sigue el siguiente enlace para comenzar.</p>";
                $contenido .= "<p><a href='http://localhost:3000/recuperar?token=" . $this->token . "'>Reestablecer Password</a></p>";
                $contenido .= "<p>Si no has solicitado la creación de esta cuenta, puedes ignorar el mensaje";
                $contenido .= "</html>";
        
                $mail->Body = $contenido;
                $mail->AltBody = 'Texto alternativo';
        
                // Enviar email
                $mail->send();
    }
}