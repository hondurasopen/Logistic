<?php
/*
Clase diseñada para validar distintos tipos de campos
   UNAH-2009
*/

class Validador{
	var $listaErrores;
	var $existeError;
	function __construct(){
		$this->existeError=false;
	}
	//Funcion para validar un campo vacio
	function validarCampoVacio($campo,$nombreCampo){
		if($campo==""||!$campo){
			//echo "Eroorr";
			$this->existeError=true;
			$this->listaErrores[]='El campo <span id="errores">'.$nombreCampo.'</span> esta vacio.';
			//echo "<br>Telefono del Administrador</br>";
		}
	}
	//funcion para imprimir todos los errores almacenados
	function agregarError($mensajeError){
		$this->existeError=true;
		$this->listaErrores[]=$mensajeError;
	}
	function imprimirErrores(){
		if($this->existeError){
			echo '<div id="sidebar2" align="center"><img src="images/error.gif" alt="Error" width="100" height="100" />  </div>';
			echo '<div align="left" id="mainContent"><b>Se encontraron los siguientes errores:</b><br/>';
			for($i=0;$i<count($this->listaErrores);$i++){
				echo $this->listaErrores[$i]."<br/>";
			}
			echo '</p><br/><span id="vinculo"><a href="javascript:history.go(-1)" >Regresar y Realizar Cambios</a></span>';
			echo '</div>';

		}
	}

	//funcion para validar el correo electronico
	function validarCorreo($campo,$nombreCampo){
		if (!eregi("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](g|l|m|pa|t|u|v)?$", $campo, $check)){
			$this->existeError=true;
			$this->listaErrores[]= 'El campo <span id="errores">'.$nombreCampo.'</span> No es una Direccion  E-mail Valida.';
		}
	}

	//funcion para validar la fecha en formato dd/mm/aaaa
	function validarFecha($fecha,$nombreCampo){
		$componentes_fecha = split("/",$fecha);
		$dia = intval($componentes_fecha[0]);
		$mes = intval($componentes_fecha[1]);
		$anio = intval($componentes_fecha[2]);
		$fecha_correcta = checkdate($mes,$dia ,$anio);
		if (!checkdate($mes,$dia ,$anio)) {
			$this->existeError=true;
			$this->listaErrores[]= 'El Campo <span id="errores">'.$nombreCampo.'</span> tiene formato de fecha invalido, el formato debe de ser dd/mm/aaaa';
		}
	}

	//funcion para validar un numero
	function validarNumero($campo,$nombreCampo){
		if(!preg_match("/^\d+/i", $campo)){
			$this->existeError=true;
			$this->listaErrores[]= 'El campo <span id="errores">'.$nombreCampo.'</span> es Invalido (Solamente Caracteres Numericos)';
		}
	}

	//funcion para validar un registro existente dependiendo de  el string de consulta: stringSelect
	function validarRegistroExistente($stringSelect,$stringMensajeError){

		$objConexion=new Conexion();
		$resultado=$objConexion->ejecutarComando($stringSelect);
		$numeroFilas = mysql_num_rows($resultado);	

		if($numeroFilas <=0){			
			$this->existeError=true;
			$this->listaErrores[] =$stringMensajeError;
		}
	}
	
	function validarRegistroExistente2($stringSelect,$stringMensajeError){

		$objConexion=new Conexion();
		$resultado=$objConexion->ejecutarComando($stringSelect);
		$numeroFilas = mysql_num_rows($resultado);	

		if($numeroFilas >0){			
			$this->existeError=true;
			$this->listaErrores[] =$stringMensajeError;
		}
	}

	function operacionHoras($horaFin,$horaInicio,$operacion){
		$componentesHoraFin = split(":",$horaFin);
		$HorasF=intval($componentesHoraFin[0]);
		$MinutosF=intval($componentesHoraFin[1]);
		$SegundosF=intval($componentesHoraFin[2]);

		$componentesHoraInicio = split(":",$horaInicio);
		$HorasI=intval($componentesHoraInicio[0]);
		$MinutosI=intval($componentesHoraInicio[1]);
		$SegundosI=intval($componentesHoraInicio[2]);

		if($operacion=='resta'){
			$Horas=$HorasF - $HorasI;
			$Minutos=$MinutosF - $MinutosI;
			/*if ($Minutos<0) {
				$Minutos=0;
				$Horas--;
			}*/
			$Segundos=$SegundosF - $SegundosI;
		}elseif($operacion=='suma'){
			$Horas=$HorasF+$HorasI;
			$Minutos=$MinutosF+$MinutosI;
			if ($Minutos>=60) {
				$Minutos=60-$Minutos;
				$Horas++;
			}
			$Segundos=$SegundosF+$SegundosI;
		}
		return $Horas.":".$Minutos.":".$Segundos;
	}


	function existenErrores(){
			return $this->existeError;
	}

}

?>