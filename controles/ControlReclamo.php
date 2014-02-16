<?php
require_once ("ManipuladorPersistencia.php");
require_once ("persistencia/Reclamo.php");
require_once ("controles/ControlOrden.php");
require_once ("controles/ControlReclamante.php");
require_once ("controles/ControlRegistrante.php");
require_once ("controles/ControlUsuario.php");
require_once ("controles/ControlVehiculo.php");

class ControlReclamo{

	public function obtenerReclamoPorId($id_registrante,$id_reclamo){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("RECLAMO","ID='".$id_reclamo."' and REGISTRANTE_ID_OID='".$id_registrante."'");
		$obj= null;
		if($result !== FALSE) {
			$corden=new ControlOrden();
			$creclamante= new ControlReclamante();
			$cregistrante= new ControlRegistrante();
			$cusuario= new ControlUsuario();
			$cvehiculo= new ControlVehiculo();
			while ($row = mysqli_fetch_array($result)){
				$orden= $corden->obtenerOrdenPorId($row["ORDEN_ID_OID"]);
				$reclamante= $creclamante->obtenerReclamantePorId($row["RECLAMANTE_ID_OID"]);
				$registrante= $cregistrante->obtenerRegistrantePorId($id_registrante);
				$usuario= $cusuario->obtenerUsuarioPorId($row["USUARIO_ID_OID"]);
				$vehiculo= $cvehiculo->obtenerVehiculoPorId($row["VEHICULO_ID_OID"]);
				$obj=new Reclamo($row["ID"],$row["FECHA_RECLAMO"],$row["FECHA_TURNO"],$row["ESTADO_RECLAMO"],$registrante,$reclamante,$vehiculo,$row["INMOVILIZADO"],$row["PELIGROSO"],$usuario,$row["DESCRIPCION"],$orden);
			}
		}
		return $obj;
	}

}

?>