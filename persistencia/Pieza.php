<?php
require_once('Proveedor.php');

class Pieza {
	private $id = 0;
	private $numero_pieza = "";
	private $descripcion = "";
	private $proveedor = null;
	

	public function __construct($i,$n,$m,Proveedor $p){
		$this->id = $i;
		$this->numero_pieza = $n;
		$this->descripcion = $m;
		$this->proveedor = $p;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}

	public function getNumeroPieza(){
		return $this->numero_pieza;
	}
	public function setNumeroPieza($n){
		$this->numero_pieza = $n;
	}

	public function getDescripcion(){
		return $this->descripcion;
	}
	public function setDescripcion($m){
		$this->descripcion = $m;
	}

	public function getPreoveedor(){
		return $this->proveedor;
	}
	public function setProveedor(Proveedor $p){
		$this->proveedor = $p;
	}

}

?>