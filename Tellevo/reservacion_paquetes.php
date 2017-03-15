<?php if($_GET['paso']=='3'||$_GET['paso']=='2'||$_GET['paso']=='4') session_start();?>
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
<?php
include ("clases/conexion.php");

	?>


<?php if ($_GET['paso']=='3'||$_GET['paso']=='2'||$_GET['paso']=='4') {
	echo '<div id="contenedor2"><div id="container">';
}else{
?>
<div style="padding: 10px 70px 0 70px">
<div id="containerGrande">
<?php
}?>


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


  <div id="mainContent2" >
  <br/>
    <h1 align="center">Reservacion de paquetes promocinales</h1>
    <br/>
	<?php
		if($_GET['paso']=='1'){
	?><br/>
    <div style="padding:0 400px 0 30px">En este lugar encontrara muchas promociones para viajar y convivir con sus amigos y familiares con un costo mas comodo y accesible
    para poder iniciar con la reservacion de paquetes puede escoger la promocion que mas le parezca y luego haga click en continuar para iniciar con la reservacion.</div><br/><br/>
    <form action="reservacion_paquetes.php?paso=2" method="post">
		<table border="1" cellspacing="0" cellpadding="10px" align="center" width="95%">
			<tr style="color: #FFFFFF; font-weight: bold; background:#2F82B3">
				<td width="20px">
					Seleccion
				</td>
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
				echo '<tr tr onmouseover="establecerColorFondo1(this);" onmouseout="quitarColorFondo1(this);">';
				echo '<td align="center"><input type="radio" name="paquete" value="'.$filaPaquete['CODIGO_PAQUETE']."%".$filaPaquete['CODIGO_RUTA_VIAJE'].'" /></td>';
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
        <div align="center"><input type="submit" value="Continuar" /></div>
        </form>
	<?php
	}
	if($_GET['paso']=='2'){

	?>

        Verifique por orden si los viajantes son clientes ya registrados o si es primera vez que viajan en nuestra compa&ntilde;ia:<br/>


         <?php

		 	$objConexion=new Conexion();
			$componentes=split("%",$_POST['paquete']);
			//session_start();
			$_SESSION['codigo_paquete']=$componentes[0];
			$_SESSION['codigo_viaje']=$componentes[1];
			$resultado=$objConexion->ejecutarComando("SELECT TBL_MV_PAQUETES.CANTIDAD_DE_BOLETOS
			FROM TBL_MV_PAQUETES WHERE (((TBL_MV_PAQUETES.CODIGO_PAQUETE)='".$componentes[0]."')
			AND ((TBL_MV_PAQUETES.CODIGO_RUTA_VIAJE)='".$componentes[1]."'));");
			$fila=mysql_fetch_array($resultado);
			$numeroBoletos=intval($fila['CANTIDAD_DE_BOLETOS']);
			$_SESSION['cantidad_boletos']=$numeroBoletos;
			?>
             <form action="reservacion_paquetes.php?paso=3" method="post"><br/><br/>
            <table align="center" width="370" border="1" cellspacing="0" cellpadding="5">
			<td width="50" align="center">Cliente</td>
            <td width="110" align="center">Registrado</td>
            <td width="90" align="center">Primera Vez</td>
			<td width="90" align="center">Responsable</td>
			<?php
			for($i=0;$i<$numeroBoletos;$i++){
			?>

                  <tr>
                  	<td align="center"><?php echo $i+1;?></td>
                    <td align="center"><input type="radio" name="estado_cliente<?php echo $i;?>" value="registrado"/></td>
                    <td align="center"><input type="radio" name="estado_cliente<?php echo $i;?>" value="no_registrado"/></td>
					<td align="center"><input type="radio" value="<?php echo $i;?>" name="responsable"/></td>
                  </tr>

			<?php
			}//fin ciclo for
			?>
            </table><br/>
            <div align="center"><input type="submit" value="continuar" /></div>
            </form>


			 <?php

			$objConexion->cerrarConexion();
		?>


	<?php
	}
	if($_GET['paso']=='3'){
	//	session_start();
		$objConexion=new Conexion();
		$numeroBoletos=$_SESSION['cantidad_boletos'];
		$_SESSION['res']=intval($_POST['responsable']);
		?>
        <div style="padding:0 25px 0 25px">A continuacion se le presentan una serie de formularios por cada uno de los pasajeros, esto es de vital importancia para identificar al usuario a la hora de abordar nuestras unidades, los clientes ya registrado solo debe de ingresar su codigo de cliente y contrase&ntilde;a y seleccionar su asiento, los clientes que viajan por primera vez con nuestra empresa deben de ingresar todos sus datos.</div>
		<?php
				$resultadoBus=$objConexion->ejecutarComando("SELECT TBL_MV_RUTAS_VIAJES.CODIGO_UNIDAD_TRANSPORTE FROM TBL_MV_RUTAS_VIAJES
				WHERE (((TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE)='".$_SESSION['codigo_viaje']."'));");
				$filaBus=mysql_fetch_array($resultadoBus);
				$resultado=$objConexion->ejecutarComando("SELECT TBL_MG_ASIENTOS_UNIDADES_TRANSPORTE.NUMERO_ASIENTO,
				TBL_MG_UBICACIONES_ASIENTOS.UBICACION_ASIENTO,TBL_MG_ASIENTOS_UNIDADES_TRANSPORTE.CODIGO_UBICACION_ASIENTO
				FROM TBL_MG_UBICACIONES_ASIENTOS RIGHT JOIN TBL_MG_ASIENTOS_UNIDADES_TRANSPORTE ON
				TBL_MG_UBICACIONES_ASIENTOS.CODIGO_UBICACION_ASIENTO = TBL_MG_ASIENTOS_UNIDADES_TRANSPORTE.CODIGO_UBICACION_ASIENTO
				WHERE (((TBL_MG_ASIENTOS_UNIDADES_TRANSPORTE.NUMERO_ASIENTO)
				Not In (SELECT TBL_MV_DETALLE_RESERVACION_PAQUETE.NUMERO_ASIENTO
				FROM ((TBL_MV_RUTAS_VIAJES INNER JOIN TBL_MV_PAQUETES ON TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE =
				TBL_MV_PAQUETES.CODIGO_RUTA_VIAJE) INNER JOIN TBL_MV_RESERVACIONES_PAQUETES ON
				TBL_MV_PAQUETES.CODIGO_PAQUETE = TBL_MV_RESERVACIONES_PAQUETES.CODIGO_PAQUETE) INNER JOIN
				TBL_MV_DETALLE_RESERVACION_PAQUETE ON TBL_MV_RESERVACIONES_PAQUETES.CODIGO_RESERVACION =
				TBL_MV_DETALLE_RESERVACION_PAQUETE.CODIGO_RESERVACION
				WHERE (((TBL_MV_RUTAS_VIAJES.CODIGO_UNIDAD_TRANSPORTE)=".$filaBus['CODIGO_UNIDAD_TRANSPORTE'].") AND
				((TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE)='".$_SESSION['codigo_viaje']."'))))
				AND ((TBL_MG_ASIENTOS_UNIDADES_TRANSPORTE.CODIGO_UNIDAD_TRANSPORTE) In (SELECT TBL_MV_RUTAS_VIAJES.CODIGO_UNIDAD_TRANSPORTE
				FROM TBL_MV_RUTAS_VIAJES WHERE (((TBL_MV_RUTAS_VIAJES.CODIGO_VIAJE)='".$_SESSION['codigo_viaje']."')))));");
				while($fila=mysql_fetch_array($resultado)){
					$asientos[]=$fila['NUMERO_ASIENTO']."-".$fila['CODIGO_UBICACION_ASIENTO']."-".$fila['UBICACION_ASIENTO'];
				}
				mysql_free_result($resultado);
				mysql_free_result($resultadoBus);
	?>
    <form action="reservacion_paquetes.php?paso=4" method="post">
	<?php

		for($i=0;$i<$numeroBoletos;$i++){

			if ($_POST['estado_cliente'.$i]=='no_registrado') {
				$_SESSION['c'.$i]='n';
			}else if ($_POST['estado_cliente'.$i]=='registrado'){
				$_SESSION['c'.$i]='r';
			}
	?>		<br/><br/><div align="center">Ingrese los datos del pasajero <?php echo $i+1;?>:</div><br/>
    		<table width="70%" border="1" cellspacing="0" cellpadding="10" align="center">
	              <tr>
	                <td align="left">Codigo Cliente <?php echo $i+1;?>:</td>
	                <td align="left"><input name="txtCodigoCliente<?php echo $i;?>" type="text" /></td>
	              </tr>
	              <?php if ($_POST['estado_cliente'.$i]=='no_registrado'){?>
	              <tr>
	                <td align="left">Nombres:</td>
	                <td align="left"><input name="txtNombres<?php echo $i;?>" type="text" size="40" /></td>
	              </tr>
	              <tr>
	                <td align="left">Apellidos:</td>
	                <td align="left"><input name="txtApellidos<?php echo $i;?>" type="text" size="40" /></td>
	              </tr>
	              <tr>
	                <td align="left">Fecha de Nacimiento</td>
	                <td align="left"><input name="txtFechaNacimiento<?php echo $i;?>" type="text" size="20" /> DD/MM/AAAA</td>
	              </tr>
	              <tr>
	                <td align="left">Genero:</td>
	                <td align="left">
	                  <label>
	                    <input type="radio" name="genero<?php echo $i;?>" value="M" id="genero_0" />
	                    Masculino</label>

	                  <label>
	                    <input type="radio" name="genero<?php echo $i;?>" value="F" id="genero_1" />
	                    Femenino</label>
	                  <br />                </td>
	              </tr>
	              <tr>
	                <td align="left">Direccion:</td>
	                <td align="left"><textarea name="txtDireccion<?php echo $i;?>" cols="50" rows="3"></textarea></td>
	              </tr>
	              <tr>
	                <td  align="left">Telefono:</td>
	                <td  align="left"><input name="txtTelefono<?php echo $i;?>" type="text" size="25" /></td>
	              </tr>
	              <tr>
	                <td align="left">Correo Electronico:</td>
	                <td align="left"><input name="txtCorreo<?php echo $i;?>" type="text" size="60" /></td>
	              </tr>
	              <tr>
		<?php }?>
	                <td align="left">Contrase&ntilde;a</td>
	                <td align="left"><input name="txtContrasena<?php echo $i;?>" type="password" size="30" /></td>
	              </tr>
	              <?php if ($_POST['estado_cliente'.$i]=='no_registrado'){?>
	              <tr>
	                <td align="left">Confirmar Contrase&ntilde;a</td>
	                <td align="left"><input name="txtConfirmContrasena<?php echo $i;?>" type="password" size="30" /></td>
	              </tr>
	    <?php } ?>
	              <tr>
	              	<td align="left">Asiento en el autobus:</td>
                    <td>
                    <select name="cboAsientos<?php echo $i;?>">
                    <option selected="selected"></option>
        <?php
                    for($j=0;$j<count($asientos);$j++){
                        echo '<option>'.$asientos[$j].'</option>';
                    }
        ?>
                    </select>
                    </td>
                </tr>

	            </table>
	<?php
		}//fin for

	?>
    	<br/><br/><br/><br/><div align="center"><input type="submit" value="Continuar con la reservacion->" /></div>
	</form>
	<?php
	$objConexion->cerrarConexion();
	}//fin if
	if($_GET['paso']=='4'){
	?>

	<?php
		include('clases/validador.php');
		$numeroBoletos=$_SESSION['cantidad_boletos'];
		$objConexion=new Conexion();
		$objValidador=new Validador();
		$clienteResponsable="";


			for($i=0;$i<$numeroBoletos;$i++){
			if (intval($_SESSION['res'])==$i) {
					$clienteResponsable=$_POST['txtCodigoCliente'.$i];
			}
			if ($_SESSION['c'.$i]=='r'){//si esta registrado

				

				$objValidador->validarCampoVacio($_POST['txtCodigoCliente'.$i],"Codigo Cliente");
				$objValidador->validarCampoVacio($_POST['txtContrasena'.$i],"Contrasena");
				$objValidador->validarCampoVacio($_POST['cboAsientos'.$i],"Asiento");

			}else if ($_SESSION['c'.$i]=='n')//si no esta registrado
			{

				$codigoCliente=$_POST['txtCodigoCliente'.$i];
				$nombresCliente=$_POST['txtNombres'.$i];
				$apellidosCliente=$_POST['txtApellidos'.$i];
				$fechaNacimiento=$_POST['txtFechaNacimiento'.$i];
				$generoCliente=$_POST['genero'.$i];
				$direccionCliente=$_POST['txtDireccion'.$i];
				$telefonoCliente=$_POST['txtTelefono'.$i];
				$correoElectronico=$_POST['txtCorreo'.$i];
				$telefonoCliente=$_POST['txtCorreo'.$i];
				$contrasena=$_POST['txtContrasena'.$i];
				$asiento=$_POST['cboAsientos'.$i];

				$objValidador->validarCampoVacio($codigoCliente,"Codigo Cliente".$i);
				$objValidador->validarCampoVacio($nombresCliente,"Nombres del cliente $i");
				$objValidador->validarCampoVacio($apellidosCliente,"Apellidos del cliente $i");
				$objValidador->validarCampoVacio($fechaNacimiento,"Fecha de Nacimiento del cliente $i");
				$objValidador->validarCampoVacio($generoCliente,"Genero del cliente $i");
				$objValidador->validarCampoVacio($direccionCliente,"Direccion del cliente $i");
				$objValidador->validarCampoVacio($telefonoCliente,"Telefono del cliente $i");
				$objValidador->validarCampoVacio($correoElectronico,"Correo Electronico del cliente $i");
				$objValidador->validarCampoVacio($contrasena,"Contrasena del cliente $i");
				$objValidador->validarCampoVacio($_POST['txtConfirmContrasena'.$i],"Confirmacion Contrasena del cliente $i");
				$objValidador->validarCampoVacio($asiento,"Asiento del cliente $i");

			}


		//echo "<br/><br/><br/>";
		}//fin del ciclo for
		if (!$objValidador->existenErrores()) {
			//$objConexion=new Conexion();
			//$clienteResponsable=$_SESSION['res'];
			$codigoPaquete=$_SESSION['codigo_paquete'];
			//echo "Cliente Responsable:".$clienteResponsable."<br/>";
			//echo "Paquete:".$codigoPaquete."<br/>";
			include('clases/cliente.php');
			include('clases/reservacionpaquete.php');
			/***********************/
			$objReservacionPaquete=new ReservacionPaquete($codigoPaquete,$clienteResponsable,time(),'1','P');
			$_SESSION['res']=$objReservacionPaquete->obtenerCodigoReservacion();
			$objReservacionPaquete->agregarReservacionPaquete();
			for($i=0;$i<$numeroBoletos;$i++){
			if ($_SESSION['c'.$i]=='r'){//si esta registrado
					$codigoCliente=$_POST['txtCodigoCliente'.$i];
					$contrasena=$_POST['txtContrasena'.$i];
					$asiento=$_POST['cboAsientos'.$i];

			}else if ($_SESSION['c'.$i]=='n')//si no esta registrado
			{

				$codigoCliente=$_POST['txtCodigoCliente'.$i];
				$nombresCliente=$_POST['txtNombres'.$i];
				$apellidosCliente=$_POST['txtApellidos'.$i];
				$fechaNacimiento=$_POST['txtFechaNacimiento'.$i];
				$generoCliente=$_POST['genero'.$i];
				$direccionCliente=$_POST['txtDireccion'.$i];
				$telefonoCliente=$_POST['txtTelefono'.$i];
				$telefonoCliente=$_POST['txtCorreo'.$i];
				$contrasena=$_POST['txtContrasena'.$i];
				$asiento=$_POST['cboAsientos'.$i];
			}

			/*************************/



			if ($_SESSION['c'.$i]=='n'){
				$objCliente=new Cliente($codigoCliente,$nombresCliente,$apellidosCliente,$fechaNacimiento,$generoCliente,$direccionCliente,$telefonoCliente,$telefonoCliente,$contrasena);
				//echo $objCliente->obtenerNombreCliente();
				$objCliente->agregarCliente();
			}

			$componentesAsiento=split("-",$asiento);
			//echo $nombresCliente;
			$objReservacionPaquete->agregarReservaCliente($codigoCliente,$componentesAsiento[1],$componentesAsiento[0]);


			}// fin del ciclo for
			echo '<div align="center"><br/><img src="images/exito.gif" alt="Error" /><br/><br/><b>La reservacion se ha realizado con Exito!</b></div>';
		}else{//en caso de existir errores
			$objValidador->imprimirErrores();
		}	
	}	
    if($_GET['paso']=='5'){
	          include('clases/reservacion.php');
			  $codigoReservacion=$_SESSION['res'];
			  $objReservacion=new Reservacion();
			  $objReservacion->realizarPago($codigoReservacion,'2');
    		  session_unset();
	 }?>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
  <div id="footer">
    <p align="center">www.tellevo.com - UNAH - Proyecto Ingenieria en Sistemas - 2009</p>
  <!-- end #footer --></div>
<!-- end #container --></div></div>
</body>
</html>