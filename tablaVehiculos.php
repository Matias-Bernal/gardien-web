<!-- tabla con scroll -->
<?php
require_once ("funcionesGeneralesPagina.php");
require_once ("controles/ControlVehiculo.php");

$controlVehiculo= new ControlVehiculo();

if (isset($_GET['id_reclamante'])){
	$variable=0;
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
// }elseif (isset($_GET['id_vehiculo'])) {
//  	$_SESSION['idVehiculo'] = $_GET['id_vehiculo'];
};
?>