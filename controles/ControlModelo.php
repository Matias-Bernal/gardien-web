<?php
require_once ("ManipuladorPersistencia.php");
require_once ("controles/ControlMarca.php");
require_once ("persistencia/Modelo.php");

class ControlModelo {

	public function obtenerModelo(){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerTodosObjetos("MODELO");
		$listado=array();
		if($result !== FALSE) {
			$cmarca=new ControlMarca();
			while ($row = mysqli_fetch_array($result)){
				$marca= $cmarca->obtenerMarcaPorId($row["MARCA_ID_OID"]);
				if($marca !== FALSE) {
					$obj=new Modelo($row["ID"],$row["NOMBRE_MODELO"],$marca);
					$listado[]=$obj;
				}
			}
		}
		return $listado;
	}

	public function obtenerModeloPorId($id){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("MODELO","ID='".$id."'");
		$row = mysqli_fetch_array($result);
		$cmarca=new ControlMarca();
		$marca= $cmarca->obtenerMarcaPorId($row["MARCA_ID_OID"]);
		if($marca !== FALSE) {
			$obj=new Modelo($row["ID"],$row["NOMBRE_MODELO"],$marca);
			return $obj;
		}
	}

	public function obtenerModeloPorNombre($nombre){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("MODELO","NOMBRE_MODELO='".$nombre."'");
		$row = mysqli_fetch_array($result);
		$cmarca=new ControlMarca();
		$marca= $cmarca->obtenerMarcaPorId($row["MARCA_ID_OID"]);
		if($marca !== FALSE) {
			$obj=new Modelo($row["ID"],$row["NOMBRE_MODELO"],$marca);
			return $obj;
		}
	}

	public function obtenerModeloPorMarca(Marca $marca){
		$mp=new ManipuladorPersistencia();
		$idMarca = $marca->getId();
		$result = $mp->obtenerObjetosPorFiltro("MODELO","MARCA_ID_OID='".$idMarca."'");
		$listado=array();
		if($result !== FALSE) {
			while ($row = mysqli_fetch_array($result)){
				$obj=new Modelo($row["ID"],$row["NOMBRE_MODELO"],$marca);
				$listado[]=$obj;
			}
		}
		return $listado;
	}


	public function modificarModelo($id,Modelo $modelo){
		$mp=new ManipuladorPersistencia();
		$result = $mp->modificarObjeto("MODELO","MARCA_ID_OID='".$modelo->getMarca().getId()."', NOMBRE_MODELO='".$modelo->getNombreModelo()."'","ID='".$id."'");
		return $result;
	}

	public function agregarModelo(Modelo $modelo){
		$mp=new ManipuladorPersistencia();
		$result = $mp->agregarObjeto("MODELO (MARCA_ID_OID,NOMBRE_MODELO)","('".$modelo->getMarca().getId()."','".$modelo->getNombreModelo()."')");
		return $result;
	}

	public function eliminarModelo($id){
		$mp=new ManipuladorPersistencia();
		$result = $mp->eliminarObjeto("MODELO","ID='".$id."'");
		return $result;
	}

}

?>