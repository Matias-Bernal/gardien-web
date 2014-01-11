<?php

class Usuario {
	private $nombre_usuario  = "";
	private $clave = "";
	private $email = "";
	private $id = 0;
	private $tipo = "";

	public function __construct($i,$n,$c,$e,$t){
		$this->id = $i;
		$this->nombre_usuario = $n;
		$this->clave = $c;
		$this->email = $e;
		$this->tipo = $t;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}

	public function getNombreUsuario(){
		return $this->nombre_usuario;
	}
	public function setNombreUsuario($n){
		$this->nombre_usuario = $n;
	}

	public function getClave(){
		return $this->clave;
	}
	public function setClave($c){
		$this->clave = $c;
	}

	public function getEmail(){
		return $this->email;
	}
	public function setEmail($e){
		$this->email = $e;
	}

	public function getTipo(){
		return $this->tipo;
	}
	public function setTipo($t){
		$this->tipo = $t;
	}
}

?>