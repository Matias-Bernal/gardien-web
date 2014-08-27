<html>
<head>
<link href="css/Estilo.css" rel="stylesheet" type="text/css" media="screen" />
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
		<div id="contenido">
			<?php
				session_start();
				$loginCorr=isset($_SESSION['nombreUsuario']);
				if($loginCorr==false){
					echo "<script language=\"JavaScript\">";
					echo "doRedirect(\"index.php\");";
					echo "</script>";
				}else{
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
								$aleatorio = rand(); 
								$nombreoriginal= explode ('.', $_FILES['archivo']['name']);
								$tamano=$_FILES['archivo']['size'];
								$nuevonombre=$nombreoriginal[0].'-'.$aleatorio.'.'.$ext;

								if ($ext=="error") {
										$error_archivo="<br />- Formato de archivo no permitido.";
										echo "<script  language=\"JavaScript\">";
										echo "	alert('Formato de Archivo Invalido. Intente Nuevamente');";
										echo "	doRedirect(\"nuevoPedido.php\");";
										echo "</script>";
								}
								$maximo_tamano= '6000000';
								if ($tamano > $maximo_tamano) {
										$error_archivo="<br />- El tama&ntilde;o de su archivo supera el m&aacute;ximo permitido.";
										echo "<script  language=\"JavaScript\">";
										echo "	alert('Archivo Invalido. Intente Nuevamente');";
										echo "	doRedirect(\"nuevoPedido.php\");";
										echo "</script>";
								}
								// copiamos el archivo en el servidor
								copy($_FILES['archivo']['tmp_name'],'formularios/'.$nuevonombre);
								$_SESSION['nuevonombre']=$nuevonombre;
								echo "<script  language=\"JavaScript\">";
								echo "doRedirect(\"enviarEmail.php\");";
								echo "</script>";
							}else{
								echo "<script  language=\"JavaScript\">";
								echo "	alert('Archivo Invalido. Intente Nuevamente');";
								echo "	doRedirect(\"nuevoPedido.php\");";
								echo "</script>";
							}
						}
					}
			?>
					<h1 align="center">NUEVO PEDIDO</h1>
					<form name='pedido' id='pedido' action='nuevoPedido.php?accion=enviarFormulario' method="post" enctype="multipart/form-data">
		 				<!-- TABLA RECLAMANTES -->
		 				<div id="div_reclamantes" name="div_reclamantes">
		 					<fieldset>
			 					<legend align="center">RECLAMANTE</legend>
								<!-- div contenedor de la tabla con scroll -->
								<div class="div_tabla_reclamantes" id="div_tabla_reclamantes" name="div_tabla_reclamantes">
								<!-- tabla con scroll -->
									<table>
										<tr class="headers">
											<th width=50>ID</th>
											<th width=100>DNI/CUIT</th>
											<th width=180>NOMBRE RECLAMANTE</th>
											<th width=150>TELEFONOS</th>
											<th>EMAIL</th>
										</tr>
											<?php
											$reclamantes = $controlAgenteReclamante->obtenerReclamantes($_SESSION['idAgente']);
											foreach ($reclamantes as $reclamante) {
												$idReclamante=$reclamante->getId();
												$nombreReclamante=$reclamante->getNombreApellido();
												$dniReclamante = $reclamante->getDni();
												$telefonosReclamante = $controlMTelefono -> obtenerMTelefonosPorReclamante($idReclamante);
												$emailReclamante = $reclamante->getEmail();
												echo "	<tr id='reclamante_$idReclamante' onClick=\"cargarVehiculos($idReclamante,'reclamante_$idReclamante');\">
															<td width=50>$idReclamante</td>
															<td width=100>$dniReclamante</td>
															<td width=180>$nombreReclamante</td>
															<td width=150><select width=150 name='TELEFONOS'>";
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
								<br/>
								<fieldset>
									<p align="center"><input name='nuevo_reclamante' id='nuevo_reclamante' type='button' onclick='nuevoReclamante()' value='NUEVO RECLAMANTE'></p>
									<br/>
									<div id="contenedor_nuevo_reclamante"></div>
								</fieldset>
								<br/>
							</fieldset>
						</div>
		 				<!-- TABLA VEHICULOS -->
						<div id="div_vehiculos" name="div_vehiculos">
							<fieldset>
			 				   <legend align="center">DATOS DEL VEHICULO</legend>
								<div class="div_tabla_vehiculos" id="div_tabla_vehiculos" name="div_tabla_vehiculos">
									<!-- tabla con scroll -->
									<table id="tabla_vehiculos"></table>
								</div>
								<br/>
								<fieldset>
									<p align="center"><input name='nuevo_vehiculo' id='nuevo_vehiculo' type='button' onclick='nuevoVehiculo()' value='NUEVO VEHICULO'></p>
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
							<p align="center"> <input name='agregar_pieza' id='agregar_pieza' type='button' onclick='agregarPieza()' value='AGREGAR PIEZA'></p>
							<div id="contenedorpiezas" name="contenedorpiezas">
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
							<p align="center"><input type='button' onclick='armarEmail()' value="ENVIAR NUEVO PEDIDO"/>
						<br/>
						</fieldset>
					</form>
			<?php
				}
			?>
		</div>
	</div>
</body>
</html>