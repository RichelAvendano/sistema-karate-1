<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PHPMailerService;

class CorreoController extends Controller
{
    public function enviarCorreo()
    {
        $mailer = new PHPMailerService();

        // Obtener el destinatario desde la solicitud POST
        $destinatario = 'richeljeremias123@gmail.com';

        // Definir asunto y mensaje del correo
        $asunto = "Asunto Importante";
        $mensaje = "<h1>Hola!</h1><p>Este es un correo de prueba con PHPMailer en Laravel.</p>";

        // Enviar el correo
        $resultado = $mailer->sendEmail($destinatario, $asunto, $mensaje);

        return response()->json(['mensaje' => $resultado]);
    }

}

