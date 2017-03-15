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
		<h1 align="center">Reservaciones de paquetes promocionales</h1>
		<br/><br/>

 <?php

    $objConexion=new Conexion();
	$resultadoEncabezado=$objConexion->ejecutarComando("SELECT TBL_MV_PAQUETES.CODIGO_PAQUETE,
	TBL_MV_PAQUETES.CODIGO_RUTA_VIAJE, TBL_MV_PAQUETES.CODIGO_ORIGEN,
	TBL_MV_PAQUETES.CODIGO_DESTINO, TBL_MV_PAQUETES.COSTO_TOTAL,
	TBL_MV_RUTAS_VIAJES.CODIGO_UNIDAD_TRANSPORTE,
	TBL_MV_RUTAS_VIAJES.FECHA_DIAS, TBL_MV_RUTAS_VIAJES.HORA_SALIDA,
	TBL_MV_RUTAS_VIAJES.ASIENTOS_OCUPADOS
	FROM TBL_MV_RUTAS_VIAJES INNER JOIN TBL_MV_PAQUETES
	ON TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE = TBL_MV_PAQUETES.CODIGO_RUTA_VIAJE;");
   while ($filaEncabezado=mysql_fetch_array($resultadoEncabezado)){
?>
<br/><br/>

			<table width="30%" cellpadding="0" cellspacing="0" border="0" align="left">
				<tr>
					<td>
						<strong>Codigo del Paquete:</strong>
					</td>
					<td>
						<?php echo $filaEncabezado['CODIGO_PAQUETE'];?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Codigo Viaje:</strong>
					</td>
					<td>
						<?php echo $filaEncabezado['CODIGO_RUTA_VIAJE'];?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Lugar de Origen:</strong>
					</td>
					<td>
<?php
						$resultadoOrigen=$objConexion->EjecutarComando("
						SELECT TBL_MG_DESTINOS.NOMBRE_DESTINO FROM TBL_MG_DESTINOS
						WHERE (((TBL_MG_DESTINOS.CODIGO_DESTINO)=".$filaEncabezado['CODIGO_ORIGEN']."));");
						$origen=mysql_fetch_array($resultadoOrigen);
						echo $origen['NOMBRE_DESTINO'];
						mysql_free_result($resultadoOrigen);
?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Lugar de Destino:</strong>
					</td>
					<td>
<?php 					$resultadoDestino=$objConexion->EjecutarComando("
						SELECT TBL_MG_DESTINOS.NOMBRE_DESTINO FROM TBL_MG_DESTINOS
						WHERE (((TBL_MG_DESTINOS.CODIGO_DESTINO)=".$filaEncabezado['CODIGO_DESTINO']."));");
						$destino=mysql_fetch_array($resultadoDestino);
						echo $destino['NOMBRE_DESTINO'];
						mysql_free_result($resultadoDestino);
?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Costo:</strong>
					</td>
					<td>
						<?php echo $filaEncabezado['COSTO_TOTAL'];?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Unidad de Transporte:</strong>
					</td>
					<td>
						<?php echo $filaEncabezado['CODIGO_UNIDAD_TRANSPORTE'];?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Fecha del viaje:</strong>
					</td>
					<td>
						<?php echo $filaEncabezado['FECHA_DIAS'];?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Hora de salida:</strong>
					</td>
					<td>
						<?php echo $filaEncabezado['HORA_SALIDA'];?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Asientos ocupados</strong>
					</td>
					<td>
						<?php echo $filaEncabezado['ASIENTOS_OCUPADOS'];?>
					</td>
				</tr>
			</table>

			<br/><br/><br/><br/><br/><br/><br/>

	<?php
				$resultado=$objConexion->ejecutarComando("SELECT TBL_MV_CLIENTE.CODIGO_CLIENTE,
				TBL_MV_CLIENTE.NOMBRES, TBL_MV_CLIENTE.APELLIDOS, TBL_MV_DETALLE_RESERVACION_PAQUETE.NUMERO_ASIENTO,
				 TBL_MG_UBICACIONES_ASIENTOS.UBICACION_ASIENTO FROM TBL_MV_RESERVACIONES_PAQUETES
				INNER JOIN (TBL_MV_CLIENTE INNER JOIN (TBL_MV_DETALLE_RESERVACION_PAQUETE
				INNER JOIN TBL_MG_UBICACIONES_ASIENTOS ON
				TBL_MV_DETALLE_RESERVACION_PAQUETE.CODIGO_UBICACION_ASIENTO =
				TBL_MG_UBICACIONES_ASIENTOS.CODIGO_UBICACION_ASIENTO) ON
				TBL_MV_CLIENTE.CODIGO_CLIENTE = TBL_MV_DETALLE_RESERVACION_PAQUETE.CODIGO_CLIENTE)
				ON TBL_MV_RESERVACIONES_PAQUETES.CODIGO_RESERVACION =
				TBL_MV_DETALLE_RESERVACION_PAQUETE.CODIGO_RESERVACION
				WHERE (((TBL_MV_RESERVACIONES_PAQUETES.CODIGO_PAQUETE)='".$filaEncabezado['CODIGO_PAQUETE']."'));");
				if (mysql_num_rows($resultado)<=0){
					echo '<br/><br/><div align="center"><strong>****Este paquete no tiene reservaciones****</strong></div>';
				}else{


	?>
			<br/><br/><div><br/><strong>Detalle de la reservacion de este paquete:</strong></div><br/>
			<table width="80%" border="1" align="center">
		      <tr class="Estilo3" bgcolor="#2F82B3">
				<td width="80" height="40" align="center">Accion</td>
				<td width="102"  align="center">Codigo Cliente</td>
		        <td width="152" align="center">Nombres</td>
		        <td width="153" align="center">Apellidos </td>
		        <td width="71" align="center">Numero Asiento</td>
		        <td width="90" align="center">Ubicacion</td>
	          </tr>
<?php




		   while ($fila=mysql_fetch_array($resultado)){

		   printf('<tr onmouseover="establecerColorFondo1(this);" onmouseout="quitarColorFondo1(this);">
				<td  align="center"><a href="consulta_reservacion_paquetes.php?operacion=eliminar&codigo_empleado=%s"><img src="images/eliminar.png" width="16" height="16" style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px"/></a>
				<a href="consulta_reservacion_paquetes.php?operacion=editar&codigo_empleado=%s"><img src="images/editar.png" width="16" height="16" style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px"/></a>
				</td>
		        <td >&nbsp;%s</td>
		        <td >&nbsp;%s</td>
		        <td >&nbsp;%s</td>
		        <td >&nbsp;%s</td>
		        <td >&nbsp;%s</td>
		      </tr>',$fila["CODIGO_CLIENTE"],$fila["CODIGO_CLIENTE"],$fila["CODIGO_CLIENTE"],$fila["NOMBRES"],$fila["APELLIDOS"],
		      $fila["NUMERO_ASIENTO"],$fila["UBICACION_ASIENTO"]);
		  }
				mysql_free_result($resultado);

		       ?>
		    </table>


<?php
		}
		echo '<br/><br/><br/><div align="center">-----------------------------------------------------------</div>';
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