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
    

    <?php
include('clases/conexion.php');

if(($_GET["operacion"]=="agregar")){
	include('clases/validador.php');

	$objValidador=new Validador();
	$objValidador->validarCampoVacio($_POST["txtCodigoLugar"],"Codigo del Lugar");
	$objValidador->validarCampoVacio($_POST["txtNombreLugar"],"Nombre del Lugar");
	$objValidador->validarCampoVacio($_POST["cboDepartamento"],"Codigo del Departamento");
	//$objValidador->validarCampoVacio($_POST["imagen"],"Fotografia del Lugar");
	if(!$objValidador->existenErrores()){
		include('clases/lugar.php');

		$componentes_codigo_depto = split("-",$_POST["cboDepartamento"]);
		$codigo = intval($componentes_codigo_depto[0]);
     		//$ruta = "imagenes_destinos/{$_FILES['imagen'][name]}";
			$ruta = "imagenes_destinos/".$_POST["txtCodigoLugar"].".jpg";
			if(!copy($_FILES['imagen']['tmp_name'], $ruta)) {
				echo "error al copiar el archivo";
			} 
			$objLugar=new Lugar($_POST["txtCodigoLugar"],$_POST["txtNombreLugar"],$_POST["cboDepartamento"],$ruta);
			$objLugar->agregarLugar();
	}

    if($objValidador->existenErrores()){
		$objValidador->imprimirErrores();
	}
}//Fin del if(($_GET["operacion"]=="agregar"))
if(!$_GET["operacion"]){
?>
	<h1> Te Llevo-Administrar Lugares</h1>
    <p>Contenido</p>
    <form name="frmLugar" method="post" action="administrar_lugares.php?operacion=agregar" enctype="multipart/form-data">
    <table width="70%" border="1" bgcolor="#FFFFFF" align="center" cellpadding="10px" cellspacing="0">
      <tr>
        <td width="132">Codigo Lugar</td>
        <td width="144">
            <input type="text" name="txtCodigoLugar"  />

        </td>
      </tr>
      <tr>
        <td>Nombre Lugar</td>
        <td>
            <input type="text" name="txtNombreLugar"  />

        </td>
      </tr>

      <tr>
        <td>Codigo Departamento</td>
        <td><select name="cboDepartamento" id="cboDepartamento">
		<?php
		 $objConexion=new Conexion();
		 $resultadoDepartamento=$objConexion->ejecutarComando("SELECT * FROM TBL_MG_DEPARTAMENTOS;");
		 while($filaDepto=mysql_fetch_array($resultadoDepartamento)){
		 	echo "<option>".$filaDepto['CODIGO_DEPARTAMENTO']."-".$filaDepto['DESCRIPCION_DEPARTAMENTO']."</option>";
		 }
		 mysql_free_result($resultadoDepartamento);
?>
			<option selected></option>
        </select>
        </td>
      </tr>
      <tr>
        <td>Fotografia</td>
        <td> <input type="file" name="imagen" size="40">

 		</td>
      </tr>
      <tr><td colspan="2" bgcolor="#A8D3FF"><div align="center"  background="#7A287A"><input type="submit" value="Guargar"/></div></td></tr>
    </table>
    </form><?php } ?>
 <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <!-- end #mainContent --></div></div></div>
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

    

   