<?php

class Ruta{
	var $codigoRuta;
	function __construct($codigoRuta){
			$this->codigoRuta=$codigoRuta;
	}
	function agregarLugar($nombreLugar,$cardinalidad,$costo,$tiempo,$objConexion){
		if(!$objConexion->ejecutarComando("INSERT INTO TBL_MV_RECORRIDO_RUTA VALUES('".$this->codigoRuta."','".$this->obtenerCodigoLugarBD($nombreLugar,$objConexion)."','".$cardinalidad."','".$costo."','".$tiempo."')")){
			echo "No se pudo agregar el lugar $nombreLugar";
			exit();
		}

	}
	function obtenerCodigoLugarBD($nombreLugar,$objConexion){
		$resultado=$objConexion->ejecutarComando("SELECT TBL_MG_DESTINOS.CODIGO_DESTINO,TBL_MG_DESTINOS.NOMBRE_DESTINO
		FROM TBL_MG_DESTINOS
		WHERE TBL_MG_DESTINOS.NOMBRE_DESTINO='".$nombreLugar."';");
		$fila=mysql_fetch_array($resultado);
		return $fila['CODIGO_DESTINO'];
	}
}

?>