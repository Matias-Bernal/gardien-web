<?php
require_once('persistencia/Reclamante.php');

class MTelefono {
	private $reclamante = null;
	private $telefono = "";
	private $id = 0;

	public function __construct($i,$t,Reclamante $r){
		$this->id = $i;
		$this->telefono = $t;
		$this->reclamante = $r;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}

	public function getTelefono(){
		return $this->telefono;
	}
	public function setTelefono($t){
		$this->reclamante = $t;
	}

	public function getReclamante(){
		return $this->reclamante;
	}
	public function setReclamante($r){
		$this->reclamante = $r;
	}
}

?>