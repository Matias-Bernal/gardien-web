<?php
require_once ("ManipuladorPersistencia.php");
require_once ("persistencia/Registrante.php");

class ControlRegistrante {

	public function obtenerRegistrantePorId($id){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("registrante","ID='".$id."'");
		$row = mysqli_fetch_array($result);
		$obj=new Agente($row["ID"],$row["NOMBRE_REGISTRANTE"]);
		return $obj;
	}

	public function obtenerRegistrantePorNombre($nombre){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("registrante","NOMBRE_REGISTRANTE='".$nombre."'");
		$row = mysqli_fetch_array($result);
		$obj=new Agente($row["ID"],$row["NOMBRE_REGISTRANTE"]);
		return $obj;
	}

}

?>