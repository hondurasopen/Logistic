<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Te llevo donde tu quieras!!!</title>
<link href="estilos.css" rel="stylesheet" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="javascript/efecto_tabla.js"></script>
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


<?php include('clases/conexion.php');
	  include('clases/validador.php'); 	?>
<div id="contenedor2">
<div id="container">
  <div id="header2"></div>
      <div id="menu2" align="center">
  <table width="900px" height="48" border="0" cellpadding="10" cellspacing="0">
    <tr>
      <td width="47" background="images/extremo_izq.gif" style="background-repeat:no-repeat" >&nbsp;</td>
      <td width="731"  background="images/barra03.gif"bgcolor="#4572AF"><ul id="MenuBar1" class="MenuBarHorizontal">
        <li><a href="inicio_cliente.php" style=" text-align:center">Inicio</a></li>
        <li><a href="#" style=" text-align:center">Reservaciones</a>
        	<ul>
				<li id="borde_inferior"><a href="consulta_viajes.php">Ver viajes</a></li>
            	<li id="borde_inferior"><a href="reservacion_viaje.php">Reservar boleto</a></li>
                <li id="borde_inferior"><a href="consulta_reservacion_cliente.php">Consultar Reservacion</a></li>
                <li><a href="realizar_pago.php?paso=1&tipo=1">Realizar pago</a></li>
            </ul>
        </li>
        <li><a href="#" style=" text-align:center">Promociones</a>
		    <ul>
            	<li id="borde_inferior"><a href="consulta_paquetes.php">Ver paquetes promocionales</a></li>
               	<li id="borde_inferior"><a href="reservacion_paquetes.php?paso=1">Reservar paquetes</a></li>
                <li id="borde_inferior"><a href="consulta_reservacion_paq_cliente.php">Consultar Reservacion</a></li>
                <li><a href="realizar_pago.php?paso=1&tipo=2">Realizar pago</a></li>
            </ul>
        </li>
        <li><a href="consulta_lugares.php" style=" text-align:center">Destinos</a></li>
        <li><a href="#">Ayuda</a></li>      
      </ul>
     </td>
      <td width="62" background="images/extremo_der.gif" style="background-repeat:no-repeat">&nbsp;</td>
    </tr>
  </table>
  </div>

<br/><br/><br/>



  <div id="mainContent2">
	<h1 align="center">Reservacion de viaje</h1>
    <?php
	 //Comprobar que la operacion no tenga relacion con el cliente
	 if(!$_GET['paso']||$_GET['operacion']=='buscar_rutas'){
	 	//if($_GET['operacion']!='cliente'){?>
    <form name="frmReservaRutas" action="reservacion_viaje.php?operacion=buscar_rutas" method="post">
      <table width="100%" border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td>Seleccione el lugar de origen:
	      <select name="cboLugaresOrigen">

      		<?php
				$objConexion=new Conexion();
				$resultado=$objConexion->ejecutarComando("SELECT TBL_MG_DESTINOS.NOMBRE_DESTINO FROM TBL_MG_DESTINOS");
				while($fila=mysql_fetch_array($resultado)){
					echo '<OPTION>'.$fila["NOMBRE_DESTINO"].'</OPTION>';
				}
				$objConexion->cerrarConexion();
				mysql_free_result($resultado);
			?>
            <OPTION selected></OPTION>
          </select></td>
          <td>Seleccione el lugar de destino:
        <select name="cboLugaresDestino">
	        <?php
				$objConexion=new Conexion();
				$resultado=$objConexion->ejecutarComando("SELECT TBL_MG_DESTINOS.NOMBRE_DESTINO FROM TBL_MG_DESTINOS");
				while($fila=mysql_fetch_array($resultado)){
					echo '<OPTION>'.$fila["NOMBRE_DESTINO"].'</OPTION>';
				}
				$objConexion->cerrarConexion();
				mysql_free_result($resultado);
			?>
             <OPTION selected></OPTION>
          </select></td>

        </tr>
        <tr >
        <td colspan="2" align="center"><input name="btnBuscarRutas" type="submit" value="Buscar Viajes"/></td>
        </tr>
      </table>

    </form>
    <?php
	}

	?>
    <p>
      <?php
		if ($_GET['operacion']=="buscar_rutas" and $_POST["cboLugaresOrigen"] and $destino=$_POST["cboLugaresDestino"]){

				$objConexion=new Conexion();
				$origen=$_POST["cboLugaresOrigen"];
				$destino=$_POST["cboLugaresDestino"];
				//Buscar Rutas que pasen por el origen o destino seleccionado
				$resultado=$objConexion->ejecutarComando("SELECT DISTINCT TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE
				FROM TBL_MG_DESTINOS INNER JOIN (TBL_MV_RUTAS_VIAJES INNER JOIN TBL_MV_RECORRIDO_RUTA ON
				 TBL_MV_RUTAS_VIAJES.CODIGO_RUTA = TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA) ON
				TBL_MG_DESTINOS.CODIGO_DESTINO = TBL_MV_RECORRIDO_RUTA.CODIGO_LUGAR
				WHERE (((TBL_MG_DESTINOS.NOMBRE_DESTINO)='".$origen."' Or (TBL_MG_DESTINOS.NOMBRE_DESTINO)='".$destino."'));");
				//$objConexion2=new Conexion();
				echo "Rutas disponibles que pasan por $origen y $destino :<br/>";
				//Crear el formulario para elegir una ruta con un radio boton
				echo '<form name="frmElegirRuta" action="reservacion_viaje.php?paso=2&nombreOrigen='.$origen.'&nombreDestino='.$destino.'" method="post">';?>
				<table width="100%" border="1" cellspacing="0" cellpadding="5">
					<tr style="color: #FFFFFF; font-weight: bold; background:#2F82B3" >
						<td align="center">Seleccion</td>
						<td align="center">Ruta</td>
						<td align="center" width="500px">Recorrido</td>
						<td align="center">Fecha/Dias</td>
						<td align="center">Salida</td>
						<td align="center">Llegada</td>
						<td align="center">Costo</td>
					</tr><?php
				while($fila=mysql_fetch_array($resultado)){
					$codigoViaje=$fila["CODIGO_VIAJE"];

				//Buscar los destinos que coincidan con el codigo de la ruta, origen y destino, si el resultado es igual a dos significa que pasa por los dos lugares
				$resultadoAuxiliar=$objConexion->ejecutarComando("SELECT TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE,TBL_MV_RUTAS_VIAJES.FECHA_DIAS, TBL_MG_DESTINOS.NOMBRE_DESTINO, TBL_MV_RECORRIDO_RUTA.CARDINALIDAD, TBL_MV_RUTAS_VIAJES.HORA_SALIDA, TBL_MV_RECORRIDO_RUTA.TIEMPO
FROM TBL_MG_DESTINOS INNER JOIN (TBL_MV_RUTAS_VIAJES INNER JOIN TBL_MV_RECORRIDO_RUTA ON TBL_MV_RUTAS_VIAJES.CODIGO_RUTA = TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA) ON TBL_MG_DESTINOS.CODIGO_DESTINO = TBL_MV_RECORRIDO_RUTA.CODIGO_LUGAR
WHERE (((TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE)='".$codigoViaje."') AND (TIPO_RUTA!='O') AND ((TBL_MG_DESTINOS.NOMBRE_DESTINO)='".$origen."' Or
				 (TBL_MG_DESTINOS.NOMBRE_DESTINO)='".$destino."')) ORDER BY TBL_MV_RECORRIDO_RUTA.CARDINALIDAD;");

				if(mysql_num_rows($resultadoAuxiliar)==2){



						$objValidadorH=new Validador();
						$filaResultadoAuxiliar=mysql_fetch_array($resultadoAuxiliar);
						$filaResultadoAuxiliar2=mysql_fetch_array($resultadoAuxiliar);
						$horaSalida=$filaResultadoAuxiliar['HORA_SALIDA'];
						$tiempo1=$filaResultadoAuxiliar['TIEMPO'];//Tiempo del origen
						$tiempo2=$filaResultadoAuxiliar2['TIEMPO'];//Tiempo del destino
						$fecha_dias=$filaResultadoAuxiliar['FECHA_DIAS'];
						$tiempo=$objValidadorH->operacionHoras($tiempo2,$tiempo1,'resta');
						$horaLlegada="";
						$horaLlegada=$objValidadorH->operacionHoras($horaSalida,$tiempo,'suma');


						//Comprobar la cardinalidad si pasa primero por el destino seleccionado
						if ($filaResultadoAuxiliar["NOMBRE_DESTINO"]==$origen) {
								echo '<tr onmouseover="establecerColorFondo1(this);" onmouseout="quitarColorFondo1(this);">';
								echo '<td width="50" align="center"><input type="radio" name="codigo_ruta" value="'.$codigoViaje.'" /></td>';
								$resultadoRuta=$objConexion->ejecutarComando("SELECT TBL_MG_DESTINOS.NOMBRE_DESTINO,
								TBL_MV_RECORRIDO_RUTA.CARDINALIDAD, TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE, TBL_MV_RECORRIDO_RUTA.COSTO,
								TBL_MV_RECORRIDO_RUTA.TIEMPO FROM TBL_MG_DESTINOS INNER JOIN (TBL_MV_RUTAS_VIAJES INNER JOIN
								TBL_MV_RECORRIDO_RUTA ON TBL_MV_RUTAS_VIAJES.CODIGO_RUTA = TBL_MV_RECORRIDO_RUTA.CODIGO_RUTA) ON
								TBL_MG_DESTINOS.CODIGO_DESTINO = TBL_MV_RECORRIDO_RUTA.CODIGO_LUGAR
								WHERE (((TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE)='".$codigoViaje."' )) ORDER BY TBL_MV_RECORRIDO_RUTA.CARDINALIDAD;");
								$linea="";
								echo "<td>".$codigoViaje."</td>";
								$costoViaje=0;
								while($filaRuta=mysql_fetch_array($resultadoRuta)){
									$lugar=$filaRuta['NOMBRE_DESTINO'];
									if (($lugar==$origen) or ($lugar==$destino)) {
										$costoViaje=intval($filaRuta['COSTO'])-$costoViaje;
										$lugar='<span id="errores">'.$lugar.'</span>';
									}
									$linea.="--".$lugar;
								}
								echo "<td>".$linea."</td><td>$fecha_dias</td><td>$horaSalida</td><td>$horaLlegada</td><td>L.&nbsp;<b>$costoViaje</b></td>";
								//session_start();
								$_SESSION['costoViaje']=$costoViaje;
								mysql_free_result($resultadoRuta);
								echo "</tr>";
						}
				}
				mysql_free_result($resultadoAuxiliar);
			}
			echo "</table>";
			echo "<b>*Nota:</b>Los costos mostrados son desde $origen hasta $destino .";
			mysql_free_result($resultado);
			$objConexion->cerrarConexion();
			?>

    </p><br/><br/>
                <table width="495" border="1" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="137"><label><input type="radio" name="estado_cliente" value="registrado"/>Cliente Registrado</label></td>
                    <td width="121"><label><input type="radio" name="estado_cliente" value="no_registrado"/>Primera Vez</label></td>
                    <td width="207"><input type="submit" name="btnContinuar" id="btnContinuar" value="Continuar con la reservacion->" align="right"/></td>
                  </tr>
      			</table>
          </form>

    <?php
		}
		if($_GET['paso']=='2'){//paso para llenar los campos del cliente
			$objValidador=new Validador();
			//session_start();
			$costoViaje=$_SESSION['costoViaje'];
			if (!$_POST['codigo_ruta']) {
				$objValidador->agregarError('Debe de seleccionar el <span id="errores">codigo del viaje</span> para elegir una ruta.');
			}
			if (!$_POST['estado_cliente']) {
				$objValidador->agregarError('Debe de seleccionar el <span id="errores">estado del cliente</span> que puede ser: <b>Registrado</b> en caso de que ya haya viajado en nuestras agencias y <b>Primera vez</b> en caso de nunca haber viajado en nuestras agencias.');
			}
			if (!$objValidador->existenErrores()) {//verifica si no exiten errores
				echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'?paso=3&estado_cliente='.$_POST['estado_cliente'].'&origen='.$_GET['nombreOrigen'].'&destino='.$_GET['nombreDestino'].'&codigo_ruta='.$_POST['codigo_ruta'].'">';
				echo '<table border="1" cellpadding="5px" width="70%" cellspacing="0" align="center">';
				echo "<tr><td>Codigo Ruta:</td> <td>".$_POST['codigo_ruta']."</td></tr>";
				echo "<tr><td>Origen:</td> <td>".$_GET['nombreOrigen']."</td></tr>";
				echo "<tr><td>Destino:</td> <td>".$_GET['nombreDestino']."</td></tr>";
				echo "<tr><td>Costo del viaje:</td> <td>".$costoViaje."</td></tr></table>";
				$objConexion=new Conexion();
				?>
	            <br/><br/><br/>
	            <table width="80%" border="1" cellspacing="0" cellpadding="10" align="center">
	              <tr>
	                <td align="left">Codigo Cliente:</td>
	                <td align="left"><input name="txtCodigoCliente" type="text" /></td>
	              </tr>
	              <?php if ($_POST['estado_cliente']=='no_registrado'){?>
	              <tr>
	                <td align="left">Nombres:</td>
	                <td align="left"><input name="txtNombres" type="text" size="40" /></td>
	              </tr>
	              <tr>
	                <td align="left">Apellidos:</td>
	                <td align="left"><input name="txtApellidos" type="text" size="40" /></td>
	              </tr>
	              <tr>
	                <td align="left">Fecha de Nacimiento</td>
	                <td align="left"><input name="txtFechaNacimiento" type="text" size="20" /></td>
	              </tr>
	              <tr>
	                <td align="left">Genero:</td>
	                <td align="left">
	                  <label>
	                    <input type="radio" name="genero" value="M" id="genero_0" />
	                    Masculino</label>

	                  <label>
	                    <input type="radio" name="genero" value="F" id="genero_1" />
	                    Femenino</label>
	                  <br />                </td>
	              </tr>
	              <tr>
	                <td align="left">Direccion:</td>
	                <td align="left"><textarea name="txtDireccion" cols="50" rows="3"></textarea></td>
	              </tr>
	              <tr>
	                <td  align="left">Telefono:</td>
	                <td  align="left"><input name="txtTelefono" type="text" size="25" /></td>
	              </tr>
	              <tr>
	                <td align="left">Correo Electronico:</td>
	                <td align="left"><input name="txtCorreo" type="text" size="60" /></td>
	              </tr>
	              <tr><?php }?>
	                <td align="left">Contrase&ntilde;a</td>
	                <td align="left"><input name="txtContrasena" type="password" size="30" /></td>
	              </tr>
	              <?php if ($_POST['estado_cliente']=='no_registrado'){?>
	              <tr>
	                <td align="left">Confirmar Contrase&ntilde;a</td>
	                <td align="left"><input name="txtConfirmContrasena" type="password" size="30" /></td>
	              </tr>
	              <?php } ?>
	              <tr>
	              	<td align="left">Asiento en el autobus:</td>


				<?php
				$resultadoBus=$objConexion->ejecutarComando("SELECT TBL_MV_RUTAS_VIAJES.CODIGO_UNIDAD_TRANSPORTE
				FROM TBL_MV_RUTAS_VIAJES
				WHERE (((TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE)='".$_POST['codigo_ruta']."'));");
				$filaBus=mysql_fetch_array($resultadoBus);


				$resultado=$objConexion->ejecutarComando("SELECT TBL_MG_ASIENTOS_UNIDADES_TRANSPORTE.NUMERO_ASIENTO, TBL_MG_UBICACIONES_ASIENTOS.UBICACION_ASIENTO, TBL_MG_ASIENTOS_UNIDADES_TRANSPORTE.CODIGO_UBICACION_ASIENTO
	FROM TBL_MG_UBICACIONES_ASIENTOS RIGHT JOIN TBL_MG_ASIENTOS_UNIDADES_TRANSPORTE ON TBL_MG_UBICACIONES_ASIENTOS.CODIGO_UBICACION_ASIENTO = TBL_MG_ASIENTOS_UNIDADES_TRANSPORTE.CODIGO_UBICACION_ASIENTO
	WHERE (((TBL_MG_ASIENTOS_UNIDADES_TRANSPORTE.NUMERO_ASIENTO) Not In (SELECT TBL_MV_RESERVACIONES.NUMERO_ASIENTO
	FROM TBL_MV_RUTAS_VIAJES INNER JOIN (TBL_MG_UBICACIONES_ASIENTOS INNER JOIN TBL_MV_RESERVACIONES ON TBL_MG_UBICACIONES_ASIENTOS.CODIGO_UBICACION_ASIENTO = TBL_MV_RESERVACIONES.CODIGO_UBICACION_ASIENTO) ON TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE = TBL_MV_RESERVACIONES.CODIGO_VIAJE
	WHERE (((TBL_MV_RUTAS_VIAJES.CODIGO_UNIDAD_TRANSPORTE)=".$filaBus['CODIGO_UNIDAD_TRANSPORTE'].") AND ((TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE)='".$_POST['codigo_ruta']."')))) AND ((TBL_MG_ASIENTOS_UNIDADES_TRANSPORTE.CODIGO_UNIDAD_TRANSPORTE) In (SELECT TBL_MV_RUTAS_VIAJES.CODIGO_UNIDAD_TRANSPORTE
	FROM TBL_MV_RUTAS_VIAJES
	WHERE (((TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE)='".$_POST['codigo_ruta']."')))));");
				?>
	            <td>
	            <select name="cboAsientos">
	            <option selected="selected"></option>
				<?php

				while($fila=mysql_fetch_array($resultado)){
					echo '<option>'.$fila['NUMERO_ASIENTO']."-".$fila['CODIGO_UBICACION_ASIENTO']."-".$fila['UBICACION_ASIENTO'].'</option>';
				}
				mysql_free_result($resultado);
				mysql_free_result($resultadoBus);
				$objConexion->cerrarConexion();
		?>
				</select>            </td></tr>
	            <tr style="color: #FFFFFF; font-weight: bold; background:#2F82B3"><td  colspan="2" align="center"><input type="button" value="Regresar" onclick="javascript:history.go(-1);"/><input type="submit" value="Continuar" /></form></td></tr>
	            </table>


			<?php
			}else{//en caso de que existan errores
				$objValidador->imprimirErrores();
			}
		}//Fin del paso 2

		if($_GET['paso']=='3'){//Confirmar los datos ingresados
			$objValidador=new Validador();
			if ($_GET['estado_cliente']=='registrado'){
				$objConexion=new Conexion();

				$resultado=$objConexion->ejecutarComando("SELECT TBL_MV_CLIENTE.* FROM TBL_MV_CLIENTE WHERE (((TBL_MV_CLIENTE.CODIGO_CLIENTE)='".$_POST['txtCodigoCliente']."') AND ((TBL_MV_CLIENTE.CONTRASENA)='".$_POST['txtContrasena']."'));");
				if($cliente=mysql_fetch_array($resultado)){

					$codigoCliente=$cliente['CODIGO_CLIENTE'];
					$nombresCliente=$cliente['NOMBRES'];
					$apellidosCliente=$cliente['APELLIDOS'];
					$fechaNacimiento=$cliente['FECHA_NACIMIENTO'];
					$generoCliente=$cliente['GENERO'];
					$direccionCliente=$cliente['DIRECCION'];
					$telefonoCliente=$cliente['TELEFONO'];
					$correoElectronico=$cliente['CORREO_ELECTRONICO'];
					$contrasena=$cliente['CONTRASENA'];
					$asiento=$_POST['cboAsientos'];
					mysql_free_result($resultado);
					$objConexion->cerrarConexion();
				}else{
					$objValidador->agregarError('El cliente con codigo '.$_POST['txtCodigoCliente'].' <span id="errores">NO EXISTE</span>, vuelva a intentar con otro codigo.');
				}

				$objValidador->validarCampoVacio($_POST['txtCodigoCliente'],"Codigo Cliente");
				$objValidador->validarCampoVacio($_POST['txtContrasena'],"Contrasena");
				$objValidador->validarCampoVacio($_POST['cboAsientos'],"Asiento");

			}else if ($_GET['estado_cliente']=='no_registrado')
			{

				$codigoCliente=$_POST['txtCodigoCliente'];
				$nombresCliente=$_POST['txtNombres'];
				$apellidosCliente=$_POST['txtApellidos'];
				$fechaNacimiento=$_POST['txtFechaNacimiento'];
				$generoCliente=$_POST['genero'];
				$direccionCliente=$_POST['txtDireccion'];
				$telefonoCliente=$_POST['txtTelefono'];
				$correoElectronico=$_POST['txtCorreo'];
				$contrasena=$_POST['txtContrasena'];
				$asiento=$_POST['cboAsientos'];

				$objValidador->validarCampoVacio($codigoCliente,"Codigo Cliente");
				$objValidador->validarCampoVacio($nombresCliente,"Nombres");
				$objValidador->validarCampoVacio($apellidosCliente,"Apellidos");
				$objValidador->validarCampoVacio($fechaNacimiento,"Fecha de Nacimiento");
				$objValidador->validarCampoVacio($generoCliente,"Genero");
				$objValidador->validarCampoVacio($direccionCliente,"Direccion");
				$objValidador->validarCampoVacio($telefonoCliente,"Telefono");
				$objValidador->validarCampoVacio($correoElectronico,"Correo Electronico");
				$objValidador->validarCampoVacio($contrasena,"Contrasena");
				$objValidador->validarCampoVacio($_POST['txtConfirmContrasena'],"Confirmacion Contrasena");
				$objValidador->validarCampoVacio($asiento,"Asiento");

			}
			if (!$objValidador->existenErrores()) {//en caso de no existir errores
				//session_start();

				$_SESSION['txtCodigoCliente']=$codigoCliente;
				$_SESSION['txtNombres']=$nombresCliente;
				$_SESSION['txtApellidos']=$apellidosCliente;
				$_SESSION['txtFechaNacimiento']=$fechaNacimiento;
				$_SESSION['genero']=$generoCliente;
				$_SESSION['txtDireccion']=$direccionCliente;
				$_SESSION['txtTelefono']=$telefonoCliente;
				$_SESSION['txtCorreo']=$correoElectronico;
				$_SESSION['txtContrasena']=$contrasena;
				$_SESSION['cboAsientos']=$asiento;

				echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'?paso=4&estado_cliente='.$_GET['estado_cliente'].'&origen='.$_GET['origen'].'&destino='.$_GET['destino'].'&codigo_ruta='.$_GET['codigo_ruta'].'">';
				?>


	        	<table width="65%" border="1" cellspacing="0" cellpadding="10" align="center">
	              <tr>
	                <td width="34%" align="left"><b>Codigo Cliente:</b></td>
	                <td width="66%" align="left"><?php echo $codigoCliente; ?></td>
	              </tr>
	              <tr>
	                <td align="left"><b>Nombres:</b></td>
	                <td align="left"><?php echo $nombresCliente;?></td>
	              </tr>
	              <tr>
	                <td align="left"><b>Apellidos:</b></td>
	                <td align="left"><?php echo $apellidosCliente;?></td>
	              </tr>
	              <tr>
	                <td align="left"><b>Fecha de Nacimiento:</b></td>
	                <td align="left"><?php echo $fechaNacimiento;?></td>
	              </tr>
	              <tr>
	                <td align="left"><b>Genero:</b></td>
	                <td align="left"><?php echo $generoCliente;?></td>
	              </tr>
	              <tr>
	                <td align="left"><b>Direccion:</b></td>
	                <td align="left"><?php echo $direccionCliente;?></td>
	              </tr>
	              <tr>
	                <td  align="left"><b>Telefono:</b></td>
	                <td  align="left"><?php echo $telefonoCliente;?></td>
	              </tr>
	              <tr>
	                <td align="left"><b>Correo Electronico:</b></td>
	                <td align="left"><?php echo $correoElectronico?></td>
	              </tr>
	              <tr>
	                <td align="left"><b>Contrase&ntilde;a:</b></td>
	                <td align="left"><?php echo $contrasena;?></td>
	              </tr>
	              <tr>
	              	<td align="left"><b>Asiento en el autobus:</b></td>
	                <td align="left"><?php echo $asiento;?></td>
	              </tr>
	              <tr>
	              	<td align="left"><b>Codigo Ruta:</b></td>
	                <td align="left"><?php echo $_GET['codigo_ruta'];?></td>
	              </tr>
	              <tr>
	              	<td align="left"><b>Lugar de origen:</b></td>
	                <td align="left"><?php echo $_GET['origen'];?></td>
	              </tr>
	              <tr>
	              	<td align="left"><b>Lugar de Destino:</b></td>
	                <td align="left"><?php echo $_GET['destino'];?></td>
	              </tr>
				  <tr>
	              	<td align="left"><b>Costo del viaje:</b></td>
	                <td align="left"><strong>L. <?php echo $_SESSION['costoViaje'];?></strong></td>
	              </tr>


	              <tr style="color: #FFFFFF; font-weight: bold; background:#2F82B3"><td colspan="2" align="center"><input type="button" value="Regresar" onclick="javascript:history.go(-1);"/><input type="submit" value="Reservar" /></td>
	              </tr>
	        </table>

	         </form>


             <p>
               <?php
		}else{//en caso de existir errores
			$objValidador->imprimirErrores();
		}
		}//fin del paso 3
		if($_GET['paso']=='4'){
			include('clases/reservacion.php');
			//session_start();
			$detalleAsiento=split("-",$_SESSION['cboAsientos']);
			$numeroAsiento=$detalleAsiento[0];
			$codigoUbicacionAsiento=$detalleAsiento[1];

			if ($_GET['estado_cliente']=='no_registrado'){
				include('clases/cliente.php');
				$objCliente=new Cliente(
				$_SESSION['txtCodigoCliente'],
				$_SESSION['txtNombres'],
				$_SESSION['txtApellidos'],
				$_SESSION['txtFechaNacimiento'],
				$_SESSION['genero'],
				$_SESSION['txtDireccion'],
				$_SESSION['txtTelefono'],
				$_SESSION['txtCorreo'],
				$_SESSION['txtContrasena']);
				$objCliente->agregarCliente();
			}
			$fecha=getdate();

			$objReservacion=new Reservacion("codigo",
			$_SESSION['txtCodigoCliente'],
			$fecha['year']."-".$fecha['mon']."-".$fecha['mday'],
			$_GET['codigo_ruta'],
			$_GET['origen'],
			$_GET['destino'],
			"1",
			"C",
			$_SESSION['costoViaje'],
			$numeroAsiento,
			$codigoUbicacionAsiento);
			$objReservacion->agregarReservacion();
			$_SESSION['reserv']=$objReservacion->obtenerCodigoReservacion();


		}
		if($_GET['paso']=='5'){?>

            <div style="padding: 50px 50px 50px 50px" align="center">
            	<form action="reservacion_viaje.php?paso=6" method="post">
                	<table width="80%" cellpadding="20px" cellspacing="0" border="1" align="center">
                    	<tr>
                        	<td align="left">Tarjeta de credito:
                            </td>
                            <td align="left">
	                            <input type="text" name="txtTarjeta" size="60"/>
                            </td>
                        </tr>
                        <tr>
                        	<td colspan="2" align="center">
                            <input type="submit" value="Realizar pago" />
                            </td>
                        </tr>
                    </table>
	            </form>
                <p><img src="images/visamc.gif" alt="VisaMC" width="130" height="38" /></p>
            </div>
<?php	  }
if($_GET['paso']=='6'){
	          include('clases/reservacion.php');
			  $codigoReservacion=$_SESSION['reserv'];
			  $objReservacion=new Reservacion();
			  $objReservacion->realizarPago($codigoReservacion,'1');
    		  session_unset();
 }?>

                  </p>
    
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