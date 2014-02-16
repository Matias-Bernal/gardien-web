<?php
require_once('persistencia/Pedido.php');
require_once('persistencia/Pieza.php');
require_once('persistencia/ReclamoTagle.php');

class PedidoPiezaReclamoTagle {
	private $id = 0;
	private $pedido = null;
	private $pieza = null;
	private $reclamo_tagle = null;

	public function __construct($i,Pedido $ped, Pieza $pie, ReclamoTagle $rec){
		$this->id = $i;
		$this->reclamo_tagle= $rec;
		$this->pedido = $ped;
		$this->pieza = $pie;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}
	
	public function getReclamoTagle(){
		return $this->reclamo_tagle;
	}
	public function setReclamoTagle(ReclamoTagle $rec){
		$this->reclamo_tagle= $rec;
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
		$this->pieza= $pie;
	}

}