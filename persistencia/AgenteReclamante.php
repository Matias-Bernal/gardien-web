<?php
require_once('Agente.php');
require_once('Reclamante.php');

class AgenteReclamante {
	private $id = 0;
	private $agente = null;
	private $reclamante = null;

	public function __construct($i, Agente $ag, Reclamante $rec){
		$this->id = $i;
		$this->agente = $ag;
		$this->reclamante = $rec;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}

	public function getAgente(){
		return $this->agente;
	}
	public function setAgente(Agente $ag){
		$this->agente = $ag;
	}

	public function getReclamante(){
		return $this->reclamante;
	}
	public function setReclamante(Reclamante $rec){
		$this->reclamante= $rec;
	}

}

?>