<?php
require_once ("ManipuladorPersistencia.php");
require_once ("persistencia/Proveedor.php");

class ControlProveedor{

	public function obtenerProveedorPorId($id_proveedor){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("PROVEEDOR","ID='".$id_proveedor."'");
		$listado=array();
		$obj=null;
		if($result !== FALSE) {
			while ($row = mysqli_fetch_array($result)){
				$obj=new Proveedor($row["ID"],$row["NOMBRE"]);
			}
		}
		return $obj;
	}

}

?>