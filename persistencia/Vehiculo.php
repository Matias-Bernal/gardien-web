<?php
require_once('Modelo.php');
require_once('Marca.php');

class Vehiculo {
	private $dominio = "";
	private $vin = "";
	private $nombre_titular = "";
	private $marca = null;
	private $modelo = null;
	private $id = 0;

	public function __construct($i,$d,$v,$n,Marca $ma,Modelo $mo){
		$this->id = $i;
		$this->dominio = $d;
		$this->vin = $v;
		$this->nombre_titular = $n;
		$this->marca = $ma;
		$this->modelo = $mo;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}

	public function getDominio(){
		return $this->dominio;
	}
	public function setDominio($d){
		$this->dominio = $d;
	}

	public function getVin(){
		return $this->vin;
	}
	public function setVin($v){
		$this->vin = $v;
	}

	public function getNombreTitular(){
		return $this->nombre_titular;
	}
	public function setNombreTitular($n){
		$this->nombre_titular = $n;
	}

	public function getMarca(){
		return $this->marca;
	}
	public function setMarca(Marca $ma){
		$this->marca = $ma;
	}

	public function getModelo(){
		return $this->modelo;
	}
	public function setModelo(Modelo $mo){
		$this->modelo = $mo;
	}

}

?>