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
</style>
</head>

<body class="twoColFixLtHdr">

<div id="contenedor2">
<div id="container">
  <div id="header2">


      </div>
      <div id="menu">
     <ul>
			<li class="current_page_item"><a href="inicio_administrador.php">Inicio</a></li>
			<li><a href="administrar_rutas.php">Rutas</a></li>
			<li><a href="administrar_promociones.php">Promociones</a></li>
			<li><a href="administrar_lugares.php">Lugares</a></li>
			<li><a href="administracion.php">Administración</a></li>

		</ul>
        <!--<div id="search">
            <form method="get" action="">
                <fieldset>
                <input type="text" name="s" id="search-text" size="15" />
                <input type="submit" id="search-submit" value="Buscar en Google" />
                </fieldset>
            </form>
		</div>-->



  </div>

<br/><br/><br/>
<?php
	if(($_GET["operacion"]=="agregar")){

			include('clases/conexion.php');
			include('clases/validador.php');
			
			$objValidador=new Validador();
			$objValidador->validarCampoVacio($_POST["txtCodigoAdministrador"],"Codigo del Administrador");
			$objValidador->validarCampoVacio($_POST["txtNombre"],"Nombre del Administrador");
			$objValidador->validarCampoVacio($_POST["txtContrasena"],"Contrasena del Administrador");
			$objValidador->validarCampoVacio($_POST["txtConfirmarContrasena"],"Confirmar Contrasena del Administrador");
			$objValidador->validarCampoVacio($_POST["txtDireccion"],"Direccion");
			$objValidador->validarCampoVacio($_POST["txtTelefono"],"Telefono");
			$objValidador->validarCampoVacio($_POST["txtCorreo"],"E-mail");
			$objValidador->validarCorreo($_POST["txtCorreo"],"E-Mail Administrador");
			$objValidador->validarRegistroExistente("SELECT * FROM TBL_MS_ADMINISTRADORES WHERE CODIGO_ADMINISTRADOR='".$_POST["txtCodigoAdministrador"]."'",'El Administrador con codigo <b>'.$_POST["txtCodigoAdministrador"].'</b><span id="errores"> YA EXISTE.<span>');
			
			if(!$objValidador->existenErrores()){
				include('clases/administrador.php');
				$objAdministrador=new Administrador($_POST["txtCodigoAdministrador"],$_POST["txtNombre"],$_POST["txtContrasena"],$_POST["txtDireccion"],$_POST["txtTelefono"],$_POST["txtCorreo"]);
				$objAdministrador->agregarAdministrador();
			}else{
            ?>
  				<!--<div id="sidebar2" align="center"><img src="images/error.gif" alt="Error" width="100" height="100" />  </div>-->
			<?php }?>


  <div id="mainContent2" align="center">

    <?php

 		if($objValidador->existenErrores()){
				$objValidador->imprimirErrores();
		}
}//Fin del if(($_GET["operacion"]=="agregar"))

		if($_GET["operacion"]!="agregar"){
  ?>
	<div id="mainContent2" align="center">
    <b>Nuevo administrador:</b>
      <form name="formularioAgregarAdministrador" method="post" action="nuevo_administrador.php?operacion=agregar"><!--guardar_administrador.php?operacion=agregar-->
		<table  width="80%" cellpadding="10" cellspacing="0" border="1" align="center">
			<tr>
				<td align="left">
					Codigo Administrador:&nbsp;
				</td>
				<td align="left">
					<input type="text" name="txtCodigoAdministrador"/>
				</td>
			</tr>
			<tr>
				<td align="left">
					Nombre Administrador:&nbsp;
				</td>
				<td align="left">
					<input type="text" name="txtNombre"/ size="50">
				</td>
			</tr>
			<tr>
				<td align="left">
					Contraseña:&nbsp;
				</td>
				<td align="left">
					<input type="password" name="txtContrasena"/>
				</td>
			</tr>
			<tr>
				<td align="left">
					Confirmar Contraseña:&nbsp;
				</td>
				<td align="left">
					<input type="password" name="txtConfirmarContrasena"/>
				</td align="left">
			</tr>
			<tr>
				<td align="left">
					Direccion:&nbsp;
				</td>
				<td align="left">
					<input type="text" name="txtDireccion"/ size="50">
				</td>
			</tr>
			<tr>
				<td align="left">
					Telefono:&nbsp;
				</td>
				<td align="left">
					<input type="text" name="txtTelefono"/>
				</td>
			</tr>
            <tr>
				<td align="left">
					E-mail:&nbsp;
				</td>
				<td align="left">
					<input type="text" name="txtCorreo" size="50"/>
				</td>
			</tr>
            <tr><td colspan="2" bgcolor="#A8D3FF"><div align="center" ><input type="submit" value="Guargar"/></div></td></tr>

		</table>

	</form>
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
    <!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
  <div id="footer">
    <p align="center">www.tellevo.com - UNAH - Proyecto Ingenieria en Sistemas - 2009</p>
  <!-- end #footer --></div>
<!-- end #container --></div></div>
</body>
</html>