<?php
require_once('persistencia/Pedido.php');
require_once('persistencia/Pieza.php');

class Muleto {
	private $descripcion = "";
	private $vin = "";
	private $pedido = null;
	private $pieza = null;
	private $id = 0;
	

	public function __construct($i,$d,$v,Pedido $ped, Pieza $pie){
		$this->id = $i;
		$this->descripcion = $d;
		$this->vin = $v;
		$this->pedido = $ped;
		$this->pieza = $pie;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}

	public function getDescripcion(){
		return $this->descripcion;
	}
	public function setDescripcion($d){
		$this->descripcion = $d;
	}

	public function getVin(){
		return $this->vin;
	}
	public function setVin($v){
		$this->vin= $v;
	}

	public function getPedido(){
		return $this->pedido;
	}
	public function setPedido(Pedido $ped){
		$this->pedido = $ped;
	}

	public function getPieza(){
		return $this->pieza;
	}
	public function setPieza(Pieza $pie){
		$this->pieza = $pie;
	}

}

?>