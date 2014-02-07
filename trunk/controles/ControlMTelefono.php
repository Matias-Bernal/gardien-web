<?php
require_once ("ManipuladorPersistencia.php");
require_once ("controles/ControlReclamante.php");
require_once ("persistencia/MTelefono.php");

class ControlMtelefono{

	public function obtenerMTelefonos(){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerTodosObjetos("mtelefono");
		$listado=array();
		if($result !== FALSE) {
			$creclamante=new ControlReclamante();
			while ($row = mysqli_fetch_array($result)){
				$reclamante = $creclamante->obtenerReclamantePorId($row["RECLAMANTE_ID_OID"]);
				if($reclamante !== FALSE) {
					$obj=new MTelefono($row["ID"],$row["TELEFONO"],$reclamante);
					$listado[]=$obj;
				}
			}
		}
		return $listado;
	}

	public function obtenerMTelefonosPorReclamante($id_reclamante){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("mtelefono","RECLAMANTE_ID_OID='".$id_reclamante."'");
		$listado=array();
		if($result !== FALSE) {
			$creclamante=new ControlReclamante();
			while ($row = mysqli_fetch_array($result)){
				$listado[]=$row["TELEFONO"];
			}
		}
		return $listado;
	}
	
	public function agregarMTelefono(MTelefono $mtelefono){
		$mp=new ManipuladorPersistencia();
		$result = $mp->agregarObjeto("mtelefono (RECLAMANTE_ID_OID,TELEFONO)", "('".$mtelefono->getReclamante()->getId()."',
		'".$mtelefono->getTelefono()."')");
		return $result;
	}

	//falta el modificar//
	
	public function eliminarMTelefono($id_mtelefono){
		$mp=new ManipuladorPersistencia();
		$result = $mp->eliminarObjeto("mtelefono","ID='".$id_mtelefono."'");
		return $result;
	}

}

?>