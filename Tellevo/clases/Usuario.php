<?php

class Usuario{
	var $codigoEmpleado, $contrasena;
	/**
	 * Constructor
	 */
	function __construct($codigoEmpleado="", $contrasena=""){
		$this->establecerValores($codigoEmpleado, $contrasena );

	}
	function establecerValores($codigoEmpleado, $contrasena ){
		$this->codigoEmpleado=$codigoEmpleado;
		$this->contrasena=$contrasena;

	}
	function agregarUsuario(){

		$objConexion=new Conexion();	
		if(!$objConexion->ejecutarComando("INSERT INTO TBL_MV_USUARIO_KIOSKO VALUES('".$this->codigoEmpleado."','".$this->contrasena."');")){
			echo " No se pudo agregar el Usuario";
			exit();
		}
		echo '<div align="center"><br/><img src="images/exito.gif" alt="Error" /><br/><br/><b>Registro Almacenado con Exito!</b></div>';
		$objConexion->cerrarConexion();
		echo "<p/><p/><p/><p/><p/><p/><p/><p/><p/><p/>";		
	}





function eliminarUsuario(){
		$objConexion=new Conexion();
		if(!$objConexion->ejecutarComando("DELETE FROM TBL_MV_USUARIO_KIOSKO WHERE TBL_MV_USUARIO_KIOSKO.CODIGO_EMPLEADO='".$this->codigoEmpleado."'")){
			echo "No se pudo Eliminar el usuario";
			exit();
		}
		$objConexion->cerrarConexion();
	}


}


?>