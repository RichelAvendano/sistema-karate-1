<?php
namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PHPMailerService
{
    public function sendEmail($to, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST', 'smtp.gmail.com'); // Servidor SMTP de Gmail
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME'); // Tu correo Gmail
            $mail->Password = env('MAIL_PASSWORD'); // Clave de aplicación de Gmail
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls'); // Usa TLS
            $mail->Port = env('MAIL_PORT', 587); // Usa puerto 587 para TLS

            // Remitente y destinatario
            $mail->setFrom(env('MAIL_FROM_ADDRESS', env('MAIL_USERNAME')), env('MAIL_FROM_NAME'));
            $mail->addAddress($to);

            // Formato HTML
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            return $mail->send() ? "✅ Correo enviado con éxito!" : "❌ Error al enviar correo.";
        } catch (Exception $e) {
            return "❌ Error al enviar correo: {$mail->ErrorInfo}";
        }
    }
}
