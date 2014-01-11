<?php
require_once('Marca.php');

class Localidad {
	private $nombre_modelo = "";
	private $marca = null;
	private $id = 0;

	public function __construct($i,$n,Marca $m){
		$this->id = $i;
		$this->nombre_modelo = $n;
		$this->marca = $m;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}

	public function getNombreModelo(){
		return $this->nombre_modelo;
	}
	public function setNombreModelo($n){
		$this->nombre_modelo = $n;
	}

	public function getMarca(){
		return $this->marca;
	}
	public function setMarca(Marca $m){
		$this->marca = $m;
	}

}

?>