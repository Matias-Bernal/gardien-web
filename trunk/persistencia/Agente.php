<?php
require_once('persistencia/Registrante.php');

class Agente extends Registrante  {

	public function __construct($i,$n){
		parent::__construct($i,$n);
	}

	public function getId(){
		return parent::getId();
	}
	public function setId($i){
		parent::setId($i);
	}

	public function getNombreRegistrante(){
		return parent::getNombreRegistrante();
	}
	public function setNombreRegistrante($n){
		parent::setNombreRegistrante($n);
	}

}

?>