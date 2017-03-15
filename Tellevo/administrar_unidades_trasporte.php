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
<?php include('clases/Conexion.php');?>
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
    <?php if($_GET['paso']=='1'){?>
    <h1 align="center">Nueva Unidad de Transporte</h1>
    <p align="center">&nbsp;</p>
    <div align="center">
    <form action="administrar_unidades_trasporte.php?paso=2" method="post">
    <table width="75%"  border="1" cellspacing="0" cellpadding="10px">
      <tr>
        <td width="36%" align="left">Numero unidad de transporte</td>
        <td width="64%" align="left">
          <input type="text" name="txtCodigoUnidad" id="txtCodigoUnidad" />
        </td>
      </tr>
      <tr>
        <td align="left">Tipo unidad de transporte</td>
        <td align="left">
        <select name="cboTipoUnidad" id="cboTipoUnidad">
<?php 
		 $objConexion=new Conexion();
		 $resultadoTipoUnidad=$objConexion->ejecutarComando("SELECT TBL_MG_TIPOS_UNIDADES_TRANSPORTE.* FROM TBL_MG_TIPOS_UNIDADES_TRANSPORTE;");		
		 while($filaTipoUnidad=mysql_fetch_array($resultadoTipoUnidad)){
		 	echo "<option>".$filaTipoUnidad['CODIGO_TIPO_UNIDAD_TRANSPORTE']."-".$filaTipoUnidad['TIPO_UNIDAD_TRANSPORTE']."</option>";
		 }
		 mysql_free_result($resultadoTipoUnidad);
?>
			<option selected></option>
        </select>
        </td>
      </tr>
      <tr>
        <td align="left">Numero de placa</td>
        <td align="left"><input type="text" name="txtPlaca" /></td>
      </tr>
      <tr>
        <td align="left">Modelo</td>
        <td align="left"><input type="text" name="txtModelo" /></td>
      </tr>
      <tr>
        <td align="left">Año modelo</td>
        <td align="left"><input type="text" name="txtAnioModelo" /></td>
      </tr>
      <tr>
        <td align="left">Capacidad de asientos</td>
        <td align="left"><input type="text" name="txtAsientos" /></td>
      </tr>
      <tr>
        <td align="left">Clase</td>
        <td align="left">
        <select name="cboClase">
<?php 
		 $resultadoClase=$objConexion->ejecutarComando("SELECT TBL_MG_CLASES_UNIDADES_TRANSPORTE.* FROM TBL_MG_CLASES_UNIDADES_TRANSPORTE;");		
		 while($filaClase=mysql_fetch_array($resultadoClase)){
		 	echo "<option>".$filaClase['CODIGO_CLASE']."-".$filaClase['DESCRIPCION_CLASE']."</option>";
		 }
		 mysql_free_result($resultadoClase);
?>
			<option selected></option>
        </select>
        </td>
      </tr>
      <tr>
        <td align="left">Conductor</td>
        <td align="left">
        <select name="cboConductor">
<?php 
		 $resultadoConductor=$objConexion->ejecutarComando("SELECT TBL_MG_EMPLEADOS.CODIGO_EMPLEADO, 
		 TBL_MG_EMPLEADOS.NOMBRES, TBL_MG_EMPLEADOS.APELLIDOS 
		 FROM TBL_MG_CARGOS_EMPLEADOS INNER JOIN TBL_MG_EMPLEADOS ON 
		 TBL_MG_CARGOS_EMPLEADOS.CODIGO_CARGO_EMPLEADO = TBL_MG_EMPLEADOS.CODIGO_CARGO
		 WHERE (((TBL_MG_CARGOS_EMPLEADOS.CODIGO_CARGO_EMPLEADO)='1'));");		
		 while($filaConductor=mysql_fetch_array($resultadoConductor)){
		 	echo "<option>".$filaConductor['CODIGO_EMPLEADO']."-".$filaConductor['NOMBRES']." ".$filaConductor['APELLIDOS']."</option>";
		 }
		 mysql_free_result($resultadoConductor);
?>
			<option selected></option>
        </select>
        </td>
      </tr>
      <tr>
        <td align="left">Asistente</td>
        <td align="left">
        <select name="cboAsistente">
<?php 
		 $resultadoAsistente=$objConexion->ejecutarComando("SELECT TBL_MG_EMPLEADOS.CODIGO_EMPLEADO, 
		 TBL_MG_EMPLEADOS.NOMBRES, TBL_MG_EMPLEADOS.APELLIDOS 
		 FROM TBL_MG_CARGOS_EMPLEADOS INNER JOIN TBL_MG_EMPLEADOS ON 
		 TBL_MG_CARGOS_EMPLEADOS.CODIGO_CARGO_EMPLEADO = TBL_MG_EMPLEADOS.CODIGO_CARGO
		 WHERE (((TBL_MG_CARGOS_EMPLEADOS.CODIGO_CARGO_EMPLEADO)='2'));");		
		 while($filaAsistente=mysql_fetch_array($resultadoAsistente)){
		 	echo "<option>".$filaAsistente['CODIGO_EMPLEADO']."-".$filaAsistente['NOMBRES']." ".$filaAsistente['APELLIDOS']."</option>";
		 }
		 mysql_free_result($resultadoAsistente);
?>
			<option selected></option>
        </select>
       </td>
      </tr>
      <tr><td colspan="2" align="center"><input type="submit" value="Continuar" /></td></tr>


    </table>
    </form>
    </div>
<?php 
	$objConexion->cerrarConexion();
	}
	if($_GET['paso']=='2'){
		 $objConexion=new Conexion();
		 $resultadoUbicacion=$objConexion->ejecutarComando("SELECT TBL_MG_UBICACIONES_ASIENTOS.* FROM TBL_MG_UBICACIONES_ASIENTOS;");
		 $ubicacionesAsientos="";
		 while($filaUbicacion=mysql_fetch_array($resultadoUbicacion)){
		 	$ubicacionesAsientos[]=$filaUbicacion['UBICACION_ASIENTO']."-".$filaUbicacion['CODIGO_UBICACION_ASIENTO'];
		 }
		 mysql_free_result($resultadoUbicacion);
		 $objConexion->cerrarConexion();
		 $componentesConductor=split("-",$_POST['cboConductor']);
		 $componentesAsistente=split("-",$_POST['cboAsistente']);
		 $componentesTipo=split("-",$_POST['cboTipoUnidad']);
		 $componentesClase=split("-",$_POST['cboClase']);
?>
		<form action="administrar_unidades_trasporte.php?paso=3&
		<?php echo "asientos=".$_POST['txtAsientos']."&codigo=".$_POST['txtCodigoUnidad']."&tipo=".$componentesTipo[0]."&cond=".$componentesConductor[0]."&asis=".$componentesAsistente[0]."&clas=".$componentesClase[0]."&anio=".$_POST['txtAnioModelo']."&mod=".$_POST['txtModelo']."&pla=".$_POST['txtPlaca'];?>" method="post">
	    <table align="center" width="50%" cellpadding="10px" cellspacing="0" border="1">
        <tr>
	        <td width="35%" align="center">Numero de Asiento</td>
            <td width="65%" align="center">Ubicacion</td>
        </tr>
<?php
		$numeroAsientos=intval($_POST['txtAsientos']);
		for($i=0;$i<$numeroAsientos;$i++){
?>
        <tr>
        	<td align="center"><?php echo $i+1;?></td>
            <td align="center"><select name="cboUbicacion<?php echo $i;?>">
              <?php
					$temp=count($ubicacionesAsientos);
					for($j=0;$j<$temp;$j++){
						echo "<option>".$ubicacionesAsientos[$j]."</option>";
					}
?>
              <option selected="selected"></option>
            </select></td>
        </tr>
		

<?php
		}
?>
	<tr>
			<td colspan="2" align="center"><input type="submit" value="Guardar" /></td>
	</tr>
    </table>
	</form>
<?php 
	} 
	if($_GET['paso']=='3'){
	
		//
		include('clases/Bus.php');	
		
		$objBus=new Bus($_GET['codigo'],$_GET['tipo'],$_GET['pla'],$_GET['mod'],$_GET['anio'],$_GET['asientos'],$_GET['clas'], $_GET['cond'],$_GET['asis']);
		$objBus->agregarBus();
		$numeroAsientos=intval($_GET['asientos']);
		$objConexion=new Conexion();	
		for($i=0;$i<$numeroAsientos;$i++){
				$componentesUbicacion=split("-",$_POST['cboUbicacion'.$i]);
				$objBus->agregarAsiento($i,$componentesUbicacion[1],$objConexion);	
		}
		
?>
		
<?php
		$objConexion->cerrarConexion(); 
	}
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
  <!-- end #footer --></div>
<!-- end #container --></div></div>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
</html>