<?php session_start();
if (!(isset($_SESSION['USUARIO_ADMINISTRADOR']) && isset($_SESSION['CONTRASENA_ADMINISTRADOR']))){
	header('Location:no_autorizado.html');
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Te llevo donde tu quieras!!!</title>
<link href="estilos.css" rel="stylesheet" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
	margin: 0;
	background: #7A287A url(images/img02.jpg) repeat left top;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size: 13px;
	color:#5577C6;
}
</style>
</head>

<body class="twoColFixLtHdr">
<script language="javascript">
function establecerColorFondo1(fila){
	fila.bgColor="#EEEEEE";
}
function quitarColorFondo1(fila){
	fila.bgColor="";
}
</script>
<?php include('clases/conexion.php');
	  include('clases/validador.php')?>
<div id="contenedor2">
<div id="container">
  <div id="header2"></div>
<?php   
   if ($_GET['operacion']=='cerrar_administrador'){ session_unset();}
   if (isset($_SESSION['USUARIO_ADMINISTRADOR']) && isset($_SESSION['CONTRASENA_ADMINISTRADOR'])){

   ?>
   <div id="menu2" align="center">
  <table width="900px" height="48px" border="0" cellpadding="8" cellspacing="0">
    <tr>
      <td width="48" background="images/extremo_izq.gif" style="background-repeat:no-repeat" >&nbsp;</td>
      <td width="747"  background="images/barra03.gif"bgcolor="#4572AF">
      <!--Menu-->
      <ul id="MenuBar1" class="MenuBarHorizontal">
        <li><a href="inicio_administrador.php" style=" text-align:center">Inicio</a></li>
        <li><a href="#" style=" text-align:center">Servicios</a>
	        <ul>
              <li id="borde_inferior"><a href="#">Rutas</a>
                     <ul>
                      <li id="borde_inferior"><a href="administrar_rutas.php">Crear ruta</a></li>
                      <li><a href="consulta_rutas.php">Ver Disponibles</a></li>
                    </ul>
              </li>
              <li id="borde_inferior"><a href="#">Viajes</a>
		            <ul>
                      <li id="borde_inferior"><a href="administrar_viajes.php?paso=apertura_viaje">Apertura Viaje</a></li>
                      <li><a href="consulta_viajes.php">Ver Disponibles</a></li>
                    </ul>
              </li>
              <li id="borde_inferior"><a href="#">Paquetes</a>
	              <ul>
                      <li id="borde_inferior"><a href="administrar_promociones.php">Nuevo Paquete</a></li>
                      <li><a href="consulta_paquetes.php">Ver Disponibles</a></li>
                   </ul>
              </li>
			  <li id="borde_inferior"><a href="consulta_reservaciones.php">Reservaciones</a></li>
			  <li><a href="consulta_reservacion_paquetes.php">Reservaciones Paquetes</a></li>
            </ul>
        </li>
        <li><a href="#" style=" text-align:center">Personal</a>
            <ul>
              <li id="borde_inferior"><a href="#">Empleados</a>
                    <ul>
		              <li id="borde_inferior"><a href="administracion_empleados.php">Nuevo Empleado</a></li>
		              <li><a href="consulta_empleados.php">Consultar</a></li>
        		    </ul>              
              </li>
              <li id="borde_inferior"><a href="asignar_conductor.php">Asignar Conductor</a></li>
              <li><a href="consulta_usuarios.php">Usuarios</a></li>
            </ul>
        </li>
        <li><a href="#" style=" text-align:center">Transporte</a>
            <ul>
                 <li id="borde_inferior"><a href="#">Buses</a>
                     <ul>
    	                 <li id="borde_inferior"><a href="administrar_unidades_trasporte.php?paso=1">Nueva Unidad</a></li>
        	             <li><a href="consulta_buses.php">Consultar</a></li>
	                </ul> 
                 </li>
                 <li><a href="#">Clases sociales</a>
                    <ul>
    	                 <li id="borde_inferior"><a href="administrar_clases.php">Nueva Clase</a></li>
        	             <li><a href="consulta_clase_social">Consultar</a></li>
	                </ul>
                 </li>
            </ul>    
        </li>
        <li><a href="#" style=" text-align:center">Destinos</a>
        <ul>
    		<li id="borde_inferior"><a href="administrar_lugares.php">Nuevo Destino</a></li>
        	<li><a href="consulta_lugares.php">Consultar</a></li>
	    </ul>
        </li>      
      </ul>
      
     </td>
      <td width="57" background="images/extremo_der.gif" style="background-repeat:no-repeat">&nbsp;</td>
    </tr>
  </table>
  </div>
  <div style="padding:10px 10px 10px 10px;" align="right"><span id="vinculo1"><img src="images/usuario_2.png" alt="" /> <a href="inicio_administrador.php?operacion=cerrar_administrador">Cerrar Sesion</a></span></div>
   <?php }?>
<br/><br/><br/>



  <div id="mainContent2">

    <?php
	 //Comprobar que la operacion no tenga relacion con el cliente
	 if(($_GET['paso']=="buscar_rutas")||$_GET['paso']=="apertura_viaje"){?>
     <h1>Apertura de viajes</h1>
     <p>Aqui podra administrar la creacion de nuevos viajes a partir de rutas previamente creadas, para ello elija el origen y destino para examinar las posibles rutas a las cuales podra poner a disposicion para los viajantes.</p>
    <form name="frmReservaRutas" action="<?php echo $_SERVER['PHP_SELF']."?paso=buscar_rutas"?>" method="post">
      <table width="100%" border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td>Seleccione el lugar de origen:
	      <select name="cboLugaresOrigen">

      		<?php
				$objConexion=new Conexion();
				$resultado=$objConexion->ejecutarComando("SELECT TBL_MG_DESTINOS.NOMBRE_DESTINO FROM TBL_MG_DESTINOS");
				while($fila=mysql_fetch_array($resultado)){
					echo '<OPTION>'.$fila["NOMBRE_DESTINO"].'</OPTION>';
				}
				$objConexion->cerrarConexion();
				mysql_free_result($resultado);
			?>
            <OPTION selected></OPTION>
          </select></td>
          <td>Seleccione el lugar de destino:
        <select name="cboLugaresDestino">
	        <?php
				$objConexion=new Conexion();
				$resultado=$objConexion->ejecutarComando("SELECT TBL_MG_DESTINOS.NOMBRE_DESTINO FROM TBL_MG_DESTINOS");
				while($fila=mysql_fetch_array($resultado)){
					echo '<OPTION>'.$fila["NOMBRE_DESTINO"].'</OPTION>';
				}
				$objConexion->cerrarConexion();
				mysql_free_result($resultado);
			?>
             <OPTION selected></OPTION>
          </select></td>

        </tr>
        <tr >
        <td colspan="2" align="center"><input name="btnBuscarRutas" type="submit" value="Buscar Rutas"/><br/><span id="vinculo1"><a href="administrar_viajes.php?paso=buscar_rutas&cantidad=todas">Mostrar todas las rutas disponibles</a></span></td>
        </tr>
      </table>

    </form>
    <?php
	}

	?>
    <p>
      <?php
		if ($_GET['paso']=="buscar_rutas" and $_POST["cboLugaresOrigen"] and $destino=$_POST["cboLugaresDestino"]){

				$objConexion=new Conexion();
				$origen=$_POST["cboLugaresOrigen"];
				$destino=$_POST["cboLugaresDestino"];
				//Buscar Rutas que pasen por el origen o destino seleccionado
				$resultado=$objConexion->ejecutarComando("SELECT DISTINCT TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA FROM TBL_MG_DESTINOS INNER JOIN TBL_MV_RECORRIDO_RUTA ON TBL_MG_DESTINOS.CODIGO_DESTINO = TBL_MV_RECORRIDO_RUTA.CODIGO_LUGAR WHERE (((TBL_MG_DESTINOS.NOMBRE_DESTINO)='".$origen."' Or (TBL_MG_DESTINOS.NOMBRE_DESTINO)='".$destino."'));");
				//$objConexion2=new Conexion();
				echo "Rutas disponibles que pasan por $origen y $destino (seleccione una):<br/>";
				//Crear el formulario para elegir una ruta con un radio boton
				echo '<form name="frmElegirRuta" action="'.$_SERVER['PHP_SELF'].'?paso=2" method="post">';
				echo '<table width="100%" border="1" cellspacing="0" cellpadding="5">
					<tr style="color: #FFFFFF; font-weight: bold; background:#2F82B3" >
						<td align="center">Seleccion</td>
						<td align="center">Codigo Ruta</td>
						<td align="center">Recorrido</td>
						<td align="center">Costo</td>
					</tr>';
				while($fila=mysql_fetch_array($resultado)){
					$codigoViaje=$fila["CODIGO_RUTA"];

				//Buscar los destinos que coincidan con el codigo de la ruta, origen y destino, si el resultado es igual a dos significa que pasa por los dos lugares
					$resultadoAuxiliar=$objConexion->ejecutarComando("SELECT TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA, TBL_MG_DESTINOS.NOMBRE_DESTINO, TBL_MV_RECORRIDO_RUTA.CARDINALIDAD FROM TBL_MG_DESTINOS INNER JOIN TBL_MV_RECORRIDO_RUTA ON TBL_MG_DESTINOS.CODIGO_DESTINO = TBL_MV_RECORRIDO_RUTA.CODIGO_LUGAR
WHERE (((TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA)='".$codigoViaje."') AND ((TBL_MG_DESTINOS.NOMBRE_DESTINO)='".$origen."' Or 									(TBL_MG_DESTINOS.NOMBRE_DESTINO)='".$destino."')) ORDER BY TBL_MV_RECORRIDO_RUTA.CARDINALIDAD;");
				if(mysql_num_rows($resultadoAuxiliar)==2){
						$filaResultadoAuxiliar=mysql_fetch_array($resultadoAuxiliar);
					    //Comprobar la cardinalidad si pasa primero por el destino seleccionado
						if ($filaResultadoAuxiliar["NOMBRE_DESTINO"]==$origen) {
								echo '<tr onmouseover="establecerColorFondo1(this);" onmouseout="quitarColorFondo1(this);">';
								echo '<td width="50" align="center"><input type="radio" name="codigo_ruta" value="'.$codigoViaje.'" /></td>';
								$resultadoRuta=$objConexion->ejecutarComando("SELECT  TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA, TBL_MG_DESTINOS.NOMBRE_DESTINO, TBL_MV_RECORRIDO_RUTA.CARDINALIDAD, TBL_MV_RECORRIDO_RUTA.COSTO
FROM TBL_MG_DESTINOS INNER JOIN TBL_MV_RECORRIDO_RUTA ON TBL_MG_DESTINOS.CODIGO_DESTINO = TBL_MV_RECORRIDO_RUTA.CODIGO_LUGAR
WHERE TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA='".$codigoViaje."' ORDER BY CARDINALIDAD;");
								$linea="";
								echo "<td>".$codigoViaje."</td>";
								$costoViaje=0;
								while($filaRuta=mysql_fetch_array($resultadoRuta)){
									$lugar=$filaRuta['NOMBRE_DESTINO'];
									if (($lugar==$origen) or ($lugar==$destino)) {
										$costoViaje=intval($filaRuta['COSTO'])-$costoViaje;
										$lugar='<span id="errores">'.$lugar.'</span>';
									}
									$linea.="--".$lugar;
								}
								echo "<td>".$linea."</td><td>L.&nbsp;".$costoViaje."</td>";
								mysql_free_result($resultadoRuta);
								echo "<tr>";
						}
				}
				mysql_free_result($resultadoAuxiliar);
			}
			echo "</table>";
			echo "<b>*Nota:</b>Los costos mostrados son desde $origen hasta $destino .";
			?>
				<br/><br/>
				<table><tr><td align="left">Tipo de viaje:</td><td align="left"><label><input type="radio" value="E" name="tipo_ruta"/>Eventual</label>&nbsp;<label><input type="radio" value="P" name="tipo_ruta"/>Permanente</label><label><input type="radio" value="O" name="tipo_ruta"/>Viaje Promocional</label></td></tr></table>

			<?php
			mysql_free_result($resultado);
			$objConexion->cerrarConexion();
			?>
			<input name="btnContinuar2" type="submit" value="Continuar->" />
    </p><br/><br/>
    </form>
      <?php
		}
		if($_GET['paso']=='2'){//llenar los datos de el viaje
			$objValidador=new Validador();
			if (!$_POST['codigo_ruta']) {
					$objValidador->agregarError('Debe de seleccionar el <span id="errores">codigo de la ruta</span>.');
				}
			if (!$_POST['tipo_ruta']) {
					$objValidador->agregarError('Debe de seleccionar el <span id="errores">tipo de viaje</span> que puede ser: <b>Eventual</b> en caso de que el viaje solo se lleve a cabo en una fecha especifica, y <b>Permanente</b> en caso de que el viaje se realice varias veces en distintos dias.');
			}
			if(!$objValidador->existenErrores()){//En caso de que no existan errores
				echo '<div style="padding:0 80px 0 80px">
					A continuacion se le presentan una serie de campos que son necesarios para la creacion de un nuevo viaje.<br/><br/>
					<b>Codigo ruta seleccionada:</b>'.$_POST['codigo_ruta'].'</div>';
					echo '<form name="frmPaso2" action="'.$_SERVER['PHP_SELF'].'?paso=3&codigo_ruta='.$_POST['codigo_ruta'].'&tipo_ruta='.$_POST['tipo_ruta'].'" method="post">'
				?>

			<table align="center" width="70%" border="1" cellspacing="0" cellpadding="5">
				<tr><td align="left">Unidad de Transporte:</td><td align="left"><select name="cboTransporte">
	              <?php
					$objConexion=new Conexion();
					$resultado=$objConexion->ejecutarcomando("SELECT TBL_MG_UNIDADES_TRANSPORTE.CODIGO_UNIDAD_TRANSPORTE FROM TBL_MG_UNIDADES_TRANSPORTE;");
					while($fila=mysql_fetch_array($resultado)){
						echo '<option>'.$fila["CODIGO_UNIDAD_TRANSPORTE"].'</option>';
					}
					mysql_free_result($resultado);
					$objConexion->cerrarConexion();
				?>
	            </select></td>
			  </tr>

				<?php if (($_POST['tipo_ruta']=='E')||($_POST['tipo_ruta']=='O')) {
				?>
						<tr><td align="left">Fecha:</td><td align="left">
						  <input type="text" name="txtFechaDias"/><br/></td>
						</tr>
				<?php
				}else if ($_POST['tipo_ruta']=='P') {?>
						<tr>
							<td align="left"><div>Dias:<p/><p/></div></td>
							<td>
								<table><tr><td><label><input type="checkbox" name="checkLunes" value="L"/>Lunes</label></td>
								<td><label><input type="checkbox" name="checkMartes"  value="M" />Martes</label></td>
								<td><label><input type="checkbox" name="checkMiercoles"  value="Mi"/>Miercoles</label></td>
								</tr>

								<tr>
								<td><label><input type="checkbox" name="checkJueves" value="J"/>Jueves</label></td>
								<td><label><input type="checkbox" name="checkViernes" value="V"/>Viernes</label></td>
								<td><label><input type="checkbox" name="checkSabado"  value="S"/>Sabado</label></td>
								</tr>
								<tr>
								<td><label><input type="checkbox" name="checkDomingo" value="D"/>Domingo</label></td>
								</tr>
								</table>
							</td>
						</tr>
				<?php
				}?>



				<tr><td align="left">Hora de Salida:</td><td align="left"><input type="text" name="txtHora"/></td></tr>
				<tr><td colspan="2" align="center"><input type="submit" value="Continuar->"></td></tr>
			</table>
	        </form>
			<p>
		    <?php
		    }else{//En caso de que si existan errores
		    	$objValidador->imprimirErrores();
			}
		}
		if($_GET['paso']=='3'){//Confirmar Datos
				$objValidador=new Validador();
				$objValidador->validarCampoVacio($_POST['cboTransporte'],"Unidad de Transporte");
				$objValidador->validarCampoVacio($_POST['txtHora'],"Hora de salida");
				if ($_GET['tipo_ruta']=='P') {
					if (!($_POST['checkLunes']||$_POST['checkMartes']||$_POST['checkMiercoles']||$_POST['checkJueves']||$_POST['checkViernes']||$_POST['checkSabado']||$_POST['checkDomingo'])) {
						$objValidador->agregarError('Debe de seleccionar <span id="errores">al menos un dia</span> para definir el horario del viaje permanente.');
					}
				}else if (($_GET['tipo_ruta']=='E')||($_GET['tipo_ruta']=='O')){
					$objValidador->validarCampoVacio($_POST['txtFechaDias'],"Fecha");
				}

				if(!$objValidador->existenErrores()){
						$fecha_dias="";
						echo '<div style="padding:0 80px 0 80px" align="center">Confirme que los datos ingresados y seleccionado sean los correctos luego haga click en guadar.<br/><br/>
						<table cellpadding="10px" width="100%" border="1"><tr"><td>
						<br/><b>Codigo ruta seleccionada:</b></td><td>'.$_GET['codigo_ruta'].'</td></tr>';
						$objConexion=new Conexion();
						$resultadoRecorrido=$objConexion->ejecutarComando("SELECT  TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA, TBL_MG_DESTINOS.NOMBRE_DESTINO, TBL_MV_RECORRIDO_RUTA.CARDINALIDAD, TBL_MV_RECORRIDO_RUTA.COSTO,TBL_MV_RECORRIDO_RUTA.TIEMPO
						FROM TBL_MG_DESTINOS INNER JOIN TBL_MV_RECORRIDO_RUTA ON TBL_MG_DESTINOS.CODIGO_DESTINO = TBL_MV_RECORRIDO_RUTA.CODIGO_LUGAR
						WHERE TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA='".$_GET['codigo_ruta']."' ORDER BY CARDINALIDAD;");
						$recorrido="";
						while($filaRecorrido=mysql_fetch_array($resultadoRecorrido)){
							$recorrido.="->".$filaRecorrido['NOMBRE_DESTINO'];
						}
						echo "<tr><td><br/><b>Recorrido de la ruta:</b></td><td>".$recorrido."</td></tr>";
						echo "<tr><td><br/><b>Tipo de Viaje:</b></td><td>";

						if($_GET['tipo_ruta']=='E'){
							echo "Viaje Eventual";
							$fecha_dias=$_POST['txtFechaDias'];
						}elseif($_GET['tipo_ruta']=='P'){
							echo "Viaje Permanente";
							$fecha_dias=$_POST['checkLunes'].$_POST['checkMartes'].$_POST['checkMiercoles'].$_POST['checkJueves'].$_POST['checkViernes'].$_POST['checkSabado'].$_POST['checkDomingo'];
						}elseif($_GET['tipo_ruta']=='O'){
							echo "Viaje Promocional";
							$fecha_dias=$_POST['txtFechaDias'];
						}
						echo "</td></tr>";
						echo "<tr><td><br/><b>Fecha/Dias:</b></td><td>".$fecha_dias."</td></tr>";
						echo "<tr><td><br/><b>Hora de salida desde el origen:</b></td><td>".$_POST['txtHora']."</td></tr>";
						$resultadoUnidades=$objConexion->ejecutarComando("SELECT TBL_MG_UNIDADES_TRANSPORTE.CODIGO_UNIDAD_TRANSPORTE, TBL_MG_TIPOS_UNIDADES_TRANSPORTE.TIPO_UNIDAD_TRANSPORTE, TBL_MG_UNIDADES_TRANSPORTE.NUMERO_PLACA, TBL_MG_UNIDADES_TRANSPORTE.DESCRIPCION_MODELO, TBL_MG_UNIDADES_TRANSPORTE.ANIO_MODELO, TBL_MG_UNIDADES_TRANSPORTE.CAPACIDAD_ASIENTOS, TBL_MG_CLASES_UNIDADES_TRANSPORTE.DESCRIPCION_CLASE
						FROM TBL_MG_TIPOS_UNIDADES_TRANSPORTE RIGHT JOIN (TBL_MG_CLASES_UNIDADES_TRANSPORTE INNER JOIN TBL_MG_UNIDADES_TRANSPORTE ON TBL_MG_CLASES_UNIDADES_TRANSPORTE.CODIGO_CLASE = TBL_MG_UNIDADES_TRANSPORTE.CODIGO_CLASE) ON TBL_MG_TIPOS_UNIDADES_TRANSPORTE.CODIGO_TIPO_UNIDAD_TRANSPORTE = TBL_MG_UNIDADES_TRANSPORTE.CODIGO_TIPO_UNIDAD_TRANSPORTE
						WHERE (((TBL_MG_UNIDADES_TRANSPORTE.CODIGO_UNIDAD_TRANSPORTE)=".$_POST['cboTransporte']."));");
						$filaEncontrada=mysql_fetch_array($resultadoUnidades);
						echo "<tr><td><br/><b>Codigo de la unidad de Transporte</b></td><td>".$filaEncontrada['CODIGO_UNIDAD_TRANSPORTE']."</td></tr>";
						echo "<tr><td><br/><b>Tipo de unidad de transporte:</b></td><td>".$filaEncontrada['TIPO_UNIDAD_TRANSPORTE']."</td></tr>";
						echo "<tr><td><br/><b>Modelo de unidad de transporte:</b></td><td>".$filaEncontrada['DESCRIPCION_MODELO']."</td></tr>";
		     			echo "<tr><td><br/><b>Categoria del Autobus:</b></td><td>".$filaEncontrada['DESCRIPCION_CLASE']."</td></tr>";
						echo "<tr><td><br/><b>Numero de placa del bus:</b></td><td>".$filaEncontrada['NUMERO_PLACA']."</td></tr>";
						echo "<tr><td><br/><b>Capacidad de pasajeros(Asientos):</b></td><td>".$filaEncontrada['CAPACIDAD_ASIENTOS']."</td></tr></table>";

						mysql_free_result($resultadoUnidades);
						mysql_free_result($resultadoRecorrido);
						$resultadoRecorrido=$objConexion->ejecutarComando("SELECT  TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA, TBL_MG_DESTINOS.NOMBRE_DESTINO, TBL_MV_RECORRIDO_RUTA.CARDINALIDAD, TBL_MV_RECORRIDO_RUTA.COSTO,TBL_MV_RECORRIDO_RUTA.TIEMPO
						FROM TBL_MG_DESTINOS INNER JOIN TBL_MV_RECORRIDO_RUTA ON TBL_MG_DESTINOS.CODIGO_DESTINO = TBL_MV_RECORRIDO_RUTA.CODIGO_LUGAR
						WHERE TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA='".$_GET['codigo_ruta']."' ORDER BY CARDINALIDAD;");
						echo '<br/><br/><b>Detalle de la ruta:</b>';
						echo '<br/><br/><table width="85%" cellpadding="10px" border="1"><tr style="color:#FFFFFF; font-weight: bold; background:#2F82B3 "><td>Transbordo</td><td>Tiempo</td><td>Costo</td></tr>';
						$objValidador=new Validador();
						$horaSalida=$_POST['txtHora'];
						$tiempoAcumulado="";
						while($filaRecorrido=mysql_fetch_array($resultadoRecorrido)){
							//$tiempoAcumulado=$objValidador->operacionHoras($filaRecorrido['TIEMPO'],$tiempoAcumulado,'resta');
							$tiempo=$filaRecorrido['TIEMPO'];

							echo '<tr><td>'.$filaRecorrido['NOMBRE_DESTINO'].'</td><td>'.$objValidador->operacionHoras($horaSalida,$tiempo,'suma').'</td><td>'.$filaRecorrido['COSTO'].'</td></tr>';
						}
						echo '</table><b>Nota:</b>Los costos y el tiempo son desde el origen hasta cada uno de los transbordos.';
						echo '</div>';
						$objConexion->cerrarConexion();
						mysql_free_result($resultadoRecorrido);
					?>
			  </p>
				<p><strong>Si esta completamente seguro de los datos ingresados y/o seleccionados son los correctos, entonces ingrese el codigo que se le asignara a el viaje que sera creado y puesto a disposicion a los viajantes.</strong>
					<br/>
					<br/>
			    </p>
				<div align="center">
				<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']."?paso=4&codigo_ruta=".$_GET['codigo_ruta']."&unidad_transporte=".$_POST['cboTransporte']."&tipo_ruta=".$_GET['tipo_ruta']."&fecha_dias=".$fecha_dias."&hora_salida=".$_POST['txtHora'];?>">
					    <label>Codigo del viaje: <input type="text" name="txtCodigoViaje" id="txtCodigoViaje" /></label>
		                <br/><br/>
		                <input type="submit" value="Guardar y aperturar el nuevo viaje" />
			      </form>
		            </div>
			<?php
			}else{
				$objValidador->imprimirErrores();
			}
		}
		if($_GET['paso']=='4'){
			$objValidador=new Validador();
			$objValidador->validarCampoVacio($_POST['txtCodigoViaje'],"Codigo Viaje");
			$objValidador->validarRegistroExistente2("SELECT TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE FROM TBL_MV_RUTAS_VIAJES WHERE (((TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE)='".$_POST['txtCodigoViaje']."'));",'El viaje con codigo <b>'.$_POST['txtCodigoViaje'].'</b><span id="errores">YA EXISTE</span> intente con otro codigo.');
			if(!$objValidador->existenErrores()){
				include('clases/viaje.php');
				$objViaje=new Viaje($_POST['txtCodigoViaje'],$_GET['codigo_ruta'],$_GET['unidad_transporte'],$_GET['tipo_ruta'],$_GET['fecha_dias'],$_GET['hora_salida'],"");
				$objViaje->agregarViaje();
			}else{
				$objValidador->imprimirErrores();
			}

		}
	?>
      </p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
  <div id="footer">
    <p align="center">www.tellevo.com - UNAH - Proyecto Ingenieria en Sistemas - 2009</p>
  <!-- end #footer --></div>
<!-- end #container --></div></div>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
</html>