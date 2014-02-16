<html>
<head>
<link href="css/Estilo.css" rel="stylesheet" type="text/css" media="screen" />
<!-- Libreria jQuery -->
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="js/Javascripts.js"></script>
</head>
<body>
	<?php
		require_once ("funcionesGeneralesPagina.php");
		require_once ("controles/ControlReclamante.php");
		require_once ("controles/ControlMTelefono.php");
		require_once ("controles/ControlAgenteReclamante.php");
		require_once ("controles/ControlAgente.php");
		require_once ("controles/ControlVehiculo.php");
		require_once ("controles/ControlModelo.php");
		require_once ("controles/ControlMarca.php");
		require_once ("controles/ControlVehiculoReclamante.php");

		$controlAgenteReclamante= new ControlAgenteReclamante();
		$controlAgente= new ControlAgente();
		$controlReclamante= new ControlReclamante();
		$controlMTelefono= new ControlMTelefono();
		$controlVehiculo= new ControlVehiculo();
		$controlMarca= new ControlMarca();
		$controlModelo= new ControlModelo();
		$controlVehiculoReclamante= new ControlVehiculoReclamante();

		session_start();
		if (isset($_GET['agregar_reclamante'])){
			if (isset($_GET['nombre']) and isset($_GET['dni']) and  isset($_GET['tel']) and isset($_GET['email'])){
				//insertamos el nuevo reclamante
				$nombre = str_replace("%20"," ",$_GET['nombre']);
				$dni = str_replace("%20"," ",$_GET['dni']);
				$telef = str_replace("%20"," ",$_GET['tel']);
				$email = str_replace("%20"," ",$_GET['email']);
				$nuevo_reclamante = new Reclamante(null,$nombre,$dni,$email);
				$id_nuevo_reclamante = $controlReclamante -> agregarReclamante($nuevo_reclamante);
				$nuevo_reclamante ->setId($id_nuevo_reclamante);
				//insertamos el/los telefonos del reclamante
				$nuevo_mtelefono = new MTelefono(null,$telef,$nuevo_reclamante);
				$id_nuevo_mtelefono = $controlMTelefono->agregarMTelefono($nuevo_mtelefono);
				//insertamos en la tabla agente_reclamante
				$nuevo_agente = $controlAgente-> obtenerAgentePorId($_SESSION['idAgente']);
				$id_nuevo_agente_reclamante = $controlAgenteReclamante->agregarAgenteReclamante($_SESSION['idAgente'],$id_nuevo_reclamante);
				echo "<script> alert('RECLAMANTE AGREGADO [ID: ".$id_nuevo_reclamante." ]');</script>";
			}
			//RE ESCRIBIMOS ES DIV RECLAMANTES DE NUEVOPEDIDO.PHP
			echo "<fieldset>
					<legend>RECLAMANTE</legend>
					<!-- div contenedor de la tabla con scroll -->
					<div class=\"contiene_tabla\" id=\"div_tabla_reclamantes\" name=\"div_tabla_reclamantes\">
								<!-- tabla con scroll -->
						<table id=\"tabla_reclamantes\" name=\"tabla_reclamantes\">
							<tr class=\"headers\">
								<th width=50>ID</th>
								<th width=100>DNI/CUIT</th>
								<th width=180>NOMBRE RECLAMANTE</th>
								<th width=150>TELEFONOS</th>
								<th>EMAIL</th>
							</tr>";
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
				echo "  </table>
					</div>
					<fieldset>
						<p align=\"center\"><a href='JavaScript:nuevoReclamante();'> NUEVO RECLAMANTE </a></p>
						<div id=\"contenedor_nuevo_reclamante\">
						</div>
			 			<br/>
					</fieldset>
					<br/>
				</fieldset>";
		}
		elseif (isset($_GET['agregar_vehiculo'])) {
			if (isset($_GET['titular']) and isset($_GET['dominio']) and  isset($_GET['vin']) and isset($_GET['marca']) and isset($_GET['modelo'])){
				//insertamos el nuevo vehiculo
				$reclamante_vehiculo = $_GET['agregar_vehiculo'];

				$titular = str_replace("%20"," ",$_GET['titular']);
				$dominio = str_replace("%20"," ",$_GET['dominio']);
				$vin = str_replace("%20"," ",$_GET['vin']);
				$marca = str_replace("%20"," ",$_GET['marca']);
				$modelo = str_replace("%20"," ",$_GET['modelo']);
				$nuevo_modelo = $controlModelo -> obtenerModeloPorNombre($modelo);
				$nuevo_vehiculo = new Vehiculo(null,$dominio,$vin,$titular,$nuevo_modelo->getMarca(),$nuevo_modelo);
				$id_nuevo_vehiculo = $controlVehiculo -> agregarVehiculo($nuevo_vehiculo);

				$nuevo_vehiculo->setId($id_nuevo_vehiculo);
				//insertamos en la tabla reclamante vehicluo
				$nuevo_reclamante_v = $controlReclamante -> obtenerReclamantePorId($reclamante_vehiculo);
				$nuevo_reclamante_vehiculo = new VehiculoReclamante($nuevo_reclamante_v,$nuevo_vehiculo);
				$id_reclamante_vehiculo = $controlVehiculoReclamante->agregarVehiculoReclamante($nuevo_reclamante_vehiculo);

				echo "<script> alert('VEHICULO AGREGADO [ID: ".$id_nuevo_vehiculo." ]');</script>";	
					//RE ESCRIBIMOS ES DIV VEHICULOS DE NUEVOPEDIDO.PHP
				$vehiculos = $controlVehiculo->obtenerVehiculosPorReclamante($reclamante_vehiculo);
				echo "<fieldset>
	 				   <legend align=\"center\">DATOS DEL VEHICULO</legend>
						<div class=\"div_tabla_vehiculos\" id=\"div_tabla_vehiculos\" name=\"div_tabla_vehiculos\">
							<!-- tabla con scroll -->
							<table id=\"tabla_vehiculos\">
								<tr class=\"headers\">
									<th>ID</th>
									<th>NOMBRE TITULAR</th>
									<th>DOMINIO</th>
									<th>VIN</th>
									<th>MARCA</th>
									<th>MODELO</th>
								</tr>";

							foreach ($vehiculos as $vehiculo) {
								$idVehiculo=$vehiculo->getId();
								$nombreTitular=$vehiculo->getNombreTitular();
								$dominio = $vehiculo->getDominio();
								$vin = $vehiculo->getVin();
								$marca = $vehiculo->getMarca()->getNombreMarca();
								$modelo = $vehiculo -> getModelo()->getNombreModelo();
								echo "	<tr id='vehiculo_".$idVehiculo."' onClick=\"guardarVehiculo(".$idVehiculo.",'vehiculo_".$idVehiculo."');\">
											<td>".$idVehiculo."</td>
											<td>".$nombreTitular."</td>
											<td>".$dominio."</td>
											<td>".$vin."</td>
											<td>".$marca."</td>
											<td>".$modelo."</td>
										</tr>";
							}
				echo "		</table>
						</div>
						<br/>
						<fieldset>
							<p align=\"center\"><input name='nuevo_vehiculo' id='nuevo_vehiculo' type='button' onclick='nuevoVehiculo()' value='NUEVO VEHICULO'></p>
							<div id=\"contenedor_nuevo_vehiculo\">
							</div>
	 						<br/>
						</fieldset>
						<br/>
					</fieldset>";
			}
		}
		elseif (isset($_GET['cargar_vehiculo'])) {
			$vehiculos = $controlVehiculo->obtenerVehiculosPorReclamante($_GET['cargar_vehiculo']);
			echo "<table id=\"tabla_vehiculos\">
					<tr class=\"headers\">
						<th>ID</th>
						<th>NOMBRE TITULAR</th>
						<th>DOMINIO</th>
						<th>VIN</th>
						<th>MARCA</th>
						<th>MODELO</th>
					</tr>";
			foreach ($vehiculos as $vehiculo) {
				$idVehiculo=$vehiculo->getId();
				$nombreTitular=$vehiculo->getNombreTitular();
				$dominio = $vehiculo->getDominio();
				$vin = $vehiculo->getVin();
				$marca = $vehiculo->getMarca()->getNombreMarca();
				$modelo = $vehiculo -> getModelo()->getNombreModelo();
				echo "	<tr id='vehiculo_".$idVehiculo."' onClick=\"guardarVehiculo(".$idVehiculo.",'vehiculo_".$idVehiculo."');\">
							<td>".$idVehiculo."</td>
							<td>".$nombreTitular."</td>
							<td>".$dominio."</td>
							<td>".$vin."</td>
							<td>".$marca."</td>
							<td>".$modelo."</td>
						</tr>";
			}
			echo "</table>";
		}
		elseif (isset($_GET['cargar_marca'])) {
			$marca = $controlMarca->obtenerMarcaPorNombre($_GET['cargar_marca']);
			$modelos = $controlModelo->obtenerModeloPorMarca($marca);
			foreach ($modelos as $modelo) {
				echo "<option>".$modelo->getNombreModelo()."</option>";
			}
		}
	?>
</body>
</html>