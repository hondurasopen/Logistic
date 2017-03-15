<?php session_start();
if (!(isset($_SESSION['USUARIO_ADMINISTRADOR']) && isset($_SESSION['CONTRASENA_ADMINISTRADOR']))){
	header('Location:no_autorizado.html');
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script language="javascript" src="javascript/efecto_tabla.js"></script>
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

	echo "AQUI";

	$objEmp->eliminarEmpleado();



	}
	?>
<div id="containerGrande">
  <div id="headerGrande" align="center"><img src="images/teLLevo2.jpg" alt="Te llevo" width="900" height="120"/>      </div>
 <div id="menu">
     <ul>
			<li class="current_page_item"><a href="inicio_administrador.php">Inicio</a></li>
			<li><a href="administrar_rutas.php">Rutas</a></li>
			<li><a href="administrar_promociones.php">Promociones</a></li>
			<li><a href="administrar_lugares.php">Lugares</a></li>
			<li><a href="administracion.php">Administración</a></li>
			
	</ul>      
  </div>
    

  
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
  <h1>Empleados inscritos</h1>En esta seccion podra modificar los datos de los empleados, eliminarlos y establecerlos como usuarios en una terminal de venta de boletos.</div><br/><br/>
    <table width="95%" border="1">
      <tr class="Estilo3" bgcolor="#2F82B3">
	    <td width="62" align="center">Accion</td>
        <td width="79" height="40" align="center">Codigo </td>
        <td width="118" align="center">Numero Identidad</td>
        <td width="133" align="center">Nombres</td>
        <td width="150" align="center">Apellidos </td>
        <td width="199" align="center">Direccion Domicilio</td>
        <td width="82" align="center"> Telefono</td>
        <td width="119" align="center">Cargo</td>
        <td width="49" align="center">Genero</td>
        <td width="142" align="center">Correo</td>
        
      </tr>
      <?php 
  
   $objCon=new Conexion();
   $resultado=$objCon->ejecutarComando("SELECT TBL_MG_EMPLEADOS.CODIGO_EMPLEADO, TBL_MG_EMPLEADOS.NUMERO_IDENTIDAD, TBL_MG_EMPLEADOS.NOMBRES, TBL_MG_EMPLEADOS.APELLIDOS, TBL_MG_EMPLEADOS.DIRECCION_DOMICILIO, TBL_MG_EMPLEADOS.TELEFONO, TBL_MG_CARGOS_EMPLEADOS.DESCRIPCION_CARGO_EMPLEADO, TBL_MG_EMPLEADOS.GENERO_EMPLEADO, TBL_MG_EMPLEADOS.CORREO
FROM TBL_MG_CARGOS_EMPLEADOS INNER JOIN TBL_MG_EMPLEADOS ON TBL_MG_CARGOS_EMPLEADOS.CODIGO_CARGO_EMPLEADO = TBL_MG_EMPLEADOS.CODIGO_CARGO;
");
   
  
   
   while ($fila=mysql_fetch_array($resultado)){
    
   printf('<tr onmouseover="establecerColorFondo1(this);" onmouseout="quitarColorFondo1(this);">
	   <td align="center">
	   <a title="Eliminar datos de empleado" href="consulta_empleados.php?operacion=eliminar&codigo_empleado=%s">
	   		<img src="images/eliminar.png" width="16" height="16" style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px"/>
		</a>
			<a title="Modificar Datos" href="administracion_empleados.php?operacion=editar&codigo_empleado=%s"><img src="images/editar.png" width="16" height="16" style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px"/>
			</a>
		<a title="Establecer como usuario de venta" href="administracion_usuarios.php?operacion=usuario&codigo_empleado=%s"><img src="images/usuario.png" width="16" height="16" style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px"/>
		</a>
		
		</td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%s</td>
        <td >&nbsp;%s</td>
        <td align="center">&nbsp;%s</td>
        <td >&nbsp;%s</td>
        
      </tr>',$fila["CODIGO_EMPLEADO"],$fila["CODIGO_EMPLEADO"],$fila["CODIGO_EMPLEADO"],$fila["CODIGO_EMPLEADO"],$fila["NUMERO_IDENTIDAD"],$fila["NOMBRES"],$fila["APELLIDOS"],$fila["DIRECCION_DOMICILIO"],$fila["TELEFONO"],$fila["DESCRIPCION_CARGO_EMPLEADO"],$fila["GENERO_EMPLEADO"],
	  $fila["CORREO"]);
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
</body>
</html>