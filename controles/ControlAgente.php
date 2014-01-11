<?php
require_once ("manipuladorPersistencia.php");
require_once ("persistencia/Agente.php");

class ControlAgente {

	public function obtenerAgente(){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosOrdenadosPorFiltro("agente","ID");
		$listado=array();
		if($result === FALSE) {
			return $listado; // TODO: ningun registro
		}
		while ($row = mysql_fetch_array($result)){
			$obj=new Agente($row["ID"],$row["NOMBRE REGISTRANTE"]);
			$listado[]=$obj;
		}
		return $listado;
	}

	public function obtenerAgentePorId($id){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("agente","ID=$id");
		$row = mysql_fetch_array($result);
		$obj=new Agente($row["ID"],$row["NOMBRE REGISTRANTE"]);
		return $obj;
	}

	public function modificarAgente($id,$agente){
		$mp=new ManipuladorPersistencia();
		$result = $mp->modificarObjeto("agente","NOMBRE REGISTRANTE='".$agente->getNombreRegistrante()."'","ID=$id");
		return ;
	}

	public function agregarAgente($agente){
		$mp=new ManipuladorPersistencia();
		$result = $mp->agregarObjeto("agente (NOMBRE REGISTRANTE)","('".$agente->getNombreRegistrante()."')");
	}

	//verifica si esta en uso - no requiere eliminar dependencias
	public function eliminarAgente($id){
		$mp=new ManipuladorPersistencia();
		$result = $mp->eliminarObjeto("agente","ID=$id");		
	}

}

?>