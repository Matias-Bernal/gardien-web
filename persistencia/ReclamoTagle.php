<?php
require_once('persistencia/Registrante.php');

class ReclamoTagle {
	private $id = 0;
	private $fecha_reclamo_tagle = "";
	private $descripcion = "";
	private $registrante = null;
	
	public function __construct($i,$f,$d,Registrante $r){
		$this->id = $i;
		$this->fecha_reclamo_tagle = $f;
		$this->$descripcion = $d
		$this->registrante = $r;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id = $i;
	}

	public function getFechaReclamoTagle(){
		return $this->$fecha_reclamo_tagle;
	}
	public function setFechaReclamoTagle($f){
		$this->$fecha_reclamo_tagle = $f;
	}

	public function getDescripcion(){
		return $this->$descripcion;
	}
	public function setDescripcion($d){
		$this->$descripcion = $f;
	}

	public function getRegistrante(){
		return $this->registrante;
	}
	public function setRegistrante(Registrante $r){
		$this->registrante = $r;
	}

}

?>