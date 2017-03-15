<?php session_start();
if (!(isset($_SESSION['USUARIO_ADMINISTRADOR']) && isset($_SESSION['CONTRASENA_ADMINISTRADOR']))){
	header('Location:no_autorizado.html');
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script language="javascript" src="javascript/efecto_tabla.js"></script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
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
	include("clases/empleado.php");
	//1.Crear un ubjeto Empleado con parametros por defecto
	//2.Llamas a la funcion establecerCodigoEmpleado(PARAMETRO ENVIADO CON GET);
	//3.LLamar Funcion Eliminar Empleado
	$objEmp=new Empleado($_GET["codigo_empleado"],"","","","","","","","");
	$objEmp->eliminarEmpleado();
	}
?>
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
<?php
  				$objConexion=new Conexion();
?>

				<table width="80%" border="1" cellspacing="0" cellpadding="10px" align="center">
					<tr style="color: #FFFFFF; font-weight: bold; background:#2F82B3" >
						<td width="10%" align="center">Accion</td>
					  <td width="14%" align="center">Codigo Ruta</td>
					  <td width="62%" align="center">Recorrido</td>
					  <td width="14%" align="center">Costo</td>
				  </tr>
<?php



					$resultado=$objConexion->ejecutarComando("SELECT DISTINCT TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA
					FROM TBL_MV_RECORRIDO_RUTA ORDER BY TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA;");
					while($fila=mysql_fetch_array($resultado)){
					$codigoRuta=$fila['CODIGO_RUTA'];
    				//$filaResultadoAuxiliar=mysql_fetch_array($resultadoAuxiliar);
					echo '<tr onmouseover="establecerColorFondo1(this);" onmouseout="quitarColorFondo1(this);">';
					echo '<td width="50" align="center"></td>';
					$resultadoRuta=$objConexion->ejecutarComando("SELECT  TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA,
					TBL_MG_DESTINOS.NOMBRE_DESTINO, TBL_MV_RECORRIDO_RUTA.CARDINALIDAD,
					TBL_MV_RECORRIDO_RUTA.COSTO FROM TBL_MG_DESTINOS INNER JOIN TBL_MV_RECORRIDO_RUTA
					ON TBL_MG_DESTINOS.CODIGO_DESTINO = TBL_MV_RECORRIDO_RUTA.CODIGO_LUGAR
					WHERE TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA='".$codigoRuta."' ORDER BY CARDINALIDAD;");
					$linea="";
					echo "<td>".$codigoRuta."</td>";
					$costoViaje=0;
					while($filaRuta=mysql_fetch_array($resultadoRuta)){
						$lugar=$filaRuta['NOMBRE_DESTINO'];
						$linea.="--".$lugar;
						$costoViaje=$filaRuta['COSTO'];
					}
					echo "<td align='left'>".$linea."</td><td align='left'>L.&nbsp;".$costoViaje."</td>";
					echo "<tr>";
						mysql_free_result($resultadoRuta);
					}
					mysql_free_result($resultado);



			?>
			</table>



			<?php

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
    </div>

  <div id="footer">
    <p align="center">www.tellevo.com - UNAH - Proyecto Ingenieria en Sistemas - 2009</p>
</div>
</div></div>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
</html>