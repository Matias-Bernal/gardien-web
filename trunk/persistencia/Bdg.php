<?php
require_once('persistencia/Pieza.php');
require_once('persistencia/Pedido.php');

class Reclamo {
	private $fecha_bdg = "";
	private $pieza = null;
	private $pedido = null;
	private $numero_bdg = "";
	private $id = 0;
	

	public function __construct($i,$f,Pieza $pie, Pedido $ped,$n){
		$this->id = $i;
		$this->fecha_bdg = $f;
		$this->pieza = $pie;
		$this->pedido = $ped;
		$this->numero_bdg = $n;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}

	public function getFechaBdg(){
		return $this->fecha_bdg;
	}
	public function setFechaBdg($f){
		$this->fecha_bdg = $f;
	}

	public function getPieza(){
		return $this->pieza;
	}
	public function setPieza(pieza $pie){
		$this->pieza = $pie;
	}

	public function getPedido(){
		return $this->pedido;
	}
	public function setpedido(Pedido $ped){
		$this->pedido = $ped;
	}

	public function getNumeroBdg(){
		return $this->numero_bdg;
	}
	public function setNumeroBdg($n){
		$this->numero_bdg = $n;
	}

}

?>