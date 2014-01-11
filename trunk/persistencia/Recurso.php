<?php

class Recurso {
	private $fecha_recurso = "";
	private $numero_recurso = "";
	private $id = 0;	

	public function __construct($i,$n,$f){
		$this->id = $i;
		$this->numero_recurso = $n;
		$this->fecha_recurso = $f;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}

	public function getNumeroRecurso(){
		return $this->numero_recurso;
	}
	public function setNumeroRecurso($n){
		$this->numero_recurso = $n;
	}

	public function getFechaRecurso(){
		return $this->fecha_recurso;
	}
	public function setFechaRecurso($f){
		$this->fecha_recurso = $f;
	}

}

?>