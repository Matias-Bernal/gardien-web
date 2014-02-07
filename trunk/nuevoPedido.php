<html>
<head>
<link href="css/Estilo.css" rel="stylesheet" type="text/css" media="screen" />
<!-- Libreria jQuery -->
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="js/Javascripts.js"></script>

<title>Gardien Web - Nuevo Pedido</title>
</head>
<body>

<?php
require_once ("funcionesGeneralesPagina.php");
require_once ("controles/ControlUsuarioWeb.php");
require_once ("controles/ControlReclamante.php");
require_once ("controles/ControlAgenteReclamante.php");
require_once ("controles/ControlMTelefono.php");
require_once ("controles/ControlVehiculo.php");

$controlUsrWeb=new ControlUsuarioWeb();
$controlReclamante= new ControlReclamante();
$controlAgenteReclamante= new ControlAgenteReclamante();
$controlMTelefono= new ControlMTelefono();
$controlVehiculo= new ControlVehiculo();
logo();
menulateral();
?>
	<!-- Mostrando Datos -->
	<div class="pagina">
	<?php
	session_start();
	$loginCorr=isset($_SESSION['nombreUsuario']);
	?>
		<div id="contenido">
			<?php
				if(isset($_REQUEST['accion'])){
					if($_REQUEST['accion']=="enviarFormulario"){
						//comprobamos si se adjunto un archivo, y si su tamano es menor al permitido
						if (isset($_FILES['archivo']['tmp_name'])) {
						$tipo=$_FILES['archivo']['type'];
						//Formatos de archivo permitidos, si desean agregar mas, agregar un case para cada formato. 
						switch ($tipo) {
							case "image/gif":
							$ext="gif";
							break;
							case "image/pjpeg":
							$ext="jpg";
							break;
							case "image/jpeg":
							$ext="jpg";
							break;
							case "image/png":
							$ext="png";
							break;
							case "application/zip":
							$ext="zip";
							break;
							case "application/msword":
							$ext="doc";
							break;
							case "application/pdf":
							$ext="pdf";
							break;	
							case "application/rtf":
							$ext="rtf";
							break;	
							case "application/octet-stream":
							$extension_type= explode ('.', $_FILES['archivo']['name']);
							$ext= end($extension_type);
							if($ext!="rar") {$ext="error";}
							break;			
							default:
							$ext="error";
							break;
						}
						$maximo_tamano= '6000000';
						$aleatorio = rand(); 
						$nombreoriginal= explode ('.', $_FILES['archivo']['name']);
						$tamano=$_FILES['archivo']['size'];
						$nuevonombre=$nombreoriginal[0].'-'.$aleatorio.'.'.$ext;
						}
						if (isset ($nuevonombre)) {
							if ($ext=="error") {$error_archivo="<br />- Formato de archivo no permitido.";}
							if ($tamano > $maximo_tamano) {$error_archivo="<br />- El tama&ntilde;o de su archivo supera el m&aacute;ximo permitido.";}
						}
						// copiamos el archivo en el servidor
						copy($_FILES['archivo']['tmp_name'],'formularios/'.$nuevonombre);
						$_SESSION['nuevonombre']=$nuevonombre;
						echo "<script  language=\"JavaScript\">";
						echo "doRedirect(\"enviarEmail.php\");";
						echo "</script>";
					}
				}
			?>
			<h1>NUEVO PEDIDO</h1>
			<form name='pedido' id='pedido' action='nuevoPedido.php?accion=enviarFormulario' method="post" enctype="multipart/form-data">
				<p>* Datos OBLIGATORIOS</p>
 				<!-- TABLA RECLAMANTES -->
 				<div id="div_reclamantes" name="div_reclamantes">
 					<fieldset>
	 					<legend>RECLAMANTE</legend>
	 					<!-- tabla para los encabezados -->
						<table class="titulos">
							<tr class="headers">
								<th>ID</th>
								<th>DNI/CUIT</th>
								<th>NOMBRE RECLAMANTE</th>
								<th>TELEFONOS</th>
								<th>EMAIL</th>
							</tr>
						</table>
						<!-- div contenedor de la tabla con scroll -->
						<div class="contiene_tabla" id="div_tabla_reclamantes" name="div_tabla_reclamantes">
						<!-- tabla con scroll -->
							<table>
									<?php
									$reclamantes = $controlAgenteReclamante->obtenerReclamantes($_SESSION['idAgente']);
									foreach ($reclamantes as $reclamante) {
										$idReclamante=$reclamante->getId();
										$nombreReclamante=$reclamante->getNombreApellido();
										$dniReclamante = $reclamante->getDni();
										$telefonosReclamante = $controlMTelefono -> obtenerMTelefonosPorReclamante($idReclamante);
										$emailReclamante = $reclamante->getEmail();
										echo "	<tr id='reclamante_$idReclamante' onClick=\"cargarVehiculos($idReclamante,'reclamante_$idReclamante');\">
													<td>$idReclamante</td>
													<td>$dniReclamante</td>
													<td>$nombreReclamante</td>
													<td><select name='TELEFONOS'>";
													$tel=0;
														foreach($telefonosReclamante as $telefono) {
														echo "<option value='tel_$tel'>$telefono</option>";
														$tel++;
													};
										echo "		</select></td>
													<td>$emailReclamante</td>
												</tr>";
									}
									?>
							</table>
						</div>
						<fieldset>
							<p align="center"><a href='JavaScript:nuevoReclamante();'> NUEVO RECLAMANTE </a></p>
							<div id="contenedor_nuevo_reclamante"></div>
	 						<br/>
						</fieldset>
						<br/>
					</fieldset>
				</div>
 				<!-- TABLA VEHICULOS -->
				<div id="div_vehiculos" name="div_vehiculos">
					<fieldset>
	 				   <legend>DATOS DEL VEHICULO</legend>
	 					<!-- tabla para los encabezados -->
						<table class="titulos">
							<tr class="headers">
								<th>ID</th>
								<th>NOMBRE TITULAR</th>
								<th>DOMINIO</th>
								<th>VIN</th>
								<th>MARCA</th>
								<th>MODELO</th>
							</tr>
						</table>
						<!-- div contenedor de la tabla con scroll -->
						<div class="contiene_tabla" id="div_tabla_vehiculos">
							<!-- tabla con scroll -->
							<table id="tabla_vehiculos"></table>
						</div>
						<fieldset>
							<p align="center"><a href='JavaScript:nuevoVehiculo();'> NUEVO VEHICULO </a></p>
							<div id="contenedor_nuevo_vehiculo">
							</div>
	 						<br/>
						</fieldset>
						<br/>
					</fieldset>
				</div>
				<!-- PIEZAS A SOLICITAR -->
				<fieldset>
 					<legend>PIEZAS A SOLICITAR</legend>
					<p align="center"><a href='JavaScript:agregarPieza();'> AGREGAR PIEZA </a></p>
					<div id="contenedorpiezas">
					</div>
 				<br/>
				</fieldset>
				<p>* Maximo 5 Piezas</p>
				
				<fieldset>
 				   <legend>COMENTARIOS Y/O DATOS ADICIONALES</legend>
				   <p><textarea name="datos_Adicionales" id="datos_Adicionales" rows="6" cols="90"></textarea></p>
 				<br/>
				</fieldset>
				
				<fieldset>
 				   <legend>FORMULARIO DE ACEPTACION DE CARGOS</legend>
					<p>*Subir Imagen: <input type="file" name="archivo" id="archivo" title="Elija el Archivo..."/></p>
				<br/>
				</fieldset>
				<p>* Formatos soportados: JPG, PNG, GIF</p>
				<p>* Tama&ntilde;o maximo de archivo: 2MB</p>
 				
				<fieldset>
					<legend>ENVIAR FORMULARIO</legend>
					<p>Enviar formulario por correo electronico: Al pulsar en el boton se abrira la pagina
   						de envio de correo: en esa pagina pulsa en enviar:</p>
 					<p align="center"><input type="submit"	onclick='armarEmail()' value="Enviar"/>
				<br/>
				</fieldset>
			</form>
		</div>
	</div>
</body>
</html>