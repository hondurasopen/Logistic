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
</style>
</head>

<body class="twoColFixLtHdr">

<div id="contenedor2">
<div id="container">
  <div id="header2"></div><?php   
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

     <?php
include('clases/conexion.php');

if(($_GET["operacion"]=="agregar")){
	include('clases/validador.php');

	$objValidador=new Validador();
	$objValidador->validarCampoVacio($_POST["txtCodigoEmpleado"],"Codigo del Empleado");
	$objValidador->validarCampoVacio($_POST["txtIdentidad"],"Numero de Identidad del Empleado");
	$objValidador->validarCampoVacio($_POST["txtNombres"],"Nombres del Empleado");
	$objValidador->validarCampoVacio($_POST["txtApellidos"],"Apellidos del Empleado");
	$objValidador->validarCampoVacio($_POST["txtDireccion"],"Direccion del Empleado");
	$objValidador->validarCampoVacio($_POST["txtTelefono"],"Telefono del Empleado");
	$objValidador->validarCampoVacio($_POST["cboCargo"],"Cargo del Empleado");
	$objValidador->validarCampoVacio($_POST["rgGenero"],"Genero del Empleado");
	$objValidador->validarCampoVacio($_POST["txtCorreo"],"E-mail");
	$objValidador->validarCorreo($_POST["txtCorreo"],"E-Mail Administrador");
	//$objValidador->validarRegistroExistente("SELECT * FROM TBL_MG_EMPLEADOS WHERE CODIGO_EMPLEADO='".$_POST["txtCodigoEmpleado"]."'",'El Empleado con codigo <b>'.$_POST["txtCodigoEmpleado"].'</b><span id="errores"> YA EXISTE.<span>');

	if(!$objValidador->existenErrores()){
		include('clases/empleado.php');

		$objEmpleado=new Empleado($_POST["txtCodigoEmpleado"],$_POST["txtIdentidad"],$_POST["txtNombres"],$_POST["txtApellidos"],$_POST["txtDireccion"],$_POST["txtTelefono"],$_POST["cboCargo"],$_POST["rgGenero"],$_POST["txtCorreo"]);
		$objEmpleado->agregarEmpleado();
	}else{
	?>

	<?php }?>


  	<div id="mainContent2" align="center">
    <?php
	if($objValidador->existenErrores()){
		$objValidador->imprimirErrores();
	}
}//Fin del if(($_GET["operacion"]=="agregar"))
//aqui va el codigo de la operacion modificar
if($_GET["operacion"]=="modificar" ){
	include('clases/validador.php');
	$objValidador=new Validador();
	$objValidador->validarCampoVacio($_POST["txtCodigoEmpleado"],"Codigo del Empleado");
	$objValidador->validarCampoVacio($_POST["txtIdentidad"],"Numero de Identidad del Empleado");
	$objValidador->validarCampoVacio($_POST["txtNombres"],"Nombres del Empleado");
	$objValidador->validarCampoVacio($_POST["txtApellidos"],"Apellidos del Empleado");
	$objValidador->validarCampoVacio($_POST["txtDireccion"],"Direccion del Empleado");
	$objValidador->validarCampoVacio($_POST["txtTelefono"],"Telefono del Empleado");
	$objValidador->validarCampoVacio($_POST["cboCargo"],"Cargo del Empleado");
	$objValidador->validarCampoVacio($_POST["rgGenero"],"Genero del Empleado");
	$objValidador->validarCampoVacio($_POST["txtCorreo"],"E-mail");
	$objValidador->validarCorreo($_POST["txtCorreo"],"E-Mail Administrador");

	if(!$objValidador->existenErrores()){
		include('clases/empleado.php');

		$objEmpleado=new Empleado($_POST["txtCodigoEmpleado"],$_POST["txtIdentidad"],$_POST["txtNombres"],$_POST["txtApellidos"],$_POST["txtDireccion"],$_POST["txtTelefono"],$_POST["cboCargo"],$_POST["rgGenero"],$_POST["txtCorreo"]);
		$objEmpleado->modificarEmpleado();
	}else{
	?>

	<?php }?>


  	<div id="mainContent2" align="center">
    <?php
	if($objValidador->existenErrores()){
		$objValidador->imprimirErrores();
	}
}

if($_GET["operacion"]!="agregar" or $_GET["operacion"]!="modificar" && !$objValidador->existenErrores()){

	echo '<div id="mainContent2" align="center">';
    if($_GET['operacion']=='editar'){
		echo '<form name="frmEmpleado" method="post" action="administracion_empleados.php?operacion=modificar">';
			$objConexion=new Conexion();
		$resultado=$objConexion->ejecutarComando("SELECT TBL_MG_EMPLEADOS.*, TBL_MG_CARGOS_EMPLEADOS.DESCRIPCION_CARGO_EMPLEADO
FROM TBL_MG_CARGOS_EMPLEADOS INNER JOIN TBL_MG_EMPLEADOS ON TBL_MG_CARGOS_EMPLEADOS.CODIGO_CARGO_EMPLEADO = TBL_MG_EMPLEADOS.CODIGO_CARGO
 WHERE CODIGO_EMPLEADO='".$_GET['codigo_empleado']."' ;");
    	$fila=mysql_fetch_array($resultado);
	}else{
		echo '<form name="frmEmpleado" method="post" action="administracion_empleados.php?operacion=agregar">';
	}
?>
    <table  width="80%" cellpadding="10" cellspacing="0" border="1">
      <tr>
        <td align="left">Codigo Empleado: </td>
        <td align="left">
            <?php echo '<input type="text" name="txtCodigoEmpleado" value="'.$fila["CODIGO_EMPLEADO"].'"/>'?>
        </td>
      </tr>
      <tr>
        <td align="left">Numero Identidad:</td>
        <td align="left">
            <input type="text" name="txtIdentidad" value="<?php echo $fila['NUMERO_IDENTIDAD'];?>" />
        </td>
      </tr>
      <tr>
        <td align="left">Nombres:</td>
        <td align="left">
            <input type="text" name="txtNombres" value="<?php echo $fila["NOMBRES"];?>" />
        </td>
      </tr>
      <td align="left">Apellidos:</td>
        <td align="left">
            <input type="text" name="txtApellidos" value="<?php echo $fila["APELLIDOS"];?>" />
        </td>
      </tr>
      <tr>
        <td align="left">Genero:</td>
        <td align="left">

            <label>
              <input type="radio" name="rgGenero" value="F" <?php if($fila["GENERO_EMPLEADO"]=='F') echo "checked";?>/>
              Femenino<?php $fila["GENERO_EMPLEADO"];?></label>
            <label>
              <input type="radio" name="rgGenero" value="M" <?php if($fila["GENERO_EMPLEADO"]=='M') echo "checked";?>/>
              Masculino</label>
            <br />
           </td>
      </tr>

      <tr>
        <td align="left">Cargo:</td>
        <td align="left"><?php
//include("clases/Conexion.php");
//crear un objeto conexion
$obConexion=new Conexion();
//llamar metodo ejecutarComando con un Select para los cargos SELECT CARGO.DESCRIPCION_CARGO FROM CARGO; almacenar el resultado en una variaable
$resultadoCombo=$obConexion->ejecutarComando("SELECT DESCRIPCION_CARGO_EMPLEADO FROM TBL_MG_CARGOS_EMPLEADOS");


?>
          <select name="cboCargo">
        <?php while($filaCombo=mysql_fetch_array($resultadoCombo)){
			if($filaCombo["DESCRIPCION_CARGO_EMPLEADO"]==$fila["DESCRIPCION_CARGO_EMPLEADO"]){
				echo "<option selected>".$filaCombo["DESCRIPCION_CARGO_EMPLEADO"]."</option>";
			}else{
				echo "<option>".$filaCombo["DESCRIPCION_CARGO_EMPLEADO"]."</option>";
			}
        }



		mysql_free_result($resultadoCombo);?>
		<option <?php if(!isset($_GET["operacion"])) echo "selected";?>></option>
        </select>

    	</td>
      </tr>
      <tr>
        <td align="left">Dirección:</td>
        <td align="left">

            <input type="text" name="txtDireccion" value="<?php echo $fila["DIRECCION_DOMICILIO"];?>"  />

        </td>
      </tr>
      <tr>
        <td align="left">Telefono:</td>
        <td align="left">
            <input type="text" name="txtTelefono" value="<?php echo $fila["TELEFONO"];?>"/>

        </td>
      </tr>
      <tr>
        <td align="left">Correo Electronico:</td>
        <td align="left">
            <input type="text" name="txtCorreo"  value="<?php echo $fila["CORREO"];?>" />
        </td>
      </tr>
      <tr><td colspan="2" bgcolor="#A8D3FF"><div align="center"  background="#7A287A"><input type="submit" value="Guargar"/></div></td></tr>
    </table>

    </form>
    <?php }?>
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
<!-- end #container --></div></div>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
</html>