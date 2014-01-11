<?php
require_once('Reclamo.php');
require_once('Orden.php');

class OrdenReclamo {
	private $orden = null;
	private $reclamo = null;
	private $id = 0;
	

	public function __construct($i,Reclamo $r,Orden $o){
		$this->id = $i;
		$this->reclamo = $r;
		$this->orden = $o;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}

	public function getReclamo(){
		return $this->reclamo;
	}
	public function setReclamo(Reclamo $r){
		$this->reclamo = $r;
	}

	public function getOrden(){
		return $this->orden;
	}
	public function setOrden(Orden $o){
		$this->orden = $o;
	}
}

?>