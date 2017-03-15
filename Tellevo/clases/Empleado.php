<?php

class Empleado{
	var $codigoEmpleado, $identidad, $nombres, $apellidos, $direccion, $telefono,
		$descripcionCargo,$genero, $correo;
	/**
	 * Constructor
	 */
	function __construct($codigoEmpleado="", $identidad="", $nombres="", $apellidos="", $direccion="",$telefono="",
	$descripcionCargo="",$genero="", $correo=""){
		$this->establecerValores($codigoEmpleado, $identidad, $nombres, $apellidos, $direccion, $telefono,
		$descripcionCargo,$genero, $correo);

	}
	function establecerValores($codigoEmpleado, $identidad, $nombres, $apellidos, $direccion, $telefono,
	$descripcionCargo,$genero,$correo){
		$this->codigoEmpleado=$codigoEmpleado;
		$this->identidad=$identidad;
		$this->nombres=$nombres;
		$this->apellidos=$apellidos;
		$this->direccion=$direccion;
		$this->telefono=$telefono;
		$this->descripcionCargo=$descripcionCargo;
		$this->genero=$genero;
		$this->correo=$correo;
	}
	function agregarEmpleado(){
		$codigoCargo=$this->obtenerCodigoCargoBD();

		$objConexion=new Conexion();
		if(!$objConexion->ejecutarComando("INSERT INTO TBL_MG_EMPLEADOS VALUES('".$this->codigoEmpleado."','".$this->identidad."','".$this->nombres."','".$this->apellidos."','".$this->direccion."', '".$this->telefono."','".$codigoCargo."','".$this->genero."','".$this->correo."')")){
			echo " No se pudo agregar el empleado";
			exit();
		}
		echo '<div align="center"><br/><img src="images/exito.gif" alt="Error" /><br/><br/><b>Registro Almacenado con Exito!</b></div>';
		$objConexion->cerrarConexion();
		echo "<p/><p/><p/><p/><p/><p/><p/><p/><p/><p/>";
		exit();
	}
	
	function obtenerCodigoCargoBD(){
		$objConexion=new Conexion();
		$resultado=$objConexion->ejecutarComando("SELECT TBL_MG_CARGOS_EMPLEADOS.CODIGO_CARGO_EMPLEADO FROM TBL_MG_CARGOS_EMPLEADOS WHERE TBL_MG_CARGOS_EMPLEADOS.DESCRIPCION_CARGO_EMPLEADO='".$this->descripcionCargo."'");
		$fila=mysql_fetch_array($resultado);

		return $fila["CODIGO_CARGO_EMPLEADO"];
	}

function eliminarEmpleado(){
		$objConexion=new Conexion();
		if(!$objConexion->ejecutarComando("DELETE FROM TBL_MG_EMPLEADOS WHERE TBL_MG_EMPLEADOS.CODIGO_EMPLEADO='".$this->codigoEmpleado."'")){
			echo "No se pudo Eliminar el empleado";
			exit();
		}
		$objConexion->cerrarConexion();
	}
	
function modificarEmpleado(){
	$objConexion=new Conexion();
	if(!$objConexion->ejecutarComando("UPDATE TBL_MG_EMPLEADOS SET TBL_MG_EMPLEADOS.CODIGO_EMPLEADO='".$this->codigoEmpleado."',TBL_MG_EMPLEADOS.NUMERO_IDENTIDAD='".$this->identidad."', TBL_MG_EMPLEADOS.NOMBRES='".$this->nombres."', TBL_MG_EMPLEADOS.APELLIDOS='".$this->apellidos."', TBL_MG_EMPLEADOS.DIRECCION_DOMICILIO='".$this->direccion."', TBL_MG_EMPLEADOS.TELEFONO='".$this->telefono."', TBL_MG_EMPLEADOS.CODIGO_CARGO='".$this->obtenerCodigoCargoBD()."', TBL_MG_EMPLEADOS.GENERO_EMPLEADO='".$this->genero."',TBL_MG_EMPLEADOS.CORREO='".$this->correo."' WHERE TBL_MG_EMPLEADOS.CODIGO_EMPLEADO='".$this->codigoEmpleado."'")){
		echo " No se pudo modificar el empleado";
			exit();
	}
	echo '<div align="center"><br/><img src="images/exito.gif" alt="Error" /><br/><br/><b>Registro Modificado con Exito!</b></div>';
		$objConexion->cerrarConexion();
		echo "<p/><p/><p/><p/><p/><p/><p/><p/><p/><p/>";
		exit();
	
}
	/* Funciones de Acceso*/
	function obtenerCodigo(){
		return $codigoEmpleado;
	}
	function establecerCodigo($codigo){
		$this->codigoEmpleado=$codigo;
	}

	function obtenerIdentidad(){
		return $identidad;
	}
	function establecerIdentidad($identidad){
		$this->identidad=$identidad;
	}

	function obtenerNombres(){
		return $nombres;
	}
	function establecerNombres($nombre){
		$this->nombre=$nombres;
	}
    function obtenerApellidos(){
		return $apellidos;
	}
	function establecerApellidos($apellidos){
		$this->apellidos=$apellidos;
	}
	function obtenerDireccion(){
		return $direccion;
	}
	function establecerDireccion($direccion){
		$this->direccion=$direccion;
	}

	function obtenerTelefono(){
		return $telefono;
	}
	function establecerTelefono($telefono){
		$this->telefono=$telefono;
	}

	
	
	function obtenerGenero(){
		return $genero;
	}

	function establecerGenero($genero){
		$this->genero=$genero;
	}


	function obtenerCorreo(){
		return $this->correo;
	}
	function establecerCorreo($correo){
		$this->correo=$correo;
	}
}


?>