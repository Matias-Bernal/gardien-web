<?php
require_once ("ManipuladorPersistencia.php");
require_once ("persistencia/Pedido.php");
require_once ("controles/ControlReclamo.php");

class ControlPedido{

	public function obtenerPedidoPorId($id_pedido,$id_registrante){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("PEDIDO","ID='".$id_pedido."'");
		$listado=array();
		$obj = null;
		if($result !== FALSE) {
			$creclamo=new ControlReclamo();
			while ($row = mysqli_fetch_array($result)){
				$reclamo = $creclamo->obtenerReclamoPorId($id_registrante,$row["RECLAMO_ID_OID"]);
				if($reclamo !=  null) {
					$obj=new Pedido($row["ID"],$reclamo,$row["FECHA_SOLICITUD_PEDIDO"]);
				}
			}
			return $obj;
		}
	}

}

?>