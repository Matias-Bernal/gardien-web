<?php

class Registrante {
	private $id = 0;
	private $nombre_registrante = "";
	
	public function __construct($i,$n){
		$this->id = $i;
		$this->nombre_registrante = $n;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}

	public function getNombreRegistrante(){
		return $this->nombre_registrante;
	}
	public function setNombreRegistrante($n){
		$this->nombre_registrante=$n;
	}	
}

?>