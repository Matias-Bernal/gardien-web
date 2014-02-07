<?php
require_once ("ManipuladorPersistencia.php");
require_once ("persistencia/VehiculoReclamante.php");
require_once ("controles/ControlVehiculo.php");
require_once ("controles/ControlReclamante.php");
require_once ("persistencia/Vehiculo.php");
require_once ("persistencia/Reclamante.php");

class ControlVehiculoReclamante{

	public function obtenerVehiculoReclamante(){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerTodosObjetos("vehiculo_reclamante");
		$listado=array();
		if($result !== FALSE) {
			$cvehiculo=new ControlVehiculo();
			$creclamante=new ControlReclamante();
			while ($row = mysqli_fetch_array($result)){
				$vehiculo = $cvehiculo->obtenerVehiculoPorId($row["ID_VEHICULO"]);
				$reclamante = $creclamante->obtenerReclamantePorId($row["ID_RECLAMANTE"]);
				if($vehiculo !==  FALSE or $reclamante !== FALSE) {
					$obj=new VehiculoReclamante($reclamante,$vehiculo);
					$listado[]=$obj;
				}
			}
		}
		return $listado;
	}

	public function obtenerVehiculosPorReclamante($id_reclamante){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("vehiculo_reclamante","ID_RECLAMANTE='".$id_reclamante."'");
		$listado=array();
		if($result !== FALSE) {
			$cvehiculo=new ControlVehiculo();
			while ($row = mysqli_fetch_array($result)){
				$vehiculo = $cvehiculo->obtenerVehiculoPorId($row["ID_VEHICULO"]);
				if($vehiculo !==  FALSE) {
					$listado[]=$vehiculo;
				}
			}
		}
		return $listado;
	}
	
	public function agregarVehiculoReclamante(VehiculoReclamante $reclamanteVehiculo){
		$mp=new ManipuladorPersistencia();
		$result = $mp->agregarObjeto("vehiculo_reclamante (ID_RECLAMANTE,ID_VEHICULO)",
		"('".$reclamanteVehiculo->getReclamante()->getId()."',
		'".$reclamanteVehiculo->getVehiculo()->getId()."')");
		return $result;
	}

	//falta el modificar//
	
	public function eliminarVehiculoReclamante(VehiculoReclamante $reclamanteVehiculo){
		$mp=new ManipuladorPersistencia();
		$idVehiculo = $reclamanteVehiculo->getVehiculo->getId();
		$idReclamante = $reclamanteVehiculo->getReclamante()->getId();
		$result = $mp->eliminarObjeto("vehiculo_reclamante","ID_RECLAMANTE='".$idReclamante."' AND ID_VEHICULO='".$idVehiculo."'");
		return $result;
	}

}

?>