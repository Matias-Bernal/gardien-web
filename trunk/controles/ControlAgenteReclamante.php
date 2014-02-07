<?php
require_once ("ManipuladorPersistencia.php");
require_once ("persistencia/AgenteReclamante.php");
require_once ("controles/ControlAgente.php");
require_once ("controles/ControlReclamante.php");
require_once ("persistencia/Agente.php");
require_once ("persistencia/Reclamante.php");

class ControlAgenteReclamante{

	public function obtenerAgenteReclamante(){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerTodosObjetos("agente_reclamante");
		$listado=array();
		if($result !== FALSE) {
			$cagente=new ControlAgente();
			$creclamante=new ControlReclamante();
			while ($row = mysqli_fetch_array($result)){
				$agente = $cagente->obtenerAgentePorId($row["ID_AGENTE"]);
				$reclamante = $creclamante->obtenerReclamantePorId($row["ID_RECLAMANTE"]);
				if($agente !==  FALSE or $reclamante !== FALSE) {
					$obj=new AgenteReclamante($agente,$reclamante);
					$listado[]=$obj;
				}
			}
		}
		return $listado;
	}

	public function obtenerReclamantes($id_agente){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("agente_reclamante","ID_AGENTE='".$id_agente."'");
		$listado=array();
		if($result !== FALSE) {
			$creclamante=new ControlReclamante();
			while ($row = mysqli_fetch_array($result)){
				$reclamante = $creclamante->obtenerReclamantePorId($row["ID_RECLAMANTE"]);
				if($reclamante !== FALSE) {
					$listado[]=$reclamante;
				}
			}
		}
		return $listado;
	}
	
	public function agregarAgenteReclamante($idAgente, $idReclamante){
		$mp=new ManipuladorPersistencia();
		$result = $mp->agregarObjeto("agente_reclamante (ID_AGENTE,ID_RECLAMANTE)",
		"('".$idAgente."','".$idReclamante."')");
		return $result;
	}
	
	//falta el modificar//

	public function eliminarAgenteReclamante(AgenteReclamante $agenteReclamante){
		$mp=new ManipuladorPersistencia();
		$idAgente = $agenteReclamante->getAgente->getId();
		$idReclamante = $agenteReclamante->getReclamante()->getId();
		$result = $mp->eliminarObjeto("agente_reclamante","ID_AGENTE='".$idAgente."' AND ID_RECLAMANTE='".$idReclamante."'");
		return $result;
	}

}

?>