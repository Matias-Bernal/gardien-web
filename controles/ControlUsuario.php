<?php
require_once ("ManipuladorPersistencia.php");
require_once ("persistencia/Usuario.php");

class ControlUsuario {

	public function obtenerUsuarioPorId($id){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("USUARIO","ID='".$id."'");
		$obj=null;
		if($result !== FALSE) {
			while ($row = mysqli_fetch_array($result)){
				$obj=new Usuario($row["ID"],$row["NOMBRE_USUARIO"],$row["CLAVE"],$row["EMAIL"],$row["TIPO"]);
			}
		}
		return $obj;
	}

}

?>