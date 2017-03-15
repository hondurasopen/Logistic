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
		<h1 align="center">Paquetes promocionales disponibles</h1>
		<br/><br/>
<?php

?><br/>
    <br/><br/>
    <table border="1" cellspacing="0" cellpadding="10px" align="center" width="95%">
			<tr style="color: #FFFFFF; font-weight: bold; background:#2F82B3">
				<?php if ((isset($_SESSION['USUARIO_ADMINISTRADOR']) && isset($_SESSION['CONTRASENA_ADMINISTRADOR']))){	?>
                <td width="20px">
					Seleccion
				</td>
                <?php } ?>
				<td>
					Descripcion paquete
				</td>
				<td>
					Origen
				</td>
				<td>
					Destino
				</td>
				<td>
					Fecha
				</td>
				<td>
					Hora Salida
				</td>
<td>
					Boletos
				</td>
				<td>
					Costo total
				</td>
			</tr>
	<?php
		$objConexion=new Conexion();
		$resultadoPaquetes=$objConexion->ejecutarComando("SELECT TBL_MV_PAQUETES.*, TBL_MV_RUTAS_VIAJES.FECHA_DIAS,
					TBL_MV_RUTAS_VIAJES.HORA_SALIDA FROM TBL_MV_RUTAS_VIAJES INNER JOIN TBL_MV_PAQUETES ON
					TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE = TBL_MV_PAQUETES.CODIGO_RUTA_VIAJE;");
		while($filaPaquete=mysql_fetch_array($resultadoPaquetes)){
			echo '<tr onmouseover="establecerColorFondo1(this);" onmouseout="quitarColorFondo1(this);">';
			
			if ((isset($_SESSION['USUARIO_ADMINISTRADOR']) && isset($_SESSION['CONTRASENA_ADMINISTRADOR']))){			
			echo '<td align="center"><a href="consulta_paquetes.php"><img src="images/eliminar.png" width="16" height="16" style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px"/></a>
			<a href="consulta_paquetes.php"><img src="images/editar.png" width="16" height="16" style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px"/></a></td>';
			}
			echo '<td align="left">'.$filaPaquete['DESCRIPCION_PAQUETE'].'</td>';
			$sql="SELECT TBL_MG_DESTINOS.NOMBRE_DESTINO FROM TBL_MG_DESTINOS WHERE (((TBL_MG_DESTINOS.CODIGO_DESTINO)=";
			$resultadoOrigen=$objConexion->ejecutarComando($sql.$filaPaquete['CODIGO_ORIGEN']."));");
			$resultadoDestino=$objConexion->ejecutarComando($sql.$filaPaquete['CODIGO_DESTINO']."));");
			$filaOrigen=mysql_fetch_array($resultadoOrigen);
			$filaDestino=mysql_fetch_array($resultadoDestino);
			echo '<td align="left">'.$filaOrigen['NOMBRE_DESTINO'].'</td>';
			echo '<td align="left">'.$filaDestino['NOMBRE_DESTINO'].'</td>';
			echo '<td align="left">'.$filaPaquete['FECHA_DIAS'].'</td>';
			echo '<td align="left">'.$filaPaquete['HORA_SALIDA'].'</td>';
			echo '<td align="left">'.$filaPaquete['CANTIDAD_DE_BOLETOS'].'</td>';
			echo '<td align="left"><b>L.'.$filaPaquete['COSTO_TOTAL'].'</b></td></tr>';

		}
		mysql_free_result($resultadoPaquetes);
		$objConexion->cerrarConexion();

	?>
		</table>
        <br/>
        

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