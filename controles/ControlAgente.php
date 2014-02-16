<?php
require_once ("ManipuladorPersistencia.php");
require_once ("persistencia/Agente.php");

class ControlAgente {

	public function obtenerAgentes(){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerTodosObjetos("agente");
		$listado=array();
		if($result !== FALSE) {
			while ($row = mysqli_fetch_array($result)){
				$obj=new Agente($row["ID"],$row["NOMBRE_REGISTRANTE"]);
				$listado[]=$obj;
			}
		}
		return $listado;
	}

	public function obtenerAgentePorId($id){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("REGISTRANTE","ID='".$id."'");
		$row = mysqli_fetch_array($result);
		$obj=new Agente($row["ID"],$row["NOMBRE_REGISTRANTE"]);
		return $obj;
	}

	public function obtenerAgentePorNombre($nombre){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("REGISTRANTE","NOMBRE_REGISTRANTE='".$nombre."'");
		$row = mysqli_fetch_array($result);
		$obj=new Agente($row["ID"],$row["NOMBRE_REGISTRANTE"]);
		return $obj;
	}

	public function modificarAgente($id,$agente){
		$mp=new ManipuladorPersistencia();
		$result = $mp->modificarObjeto("REGISTRANTE","NOMBRE_REGISTRANTE='".$agente->getNombreRegistrante()."'","ID='".$id."'");
		return $result;
	}

	public function agregarAgente($agente){
		$mp=new ManipuladorPersistencia();
		$result = $mp->agregarObjeto("AGENTE (NOMBRE_REGISTRANTE)","('".$agente->getNombreRegistrante()."')");
		return $result;
	}

	public function eliminarAgente($id){
		$mp=new ManipuladorPersistencia();
		$result = $mp->eliminarObjeto("AGENTE","ID='".$id."'");
		return $result;	
	}

}

?>