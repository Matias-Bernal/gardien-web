<?php
require_once ("ManipuladorPersistencia.php");
require_once ("persistencia/Reclamante.php");

class ControlReclamante {

	public function obtenerReclamantes(){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerTodosObjetos("RECLAMANTE");
		$listado=array();
		if($result !== FALSE) {
			while ($row = mysqli_fetch_array($result)){
				$obj=new Reclamante($row["ID"],$row["NOMBRE_APELLIDO"],$row["DNI"],$row["EMAIL"]);
				$listado[]=$obj;
			}
		}
		return $listado;
	}

	public function obtenerReclamantePorId($id){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("RECLAMANTE","ID='".$id."'");
		$row = mysqli_fetch_array($result);
		$obj=new Reclamante($row["ID"],$row["NOMBRE_APELLIDO"],$row["DNI"],$row["EMAIL"]);
		return $obj;
	}

	public function obtenerReclamantePorDni($d){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("RECLAMANTE","DNI='".$d."'");
		$row = mysqli_fetch_array($result);
		$obj=new Reclamante($row["ID"],$row["NOMBRE_APELLIDO"],$row["DNI"],$row["EMAIL"]);
		return $obj;
	}

	public function modificarReclamante($id,$reclamante){
		$mp=new ManipuladorPersistencia();
		$result = $mp->modificarObjeto("RECLAMANTE","DNI='".$reclamante->getDni()."',EMAIL='".$reclamante->getEmail()."', NOMBRE_APELLIDO='".$reclamante->getNombreApellido()."'","ID='".$id."'");
		return $result;
	}

	public function agregarReclamante(Reclamante $reclamante){
		$mp=new ManipuladorPersistencia();
		$result = $mp->agregarObjeto("RECLAMANTE (DNI,EMAIL,NOMBRE_APELLIDO)","('".$reclamante->getDni()."','".$reclamante->getEmail()."','".$reclamante->getNombreApellido()."')");
		return $result;
	}

	public function eliminarReclamante($id){
		$mp=new ManipuladorPersistencia();
		$result = $mp->eliminarObjeto("RECLAMANTE","ID='".$id."'");
		return $result;
	}

}

?>