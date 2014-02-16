<?php
require_once ("ManipuladorPersistencia.php");
require_once ("persistencia/PedidoPieza.php");
require_once ("controles/ControlPedido.php");
require_once ("controles/ControlPieza.php");
require_once ("controles/ControlDevolucionPieza.php");

class ControlPedidoPieza{

	public function obtenerPedidoPiezas($id_registrante){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerTodosObjetos("PEDIDO_PIEZA");
		$listado=array();
		if($result !== FALSE) {
			$cpedido=new ControlPedido();
			$cpieza=new ControlPieza();
			$cdevolucionPieza=new ControlDevolucionPieza();
			while ($row = mysqli_fetch_array($result)){
				$obj=null;
				$pedido = $cpedido->obtenerPedidoPorId($row["PEDIDO_ID_OID"],$id_registrante);
				$pieza = $cpieza->obternerPiezaPorId($row["PIEZA_ID_OID"]);
				if($pedido !=  null and $pieza != null) {
					$devolucion = $cdevolucionPieza->obtenerDevolucionPiezaPorId($row["DEVOLUCION_TAGLE_ID_OID"]);
					if($devolucion != null){
						$obj=new PedidoPieza($row["ID"],$pedido,$pieza,$row["NUMERO_PEDIDO"],$row["FECHA_SOLICITUD_FABRICA"],$row["FECHA_RECEPCION_FABRICA"],$row["FECHA_ENVIO_AGENTE"],$row["FECHA_RECEPCION_AGENTE"],$row["FECHA_RECEPCION_TAGLE"],$devolucion);
					}else{
						$obj=new PedidoPieza($row["ID"],$pedido,$pieza,$row["NUMERO_PEDIDO"],$row["FECHA_SOLICITUD_FABRICA"],$row["FECHA_RECEPCION_FABRICA"],$row["FECHA_ENVIO_AGENTE"],$row["FECHA_RECEPCION_AGENTE"],$row["FECHA_RECEPCION_TAGLE"],null);
					}
					$listado[]=$obj;
				}
			}
		}
		return $listado;
	}

	public function obtenerPedidoPiezasPorId($id_pedido_pieza,$id_registrante){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("PEDIDO_PIEZA","ID='".$id_pedido_pieza."'");
		$obj=null;
		if($result !== FALSE) {
			$cpedido=new ControlPedido();
			$cpieza=new ControlPieza();
			$cdevolucionPieza=new ControlDevolucionPieza();
			while ($row = mysqli_fetch_array($result)){
				$pedido = $cpedido->obtenerPedidoPorId($row["PEDIDO_ID_OID"],$id_registrante);
				$pieza = $cpieza->obternerPiezaPorId($row["PIEZA_ID_OID"]);
				if($pedido !=  null and $pieza != null) {
					$devolucion = $cdevolucionPieza->obtenerDevolucionPiezaPorId($row["DEVOLUCION_TAGLE_ID_OID"]);
					if($devolucion != null){
						$transporte = $devolucion->getTransporte();
						$obj=new PedidoPieza($row["ID"],$pedido,$pieza,$row["NUMERO_PEDIDO"],$row["FECHA_SOLICITUD_FABRICA"],$row["FECHA_RECEPCION_FABRICA"],$row["FECHA_ENVIO_AGENTE"],$row["FECHA_RECEPCION_AGENTE"],$row["FECHA_RECEPCION_TAGLE"],$devolucion);
					}else{
						$obj=new PedidoPieza($row["ID"],$pedido,$pieza,$row["NUMERO_PEDIDO"],$row["FECHA_SOLICITUD_FABRICA"],$row["FECHA_RECEPCION_FABRICA"],$row["FECHA_ENVIO_AGENTE"],$row["FECHA_RECEPCION_AGENTE"],$row["FECHA_RECEPCION_TAGLE"],null);
					}
				}
			}
		}
		return $obj;
	}

	public function modificarPedidoPiezas($id_pedido_pieza,PedidoPieza $pedido_pieza){
		$mp=new ManipuladorPersistencia();
		$cdevolucionPieza=new ControlDevolucionPieza();
		$devolucion= $pedido_pieza->getDevolucionTagle();
		if($devolucion!=null){
			if($pedido_pieza->getFechaRecepcionTagle()!=null){
				$result = $mp->modificarObjeto("PEDIDO_PIEZA",
				"FECHA_RECEPCION_TAGLE='".$pedido_pieza->getFechaRecepcionTagle()."', 
				DEVOLUCION_TAGLE_ID_OID='".$devolucion->getId()."'"
				,"ID='".$id_pedido_pieza."'");
			}else{
				$result = $mp->modificarObjeto("PEDIDO_PIEZA",
				"FECHA_RECEPCION_TAGLE=NULL, 
				DEVOLUCION_TAGLE_ID_OID='".$devolucion->getId()."'"
				,"ID='".$id_pedido_pieza."'");
			}
		}else{
			if($pedido_pieza->getFechaRecepcionTagle()!=null){
				$result = $mp->modificarObjeto("PEDIDO_PIEZA",
				"FECHA_RECEPCION_TAGLE='".$pedido_pieza->getFechaRecepcionTagle()."'" 
				,"ID='".$id_pedido_pieza."'");
			}else{
				$result = $mp->modificarObjeto("PEDIDO_PIEZA",
				"FECHA_RECEPCION_TAGLE=NULL" 
				,"ID='".$id_pedido_pieza."'");
			}
		}
		return $result;
	}
}

?>