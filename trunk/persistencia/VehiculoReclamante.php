<?php
require_once('Vehiculo.php');
require_once('Reclamante.php');

class VehiculoReclamante {
	private $reclamante = null;
	private $vehiculo = null;

	public function __construct(Reclamante $rec, Vehiculo $veh){
		$this->reclamante = $rec;
		$this->vehiculo = $veh;
	}

	public function getVehiculo(){
		return $this->vehiculo;
	}
	public function setVehiculo(Vehiculo $veh){
		$this->vehiculo = $veh;
	}

	public function getReclamante(){
		return $this->reclamante;
	}
	public function setReclamante(Reclamante $rec){
		$this->reclamante= $rec;
	}

}

?>