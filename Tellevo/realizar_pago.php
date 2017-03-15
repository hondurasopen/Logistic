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
</style></head>

<body class="twoColFixLtHdr">

<div id="contenedor2">
<div id="container">
  <div id="header2">
    
    
      </div>
      <div id="menu">
     <ul>
			<li class="current_page_item"><a href="inicio_empleado.php">Inicio</a></li>
			<li><a href="reservaciones_cliente.php">Reservaciones</a></li>
			<li><a href="promociones_cliente.php">Promociones</a></li>
			<li><a href="consulta_rutas_cliente.php">Rutas</a></li>
			<li><a href="consulta_lugares_cliente.php">Lugares</a></li>
			<li><a href="servicios_cliente.php">Servicios al cliente</a></li>
		</ul>     
  </div>
    

  <div id="mainContent2" align="center">
  <?php if($_GET['paso']=='1'){?>
    <form action="realizar_pago.php?paso=2&tipo=<?php echo $_GET['tipo'];?>" method="post">
      <table width="60%" border="1" cellspacing="0" cellpadding="10px" align="center">
      <tr>
        <td align="left">Codigo Cliente:</td>
        <td align="left"><input type="text" name="txtCliente" size="45"/></td>
      </tr>
      <tr>
        <td align="left">Contrase&ntilde;a:</td>
        <td align="left"><input type="password" name="txtContrasena" size="35"/></td>
      </tr>
      <tr>
        <td align="left"><?php if($_GET['tipo']=='1') echo "Codigo de Reservacion:";?><?php if($_GET['tipo']=='2') echo "Codigo de Reservacion del Paquete:";?> </td>
        <td align="left"><input type="text" name="txtReservacion" size="45"/></td>
      </tr>
      <tr>
        <td align="left">Numero de tarjeta de Credito:</td>
        <td align="left"><input type="text" name="txtTarjeta" size="45"/></td>
      </tr>
      <tr>        
        <td colspan="2" align="center"><input type="submit" value="Realizar Pago"/></td>
      </tr>
    </table>

      <p><img src="images/visamc.gif" alt="VisaMC" width="130" height="38" /></p>
    </form>
	<?php }
	if($_GET['paso']=='2'){
			  include('clases/reservacion.php');
			  include('clases/conexion.php');			  
			  $codigoReservacion=$_POST['txtReservacion'];			  
			  $objReservacion=new Reservacion();
			  $objReservacion->realizarPago($codigoReservacion,$_GET['tipo']);    		  
	}?>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <!-- end #mainContent --></div>	
  <div id="footer">
    <p align="center">www.tellevo.com - UNAH - Proyecto Ingenieria en Sistemas - 2009</p>
  <!-- end #footer --></div>
<!-- end #container --></div></div>
</body>
</html>
