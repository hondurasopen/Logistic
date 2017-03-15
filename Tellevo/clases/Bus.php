<?php

include('clases/Asiento.php');
class Bus{
	var $codigoBus,$tipo,$numeroPlaca,$modelo,$anio,$capacidad, $clase, $codigoConductor,$codigoAsistente,$objAsiento;
	/**
	 * Constructor
	 */
	function __construct($codigoBus="",$tipo="",$numeroPlaca="",$modelo="",$anio="",$capacidad="", $clase="", $codigoConductor="",$codigoAsistente=""){
		$this->establecerValores($codigoBus,$tipo,$numeroPlaca,$modelo,$anio,$capacidad, $clase, $codigoConductor,$codigoAsistente);
		$this->objAsiento=new Asiento();

	}
	function establecerValores($codigoBus,$tipo,$numeroPlaca,$modelo,$anio,$capacidad, $clase, $codigoConductor,$codigoAsistente){
		$this->codigoBus=$codigoBus;
		$this->tipo=$tipo;
		$this->numeroPlaca=$numeroPlaca;
		$this->modelo=$modelo;
		$this->anio=$anio;
		$this->capacidad=$capacidad;
		$this->clase=$clase;
		$this->codigoConductor=$codigoConductor;
		$this->codigoAsistente=$codigoAsistente;
	}
	function agregarBus(){
		$objConexion=new Conexion();
		if(!$objConexion->ejecutarComando("INSERT INTO TBL_MG_UNIDADES_TRANSPORTE VALUES(
		'".$this->codigoBus."',
		'".$this->tipo."',
		'".$this->numeroPlaca."',
		'".$this->modelo."',
		'".$this->anio."',
		'".$this->capacidad."',
		'".$this->clase."',
		'".$this->codigoConductor."',
		'".$this->codigoAsistente."');")){
				echo "No se pudo agregar el bus";
				$objConexion->cerrarConexion();
				exit();
			}
		echo '<div align="center"><br/><img src="images/exito.gif" alt="Error" /><br/><br/><b>Registro Almacenado con Exito!</b></div>';
		$objConexion->cerrarConexion();
	}
	function agregarAsiento($numeroAsiento,$ubicacion,$conexion){
		$this->objAsiento->establecerValores($numeroAsiento,$ubicacion,$this->codigoBus);
		$this->objAsiento->agregarAsiento($conexion);
	}
	function asignarConductor($empleado,$bus,$objConexion){
		
		if(!$objConexion->ejecutarComando("UPDATE tellevo.tbl_mg_unidades_transporte SET CODIGO_CONDUCTOR = '".$empleado."' WHERE tbl_mg_unidades_transporte.CODIGO_UNIDAD_TRANSPORTE ='".$bus."'")){
			echo "NO se pudo asignar el conductor al bus";
			exit();
		}
			echo '<div align="center"><br/><img src="images/exito.gif" alt="Error" /><br/><br/><b>Conductor Asignado con Exito!</b>';
	}	
	function eliminarBus(){
		$objConexion=new Conexion();
		if(!$objConexion->ejecutarComando("DELETE FROM TBL_MG_UNIDADES_TRANSPORTE WHERE TBL_MG_UNIDADES_TRANSPORTE.CODIGO_UNIDAD_TRANSPORTE='".$this->codigoBus."'")){
					echo "No se pudo elimnar la unidad de transporte";
					exit();
					}
					$objConexion->cerrarConexion();
	}
}


?>