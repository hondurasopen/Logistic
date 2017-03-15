<?php
include ('clases/Asiento.php');
class Administrador{

	var $codigoAdministrador,$nombre,$contrasena,$direccion,$telefono,$correo;

	function __construct($codigoAdministrador=0,$nombre="",$contrasena="",$direccion="",$telefono="",$correo=""){		
		$this->establecerValores($codigoAdministrador,$nombre,$contrasena,$direccion,$telefono,$correo);		
	}
	function establecerValores($codigoAdministrador,$nombre,$contrasena,$direccion,$telefono,$correo){
		$this->codigoAdministrador=$codigoAdministrador;
		$this->nombre=$nombre;
		$this->contrasena=$contrasena;
		$this->direccion=$direccion;
		$this->telefono=$telefono;
		$this->correo=$correo;
	}


	function agregarAdministrador(){
		$objConexion=new Conexion();
		if(!$objConexion->ejecutarComando("INSERT INTO TBL_MS_ADMINISTRADORES VALUES('".$this->codigoAdministrador."','".$this->nombre."','".$this->direccion."','".$this->telefono."','".$this->contrasena."','".$this->correo."');")){
			echo "No se pudo agregar el administrador";
			$objConexion->cerrarConexion();
			exit();
		}
		echo '<div align="center"><br/><img src="images/exito.gif" alt="Error" /><br/><br/><b>Registro Almacenado con Exito!</b></div>';
		$objConexion->cerrarConexion();
	}
	function eliminarAdministrador(){
		$objConexion=new Conexion();
		if(!$objConexion->ejecutarComando("DELETE FROM TBL_MS_ADMINISTRADORES WHERE CODIGO_ADMINISTRADOR=".$this->codigoAdministrador)){
			echo "No se pudo Eliminar el administrador";
			exit();
		}
		$objConexion->cerrarConexion();
	}
	function modificarAdministrador(){
		$objConexion=conectar();
		if(!$objConexion->ejecutarComando("UPDATE TBL_MS_ADMINISTRADORES SET  () WHERE CODIGO_ADMINISTRADOR=".$this->codigoAdministrador)){
			echo "No se pudo Eliminar el administrador";
			exit();
		}
		$objConexion->cerrarConexion();
	}
	function autenticarAdministrador(){

		$objConexion=new Conexion();

		$resultado=$objConexion->ejecutarComando("SELECT * FROM TBL_MS_ADMINISTRADORES WHERE CODIGO_ADMINISTRADOR='".$this->codigoAdministrador."' AND  NOMBRE_ADMINISTRADOR='".$this->nombre."' AND CONTRASENA='".$this->contrasena."'");
		if(mysql_fetch_array($resultado)){
			//echo "TRUE";
			mysql_free_result($resultado);
			return true;
		}

		//echo "FALSE";
		mysql_free_result($resultado);
		return false;




	}


	function conectar(){
		return new Conexion();
	}

	/*Funciones de Acceso*/
	function obtenerCodigo(){
		return $codigoAdministrador;
	}
	function establecerCodigo($codigo){
		
	}
}
?>