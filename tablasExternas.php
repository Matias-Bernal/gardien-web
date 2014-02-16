<html>
<head>
<link href="css/Estilo.css" rel="stylesheet" type="text/css" media="screen" />
<!-- Libreria jQuery -->
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="js/Javascripts.js"></script>
</head>
<body>
	<div id="cargar_vehiculo">
		<?php
			require_once ("funcionesGeneralesPagina.php");
			require_once ("controles/ControlVehiculo.php");
			$controlVehiculo= new ControlVehiculo();
			if (isset($_GET['id_reclamante'])){
				$vehiculos = $controlVehiculo->obtenerVehiculosPorReclamante($_GET['id_reclamante']);
				session_start();
		?>
				<table id="tabla_vehiculos">
					<tr class="headers">
						<th>ID</th>
						<th>NOMBRE TITULAR</th>
						<th>DOMINIO</th>
						<th>VIN</th>
						<th>MARCA</th>
						<th>MODELO</th>
					</tr>
		<?php
					foreach ($vehiculos as $vehiculo) {
						$idVehiculo=$vehiculo->getId();
						$nombreTitular=$vehiculo->getNombreTitular();
						$dominio = $vehiculo->getDominio();
						$vin = $vehiculo->getVin();
						$marca = $vehiculo->getMarca()->getNombreMarca();
						$modelo = $vehiculo -> getModelo()->getNombreModelo();
						echo "	<tr id='vehiculo_$idVehiculo' onClick=\"guardarVehiculo($idVehiculo,'vehiculo_$idVehiculo');\">
									<td width=50>$idVehiculo</td>
									<td width=100>$nombreTitular</td>
									<td width=75>$dominio</td>
									<td>$vin</td>
									<td>$marca</td>
									<td>$modelo</td>
								</tr>";
					}
		?>
				</table>
		<?php
			};
		?>
	</div>
</body>
</html>
