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
</style></head>

<body class="twoColFixLtHdr">
<?php include('clases/conexion.php')?>
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

<br/><br/><br/>



  <div id="mainContent2">

    <h1>&nbsp;</h1>
    <?php
	if(!$_GET['paso']){
	?>
    <form name="frmNumTransbordos" method="post" action="administrar_rutas.php?paso=1">
    <table width="542" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td width="415">Numero de transbordos o lugares de parada:&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="text" name="numero_transbordos" id="numero_transbordos" size="15"/></td>
        <td width="81"><input name="btnContinuar1" type="submit" value="Continuar>"/></td>
      </tr>
    </table>
   </form>
   <?php }
   if($_GET['paso']=='1'){
   $transbordos=$_POST['numero_transbordos'];
   echo '<form id="form1" name="form1" method="post" action="administrar_rutas.php?paso=2&numero_transbordos='.$transbordos.'">';
   ?>
   Codigo Ruta:&nbsp;<input name="codigo_ruta" type="text" /><br/>
   <?php

   for($i=0;$i<$transbordos;$i++){
   ?>
   <br/>

	<table width="76%" border="1" cellspacing="0" cellpadding="10" align="center">
      <tr>
        <td width="43%">Lugar:</td>
        <td width="57%">
      		<?php
				echo '<select name="cboLugaresOrigen'.$i.'">';
				$objConexion=new Conexion();
				$resultado=$objConexion->ejecutarComando("SELECT TBL_MG_DESTINOS.NOMBRE_DESTINO FROM TBL_MG_DESTINOS");
				while($fila=mysql_fetch_array($resultado)){
					echo '<OPTION>'.$fila["NOMBRE_DESTINO"].'</OPTION>';
				}
				$objConexion->cerrarConexion();
				mysql_free_result($resultado);
				echo '<OPTION selected></OPTION></select>';
			?>

          </td>
      </tr>
      <tr>
        <td>Costo desde el inicio hasta aquí:</td>
        <td><?php echo '<input name="txtCosto'.$i.'" type="text" size="20" />'; ?>
          Lps.</td>
      </tr>
      <tr>
        <td>Tiempo desde el inicio hasta aquí:</td>
        <td><?php echo '<input name="txtTiempo'.$i.'" type="text" size="20" />'; ?>
          (HH:MM:SS)</td>
      </tr>
    </table>

	<br/><br/>
	<?php }?>
    <div align="center">
      <input name="btnContinuar2" type="submit" value="Guardar Ruta" />
    </div>
    </form>
    <?php }
	if($_GET['paso']=='2'){
		include('clases/ruta.php');
		$objRuta=new Ruta($_POST['codigo_ruta']);
		$objConexion=new Conexion();
		for($j=0;$j<$_GET['numero_transbordos'];$j++){
			$objRuta->agregarLugar($_POST['cboLugaresOrigen'.$j],$j,$_POST['txtCosto'.$j],$_POST['txtTiempo'.$j],$objConexion);
		}
		echo '<div align="center"><br/><img src="images/exito.gif" alt="Error" /><br/><br/><b>Se ha almacenado la ruta correctamente!</b></div>';
	 }?>
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