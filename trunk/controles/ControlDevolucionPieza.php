<?php
require_once ("ManipuladorPersistencia.php");
require_once ("persistencia/DevolucionPieza.php");

class ControlDevolucionPieza {

	public function obtenerDevolucionPiezaPorId($id_dev){
		$mp=new ManipuladorPersistencia();
		$result = $mp-> obtenerObjetosPorFiltro("DEVOLUCION_PIEZA","ID='".$id_dev."'");
		$obj=null;
		if($result !== FALSE) {
			while ($row = mysqli_fetch_array($result)){
				$obj=new DevolucionPieza($row["ID"],$row["NUMERO_REMITO"],$row["FECHA_DEVOLUCION"],$row["TRANSPORTE"],$row["NUMERO_RETIRO"]);
			}
		}
		return $obj;
	}

	public function agregarDevolucionPieza(DevolucionPieza $dev_pieza){
		$mp=new ManipuladorPersistencia();
		if($dev_pieza->getFechaDevolucion()!=null){
			$result = $mp->agregarObjeto("DEVOLUCION_PIEZA (FECHA_DEVOLUCION,NUMERO_REMITO,NUMERO_RETIRO,TRANSPORTE)",
			"('".$dev_pieza->getFechaDevolucion()."',
			'".$dev_pieza->getNumeroRemito()."',
			'".$dev_pieza->getNumeroRetiro()."',
			'".$dev_pieza->getTransporte()."')");
			return $result;
		}else{
			$result = $mp->agregarObjeto("DEVOLUCION_PIEZA (NUMERO_REMITO,NUMERO_RETIRO,TRANSPORTE)",
			"('".$dev_pieza->getNumeroRemito()."',
			'".$dev_pieza->getNumeroRetiro()."',
			'".$dev_pieza->getTransporte()."')");
			return $result;
		}
	}

	public function modificarDevolucionPieza($id_dev, DevolucionPieza $dev_pieza){
		$mp=new ManipuladorPersistencia();
		if($dev_pieza->getFechaDevolucion()!=null){
			$result = $mp->modificarObjeto("DEVOLUCION_PIEZA",
			"FECHA_DEVOLUCION='".$dev_pieza->getFechaDevolucion()."', 
			NUMERO_REMITO='".$dev_pieza->getNumeroRemito()."', 
			NUMERO_RETIRO='".$dev_pieza->getNumeroRetiro()."', 
			TRANSPORTE='".$dev_pieza->getTransporte()."'","ID='".$id_dev."'");
		}else{
			$result = $mp->modificarObjeto("DEVOLUCION_PIEZA",
			"NUMERO_REMITO='".$dev_pieza->getNumeroRemito()."', 
			NUMERO_RETIRO='".$dev_pieza->getNumeroRetiro()."', 
			TRANSPORTE='".$dev_pieza->getTransporte()."'","ID='".$id_dev."'");
		}
		return $result;
	}

}

?>