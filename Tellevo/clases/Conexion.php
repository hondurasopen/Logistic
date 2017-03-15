<?php
/*Clase para conectarse con la base de datos*/
class Conexion{
    var $host,$usuario,$contrasena,$conexionMySql,$nombreBaseDatos,$baseDatos;

    function __construct($nombreBaseDatos="tellevo",$host="localhost",$usuario="root",$contrasena=""){
        $this->host=$host;
        $this->usuario=$usuario;
        $this->contrasena=$contrasena;
        $this->nombreBaseDatos=$nombreBaseDatos;
		if(!($this->conexionMySql=mysql_connect($host,$usuario,$contrasena))){
			echo "Error al conectarse";
			exit();
		}
    	//echo "Conexion Exitosa";
		if(!mysql_select_db($nombreBaseDatos,$this->conexionMySql)){
			echo "Error al seleccionar la base de datos:". $this->nombreBaseDatos."<Br>";
		}
    }

    function ejecutarComando($stringConsulta){
       return mysql_query($stringConsulta,$this->conexionMySql);
    }
    function obtenerConexion(){
      return $this->conexionMySql;
    }
	function cerrarConexion(){
		mysql_close($this->conexionMySql);
	}
}
?>