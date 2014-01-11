<?php

class Reclamante {
	private $id = 0;
	private $nombre_apellido = "";
	private $dni = "";
	private $email = "";
	

	public function __construct($i,$n,$d,$e){
		$this->id = $i;
		$this->nombre_apellido = $n;
		$this->dni = $d;
		$this->email = $e;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}

	public function getNombreApellido(){
		return $this->nombre_apellido;
	}
	public function setNombreApellido($n){
		$this->nombre_apellido = $n;
	}

	public function getDni(){
		return $this->dni;
	}
	public function setDni($d){
		$this->dni = $d;
	}

	public function getEmail(){
		return $this->email;
	}
	public function setEmail($e){
		$this->email = $e;
	}

}

?>