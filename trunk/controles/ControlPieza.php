<?php
require_once ("ManipuladorPersistencia.php");
require_once ("persistencia/Pieza.php");
require_once ("controles/ControlProveedor.php");

class ControlPieza{

	public function obternerPiezaPorId($id_pieza){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("PIEZA","ID='".$id_pieza."'");
		$listado=array();
		$obj = null;
		if($result !== FALSE) {
			$cproveedor=new ControlProveedor();
			while ($row = mysqli_fetch_array($result)){
				$proveedor = $cproveedor->obtenerProveedorPorId($row["PROVEEDOR_ID_OID"]);
				if($proveedor!=null){
					$obj=new Pieza($row["ID"],$row["NUMERO_PIEZA"],$row["DESCRIPCION"],$proveedor);
				}
			}
		}
		return $obj;
	}

}

?>