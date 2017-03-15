<?php session_start(); ?>
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

<?php include('clases/conexion.php');
$objConexion=new Conexion();?>
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

		<p><br/>
		    <br/>


 <?php
 if($_GET['operacion']=='eliminar'){
 //AQUI
 	include ("clases/reservacion.php");
	$objReservacion=new Reservacion($_GET["reservacion"], "","","","","","","","","","");
	$objReservacion->eliminarReservacion();
	header('location:consulta_reservacion_cliente.php?operacion=consultar');
 }
 if($_GET['operacion']=='consultar'){
	include ("clases/validador.php");
	
	$objValidador=new Validador();
	if(!($_SESSION['cliente'] && $_SESSION['contrasena'])){
			$codigoCliente=$_POST["txtCodigoCliente"];
			$contrasena=$_POST["txtContrasenaCliente"];
			$objValidador->validarRegistroExistente("SELECT TBL_MV_CLIENTE.CODIGO_CLIENTE,
			TBL_MV_CLIENTE.CONTRASENA FROM TBL_MV_CLIENTE WHERE TBL_MV_CLIENTE.CODIGO_CLIENTE='"
			.$codigoCliente."' AND TBL_MV_CLIENTE.CONTRASENA='".$contrasena."';",
			"El Cliente no existe, porfavor introduzca un codigo y contraseña valida");
	}else{
		$codigoCliente=$_SESSION["cliente"];
		$contrasena=$_SESSION["contrasena"];
	}
	if(!$objValidador->existenErrores()){
	$_SESSION['cliente']=$codigoCliente;
	$_SESSION['contrasena']=$contrasena;
	$resultado=$objConexion->ejecutarComando("SELECT TBL_MV_RESERVACIONES.*, TBL_MG_UBICACIONES_ASIENTOS.UBICACION_ASIENTO
	FROM TBL_MV_RESERVACIONES INNER JOIN TBL_MG_UBICACIONES_ASIENTOS ON TBL_MV_RESERVACIONES.CODIGO_UBICACION_ASIENTO = TBL_MG_UBICACIONES_ASIENTOS.CODIGO_UBICACION_ASIENTO
	WHERE TBL_MV_RESERVACIONES.CODIGO_CLIENTE='".$codigoCliente."';");?>
	<table width="95%" cellpadding="10px" cellspacing="0" border="1" align="center">
    <tr style="color: #FFFFFF; font-weight: bold; background:#2F82B3">
    	<td align="center">Accion</td>
    	<td align="center">Codigo reservacion</td>
        <td align="center">Fecha reservacion</td>
        <td align="center">Codigo viaje</td>
        <td align="center">Origen</td>
        <td align="center">Destino</td>
        <td align="center">Estado pago</td>
        <td align="center">Costo</td>
        <td align="center">Ubicacion</td>
        <td align="center">Asiento</td>

    </tr>
	<?php
			while ($fila=mysql_fetch_array($resultado)){

	   printf('<tr onmouseover="establecerColorFondo1(this);" onmouseout="quitarColorFondo1(this);">
			<td align="center">
			<a href="consulta_reservacion_cliente.php?operacion=eliminar&reservacion=%s">
			<img src="images/eliminar.png" width="16" height="16" style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; 								BORDER-RIGHT-WIDTH: 0px"/>
			</a>

			</a>
			</td>
			<td align="left">&nbsp;%s</td>
			<td align="left">&nbsp;%s</td>
			<td align="left">&nbsp;%s</td>
			<td align="left">&nbsp;%s</td>
			<td align="left">&nbsp;%s</td>
			<td align="left">&nbsp;%s</td>
			<td align="left">&nbsp;%s</td>
			<td align="left">&nbsp;%s</td>
			<td align="left">&nbsp;%s</td>

		  </tr>',$fila["CODIGO_RESERVACION"],$fila["CODIGO_RESERVACION"], $fila["FECHA_RESERVACION"],$fila["CODIGO_VIAJE"],$fila["CODIGO_LUGAR_ORIGEN"],$fila["CODIGO_LUGAR_DESTINO"],$fila["ESTADO_PAGO"], $fila["MONTO_TOTAL"], $fila["UBICACION_ASIENTO"], $fila["NUMERO_ASIENTO"]);
		   }
		   ?>
           </table>
		   <?php
		}
		if($objValidador->existenErrores()){
				$objValidador->imprimirErrores();
		}
	$objConexion->cerrarConexion();
	} if(!$_GET['operacion']){
?>
	  </p>
      	<form name="consulta_reservacion_cliente" action="consulta_reservacion_cliente.php?operacion=consultar" method="post">
		<table width="60%" border="1" cellspacing="0" cellpadding="10px" align="center">
          <tr>
            <td align="left">Codigo cliente responsable del paquete:</td>
            <td align="left"><input type="text" name="txtCodigoCliente"  /></td>
          </tr>
          <tr>
            <td align="left">Contrase&ntilde;a Cliente:</td>
            <td align="left"><input type="password" name="txtContrasenaCliente"  /></td>
          </tr>
          <tr><td colspan="2" bgcolor="#A8D3FF"><div align="center"  background="#7A287A"><input type="submit" value="Consultar"/></div></td></tr>
        </table>
        </form>
        <?php }?>
		<p>&nbsp;		        </p>
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