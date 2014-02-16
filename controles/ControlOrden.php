<?php
require_once ("ManipuladorPersistencia.php");
require_once ("persistencia/Orden.php");
require_once ("controles/ControlRecurso.php");

class ControlOrden{

	public function obtenerOrdenPorId($id_orden){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("ORDEN","ID='".$id_orden."'");
		$obj=null;
		if($result !== FALSE) {
			$crecurso= new ControlRecurso();
			while ($row = mysqli_fetch_array($result)){
				$recurso= $crecurso->obtenerRecursoPorId($row["RECURSO_ID_OID"]);
				$obj=new Orden($row["ID"],$row["NUMERO_ORDEN"],$row["FECHA_APERTURA"],$row["FECHA_CIERRE"],$row["ESTADO"],$recurso);
			}
		return $obj;
		}
	}

}

?>