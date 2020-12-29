<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer2/Exception.php';
require 'PHPMailer2/PHPMailer.php';
require 'PHPMailer2/SMTP.php';

require 'funcs/conexion.php';
require 'funcs/funcs.php';
 $errors = array();

 if (!empty($_POST))
  {
 	
 	$email = $mysqli->real_escape_string($_POST['email']);

 	if (!isEmail($email)) 
 	{
 		$errors[] = "Debe ingresar un correo electronico valido";
 	}
 		if (emailExiste($email)) {
 			
 			$user_id = getValor('id','correo',$email);
 			$nombre = getValor('nombre','correo',$email);

 			$token = generaTokenPass($user_id);

$url = 'http://'.$_SERVER["SERVER_NAME"].'/cambia_pass.php?user_id='.$user_id.'&token='.$token;
			
			$asunto = 'Recuperar Password - Sistema de usuarios GoTech GT';
			$cuerpo = "Hola $nombre: <br /><br />se ha solicitado un reinicio de contraseña. <br/><br/>Para restaurar la contrase&ntilde;a visita la siguiente direccion: <a href='$url'>Cambiar contraseña<a/>";

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
    $mail2->addAddress($email, $nombre);     // Add a recipient

    // Content
    $mail2->isHTML(true);                                  // Set email format to HTML
    $mail2->Subject = $asunto;
    $mail2->Body    = $cuerpo;


    $mail2->send();
    
    echo "Hemos enviado un correo electronico a la direccion $email para restablecer tu contraseña";

    echo "<br><a href='inicio.php' >Iniciar Sesion</a>";
    
		exit;

} catch (Exception $e) {
    echo "Hubo un error al enviar el Email: {$mail->ErrorInfo}";
    $errors[] = "Error al enviar Email";
}


 		}else{
 			$errors[] = "El correo electronico no existe";
 		}
 }

?>

<html>
	<head>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
		<title>Recuperar Contraseña</title>
		
		<script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        
        <link href="css/styles.css" rel="stylesheet" />
		
	</head>
	
	<body>
				<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="index.html">GoTech GT</a><button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu <i class="fas fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                    	<li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="registro.php">Registrate</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#portfolio">Cursos</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">Acerca de nosotros</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">Recuperar</a></li>

       
                </div>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="page-section" id="contact">
		
		<div class="container">    
			<div id="loginbox" style="margin-top:50px;" class="col-lg-8 mx-auto">                    
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title">Recuperar Password</div>
						<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="inicio.php">Iniciar Sesi&oacute;n</a></div>
					</div>     
					
					<div style="padding-top:30px" class="panel-body" >
						
						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
						
						<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
							
							<div style="margin-bottom: 25px" class="form-group floating-label-form-group controls mb-0 pb-2">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="email" type="email" class="form-control" name="email" placeholder="email" required>                                        
							</div>
							

							<br>
							<div class="form-group" align="center">                                      
								<div class="col-md-offset-3 col-md-9">
									<button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Enviar Email</button> 
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12 control">
									<hr>
									<div >
										No tiene una cuenta! <a href="registro.php">Registrate aquí</a>
									</div>
								</div>
							</div>   
						</form>
						<?php echo resultBlock($errors); ?>
					</div>                     
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