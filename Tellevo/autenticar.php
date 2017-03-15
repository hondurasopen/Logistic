<?php
	include('clases/Conexion.php');
	include('clases/Administrador.php');

	$objAdministrador=new Administrador($_POST["txtIDAdministradorInicio"],$_POST["txtNombreUsuarioAdministrador"],$_POST["txtContrasenaAdministradorInicio"],"","","");

	if($objAdministrador->autenticarAdministrador()){
		session_start();
		$_SESSION['USUARIO_ADMINISTRADOR']=$_POST["txtIDAdministradorInicio"];
		$_SESSION['CONTRASENA_ADMINISTRADOR']=$_POST["txtNombreUsuarioAdministrador"];


		header("Location:inicio_administrador.php");

	}else{

		header('Location:no_autorizado.html');
		echo "Se requiere Autorizacion";
		exit;

	}
?>