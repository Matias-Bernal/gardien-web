<?php
require_once('Registrante.php');
require_once('Reclamante.php');
require_once('Vehiculo.php');
require_once('Usuario.php');
require_once('Orden.php');

class Reclamo {
	private $fecha_reclamo = "";
	private $fecha_turno = "";
	private $estado_reclamo = "";
	private $registrante = null;
	private $reclamante = null;
	private $vehiculo = null;
	private $inmovilizado = false;
	private $peligroso = false;
	private $usuario = null;
	private $descripcion = "";
	private $orden = null;
	private $id = 0;
	

	public function __construct($i,$fr,$ft,$e,Registrante $reg, Reclamante $rec,Vehiculo $v,$inm,$pel,Usuario $u,$des,Orden $ord){
		$this->id = $i;
		$this->fecha_reclamo = $fr;
		$this->fecha_turno = $ft;
		$this->estado_reclamo = $e;
		$this->registrante = $reg;
		$this->reclamante = $rec;
		$this->vehiculo = $v;
		$this->inmovilizado = $inm;
		$this->peligroso = $pel;
		$this->usuario = $u;
		$this->descripcion = $des;
		$this->orden = $ord;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}

	public function getFechaReclamo(){
		return $this->fecha_reclamo;
	}
	public function setFechaReclamo($fr){
		$this->fecha_reclamo = $fr;
	}

	public function getFechaTurno(){
		return $this->fecha_turno;
	}
	public function setFechaTurno($ft){
		$this->fecha_turno= $ft;
	}

	public function getEstadoReclamo(){
		return $this->estado_reclamo;
	}
	public function setEstadoReclamo($e){
		$this->estado_reclamo = $e;
	}

	public function getRegistrante(){
		return $this->registrante;
	}
	public function setRegistrante(Registrante $reg){
		$this->registrante = $reg;
	}

	public function getReclamante(){
		return $this->reclamante;
	}
	public function setReclamante(Reclamante $rec){
		$this->reclamante = $rec;
	}

	public function getVehiculo(){
		return $this->vehiculo;
	}
	public function setVehiculo(Vehiculo $v){
		$this->vehiculo = $v;
	}

	public function getInmovilizado(){
		return $this->inmovilizado;
	}
	public function setInmovilizado($inm){
		$this->inmovilizado = $inm;
	}

	public function getPeligroso(){
		return $this->peligroso;
	}
	public function setPeligroso($pel){
		$this->peligroso = $pel;
	}
	
	public function getUsuario(){
		return $this->usuario;
	}
	public function setUsuario(Usuario $u){
		$this->usuario = $u;
	}

	public function getDescripcion(){
		return $this->descripcion;
	}
	public function setDescripcion($des){
		$this->descripcion = $des;
	}

	public function getOrden(){
		return $this->orden;
	}
	public function setOrden(Orden $ord){
		$this->orden = $ord;
	}
}

?>