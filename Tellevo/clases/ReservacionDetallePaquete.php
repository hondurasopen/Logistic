<?php

class ReservacionDetallePaquete{
	var $codigoReservacion,$codigoCliente,$ubicacionAsiento,$numeroAsiento;
	function __construct($codigoReservacion="",$codigoCliente="",$ubicacionAsiento="",$numeroAsiento=""){
		$this->establecerValores($codigoReservacion,$codigoCliente,$ubicacionAsiento,$numeroAsiento);
	}
	function establecerValores($codigoReservacion,$codigoCliente,$ubicacionAsiento,$numeroAsiento){
		$this->codigoReservacion=$codigoReservacion;
		$this->codigoCliente=$codigoCliente;
		$this->ubicacionAsiento=$ubicacionAsiento;
		$this->numeroAsiento=$numeroAsiento;
	}
	function agregar(){
		$objConexion=new Conexion();
		if(!$objConexion->ejecutarComando("INSERT INTO  TBL_MV_DETALLE_RESERVACION_PAQUETE VALUES('".$this->codigoReservacion."','".$this->codigoCliente."','".$this->ubicacionAsiento."','".$this->numeroAsiento."');")){
			echo "No se pudo agregar la reservacion para el cliente con codigo ".$codigoCliente;
			$objConexion->cerrarConexion();
			exit();
		}
		echo '<div align="center"><br/><img src="images/exito.gif" alt="Error" /><br/><br/><b>Registro Almacenado con Exito!</b></div>';
		$objConexion->cerrarConexion();
	}

}

?>