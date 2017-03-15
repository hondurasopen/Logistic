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
		
        <?php 
		if($_GET['operacion']=='eliminar' && (isset($_SESSION['USUARIO_ADMINISTRADOR']) && isset($_SESSION['CONTRASENA_ADMINISTRADOR']))){
   		
			include("clases/lugar.php");
			$objLugar=new Lugar($_GET["codigo_destino"],"","","" );
			$objLugar->eliminarLugar();
		}else if (!(isset($_SESSION['USUARIO_ADMINISTRADOR']) && isset($_SESSION['CONTRASENA_ADMINISTRADOR'])) && $_GET['operacion']=='eliminar'){
			header('Location:no_autorizado.html');		
		}
		if($_GET['operacion']=='ver'){
		   ///AQUI
		   $objConexion=new Conexion();
		   $resultado=$objConexion->ejecutarComando("SELECT TBL_MG_DESTINOS.NOMBRE_DESTINO, TBL_MG_DEPARTAMENTOS.DESCRIPCION_DEPARTAMENTO, 				TBL_MG_DESTINOS.FOTOGRAFIA
FROM TBL_MG_DEPARTAMENTOS RIGHT JOIN TBL_MG_DESTINOS ON TBL_MG_DEPARTAMENTOS.CODIGO_DEPARTAMENTO = TBL_MG_DESTINOS.CODIGO_DEPARTAMENTO
WHERE TBL_MG_DESTINOS.CODIGO_DESTINO=".$_GET["codigo_destino"].";");
			$fila=mysql_fetch_array($resultado);
			echo "<div align='center'><br/><h1>".$fila['NOMBRE_DESTINO'].", ".$fila["DESCRIPCION_DEPARTAMENTO"]."</h1><br/><br/>";
		   echo  "<img width='800px' src='".$fila["FOTOGRAFIA"]."'></div>";
		    
		   
		}
		if(!$_GET['operacion'] or $_GET['operacion']=='eliminar'){
		?>
        <h1 align="center">Lugares disponibles</h1>
		<br/><br/><br/>
        
   		<table width="70%" border="1" align="center" >
          <tr class="Estilo3" bgcolor="#2F82B3">
            <td width="63" align="center">Operacion</td>
            <td width="80" height="40" align="center">Codigo Lugar</td>
            <td width="223" align="center">Nombre Lugar</td>
            <td width="208" align="center">Departamento</td>
            
         </tr>
         <?php 
  
		   $objCon=new Conexion();
		   $resultado=$objCon->ejecutarComando("SELECT TBL_MG_DESTINOS.CODIGO_DESTINO, TBL_MG_DESTINOS.NOMBRE_DESTINO, TBL_MG_DEPARTAMENTOS.DESCRIPCION_DEPARTAMENTO
FROM TBL_MG_DEPARTAMENTOS RIGHT JOIN TBL_MG_DESTINOS ON TBL_MG_DEPARTAMENTOS.CODIGO_DEPARTAMENTO = TBL_MG_DESTINOS.CODIGO_DEPARTAMENTO;");
    while ($fila=mysql_fetch_array($resultado)){
    
   printf('<tr onmouseover="establecerColorFondo1(this);" onmouseout="quitarColorFondo1(this);">
        <td align="center">
		<a href="consulta_lugares.php?operacion=eliminar&codigo_destino=%s">
			<img src="images/eliminar.png" width="16" height="16" style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px"/>
		</a>	
		<a href="consulta_lugares.php?operacion=ver&codigo_destino=%s">
			<img src="images/ver.png" width="16" height="16" style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px"/>
		</a>	
		</td>
		<td align="center">&nbsp;%s</td>
        <td align="left">&nbsp;%s</td>
        <td align="left">&nbsp;%s</td>       
        
      </tr>',$fila["CODIGO_DESTINO"],$fila["CODIGO_DESTINO"],$fila["CODIGO_DESTINO"],$fila["NOMBRE_DESTINO"],$fila["DESCRIPCION_DEPARTAMENTO"]);
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