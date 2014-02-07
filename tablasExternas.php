<html>
<head>
<link href="css/Estilo.css" rel="stylesheet" type="text/css" media="screen" />
<!-- Libreria jQuery -->
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="js/Javascripts.js"></script>
</head>
<body>

	<div id="cargar_reclamante">
	</div>
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
		<?php
					foreach ($vehiculos as $vehiculo) {
						$idVehiculo=$vehiculo->getId();
						$nombreTitular=$vehiculo->getNombreTitular();
						$dominio = $vehiculo->getDominio();
						$vin = $vehiculo->getVin();
						$marca = $vehiculo->getMarca()->getNombreMarca();
						$modelo = $vehiculo -> getModelo()->getNombreModelo();
						echo "	<tr id='vehiculo_$idVehiculo' onClick=\"guardarVehiculo($idVehiculo,'vehiculo_$idVehiculo');\">
									<td>$idVehiculo</td>
									<td>$nombreTitular</td>
									<td>$dominio</td>
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
	<div id="nuevo_reclamante">

	</div>
	<div id="nuevo_vehiculo">
	</div>
</body>
</html>