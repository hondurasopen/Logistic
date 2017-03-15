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
.Estilo3 {color: #FFFFFF; font-weight: bold; }
</style>
</head>

<body class="twoColFixLtHdr">
<script language="javascript">
	function establecerColorFondo1(fila){
		fila.bgColor="#144A87";
		fila.style.color="#FFFFFF";
		fila.style.bold=true;
	}
	function quitarColorFondo1(fila){
		fila.bgColor="";
		fila.style.color=""
		fila.style.bold=false;

	}
</script>
<?php
include ("clases/conexion.php");
if($_GET['operacion']=='eliminar'){

	include("clases/reservacion.php");
	//1.Crear un ubjeto Reservacion con parametros por defecto
	//2.Llamas a la funcion establecerCodigoReservacion(PARAMETRO ENVIADO CON GET);
	//3.LLamar Funcion Eliminar REservacion
	$objRes=new Reservacion($_GET["codigo_reservacion"],"","","","","","","","");
	echo "AQUI";

	$objRes->eliminarReservacion();



	}
	?>

<div id="containerGrande">
  <div id="headerGrande" align="center"><img src="images/teLLevo2.jpg" alt="Te llevo" width="900" height="120"/>      </div>
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


  <div id="mainContent2" align="center">
	<br/><br/>A continuacion se presentan todas las reservaciones realizadas por las clientes hasta la fecha:<br/><br/>
    <table width="88%" border="1">
      <tr class="Estilo3" bgcolor="#2F82B3">
		<td width="60" height="40" align="center">Accion</td>
        <td width="130" height="40" align="center">Reservacion</td>
        <td width="89" align="center">Cliente</td>
        <td width="87" align="center">Fecha</td>
        <td width="155" align="center">Viaje </td>
        <td width="184" align="center">Origen</td>
        <td width="136" align="center"> Destino</td>
        <td width="138" align="center">Tipo de Pago</td>
        <td width="168" align="center">Estado de Pago</td>
        <td width="56" align="center">Total</td>
        </tr>
      <?php

   $objCon=new Conexion();
   $resultado=$objCon->ejecutarComando("SELECT * FROM  TBL_MV_RESERVACIONES");



   while ($fila=mysql_fetch_array($resultado)){

   printf('<tr onmouseover="establecerColorFondo1(this);" onmouseout="quitarColorFondo1(this);">
		<td ><a href="administrar_reservaciones.php?operacion=eliminar&codigo_reservacion=%s"><img src="images/eliminar.png" width="16" height="16" style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px"/></a></td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%d</td>
        <td >&nbsp;%d</td>
        <td >&nbsp;%d</td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%d</td>

      </tr>',$fila["CODIGO_RESERVACION"],$fila["CODIGO_RESERVACION"],$fila["CODIGO_CLIENTE"],$fila["FECHA_RESERVACION"],$fila["CODIGO_VIAJE"],
      $fila["CODIGO_LUGAR_ORIGEN"],$fila["CODIGO_LUGAR_DESTINO"],$fila["CODIGO_TIPO_PAGO"],$fila["ESTADO_PAGO"],
	  $fila["MONTO_TOTAL"]);
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
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
</html>