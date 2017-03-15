<?php
class Asiento{
	var $numeroAsiento,$ubicacion,$unidadTransporte;
	function __construct($numeroAsiento="",$ubicacion="",$unidadTransporte=""){
		$this->establecerValores($numeroAsiento,$ubicacion,$unidadTransporte);
	}
	function establecerValores($numeroAsiento,$ubicacion,$unidadTransporte){
		$this->numeroAsiento=$numeroAsiento;
		$this->ubicacion=$ubicacion;
		$this->unidadTransporte=$unidadTransporte;
	}		
	function agregarAsiento($objConexion){
		if(!$objConexion->ejecutarComando("INSERT INTO TBL_MG_ASIENTOS_UNIDADES_TRANSPORTE  VALUES(
			'".$this->unidadTransporte."',
			'".$this->ubicacion."',
			'".$this->numeroAsiento."');")){
			echo "Error al agregar el asiento";
			$objConexion->cerrarConexion();
			exit();
		}
	}
	function eliminarAsiento($codigoBus){
		$objConexion=new Conexion();
		if(!$objConexion->ejecutarComando("DELETE FROM TBL_MG_ASIENTOS_UNIDADES_TRANSPORTE WHERE TBL_MG_ASIENTOS_UNIDADES_TRANSPORTE.CODIGO_UNIDAD_TRANSPORTE='".$codigoBus."'")){
			echo "No se pudo eliminar Asientos";
			exit();
		}
		$objConexion->cerrarConexion();
	}
}
?>
