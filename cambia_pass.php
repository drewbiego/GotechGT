<?php
require 'funcs/conexion.php';
require 'funcs/funcs.php';

if (empty($_GET['user_id'])) {
	header('Location: inicio.php');

}

if (empty($_GET['token'])) {
	header('Location: inicio.php');
}

$user_id = $mysqli->real_escape_string($_GET['user_id']);
$token = $mysqli->real_escape_string($_GET['token']);

if (!verificaTokenPass($user_id, $token)) {
	echo "No se pudo verificar los datos";
	exit;
}
?>
<html>
	<head>

		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

		<title>Cambiar contraseña</title>
		
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
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">Cambiar</a></li>

       
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
						<div class="panel-title">Cambiar contraseña</div>
						<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="inicio.php">Iniciar Sesi&oacute;n</a></div>
					</div>     
					
					<div style="padding-top:30px" class="panel-body" >
						
						<form id="loginform" class="form-horizontal" role="form" action="guarda_pass.php" method="POST" autocomplete="off">
							
							<input type="hidden" id="user_id" name="user_id" value ="<?php echo $user_id; ?>" />
							
							<input type="hidden" id="token" name="token" value ="<?php echo $token; ?>" />
							
							<div class="form-group">
								
								<div class="form-group floating-label-form-group controls mb-0 pb-2">
									<input type="password" class="form-control" name="password" placeholder="Contraseña" required>
								</div>
							</div>
							
							<div class="form-group">
								
								<div class="form-group floating-label-form-group controls mb-0 pb-2">
									<input type="password" class="form-control" name="con_password" placeholder="Confirmar Contraseña" required>
								</div>
							</div>
							
							<div class="form-group" align="center">                                      
								<div class="col-md-offset-3 col-md-9">
									<button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Modificar</button> 
								</div>
							</div> 
							<hr>
						</form>
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
