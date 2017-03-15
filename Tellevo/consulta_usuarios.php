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
.Estilo3 {color: #FFFFFF; font-weight: bold; }
</style>
</head>

<body class="twoColFixLtHdr">
<script language="javascript">
	function establecerColorFondo1(fila){
		fila.bgColor="#144A87";
		fila.style.color="#FFFFFF";
		fila.style.bold=true;
	}
	function quitarColorFondo1(fila){
		fila.bgColor="";
		fila.style.color=""
		fila.style.bold=false;

	}
</script>
<?php include('clases/conexion.php');?>
<div id="contenedor2">
<div id="container">
  <div id="headerGrande" align=
"center"><img src="images/teLLevo2.jpg" alt="Te llevo" width="900" height="120"/>      </div>
 <div id="menu">
     <ul>
			<li class="current_page_item"><a href="inicio_administrador.php">Inicio</a></li>
			<li><a href="administrar_rutas.php">Rutas</a></li>
			<li><a href="administrar_promociones.php">Promociones</a></li>
			<li><a href="administrar_lugares.php">Lugares</a></li>
			<li><a href="administracion.php">Administración</a></li>

	</ul>
  </div>

 <div id="mainContent2">

		<br/>
		<br/>
		<h1 align="center">Usuarios disponibles</h1>
		<br/><br/><br/>
        <?php 
		if($_GET['operacion']=='eliminar' && (isset($_SESSION['USUARIO_ADMINISTRADOR']) && isset($_SESSION['CONTRASENA_ADMINISTRADOR']))){
   		
			include("clases/usuario.php");
			$objUsuario=new Usuario($_GET["codigo_empleado"],"" );
			$objUsuario->eliminarUsuario();
		}else if (!(isset($_SESSION['USUARIO_ADMINISTRADOR']) && isset($_SESSION['CONTRASENA_ADMINISTRADOR'])) && $_GET['operacion']=='eliminar'){
			header('Location:no_autorizado.html');		
		}
		
		if(!$_GET['operacion'] or $_GET['operacion']=='eliminar'){
		?>
        
   		<table width="70%" border="1" align="center" >
          <tr class="Estilo3" bgcolor="#2F82B3">
            <td width="63" align="center">Operacion</td>
            <td width="80" height="40" align="center">Codigo Empleado</td>
            <td width="223" align="center">Nombre </td>
            <td width="208" align="center">Apelledos</td>
             <td width="208" align="center">Correo</td>
         </tr>
         <?php 
  
		   $objConexion=new Conexion();
		   $resultado=$objConexion->ejecutarComando("SELECT TBL_MV_USUARIO_KIOSKO.CODIGO_EMPLEADO, TBL_MG_EMPLEADOS.NOMBRES, TBL_MG_EMPLEADOS.APELLIDOS, TBL_MG_EMPLEADOS.CORREO
FROM TBL_MG_EMPLEADOS INNER JOIN TBL_MV_USUARIO_KIOSKO ON TBL_MG_EMPLEADOS.CODIGO_EMPLEADO = TBL_MV_USUARIO_KIOSKO.CODIGO_EMPLEADO
;");
    while ($fila=mysql_fetch_array($resultado)){
    
   printf('<tr onmouseover="establecerColorFondo1(this);" onmouseout="quitarColorFondo1(this);">
        <td align="center">
		<a href="consulta_usuarios.php?operacion=eliminar&codigo_empleado=%s">
			<img src="images/eliminar.png" width="16" height="16" style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px"/>
		</a>	
		
		</a>	
		</td>
		<td align="center">&nbsp;%s</td>
        <td align="left">&nbsp;%s</td>
        <td align="left">&nbsp;%s</td>       
        <td align="left">&nbsp;%s</td>
		
      </tr>',$fila["CODIGO_EMPLEADO"],$fila["CODIGO_EMPLEADO"],$fila["NOMBRES"],$fila["APELLIDOS"],$fila["CORREO"]);
       }
       
       ?>
    </table>
<?php
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
   </div></div>
<br class="clearfloat" />
  <div id="footer">
    <p align="center">www.tellevo.com - UNAH - Proyecto Ingenieria en Sistemas - 2009</p>
  <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>