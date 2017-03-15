<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
</style>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body class="twoColFixLtHdr">

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
   
   
  <br/><br/>



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


  <div id="mainContent2">
   
      <?php if (!(isset($_SESSION['USUARIO_ADMINISTRADOR']) && isset($_SESSION['CONTRASENA_ADMINISTRADOR']))){?>
  
   

    <div align="center"><form name="formulario" method="post" action="autenticar.php"><!--guardar_administrador.php?operacion=agregar-->
	    &nbsp;
	    <p><b>Iniciar Sesion para administrador:</b></p>
	    <p><br/>
	      </p>
	    <table width="650" border="1" cellspacing="0" cellpadding="10">
          <tr>
             <td width="206" align="left"> ID Administrador:</td>
            <td width="414" align="left"><input name="txtIDAdministradorInicio" type="text"  size="20"/></td>
          </tr>
           <tr>
             <td align="left">Nombre Usuario Administrador:</td>
             <td align="left"><input name="txtNombreUsuarioAdministrador" type="text" size="60"/></td>
           </tr>
           <tr>
             <td align="left">Contraseña:</td>
             <td align="left"><input name="txtContrasenaAdministradorInicio" type="password" size="40"/></td>
           </tr>
           <tr><td colspan="2" bgcolor="#53A4C2"><div align="center"><input type="submit" value="Ingresar"/></div></td></tr>
         </table>

	  </form></div>
	<?php }
		else{?>
			
            <h1>BIENVENIDO</h1><br/>
            Esta es la interfaz admnistrativa de la empresa de transporte terrestre &quot;Te Llevo&quot; , desde esta pagina podra administrar todos los recursos necesarios que para poder planificar viajes. Aqui podra crear rutas, definir viajes, paquetes promocinales, lugares de viaje, asi como administrar las unidades de transporte, empleados que las conducen, empleados de personal en puntos de venta. Este sitio permite realizar consulta de todas las operaciones realizadas para asi llevar un control organizado,legible y facil de entender.
			
<?php		}?>
	<p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>

    <!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
  <div id="footer">
    <p align="center"><span id="vinculo2"><a href="acerca_de.html">Acerca de Webmasters</a> | <a href="">Contactos</a> | <a href="">Enlaces de Interes</a> | <a href="">Sugerencias</a> | <a href="">Buscar</a></span><br />www.tellevo.com - UNAH Ingenieria en Sistemas- Proyecto Ingenieria del Software - 2009</p>
  </div>
<!-- end #container --></div></div>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
</html>