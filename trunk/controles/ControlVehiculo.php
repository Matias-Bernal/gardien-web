<?php
require_once ("ManipuladorPersistencia.php");
require_once ("persistencia/Vehiculo.php");
require_once ("controles/ControlModelo.php");

class ControlVehiculo {

	public function obtenerVehiculos(){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerTodosObjetos("vehiculo");
		$listado=array();
		if($result !== FALSE) {
			$cmarca=new ControlMarca();
			$cmodelo=new ControlModelo();
			while ($row = mysqli_fetch_array($result)){
				$marca = $cmarca->obtenerMarcaPorId($row["MARCA_ID_OID"]);
				$modelo = $cmodelo->obtenerModeloPorId($row["MODELO_ID_OID"]);
				if($marca !==  FALSE or $modelo !== FALSE) {
					$obj=new Vehiculo($row["ID"],$row["DOMINIO"],$row["VIN"],$row["NOMBRE_TITULAR"],$marca,$modelo);
					$listado[]=$obj;			
				}
			}
		}
		return $listado;
	}

	public function obtenerVehiculoPorId($id){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("vehiculo","ID='".$id."'");
		if($result !== FALSE) {
			$row = mysqli_fetch_array($result);
			$cmarca=new ControlMarca();
			$marca = $cmarca->obtenerMarcaPorId($row["MARCA_ID_OID"]);
			$cmodelo=new ControlModelo();
			$modelo = $cmodelo->obtenerModeloPorId($row["MODELO_ID_OID"]);
			if($marca !==  FALSE or $modelo !== FALSE) {
				$obj=new Vehiculo($row["ID"],$row["DOMINIO"],$row["VIN"],$row["NOMBRE_TITULAR"],$marca,$modelo);
				return $obj;
			}
		}
	}

	public function obtenerVehiculosPorReclamante($id){
	$mp=new ManipuladorPersistencia();
	$result = $mp->obtenerObjetosPorFiltro("vehiculo_reclamante","ID_RECLAMANTE='".$id."'");
	$listado=array();
		if($result !== FALSE) {
			while ($row = mysqli_fetch_array($result)){
				$listado[] = $this->obtenerVehiculoPorId($row["ID_VEHICULO"]);
			}
		}
		return $listado;
	}

	public function obtenerVehiculoPorDominio($dominio){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("vehiculo","DOMINIO='".$dominio."'");
		if($result !== FALSE) {
			$row = mysqli_fetch_array($result);
			$cmarca=new ControlMarca();
			$marca = $cmarca->obtenerMarcaPorId($row["MARCA_ID_OID"]);
			$cmodelo=new ControlModelo();
			$modelo = $cmodelo->obtenerModeloPorId($row["MODELO_ID_OID"]);
			if($marca !==  FALSE or $modelo !== FALSE) {
				$obj=new Vehiculo($row["ID"],$row["DOMINIO"],$row["VIN"],$row["NOMBRE_TITULAR"],$marca,$modelo);
				return $obj;
			}
		}
	}

	public function obtenerVehiculoPorVin($vin){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("vehiculo","VIN='".$vin."'");
		if($result !== FALSE) {
			$row = mysqli_fetch_array($result);
			$cmarca=new ControlMarca();
			$marca = $cmarca->obtenerMarcaPorId($row["MARCA_ID_OID"]);
			$cmodelo=new ControlModelo();
			$modelo = $cmodelo->obtenerModeloPorId($row["MODELO_ID_OID"]);
			if($marca !==  FALSE or $modelo !== FALSE) {
				$obj=new Vehiculo($row["ID"],$row["DOMINIO"],$row["VIN"],$row["NOMBRE_TITULAR"],$marca,$modelo);
				return $obj;
			}
		}
	}

	public function modificarVehiculo($id,$vehiculo){
		$mp=new ManipuladorPersistencia();
		$result = $mp->modificarObjeto("vehiculo",
		"DOMINIO='".$vehiculo->getDominio()."', 
		MARCA_ID_OID='".$vehiculo->getMarca()->getId()."', 
		MODELO_ID_OID='".$vehiculo->getModelo()->getId()."', 
		NOMBRE_TITULAR='".$vehiculo->getNombreTitular()."', 
		VIN='".$vehiculo->getVin()."'","ID='".$id."'");
		return $result;
	}

	public function agregarVehiculo(Vehiculo $vehiculo){
		$mp=new ManipuladorPersistencia();
		$result = $mp->agregarObjeto("vehiculo (DOMINIO,MARCA_ID_OID,MODELO_ID_OID,NOMBRE_TITULAR,VIN)",
		"('".$vehiculo->getDominio()."',
		'".$vehiculo->getMarca()->getId()."',
		'".$vehiculo->getModelo()->getId()."',
		'".$vehiculo->getNombreTitular()."',
		'".$vehiculo->getVin()."')");
		return $result;
	}

	public function eliminarVehiculo($id){
		$mp=new ManipuladorPersistencia();
		$result = $mp->eliminarObjeto("vehiculo","ID='".$id."'");	
		return $result;
	}

}

?>