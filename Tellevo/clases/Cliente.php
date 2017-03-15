<?php

/**
 *
 *
 */
class Cliente{
	var $codigoCliente,$nombres,$apellidos,$fechaNacimiento,$genero,$direccion,$telefono,$correo,$contrasena;
	function __construct($codigoCliente="",$nombres="",$apellidos="",$fechaNacimiento="",$genero="",$direccion="",$telefono="",$correo="",$contrasena=""){
		$this->establecerValores($codigoCliente,$nombres,$apellidos,$fechaNacimiento,$genero,$direccion,$telefono,$correo,$contrasena);
	}
	function establecerValores($codigoCliente,$nombres,$apellidos,$fechaNacimiento,$genero,$direccion,$telefono,$correo,$contrasena){
		$this->codigoCliente=$codigoCliente;
		$this->nombres=$nombres;
		$this->apellidos=$apellidos;
		$this->fechaNacimiento=$fechaNacimiento;
		$this->genero=$genero;
		$this->direccion=$direccion;
		$this->telefono=$telefono;
		$this->correo=$correo;
		$this->contrasena=$contrasena;
	}
	function agregarCliente(){
		$objConexion=new Conexion();
		if(!$objConexion->ejecutarComando("INSERT INTO TBL_MV_CLIENTE VALUES('".$this->codigoCliente."','".$this->nombres."','".$this->apellidos."','".$this->fechaNacimiento."','".$this->genero."','".$this->direccion."','".$this->telefono."','".$this->correo."','".$this->contrasena."');")){
			echo "No se pudo agregar el Cliente";
			$objConexion->cerrarConexion();
			exit();
		}
		//echo '<div align="center"><br/><img src="images/exito.gif" alt="Error" /><br/><br/><b>Registro Almacenado con Exito!</b></div>';
		$objConexion->cerrarConexion();
	}
	function obtenerNombreCliente(){
		return $this->nombres;
	}
}


?>