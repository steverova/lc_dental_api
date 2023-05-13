<?php
require_once "./vendor/autoload.php";
require_once './vendor/phpmailer/phpmailer/src/SMTP.php';
require_once "./vendor/phpmailer/phpmailer/src/PHPMailer.php";

class MailerModel
{

    function sendMail($receiver, $message, $subject)
    {

        $outlook_mail = new PHPMailer\PHPMailer\PHPMailer();
        $outlook_mail->CharSet = 'UTF-8';
        $outlook_mail->ContentType = 'text/html';

        $outlook_mail->IsSMTP();
        // Send email using Outlook SMTP server
        $outlook_mail->Host = 'smtp-mail.outlook.com';
        // port for Send email
        $outlook_mail->Port = 587;
        $outlook_mail->SMTPSecure = 'tls';
        $outlook_mail->SMTPAuth = true;
        $outlook_mail->Username   = 'jeandelgado115@hotmail.com';
        $outlook_mail->Password   = 'jean702550018';

        $outlook_mail->From = 'jeandelgado115@hotmail.com';
        $outlook_mail->FromName = ''; // frome name
        $outlook_mail->AddAddress($receiver, '');  // Add a recipient  to name // Name is optional

        $outlook_mail->IsHTML(true); // Set email format to HTML

        $outlook_mail->Subject = $subject;
        $outlook_mail->Body    = $message;


        if ($outlook_mail->Send()) {
            echo json_encode(array("Mensaje" => "El correo fue enviado exitosamente", "Status" => true));
            $outlook_mail->clearAllRecipients();
            return true;
        } else {
            echo json_encode(array("Mensaje" => "Error al enviar el correo", "Status" => false));
            return false;
        }
    }
}
