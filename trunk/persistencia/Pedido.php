<?php
require_once('persistencia/Reclamo.php');

class Pedido {
	private $id = 0;
	private $fecha_solicitud_pedido = "";
	private $reclamo = null;
	

	public function __construct($i,Reclamo $r,$f){
		$this->id = $i;
		$this->reclamo = $r;
		$this->fecha_solicitud_pedido = $f;
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

	public function getFechaSolicitudPedido(){
		return $this->fecha_solicitud_pedido;
	}
	public function setFechaSolicitudPedido($f){
		$this->fecha_solicitud_pedido = $f;
	}
}

?>