<?php session_start();?>
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
<script language="javascript" src="javascript/efecto_tabla.js"></script>
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
   <?php }else{?>
  <div id="menu2" align="center">
  <table width="900px" height="48" border="0" cellpadding="10" cellspacing="0">
    <tr>
      <td width="47" background="images/extremo_izq.gif" style="background-repeat:no-repeat" >&nbsp;</td>
      <td width="731"  background="images/barra03.gif"bgcolor="#4572AF"><ul id="MenuBar1" class="MenuBarHorizontal">
        <li><a href="inicio_cliente.php" style=" text-align:center">Inicio</a></li>
        <li><a href="#" style=" text-align:center">Reservaciones</a>
        	<ul>
				<li id="borde_inferior"><a href="consulta_viajes.php">Ver viajes</a></li>
            	<li id="borde_inferior"><a href="reservacion_viaje.php">Reservar boleto</a></li>
                <li id="borde_inferior"><a href="consulta_reservacion_cliente.php">Consultar Reservacion</a></li>
                <li><a href="realizar_pago.php?paso=1&tipo=1">Realizar pago</a></li>
            </ul>
        </li>
        <li><a href="#" style=" text-align:center">Promociones</a>
		    <ul>
            	<li id="borde_inferior"><a href="consulta_paquetes.php">Ver paquetes promocionales</a></li>
               	<li id="borde_inferior"><a href="reservacion_paquetes.php?paso=1">Reservar paquetes</a></li>
                <li id="borde_inferior"><a href="consulta_reservacion_paq_cliente.php">Consultar Reservacion</a></li>
                <li><a href="realizar_pago.php?paso=1&tipo=2">Realizar pago</a></li>
            </ul>
        </li>
        <li><a href="consulta_lugares.php" style=" text-align:center">Destinos</a></li>
        <li><a href="#">Ayuda</a></li>      
      </ul>
     </td>
      <td width="62" background="images/extremo_der.gif" style="background-repeat:no-repeat">&nbsp;</td>
    </tr>
  </table>
  </div><?php }?>
<br/><br/><br/>



  <div id="mainContent2">
	<h1 align="center">Viajes Disponibles</h1>
    <?php
     			$objConexion=new Conexion();
				$resultado=$objConexion->ejecutarComando("SELECT DISTINCT TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE
				FROM TBL_MG_DESTINOS INNER JOIN (TBL_MV_RUTAS_VIAJES INNER JOIN TBL_MV_RECORRIDO_RUTA ON
				 TBL_MV_RUTAS_VIAJES.CODIGO_RUTA = TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA) ON
				TBL_MG_DESTINOS.CODIGO_DESTINO = TBL_MV_RECORRIDO_RUTA.CODIGO_LUGAR;");
?>
				<table width="100%" border="1" cellspacing="0" cellpadding="5">
					<tr style="color: #FFFFFF; font-weight: bold; background:#2F82B3" >
<?php 					if ((isset($_SESSION['USUARIO_ADMINISTRADOR']) && isset($_SESSION['CONTRASENA_ADMINISTRADOR']))){
?>						<td align="center">Accion</td>
<?php					} 
?>
						<td align="center">Ruta</td>
						<td align="center" width="500px">Recorrido</td>
						<td align="center">Fecha/Dias</td>
						<td align="center">Salida</td>
						<td align="center">Llegada</td>
						<td align="center">Costo</td>
					</tr>
<?php
				while($fila=mysql_fetch_array($resultado)){
					$codigoViaje=$fila["CODIGO_VIAJE"];


				$resultadoAuxiliar=$objConexion->ejecutarComando("SELECT TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE,
				TBL_MV_RUTAS_VIAJES.FECHA_DIAS, TBL_MG_DESTINOS.NOMBRE_DESTINO,
				TBL_MV_RECORRIDO_RUTA.CARDINALIDAD, TBL_MV_RUTAS_VIAJES.HORA_SALIDA,
				TBL_MV_RECORRIDO_RUTA.TIEMPO FROM TBL_MG_DESTINOS INNER JOIN
				(TBL_MV_RUTAS_VIAJES INNER JOIN TBL_MV_RECORRIDO_RUTA ON
				TBL_MV_RUTAS_VIAJES.CODIGO_RUTA = TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA)
				ON TBL_MG_DESTINOS.CODIGO_DESTINO = TBL_MV_RECORRIDO_RUTA.CODIGO_LUGAR
				WHERE ((TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE)='".$codigoViaje."') 
				ORDER BY TBL_MV_RECORRIDO_RUTA.CARDINALIDAD;");
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
								echo '<tr onmouseover="establecerColorFondo1(this);" onmouseout="quitarColorFondo1(this);">';
								if ((isset($_SESSION['USUARIO_ADMINISTRADOR']) && isset($_SESSION['CONTRASENA_ADMINISTRADOR']))){
									echo '<td width="50" align="center"></td>';
								}
								$resultadoRuta=$objConexion->ejecutarComando("SELECT TBL_MG_DESTINOS.NOMBRE_DESTINO,
								TBL_MV_RECORRIDO_RUTA.CARDINALIDAD, TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE, TBL_MV_RECORRIDO_RUTA.COSTO,
								TBL_MV_RECORRIDO_RUTA.TIEMPO FROM TBL_MG_DESTINOS INNER JOIN (TBL_MV_RUTAS_VIAJES INNER JOIN
								TBL_MV_RECORRIDO_RUTA ON TBL_MV_RUTAS_VIAJES.CODIGO_RUTA = TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA) ON
								TBL_MG_DESTINOS.CODIGO_DESTINO = TBL_MV_RECORRIDO_RUTA.CODIGO_LUGAR
								WHERE (((TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE)='".$codigoViaje."' )) ORDER BY TBL_MV_RECORRIDO_RUTA.CARDINALIDAD;");
								$linea="";
								echo "<td>".$codigoViaje."</td>";
								
								while($filaRuta=mysql_fetch_array($resultadoRuta)){
									$lugar=$filaRuta['NOMBRE_DESTINO'];
									$linea.="->".$lugar;
									$costoViaje=$filaRuta['COSTO'];
								}
								echo "<td>".$linea."</td><td>$fecha_dias</td><td>$horaSalida</td><td>$horaLlegada</td><td>L.&nbsp;<b>$costoViaje</b></td>";
								//session_start();
								$_SESSION['costoViaje']=$costoViaje;
								mysql_free_result($resultadoRuta);
								echo "</tr>";
				mysql_free_result($resultadoAuxiliar);
			}


			mysql_free_result($resultado);
			$objConexion->cerrarConexion();
			?>
	</table>
    </p><br/><br/>
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