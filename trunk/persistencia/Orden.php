<?php
require_once('persistencia/Recurso.php');

class Orden {
	private $numero_orden = "";
	private $fecha_apertura = "";
	private $fecha_cierre = "";
	private $estado = "";
	private $recurso = null;
	private $id = 0;


	public function __construct($i,$n,$fa,$fc,$e,$r){
		$this->id = $i;
		$this->numero_orden = $n;
		$this->fecha_apertura = $fa;
		$this->fecha_cierre = $fc;
		$this->estado = $e;
		$this->recurso = $r;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}

	public function getNumeroOrden(){
		return $this->numero_orden;
	}
	public function setNumeroOrden($n){
		$this->numero_orden = $n;
	}

	public function getFechaApertura(){
		return $this->fecha_apertura;
	}
	public function setFechaApertura($fa){
		$this->fecha_apertura = $fa;
	}

	public function getFechaCierre(){
		return $this->fecha_cierre;
	}
	public function setFechaCierre($fc){
		$this->fecha_cierre = $fc;
	}

	public function getEstado(){
		return $this->estado;
	}
	public function setEstado($e){
		$this->estado = $e;
	}

	public function getRecurso(){
		return $this->recurso;
	}
	public function setRecurso($r){
		$this->recurso = $r;
	}

}

?>