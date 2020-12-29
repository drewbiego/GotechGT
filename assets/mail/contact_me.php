<?php




// Check for empty fields
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500);
  exit();
}
$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Create the email and send the message
//$to = "diegoflo6448@gmail.com"; // Add your email address in between the "" replacing yourname@yourdomain.com - This is where the form will send a message to.
$subject = "Contaco de la Web:  $name";
$body = "Has recibido un nuevo contacto de la pagina.\n\n"."Aqui los detalles:\n\nNombre: $name\n\nEmail: $email\n\nTelefono: $phone\n\nMensaje:\n$message";
//$header = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
//$header .= "Reply-To: $email";	

//if(!mail($to, $subject, $body, $header))
 // http_response_code(500);
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
   $mail->setFrom('diegoflo64411@gmail.com', $name);
    $mail->addAddress('diegoflo6448@gmail.com', 'GoTech');     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;


    $mail->send();
    echo 'El mensaje se envio correctamente';
} catch (Exception $e) {
    echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
}
?>
