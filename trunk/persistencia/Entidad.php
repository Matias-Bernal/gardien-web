<?php
require_once('persistencia/Registrante.php');

class Entidad extends Registrante  {

	public function __construct($i,$n){
		parent::__construct($i,$n);
	}
}

?>