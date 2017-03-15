<?php


class Viaje{
	var $codigoViaje;
	var $codigoRuta;
	var $codigoUnidadTransporte;
	var $tipoRuta;
	var $fechasDias;
	var $horaSalida;
	var $numeroAsientosOcupados;
	function __construct($codigoViaje,$codigoRuta,$codigoUnidadTransporte,$tipoRuta,$fechasDias,$horaSalida,$numeroAsientosOcupados){

		$this->codigoViaje=$codigoViaje;
		$this->codigoRuta=$codigoRuta;
		$this->codigoUnidadTransporte=$codigoUnidadTransporte;
		$this->tipoRuta=$tipoRuta;
		$this->fechasDias=$fechasDias;
		$this->horaSalida=$horaSalida;
		$this->numeroAsientosOcupados=$numeroAsientosOcupados;

	}
	function agregarViaje(){
		$objConexion=new Conexion();
		if(!$objConexion->ejecutarComando("INSERT INTO TBL_MV_RUTAS_VIAJES VALUES('$this->codigoViaje','$this->codigoRuta',$this->codigoUnidadTransporte,'$this->tipoRuta','$this->fechasDias','$this->horaSalida','$this->numeroAsientosOcupados');")){
			echo "No se pudo aperturar el viaje";
			exit();
		}
		echo '<div align="center"><br/><img src="images/exito.gif" alt="Error" /><br/><br/><b>El viaje a sido aperturado con Exito!</b></div>';
		$objConexion->cerrarConexion();
	}
}


?>