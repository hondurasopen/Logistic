<?php


class Lugar{
	var $codigoLugar, $nombreLugar, $departamento, $foto;
	/**
	 * Constructor
	 */
	function __construct($codigoLugar="", $nombreLugar="", $departamento="", $foto=""){

		$this->establecerValores($codigoLugar, $nombreLugar, $departamento, $foto);

	}
	function establecerValores($codigoLugar, $nombreLugar, $departamento, $foto){
		$this->codigoLugar=$codigoLugar;
		$this->nombreLugar=$nombreLugar;
		$this->departamento=$departamento;
		$this->foto=$foto;

	}
	function agregarLugar(){
		$objConexion=new Conexion();
		if(!$objConexion->ejecutarComando("INSERT INTO TBL_MG_DESTINOS
			VALUES('".$this->codigoLugar."','".$this->nombreLugar."','".$this->departamento."','".$this->foto."');"))
		{
			echo "No se pudo agregar el lugar";
			exit();
		}
		echo '<div align="center"><br/><img src="images/exito.gif" alt="Error" /><br/><br/><b>Registro Almacenado con Exito!</b></div>';
		$objConexion->cerrarConexion();
		echo "<p/><p/><p/><p/><p/><p/><p/><p/><p/><p/>";

	}
	function eliminarLugar(){
		$objConexion=new Conexion();
		if(!$objConexion->ejecutarComando("DELETE FROM TBL_MG_DESTINOS WHERE
		CODIGO_DESTINO='".$this->codigoLugar."'"))
		{
			echo "No se pudo elimniar el Lugar";
			exit();
		}
		$objConexion->cerrarConexion();
	}
	/* Funciones de Acceso*/
	function obtenerCodigo(){
		return $codigoLugar;
	}
	function establecerCodigo($codigo){
		$this->codigoLugar=$codigo;
	}

	function obtenerNombre(){
		return $nombreLugar;
	}
	function establecerNombre($nombre){
		$this->nombreLugar=$nombre;
	}

	function obtenerDepartamento(){
		return $departamento;
	}
	function establecerDepartamento($departamento){
		$this->departamento=$departamento;
	}

	function obtenerFoto(){
		return $foto;
	}
	function establecerFoto($foto){
		$this->foto=$foto;
	}


}

?>