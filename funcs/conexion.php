<?php
	
	$mysqli=new mysqli("localhost","id13425950_gotechpruebas","^ui%KB62d-WbbJTQ","id13425950_loogin"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}


	
?>
