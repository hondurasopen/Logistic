<?php session_start();
if (!(isset($_SESSION['USUARIO_ADMINISTRADOR']) && isset($_SESSION['CONTRASENA_ADMINISTRADOR']))){
	header('Location:no_autorizado.html');
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="javascript" src="javascript/efecto_tabla.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Te llevo donde tu quieras!!!</title>
<link href="estilos.css" rel="stylesheet" />
<style type="text/css">
body {
	margin: 0;
	background: #7A287A url(images/img02.jpg) repeat left top;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size: 13px;
	color:#5577C6;
}
.Estilo3 {color: #FFFFFF; font-weight: bold; }
</style>
</head>

<body class="twoColFixLtHdr">

<?php include('clases/conexion.php');?>
<div id="contenedor2">
<div id="container">
  <div id="headerGrande" align=
"center"><img src="images/teLLevo2.jpg" alt="Te llevo" width="900" height="120"/>      </div>
 <div id="menu">
     <ul>
			<li class="current_page_item"><a href="inicio_administrador.php">Inicio</a></li>
			<li><a href="administrar_rutas.php">Rutas</a></li>
			<li><a href="administrar_promociones.php">Promociones</a></li>
			<li><a href="administrar_lugares.php">Lugares</a></li>
			<li><a href="administracion.php">Administración</a></li>

	</ul>
  </div>

 <div id="mainContent2">

		<br/>
		<br/>
		<h1 align="center">Reservaciones</h1>
		<br/><br/>

 <?php

    $objConexion=new Conexion();
	$resultadoEncabezado=$objConexion->ejecutarComando("SELECT TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE, TBL_MV_RUTAS_VIAJES.CODIGO_RUTA, TBL_MV_RUTAS_VIAJES.CODIGO_UNIDAD_TRANSPORTE, TBL_MV_RUTAS_VIAJES.TIPO_RUTA, TBL_MG_UNIDADES_TRANSPORTE.CAPACIDAD_ASIENTOS
FROM TBL_MG_UNIDADES_TRANSPORTE INNER JOIN TBL_MV_RUTAS_VIAJES ON TBL_MG_UNIDADES_TRANSPORTE.CODIGO_UNIDAD_TRANSPORTE = TBL_MV_RUTAS_VIAJES.CODIGO_UNIDAD_TRANSPORTE;");
   while ($filaEncabezado=mysql_fetch_array($resultadoEncabezado)){
?>
<br/><br/>

			<table width="98%" cellpadding="0" cellspacing="0" border="0" align="left">
<tr>
					<td width="19%">
						<strong>Codigo del Viaje:</strong>					</td>
	      <td width="81%">
						<?php echo $filaEncabezado['CODIGO_VIAJE'];?>					</td>
			  </tr>
				<tr>
					<td>
						<strong>Codigo de la Ruta:</strong>
					</td>
					<td>
						<?php echo $filaEncabezado['CODIGO_RUTA'];?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Tipo de ruta:</strong>
					</td>
					<td>
					<?php
						if($filaEncabezado['TIPO_RUTA']=='E') echo "Viaje eventual";
						if($filaEncabezado['TIPO_RUTA']=='P') echo "Viaje permanente";
						if($filaEncabezado['TIPO_RUTA']=='O') echo "Viaje eventual paquete promocional";

					?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Recorrido:</strong>
					</td>
					<td>

<?php
						$codigoViaje=$filaEncabezado["CODIGO_VIAJE"];
						$resultadoRuta=$objConexion->ejecutarComando("SELECT TBL_MG_DESTINOS.NOMBRE_DESTINO,
								TBL_MV_RECORRIDO_RUTA.CARDINALIDAD, TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE, TBL_MV_RECORRIDO_RUTA.COSTO,
								TBL_MV_RECORRIDO_RUTA.TIEMPO FROM TBL_MG_DESTINOS INNER JOIN (TBL_MV_RUTAS_VIAJES INNER JOIN
								TBL_MV_RECORRIDO_RUTA ON TBL_MV_RUTAS_VIAJES.CODIGO_RUTA = TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA) ON
								TBL_MG_DESTINOS.CODIGO_DESTINO = TBL_MV_RECORRIDO_RUTA.CODIGO_LUGAR
								WHERE (((TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE)='".$codigoViaje."' )) ORDER BY TBL_MV_RECORRIDO_RUTA.CARDINALIDAD;");
						$linea="";
						while($filaRuta=mysql_fetch_array($resultadoRuta)){
							$lugar=$filaRuta['NOMBRE_DESTINO'];
							$linea.="->".$lugar;
						}
						echo $linea;
						mysql_free_result($resultadoRuta);
?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Unidad de transporte:</strong>
					</td>
					<td>
						<?php echo $filaEncabezado['CODIGO_UNIDAD_TRANSPORTE'];?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Capacidad:</strong>
					</td>
					<td>
						<?php echo $filaEncabezado['CAPACIDAD_ASIENTOS'];?>
					</td>
				</tr>
			</table>

	  <br/><br/><br/><br/>
<?php
	$resultado=$objConexion->ejecutarComando("SELECT TBL_MV_RESERVACIONES.CODIGO_RESERVACION, TBL_MV_CLIENTE.NOMBRES, TBL_MV_CLIENTE.APELLIDOS, TBL_MV_RESERVACIONES.CODIGO_LUGAR_ORIGEN, TBL_MV_RESERVACIONES.CODIGO_LUGAR_DESTINO, TBL_MV_RESERVACIONES.ESTADO_PAGO, TBL_MV_RESERVACIONES.MONTO_TOTAL, TBL_MV_RESERVACIONES.NUMERO_ASIENTO, TBL_MV_RESERVACIONES.CODIGO_CLIENTE, TBL_MG_UBICACIONES_ASIENTOS.UBICACION_ASIENTO
FROM (TBL_MV_CLIENTE INNER JOIN TBL_MV_RESERVACIONES ON TBL_MV_CLIENTE.CODIGO_CLIENTE = TBL_MV_RESERVACIONES.CODIGO_CLIENTE) INNER JOIN TBL_MG_UBICACIONES_ASIENTOS ON TBL_MV_RESERVACIONES.CODIGO_UBICACION_ASIENTO = TBL_MG_UBICACIONES_ASIENTOS.CODIGO_UBICACION_ASIENTO
WHERE (((TBL_MV_RESERVACIONES.CODIGO_VIAJE)='".$filaEncabezado['CODIGO_VIAJE']."'));");
	if (mysql_num_rows($resultado)<=0){
		echo '<br/><br/><div align="center"><strong>****Este viaje no tiene reservaciones****</strong></div>';
	}else{


?>
			<br/><br/><div><br/><strong>Detalle de la reservacion de este viaje:</strong></div><br/>
			<table width="98%" border="1" align="center">
		      <tr class="Estilo3" bgcolor="#2F82B3">
				<td width="58" height="40" align="center">Accion</td>
				<td width="74"  align="center">Codigo  Reservacion</td>
		        <td width="130" align="center">Nombres</td>
		        <td width="105" align="center">Apellidos </td>
		        <td width="81" align="center">Origen</td>
		        <td width="70" align="center">Destino</td>
				<td width="51" align="center">Estado Pago</td>
				<td width="58" align="center">Asiento</td>
				<td width="101" align="center">Ubicacion</td>
				<td width="51" align="center">Monto</td>
	          </tr>
		<?php




		while ($fila=mysql_fetch_array($resultado)){
		
			$resultadoOrigen=$objConexion->EjecutarComando("
			SELECT TBL_MG_DESTINOS.NOMBRE_DESTINO FROM TBL_MG_DESTINOS
			WHERE (((TBL_MG_DESTINOS.CODIGO_DESTINO)=".$fila["CODIGO_LUGAR_ORIGEN"]."));");
			$origen=mysql_fetch_array($resultadoOrigen);
			
			$resultadoDestino=$objConexion->EjecutarComando("
			SELECT TBL_MG_DESTINOS.NOMBRE_DESTINO FROM TBL_MG_DESTINOS
			WHERE (((TBL_MG_DESTINOS.CODIGO_DESTINO)=".$fila['CODIGO_LUGAR_DESTINO']."));");
			$destino=mysql_fetch_array($resultadoDestino);
			
			
			
			printf('<tr onmouseover="establecerColorFondo1(this);" onmouseout="quitarColorFondo1(this);">
				<td  align="center"><a href="consulta_reservacion_paquetes.php?operacion=eliminar&codigo_empleado=%s"><img src="images/eliminar.png" width="16" height="16" style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px"/></a>
				<a href="consulta_reservacion_paquetes.php?operacion=editar&codigo_empleado=%s"><img src="images/editar.png" width="16" height="16" style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px"/></a>
				</td>
			     <td >&nbsp;%s</td>
			     <td >&nbsp;%s</td>
			     <td >&nbsp;%s</td>
			     <td >&nbsp;%s</td>
				 <td >&nbsp;%s</td>
				 <td >&nbsp;%s</td>
				 <td >&nbsp;%s</td>
				 <td >&nbsp;%s</td>
				 <td >L. %d</td>
			   </tr>',
			   $fila["CODIGO_CLIENTE"],
			   $fila["CODIGO_CLIENTE"],
			   $fila["CODIGO_RESERVACION"],
			   $fila["NOMBRES"],
			   $fila["APELLIDOS"],
			   $origen['NOMBRE_DESTINO'],
			   $destino['NOMBRE_DESTINO'],
			   $fila["ESTADO_PAGO"],
			   $fila["NUMERO_ASIENTO"],
			   $fila["UBICACION_ASIENTO"],
			   $fila["MONTO_TOTAL"]);
			   mysql_free_result($resultadoOrigen);
			   mysql_free_result($resultadoDestino);
		}
		mysql_free_result($resultado);
		
		?>
	    </table>


		<?php
		}
		echo '<br/><br/><br/><div align="center">----------------------------------------------------------------------------------------------------------------------------------------------------------</div>';
		}

	$objConexion->cerrarConexion();
?>
    <p>&nbsp;</p>

    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
   </div></div>
<br class="clearfloat" />
  <div id="footer">
    <p align="center">www.tellevo.com - UNAH - Proyecto Ingenieria en Sistemas - 2009</p>
  <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>