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
	  include('clases/validador.php'); 	?>
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

  <div id="mainContent2">
    <br/><br/><br/><h2 align="center">Creacion de paquetes promocinales</h2>
    <?php
	 //Comprobar que la operacion no tenga relacion con el cliente
	 if(!$_GET['paso']||$_GET['operacion']=='buscar_rutas'){
	 ?>
	En esta pagina podra crear paquetes promocinales a partir de viajes previamente creados, estos paquetes estaran conformados por cierta cantidad de boletos a determinado precio.
    <form name="frmReservaRutas" action="administrar_promociones.php?operacion=buscar_rutas" method="post">
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
        <td colspan="2" align="center"><input name="btnBuscarRutas" type="submit" value="Buscar Viajes"/></td>
        </tr>
      </table>

    </form>
    <?php
	}

	?>
    <p>
      <?php
		if ($_GET['operacion']=="buscar_rutas" and $_POST["cboLugaresOrigen"] and $destino=$_POST["cboLugaresDestino"]){

				$objConexion=new Conexion();
				$origen=$_POST["cboLugaresOrigen"];
				$destino=$_POST["cboLugaresDestino"];
				//Buscar Rutas que pasen por el origen o destino seleccionado
				$resultado=$objConexion->ejecutarComando("SELECT DISTINCT TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE
				FROM TBL_MG_DESTINOS INNER JOIN (TBL_MV_RUTAS_VIAJES INNER JOIN TBL_MV_RECORRIDO_RUTA ON
				 TBL_MV_RUTAS_VIAJES.CODIGO_RUTA = TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA) ON
				TBL_MG_DESTINOS.CODIGO_DESTINO = TBL_MV_RECORRIDO_RUTA.CODIGO_LUGAR
				WHERE (((TBL_MG_DESTINOS.NOMBRE_DESTINO)='".$origen."' Or (TBL_MG_DESTINOS.NOMBRE_DESTINO)='".$destino."'));");
				//$objConexion2=new Conexion();
				echo "Rutas disponibles que pasan por $origen y $destino :<br/>";
				//Crear el formulario para elegir una ruta con un radio boton
				echo '<form name="frmElegirRuta" action="administrar_promociones.php?paso=2&nombreOrigen='.$origen.'&nombreDestino='.$destino.'" method="post">';
				echo '<table width="100%" border="1" cellspacing="0" cellpadding="5">
					<tr style="color: #FFFFFF; font-weight: bold; background:#2F82B3" >
						<td align="center">Seleccion</td>
						<td align="center">Ruta</td>
						<td align="center" width="500px">Recorrido</td>
						<td align="center">Fecha/Dias</td>
						<td align="center">Salida</td>
						<td align="center">Llegada</td>
						<td align="center">Costo</td>
					</tr>';
				while($fila=mysql_fetch_array($resultado)){
					$codigoViaje=$fila["CODIGO_VIAJE"];

				//Buscar los destinos que coincidan con el codigo de la ruta, origen y destino, si el resultado es igual a dos significa que pasa por los dos lugares
				$resultadoAuxiliar=$objConexion->ejecutarComando("SELECT TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE,TBL_MV_RUTAS_VIAJES.FECHA_DIAS, TBL_MG_DESTINOS.NOMBRE_DESTINO, TBL_MV_RECORRIDO_RUTA.CARDINALIDAD, TBL_MV_RUTAS_VIAJES.HORA_SALIDA, TBL_MV_RECORRIDO_RUTA.TIEMPO
FROM TBL_MG_DESTINOS INNER JOIN (TBL_MV_RUTAS_VIAJES INNER JOIN TBL_MV_RECORRIDO_RUTA ON TBL_MV_RUTAS_VIAJES.CODIGO_RUTA = TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA) ON TBL_MG_DESTINOS.CODIGO_DESTINO = TBL_MV_RECORRIDO_RUTA.CODIGO_LUGAR
WHERE (((TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE)='".$codigoViaje."') AND ((TBL_MG_DESTINOS.NOMBRE_DESTINO)='".$origen."' Or
				 (TBL_MG_DESTINOS.NOMBRE_DESTINO)='".$destino."')) AND (TIPO_RUTA='O') ORDER BY TBL_MV_RECORRIDO_RUTA.CARDINALIDAD;");

				if(mysql_num_rows($resultadoAuxiliar)==2){



						$objValidadorH=new Validador();
						$filaResultadoAuxiliar=mysql_fetch_array($resultadoAuxiliar);
						$filaResultadoAuxiliar2=mysql_fetch_array($resultadoAuxiliar);
						$horaSalida=$filaResultadoAuxiliar['HORA_SALIDA'];
						$tiempo1=$filaResultadoAuxiliar['TIEMPO'];//Tiempo del origen
						$tiempo2=$filaResultadoAuxiliar2['TIEMPO'];//Tiempo del destino
						$fecha_dias=$filaResultadoAuxiliar['FECHA_DIAS'];
						$tiempo=$objValidadorH->operacionHoras($tiempo2,$tiempo1,'resta');
						$horaLlegada="";
						$horaLlegada=$objValidadorH->operacionHoras($horaSalida,$tiempo,'suma');


						//Comprobar la cardinalidad si pasa primero por el destino seleccionado
						if ($filaResultadoAuxiliar["NOMBRE_DESTINO"]==$origen) {
								echo '<tr onmouseover="establecerColorFondo1(this);" onmouseout="quitarColorFondo1(this);">';
								echo '<td width="50" align="center"><input type="radio" name="codigo_ruta" value="'.$codigoViaje.'" /></td>';
								$resultadoRuta=$objConexion->ejecutarComando("SELECT TBL_MG_DESTINOS.NOMBRE_DESTINO,
								TBL_MV_RECORRIDO_RUTA.CARDINALIDAD, TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE, TBL_MV_RECORRIDO_RUTA.COSTO,
								TBL_MV_RECORRIDO_RUTA.TIEMPO FROM TBL_MG_DESTINOS INNER JOIN (TBL_MV_RUTAS_VIAJES INNER JOIN
								TBL_MV_RECORRIDO_RUTA ON TBL_MV_RUTAS_VIAJES.CODIGO_RUTA = TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA) ON
								TBL_MG_DESTINOS.CODIGO_DESTINO = TBL_MV_RECORRIDO_RUTA.CODIGO_LUGAR
								WHERE (((TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE)='".$codigoViaje."' )) ORDER BY TBL_MV_RECORRIDO_RUTA.CARDINALIDAD;");
								$linea="";
								echo "<td>".$codigoViaje."</td>";
								$costoViaje=0;
								while($filaRuta=mysql_fetch_array($resultadoRuta)){
									$lugar=$filaRuta['NOMBRE_DESTINO'];
									if (($lugar==$origen) or ($lugar==$destino)) {
										$costoViaje=intval($filaRuta['COSTO'])-$costoViaje;
										$lugar='<span id="errores">'.$lugar.'</span>';
									}
									$linea.="->".$lugar;
								}
								echo "<td>".$linea."</td><td>$fecha_dias</td><td>$horaSalida</td><td>$horaLlegada</td><td>L.&nbsp;<b>$costoViaje</b></td>";
								//session_start();
								//$_SESSION['costoViaje']=$costoViaje;
								mysql_free_result($resultadoRuta);
								echo "</tr>";
						}
				}
				mysql_free_result($resultadoAuxiliar);
			}
			echo "</table>";
			echo "<b>*Nota:</b>Los costos mostrados son desde $origen hasta $destino .";
			mysql_free_result($resultado);
			$objConexion->cerrarConexion();

			?>  <br/><br/><br/>
              <table width="65%" border="1" cellspacing="0" cellpadding="10" align="center">
                      <tr>
                        <td align="left">Cantidad de boletos por paquete promocional:</td>
                        <td align="left"><input name="txtCantidadBoletos" type="text" value="0" size="15" /></td>
                      </tr>
                      <tr>
                        <td align="left">Costo total por paquete promocional:</td>
                        <td align="left"><input name="txtCostoTotal" type="text" value="0.00"  size="20"/> Lps.</td>
                      </tr>
              </table>
			<br/><br/>
            <div align="center"> <input type="submit" value="Continuar" /></div>

          </form>

    <?php
	}
	if ($_GET['paso']=='2'){
		session_start();
		$_SESSION['codigo_viaje']=$_POST['codigo_ruta'];
		$_SESSION['origen']=$_GET['nombreOrigen'];
		$_SESSION['destino']=$_GET['nombreDestino'];
		$_SESSION['cantidad_boletos']=$_POST['txtCantidadBoletos'];
		$_SESSION['costo_total']=$_POST['txtCostoTotal'];
	?>

     	<form name="frmConfirmar" action="administrar_promociones.php?paso=3" method="post">
        <table width="65%" border="1" cellspacing="0" cellpadding="10" align="center">
          <tr>
            <td align="left">Codigo Viaje:</td>
            <td align="left"><?php echo $_POST['codigo_ruta']; ?></td>
          </tr>
          <tr>
            <td align="left">Lugar de origen:</td>
            <td align="left"><?php echo $_GET['nombreOrigen'];?></td>
          </tr>
          <tr>
            <td align="left">Lugar de destino:</td>
            <td align="left"><?php echo $_GET['nombreDestino'];?></td>
          </tr>
          <tr>
            <td align="left">Cantidad de boletos por paquete:</td>
            <td align="left"><?php echo $_POST['txtCantidadBoletos'];?></td>
          </tr>
          <tr>
            <td align="left">Costo Total por paquete:</td>
            <td align="left"><?php echo $_POST['txtCostoTotal'];?></td>
          </tr>
          <tr>
            <td align="left">Ingrese el codigo del nuevo paquete promocinal:</td>
            <td align="left"><input name="txtCodigoPaquete" type="text" /></td>
          </tr>
          <tr>
            <td align="left">Descripcion del paquete:</td>
            <td align="left"><input name="txtDescripcion" type="text" /></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input name="bntGuardar" type="submit" value="Guardar" /></td>

          </tr>

        </table>
        </form>

	<?php
		}
			if ($_GET['paso']=='3'){
			include("clases/Paquete.php");
			session_start();			
			$objPaquete=new Paquete($_POST['txtCodigoPaquete'],$_SESSION['codigo_viaje'],$_SESSION['origen'],$_SESSION['destino'],$_SESSION['cantidad_boletos'],$_SESSION['costo_total'],$_POST['txtDescripcion']);

			$objPaquete->agregarPaquete();

		}
	?>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <!-- end #mainContent --></div>
	<br class="clearfloat" />
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