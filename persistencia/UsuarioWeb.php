<?php
require_once('Agente.php');

class UsuarioWeb {
	private $nombre_usuario = "";
	private $contrasenia = "";
	private $id_agente = 0;
	
	public function __construct($n,$c,$i){
		$this->nombre_usuario = $n;
		$this->contrasenia = $c;
		$this->id_agente = $i;
	}

	public function getIdAgente(){
		return $this->id_agente;
	}
	public function setIdAgente($i){
		$this->id_agente=$i;
	}

	public function getNombreUsuario(){
		return $this->nombre_usuario;
	}
	public function setNombreUsuario($n){
		$this->nombre_usuario=$n;
	}

	public function getContrasenia(){
		return $this->contrasenia;
	}
	public function setContrasenia($c){
		$this->contrasenia=$c;
	}	
}

?>