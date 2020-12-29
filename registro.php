<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer2/Exception.php';
require 'PHPMailer2/PHPMailer.php';
require 'PHPMailer2/SMTP.php';

require 'funcs/conexion.php';
require 'funcs/funcs.php';


$errors = array();

if(!empty($_POST))
{

$nombre = $mysqli ->real_escape_string($_POST['nombre']);
$usuario = $mysqli ->real_escape_string($_POST['usuario']);
$password = $mysqli ->real_escape_string($_POST['password']);
$con_password = $mysqli ->real_escape_string($_POST['con_password']);
$email = $mysqli ->real_escape_string($_POST['email']);
$captcha = $mysqli ->real_escape_string($_POST['g-recaptcha-response']);

$activo = 0;
$tipo_usuario = 2;
$secret = '6Lcm7u0UAAAAAPAzMNG2ylwEkGwwdUW8tKor5rm-';

if(!$captcha){
$errors[] = "Por favor verifica el captcha";
}/*Fin del captcha*/

if (isNull($nombre, $usuario, $password, $con_password, $email)) 
{
$errors[] = "Debe llenar todos los campos";	
}/*Fin del IsNull*/

if (!isEmail($email)) 
{
	$errors[] = "Dirrecion de correo invalida";
}/*Fin de validacion del Email*/

if (!validaPassword($password, $con_password)) {
	$errors[] = "Las contraseñas no coinciden";
}/*Fin de validacion de contraseña*/

if (usuarioExiste($usuario)) 
{
	$errors[] = "El nombre de usuario $usuario ya existe";
}/*Fin de validacion de usuarios*/

if (emailExiste($email)) 
{
	$errors[] = "El correo electronico $email ya existe";
}/*Fin de validacion de email*/

if (count($errors) == 0) 
{

$response = file_get_contents(
	"https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
	
	$arr = json_decode($response, TRUE);

	if ($arr['success']) 
	{

$pass_hash = hashPassword($password);
$token = generateToken();

$registro = registraUsuario($usuario, $pass_hash, $nombre, $email, $activo, $token, $tipo_usuario);

	if ($registro > 0) 
	{

		$url = 'http://'.$_SERVER["SERVER_NAME"].'/activar.php?id='.$registro.'&val='.$token;
		$asunto = 'Activar Cuenta - Sistema de Usuarios';
		$cuerpo = "Estimado $nombre: <br /><br />Para continuar con el registro, es indispensable de click en el siguiente enlace <a href='$url'>Activar Cuenta</a>";
		/***********************************/
		
$mail2 = new PHPMailer(true);


try {
    //Server settings
    $mail2->SMTPDebug = 0;                      // Enable verbose debug output
    $mail2->isSMTP();                                            // Send using SMTP
    $mail2->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail2->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail2->Username   = 'diegoflo64411@gmail.com';                     // SMTP username
    $mail2->Password   = 'andreslopez20ene20155f';                               // SMTP password
    $mail2->SMTPSecure = 'tls';  
    $mail2->Port       = 587;   


    //Recipients
   $mail2->setFrom('diegoflo64411@gmail.com', 'GoTech GT');
    $mail2->addAddress($email, $usuario);     // Add a recipient

    // Content
    $mail2->isHTML(true);                                  // Set email format to HTML
    $mail2->Subject = $asunto;
    $mail2->Body    = $cuerpo;


    $mail2->send();
    echo 'El mensaje se envio correctamente';
    echo "Para Terminar el proceso de registro siga las instrucciones que le hemos enviado la direccion de correo electronico: $email";

    echo "<br><a href='index.php' >Iniciar Sesion</a>";
    
		exit;

} catch (Exception $e) {
    echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
    $errors[] = "Error al enviar Email";
}



		/**********************************/
		/*if (enviarEmail($email, $nombre, $asunto, $cuerpo)) {

		echo "Para Terminar el proceso de registro siga las instrucciones que le hemos enviado la direccion de correo electronico: $email";

		echo "<br><a href='index.php' >Iniciar Sesion</a>";
		exit;
		}comprobacion del email enviado

		else{

			$errors[] = "Error al enviar Email";
		}/*Validacion correo enviado*/ 

	}else{
		$errors[] = "Error al registrar";
	}	

	}else{
		$errors[] = 'Error al comprobar captcha';
	}
}/*fin del conteo de errores*/

}/*Fin del post vacio*/

?>

<html>
	<head>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

		<title>Registro</title>
		

		<script src="https://www.google.com/recaptcha/api.js" async defer></script>

		        <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        
        <link href="css/styles.css" rel="stylesheet" />
		</head>
	
	<body>
		        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">GoTech GT</a><button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu <i class="fas fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                    	<li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="inicio.php">Iniciar Sesion</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#portfolio">Cursos</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">Acerca de nosotros</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">Registro</a></li>

       
                </div>
                    </ul>
                </div>
            </div>
        </nav>

		<section class="page-section" id="contact">
		<div class="container">
			<div class="col-lg-8 mx-auto" >
			<hr>				
						<form id="signupform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
							
							<div id="signupalert" style="display:none" class="alert alert-danger">
								<p>Error:</p>
								<span></span>
							</div>
							
							<div class="form-group">
								
								<div class="form-group floating-label-form-group controls mb-0 pb-2">
									<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php if(isset($nombre)) echo $nombre; ?>" required>
								</div>
							</div>
							
							<div class="form-group">
								
								<div class="form-group floating-label-form-group controls mb-0 pb-2">
									<input type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php if(isset($usuario)) echo $usuario; ?>" required>
								</div>
							</div>
							
							<div class="form-group">
								
								<div class="form-group floating-label-form-group controls mb-0 pb-2">
									<input type="password" class="form-control" name="password" placeholder="Password" required>
								</div>
							</div>
							
							<div class="form-group">
								
								<div class="form-group floating-label-form-group controls mb-0 pb-2">
									<input type="password" class="form-control" name="con_password" placeholder="Confirmar Password" required>
								</div>
							</div>
							
							<div class="form-group">
								
								<div class="form-group floating-label-form-group controls mb-0 pb-2">
									<input type="email" class="form-control" name="email" placeholder="Email" value="<?php if(isset($email)) echo $email; ?>" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="captcha" class="col-md-3 control-label"></label>
								<div class="g-recaptcha col-md-9" data-sitekey="6Lcm7u0UAAAAAPh2FfOc_W_S9rLqu6grvZuH2BoN"></div>
							</div>
							
							<div class="form-group">                                      
								<div class="col-md-offset-3 col-md-9">
									<button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Registrar</button> 
								</div>
							</div>
						</form>
						<?php echo resultBlock($errors); ?>
					
				</div>
			</div>
		</div>
	</section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Contact form JS-->
        <script src="assets/mail/jqBootstrapValidation.js"></script>
        <script src="assets/mail/contact_me.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

	</body>
</html>													