<?php
/**
 *
 *
 */
class Paquete{
	var $codigoPaquete,$codigoViaje,$nombreOrigen,$nombreDestino,$costoTotal,$cantidadBoletos,$descripcion;
	/**
	 * Constructor
	 */

	function __construct($codigoPaquete="",$codigoViaje="",$nombreOrigen="",$nombreDestino="",$costoTotal="",$cantidadBoletos="",$descripcion=""){
		$this->establecerValores($codigoPaquete,$codigoViaje,$nombreOrigen,$nombreDestino,$costoTotal,$cantidadBoletos,$descripcion);
	}
	function establecerValores($codigoPaquete,$codigoViaje,$nombreOrigen,$nombreDestino,$costoTotal,$cantidadBoletos,$descripcion){
		$this->codigoPaquete=$codigoPaquete;
		$this->codigoViaje=$codigoViaje;
		$this->nombreOrigen=$nombreOrigen;
		$this->nombreDestino=$nombreDestino;
		$this->costoTotal=$costoTotal;
		$this->cantidadBoletos=$cantidadBoletos;
		$this->descripcion=$descripcion;
	}
	function obtenerCodigoLugarBD($nombreLugar){
		$objConexion=new Conexion();
		$resultado=$objConexion->ejecutarComando("SELECT TBL_MG_DESTINOS.CODIGO_DESTINO
		FROM TBL_MG_DESTINOS WHERE (((TBL_MG_DESTINOS.NOMBRE_DESTINO)='$nombreLugar'));");
		$fila=mysql_fetch_array($resultado);
		$codigoLugar=$fila["CODIGO_DESTINO"];
		mysql_free_result($resultado);
		$objConexion->cerrarConexion();
		return $codigoLugar;
	}
	function agregarPaquete(){


		$sql= "INSERT INTO TBL_MV_PAQUETES VALUES('".$this->codigoPaquete."','".$this->codigoViaje."','".$this->obtenerCodigoLugarBD($this->nombreOrigen)."','".$this->obtenerCodigoLugarBD($this->nombreDestino)."',".$this->cantidadBoletos.",".$this->costoTotal.",'".$this->descripcion."');";

		$objConexion=new Conexion();
		if(!$objConexion->ejecutarComando($sql)){
			echo "No se pudo agregar el nuevo paquete";
			$objConexion->cerrarConexion();
			exit();
		}
		echo '<div align="center"><br/><img src="images/exito.gif" alt="Error" /><br/><br/><b>Se ha con exito el nuevo paquete promocional.</b></div>';
		$objConexion->cerrarConexion();
	}
}

?>