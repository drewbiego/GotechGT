<?php
require 'funcs/conexion.php';
require 'funcs/funcs.php';

if(isset($_GET['id']) AND isset($_GET['val']))
{
    $idUsuario = $_GET['id'];
    $token = $_GET['val'];
  
    $mensaje = validaIdToken($idUsuario, $token);

}
?>
<html>
<head>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

    <title>Registro</title>
    

		<script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        
        <link href="css/styles.css" rel="stylesheet" />


    </head>
<body>
<header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
            	<h1 class="masthead-heading text-uppercase mb-0">GoTech GT</h1>
              <img class="masthead-avatar" src="assets/img/logoGuate.png" align="" /><!-- Masthead Heading-->
            <h1><?php echo $mensaje ?></h1>
            <br />
            <p><a class="btn btn-primary btn-lg" href="inicio.php" role="button">Iniciar sesion</a></p>
            </div>
        </header>
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