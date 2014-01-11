<?php
require_once('Reclamo.php');

class Mano_Obra {
	private $cantidad_horas = 0.0;
	private $valor_mano_obra = 0.0;
	private $codigo_mano_obra = "";
	private $reclamo = null;
	private $id = 0;
	

	public function __construct($i,$cHs,$vHs,$c,Reclamo $r){
		$this->id = $i;
		$this->cantidad_horas = $cHs;
		$this->valor_mano_obra = $vHs;
		$this->codigo_mano_obra = $c;
		$this->reclamo = $r;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}

	public function getCantidadHoras(){
		return $this->cantidad_horas;
	}
	public function setCantidadHoras($cHs){
		$this->cantidad_horas = $cHs;
	}

	public function getValorManoObra(){
		return $this->valor_mano_obra;
	}
	public function setValorManoObra($vHs){
		$this->valor_mano_obra= $vHs;
	}

	public function getCodigoManoObra(){
		return $this->codigo_mano_obra;
	}
	public function setCodigoManoObre($c){
		$this->codigo_mano_obra = $c;
	}

	public function getReclamo(){
		return $this->reclamo;
	}
	public function setReclamo(Reclamo $r){
		$this->reclamo = $r;
	}

}

?>