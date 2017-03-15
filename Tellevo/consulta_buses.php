<?php session_start();
if (!(isset($_SESSION['USUARIO_ADMINISTRADOR']) && isset($_SESSION['CONTRASENA_ADMINISTRADOR']))){
	header('Location:no_autorizado.html');
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script language="javascript" src="javascript/efecto_tabla.js"></script>
<head>
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

<?php
include ("clases/conexion.php");
if($_GET['operacion']=='eliminar'){
    
	include("clases/bus.php");
	//include("clases/asiento.php");
	
	$objBus=new Bus($_GET["codigo_unidad_transporte"],"","","","","","","","");
	$objAsiento=new Asiento();
	$objBus->eliminarBus();	
	$codigoBus=$_GET["codigo_unidad_transporte"];
	$objAsiento->eliminarAsiento($codigoBus);


	}
	?>
<div id="containerGrande">
  <div id="headerGrande" align="center"><img src="images/teLLevo2.jpg" alt="Te llevo" width="900" height="120"/>      </div>
 <div id="menu">
     <ul>
			<li class="current_page_item"><a href="inicio_administrador.php">Inicio</a></li>
			<li><a href="administrar_rutas.php">Rutas</a></li>
			<li><a href="administrar_promociones.php">Promociones</a></li>
			<li><a href="administrar_lugares.php">Lugares</a></li>
			<li><a href="administracion.php">Administración</a></li>
			
	</ul>      
  </div>
    

  
<!--<h3>Titulo</h3>
    <p>Contenido</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>-->
      <!-- end #sidebar1 -->
    
   
  <div id="mainContent2" align="center">
  <br/><br/><br/>
  <div align="left">
  <h1>Unidades de transporte en inventario.</h1>En esta seccion podra modificar los datos de los buses y eliminarlos .</div><br/><br/>
    <table width="95%" border="1">
      <tr class="Estilo3" bgcolor="#2F82B3">
	    <td width="62" align="center">Accion</td>
        <td width="79" height="40" align="center">Codigo Bus</td>
        <td width="118" align="center">Tipo</td>
        <td width="133" align="center">Numero Placa</td>
        <td width="150" align="center">Modelo </td>
        <td width="199" align="center">Año </td>
        <td width="82" align="center"> Capacidad</td>
        <td width="119" align="center">Clase</td>
        <td width="49" align="center">Codigo Conductor</td>
        <td width="142" align="center">Codigo Asistente</td>
        
      </tr>
      <?php 
  
   $objCon=new Conexion();
   $resultado=$objCon->ejecutarComando("SELECT TBL_MG_UNIDADES_TRANSPORTE.*, TBL_MG_CLASES_UNIDADES_TRANSPORTE.DESCRIPCION_CLASE
FROM TBL_MG_CLASES_UNIDADES_TRANSPORTE INNER JOIN TBL_MG_UNIDADES_TRANSPORTE ON TBL_MG_CLASES_UNIDADES_TRANSPORTE.CODIGO_CLASE = TBL_MG_UNIDADES_TRANSPORTE.CODIGO_CLASE;
");
        
   while ($fila=mysql_fetch_array($resultado)){
    
   printf('<tr onmouseover="establecerColorFondo1(this);" onmouseout="quitarColorFondo1(this);">
	   <td align="center">
	   <a title="Eliminar datos del bus" href="consulta_buses.php?operacion=eliminar&codigo_unidad_transporte=%s">
	   		<img src="images/eliminar.png" width="16" height="16" style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px"/>
		</a>
		
		
		</td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%s</td>
        
      </tr>',$fila["CODIGO_UNIDAD_TRANSPORTE"],$fila["CODIGO_UNIDAD_TRANSPORTE"],$fila["CODIGO_TIPO_UNIDAD_TRANSPORTE"],$fila["NUMERO_PLACA"],$fila["DESCRIPCION_MODELO"],$fila["ANIO_MODELO"],$fila["CAPACIDAD_ASIENTOS"],$fila["DESCRIPCION_CLASE"],$fila["CODIGO_CONDUCTOR"],$fila["CODIGO_ASISTENTE"]);
       }
       
       ?>
    </table>
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
  <!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
  <div id="footer">
    <p align="center">www.tellevo.com - UNAH - Proyecto Ingenieria en Sistemas - 2009</p>
  <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>