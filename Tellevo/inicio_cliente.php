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
<?php include('clases/conexion.php');?>
<div id="contenedor2">
<div id="container">
  <div id="header">


      </div>
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
  </div>
  <div id="mainContent2">
	  <br/>
    <h1> Bienvenido a Te Llevo!!!</h1>
    <p>No busques mas en google, estas en el sitio indicado, somos la empresa de transporte terrestre &quot;Te Llevo!&quot;, en nuestra empresa podras viajar a muchos lugares del pais, con la mayor comodidad, atencion y seguridad. Disfruta con tu familia y amistades de nuestras atenciones, puedes elegir de una variedad de rutas y promociones con las cuales viajaras con las personas que quieras a un costo minimo.</p>
    <p>En este sitio podras realizar tus reservaciones para tus diferentes destinos, podras escoger hasta la comodidad de tu asiento en el autobus, podras realizar tus pagos con tarjeta de credito, en efectivo, o bien simplemente reservar tu boleto y pagar despues.</p>
    <p>Las promociones que ponemos a disposicion, estan organizadas mediante paquetes promocinales, que concisten en un determinado numero de boletos a un precio muy razonable. </p>
	
    </p>
    Para mayor informacion, comentarios o sugerencias escribenos a: &lt;adonde@tellevo.com&gt; o llame a nuestras lineas telefonicas:<br/>
    228-1649, 228-6648, 228-4587, 228-4556, 228-9987, 228-6966.
    <br/>
   
    
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