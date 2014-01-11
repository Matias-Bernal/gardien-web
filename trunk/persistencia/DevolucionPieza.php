<?php

class DevolucionPieza {
	private $numero_remito = "";
	private $fecha_devolucion = "";
	private $transporte = "";
	private $numero_retiro = "";
	private $id = 0;
	

	public function __construct($i,$n,$f,$t,$nr){
		$this->id = $i;
		$this->numero_remito = $n;
		$this->fecha_devolucion = $f;
		$this->transporte = $t;
		$this->numero_retiro = $nr;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}

	public function getNumeroRemito(){
		return $this->numero_remito;
	}
	public function setNumeroRemito($n){
		$this->numero_remito = $n;
	}

	public function getFechaDevolucion(){
		return $this->fecha_devolucion;
	}
	public function setFechaDevolucion($f){
		$this->fecha_devolucion= $f;
	}

	public function getTransporte(){
		return $this->transporte;
	}
	public function setTransporte($t){
		$this->transporte = $t;
	}

	public function getNumeroRetiro(){
		return $this->numero_retiro;
	}
	public function setNumeroRetiro($nr){
		$this->numero_retiro = $nr;
	}

}

?>