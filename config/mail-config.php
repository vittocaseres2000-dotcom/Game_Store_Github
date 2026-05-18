<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

function enviarCodigo2FA(
    $correo,
    $nombre,
    $codigo
){

    $mail = new PHPMailer(true);

    try{

        /* SMTP */

        $mail->isSMTP();

        $mail->Host =
        'smtp.gmail.com';

        $mail->SMTPAuth = true;

        $mail->Username =
        'TU_CORREO@gmail.com';

        $mail->Password =
        'TU_PASSWORD_APP';

        $mail->SMTPSecure =
        PHPMailer::ENCRYPTION_STARTTLS;

        $mail->Port = 587;

        /* REMITENTE */

        $mail->setFrom(
            'TU_CORREO@gmail.com',
            'GameStore'
        );

        /* DESTINO */

        $mail->addAddress(
            $correo,
            $nombre
        );

        /* CONTENIDO */

        $mail->isHTML(true);

        $mail->Subject =
        'Codigo de verificacion GameStore';

        $mail->Body = "

        <div style='
            background:#0b1120;
            padding:40px;
            font-family:Arial;
            color:white;
        '>

            <h1 style='color:#ff2e63;'>
                GameStore Security
            </h1>

            <p>
                Hola <b>$nombre</b>
            </p>

            <p>
                Tu codigo de verificacion es:
            </p>

            <div style='
                font-size:42px;
                font-weight:bold;
                color:#ff2e63;
                letter-spacing:8px;
                margin:30px 0;
            '>

                $codigo

            </div>

            <p>
                Este codigo expirara pronto.
            </p>

        </div>
        ";

        $mail->send();

        return true;

    }catch(Exception $e){

        return false;

    }

}