<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);


try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'diegoflo64411@gmail.com';                     // SMTP username
    $mail->Password   = 'andreslopez20ene20155f';                               // SMTP password
    $mail->SMTPSecure = 'tls';  
    $mail->Port       = 587;   


    //Recipients
   $mail->setFrom('diegoflo64411@gmail.com', 'DiegoF');
    $mail->addAddress('diegoflo6448@gmail.com', 'Joe');     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Asunto importante wey';
    $mail->Body    = 'Este es un correo de prueba';


    $mail->send();
    echo 'El mensaje se envio correctamente';
} catch (Exception $e) {
    echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
}