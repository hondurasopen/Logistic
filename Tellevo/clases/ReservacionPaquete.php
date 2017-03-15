<?php
/**
 *
 *
 */
class ReservacionPaquete{
	var $codigoReservacion,$codigoPaquete,$codigoCliente,$fechaReservacion,$tipoPago,$estadoPago;
	function __construct($codigoPaquete="",$codigoCliente="",$fechaReservacion="",$tipoPago="",$estadoPago=""){
		$this->establecerValores($codigoPaquete,$codigoCliente,$fechaReservacion,$tipoPago,$estadoPago);
	}
	function establecerValores($codigoPaquete,$codigoCliente,$fechaReservacion,$tipoPago,$estadoPago){
		$this->codigoPaquete=$codigoPaquete;
		$this->codigoCliente=$codigoCliente;
		$this->fechaReservacion=$fechaReservacion;
		$this->tipoPago=$tipoPago;
		$this->estadoPago=$estadoPago;
	}
	function agregarReservacionPaquete(){
		$objConexion=new Conexion();
		$fecha=getdate();
		
		if(!$objConexion->ejecutarComando("INSERT INTO TBL_MV_RESERVACIONES_PAQUETES  VALUES('".
		$this->obtenerCodigoUltimaReservacion()."','".
		$this->codigoPaquete."','".
		$this->codigoCliente."','".
		$fecha['year']."-".$fecha['mon']."-".$fecha['mday']."','".
		$this->tipoPago."','".
		$this->estadoPago."');")){
			echo "No se pudo agregar la reservacion";
			$objConexion->cerrarConexion();
			exit();
		}
		//echo '<div align="center"><br/><img src="images/exito.gif" alt="Error" /><br/><br/><b>Registro Almacenado con Exito!</b></div>';
		$objConexion->cerrarConexion();
	}
	function agregarReservaCliente($codigoCliente,$ubicacionAsiento,$numeroAsiento){
		$objConexion=new Conexion();
		
		if(!$objConexion->ejecutarComando("INSERT INTO  TBL_MV_DETALLE_RESERVACION_PAQUETE VALUES('".$this->codigoReservacion."','".$codigoCliente."','".$ubicacionAsiento."','".$numeroAsiento."');")){
			echo "No se pudo agregar la reservacion para el cliente con codigo ".$codigoCliente;
			$objConexion->cerrarConexion();
			exit();
		}
		//echo '<div align="center"><br/><img src="images/exito.gif" alt="Error" /><br/><br/><b>Registro Almacenado con Exito!</b></div>';
		$objConexion->cerrarConexion();
	}
	function obtenerCodigoUltimaReservacion(){
		$objConexion=new Conexion();
		$resultado=$objConexion->ejecutarComando("
		SELECT Max(TBL_MV_RESERVACIONES_PAQUETES.CODIGO_RESERVACION) AS CODIGO_RESERVACION
		FROM TBL_MV_RESERVACIONES_PAQUETES
		ORDER BY Max(TBL_MV_RESERVACIONES_PAQUETES.CODIGO_RESERVACION) DESC;");
		$fila=mysql_fetch_array($resultado);
		$codigoReservacion=$fila["CODIGO_RESERVACION"];
		mysql_free_result($resultado);
		$objConexion->cerrarConexion();
		$this->codigoReservacion=$codigoReservacion+1;
		return $codigoReservacion+1;
	}
	function obtenerCodigoReservacion(){
		return $this->codigoReservacion;
	}
}


?>