<?php
require_once ("ManipuladorPersistencia.php");
require_once ("persistencia/Marca.php");

class ControlMarca {

	public function obtenerMarcas(){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerTodosObjetos("MARCA");
		$listado=array();
		if($result !== FALSE) {
			while ($row = mysqli_fetch_array($result)){
				$obj=new Marca($row["ID"],$row["NOMBRE_MARCA"]);
				$listado[]=$obj;
			}
		}
		return $listado;
	}

	public function obtenerMarcaPorId($id){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("MARCA","ID='".$id."'");
		$row = mysqli_fetch_array($result);
		$obj=new Marca($row["ID"],$row["NOMBRE_MARCA"]);
		return $obj;
	}

	public function obtenerMarcaPorNombre($nombre){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("MARCA","NOMBRE_MARCA='".$nombre."'");
		$row = mysqli_fetch_array($result);
		$obj=new Marca($row["ID"],$row["NOMBRE_MARCA"]);
		return $obj;
	}

	public function modificarMarca($id,Marca $marca){
		$mp=new ManipuladorPersistencia();
		$result = $mp->modificarObjeto("MARCA","NOMBRE_MARCA='".$marca->getNombreMarca()."'","ID='".$id."'");
		return result;
	}

	public function agregarMarca(Marca $marca){
		$mp=new ManipuladorPersistencia();
		$result = $mp->agregarObjeto("MARCA (NOMBRE_MARCA)","('".$marca->getNombreMarca()."')");
		return result;
	}

	public function eliminarMarca($id){
		$mp=new ManipuladorPersistencia();
		$result = $mp->eliminarObjeto("MARCA","ID='".$id."'");
		return result;
	}

}

?>