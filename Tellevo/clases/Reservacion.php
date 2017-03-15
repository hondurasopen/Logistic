<?php

class Reservacion{
	var $codigoReservacion,$codigoCliente,$fecha,$codigoViaje,$codigoLugarOrigen,$codigoLugarDestino,$tipoPago,$estadoPago,$montoTotal,$numeroAsiento,$codigoUbicacion;
	/**
	 * Constructor
	 */

	function __construct($codigoReservacion="",
	$codigoCliente=""
	,$fecha=""
	,$codigoViaje=""
	,$codigoLugarOrigen=""
	,$codigoLugarDestino=""
	,$tipoPago=""
	,$estadoPago=""
	,$montoTotal=""
	,$numeroAsiento=""
	,$codigoUbicacion=""){
		$this->establecerValores($codigoReservacion,$codigoCliente,$fecha,$codigoViaje,$codigoLugarOrigen,$codigoLugarDestino,$tipoPago,$estadoPago,$montoTotal,$numeroAsiento,$codigoUbicacion);
	}

	function establecerValores($codigoReservacion, $codigoCliente,$fecha,$codigoViaje,$codigoLugarOrigen,$codigoLugarDestino,$tipoPago,$estadoPago,$montoTotal,$numeroAsiento,$codigoUbicacion){
	    $this->codigoReservacion=$codigoReservacion;
		$this->codigoCliente=$codigoCliente;
		$this->fecha=$fecha;
		$this->codigoViaje=$codigoViaje;
		$this->codigoLugarOrigen=$codigoLugarOrigen;
		$this->codigoLugarDestino=$codigoLugarDestino;
		$this->tipoPago=$tipoPago;
		$this->estadoPago=$estadoPago;
		$this->montoTotal=$montoTotal;
		$this->numeroAsiento=$numeroAsiento;
		$this->codigoUbicacion=$codigoUbicacion;


	}
	function agregarReservacion(){

		$this->codigoReservacion=$this->obtenerCodigoUltimaReservacion();
		$sql= "INSERT INTO TBL_MV_RESERVACIONES VALUES('".
		$this->codigoReservacion."','".
		$this->codigoCliente."','".$this->fecha."','".
		$this->codigoViaje."','".
		$this->obtenerCodigoLugarBD(
		$this->codigoLugarOrigen)."','".
		$this->obtenerCodigoLugarBD(
		$this->codigoLugarDestino)."','".
		$this->tipoPago."','".
		$this->estadoPago."','".
		$this->montoTotal."','".
		$this->codigoUbicacion."','".
		$this->numeroAsiento."');";

		$objConexion=new Conexion();
		if(!$objConexion->ejecutarComando($sql)){
			echo "No se pudo agregar la reservacion";
			$objConexion->cerrarConexion();
			exit();
		}
		echo '<div align="center"><br/><img src="images/exito.gif" alt="Error" /><br/><br/><b>Se ha realizado la reservacion con exito.</b>';
		echo '<br/><br/><br/>Si desea realizar el pago puede dar click en el boton "Realizar pago", si lo desea puede pagar en otro momento, su reservacion quedara almacenada para realizar el pago cuando lo desee.';
		echo '<br/><br/><br/><form action="reservacion_viaje.php?paso=5" method="post"><input type="submit" value="Realizar pago"></form></div>';
		$objConexion->cerrarConexion();
	}
	
	function realizarPago($codigoReservacion,$tipo){
		$objConexion=new Conexion();
		if($tipo=='1'){
			if(!$objConexion->ejecutarComando("UPDATE tbl_mv_reservaciones SET ESTADO_PAGO = 'P'
			WHERE tbl_mv_reservaciones.CODIGO_RESERVACION =".$codigoReservacion.";")){
				echo "No se pudo realizar el pago";
				$objConexion->cerrarConexion();
				exit();
			}
			echo '<div align="center"><br/><img src="images/exito.gif"  /><br/><br/><b>Se ha realizado el pago con exito.</b>';
			
		}
		if($tipo=='2'){
			if(!$objConexion->ejecutarComando("UPDATE tbl_mv_reservaciones_paquetes SET ESTADO_PAGO = 'P' WHERE
			tbl_mv_reservaciones_paquetes.CODIGO_RESERVACION=".$codigoReservacion.";")){
				echo "No se pudo realizar el pago";
				$objConexion->cerrarConexion();
				exit();
			}
			echo '<div align="center"><br/><img src="images/exito.gif"  /><br/><br/><b>Se ha realizado el pago con exito.</b>';
		}
		$objConexion->cerrarConexion();

	}
	function obtenerCodigoUltimaReservacion(){
		$objConexion=new Conexion();
		$resultado=$objConexion->ejecutarComando("SELECT TBL_MV_RESERVACIONES.CODIGO_RESERVACION
		FROM TBL_MV_RESERVACIONES ORDER BY TBL_MV_RESERVACIONES.CODIGO_RESERVACION DESC;");
		$fila=mysql_fetch_array($resultado);
		$codigoReservacion=$fila["CODIGO_RESERVACION"];
		mysql_free_result($resultado);
		$objConexion->cerrarConexion();
		return $codigoReservacion+1;
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



	/*duda con que codigo se va a eliminar */

	function eliminarReservacion(){
		$objConexion=new Conexion();
		if(!$objConexion->ejecutarComando("DELETE FROM TBL_MV_RESERVACIONES WHERE TBL_MV_RESERVACIONES.CODIGO_RESERVACION='".$this->codigoReservacion."'")){
			echo "No se pudo Eliminar la reservacion";
			exit();
		}
		$objConexion->cerrarConexion();
	}
	/*Funciones de Acceso*/

	function obtenerCodigoReservacion(){
		return $this->codigoReservacion;
	}
	function establecerCodigoReservacion($codigoRes){
		$this->codigoReservacion=$codigoRes;
	}

	/*codigocliente*/
	function obtenerCodigo(){
		return $this->codigoCliente;
	}
	function establecerCodigo($codigo){
		$this->codigoCliente=$codigo;
	}

	/*fecha*/
	function obtenerFecha(){
		return $this->fecha;
	}
	function establecerFecha($fecha){
		$this->fecha=$fecha;
	}

	/*codigoruta*/

	function obtenerCodigoRuta(){
		return $this->codigoRuta;
	}
	function establecerCodigoRuta($codigoRuta){
		$this->codigoRuta=$codigoRuta;
	}

	/*codigoorigen*/


	function obtenerCodigoLugarOrigen(){
		return $codigoLugarOrigen;
	}
	function establecerCodigoLugarOrigen($codigoOrigen){
		$this->codigoLugarOrigen=$codigoOrigen;
	}

	/*codigo destino*/

	function obtenerCodigoLugarDestino(){
		return $codigoLugarDestino;
	}
	function establecerCodigoLugarDestino($codigoDestino){
		$this->codigoLugarDestino=$codigoDestino;
	}


	/*tipo pago*/

    function obtenerTipoPago(){
		return $tipoPago;
	}
	function establecerTipoPago($tipo){
		$this->tipoPago=$tipo;
	}

	/*numero asiento*/
	function obtenerNumeroAsiento(){
		return $numeroAsiento;
	}
	function establecerNumeroAsiento($asiento){
		$this->numeroAsiento=$asiento;
	}






}
?>