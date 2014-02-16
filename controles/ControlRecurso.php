<?php
require_once ("ManipuladorPersistencia.php");
require_once ("persistencia/Recurso.php");

class ControlRecurso{

	public function obtenerRecursoPorId($id_recurso){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("RECURSO","ID='".$id_recurso."'");
		$obj= null;
		if($result !== FALSE) {
			while ($row = mysqli_fetch_array($result)){
				$obj=new Recurso($row["ID"],$row["NUMERO_RECURSO"],$row["FECHA_RECURSO"]);
			}
		return $obj;
		}
	}

}

?>