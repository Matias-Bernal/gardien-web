<?php
class ManipuladorPersistencia {
	private $host = "";
	private $usrBD = "";
	private $passBD = "";
	private $nombreBD = "";

	public function __construct(){
		$this->host = "localhost";
		$this->usrBD = "root";
		$this->passBD = "root";
		$this->nombreBD = "tagle_garantias2";
	}

	public function agregarObjeto($tablaYdatos,$valores){
		$link = mysqli_connect($this->host, $this->usrBD, $this->passBD, $this->nombreBD);
		$result= mysqli_query($link,"INSERT INTO $tablaYdatos VALUES $valores");
		$last_id = $link->insert_id;
		return $last_id;
	}

	public function eliminarObjeto($tabla,$condicion){
		$link = mysqli_connect($this->host, $this->usrBD, $this->passBD, $this->nombreBD);
		$result= mysqli_query($link,"DELETE FROM $tabla WHERE $condicion");
		return $result;
	}
	public function obtenerTodosObjetos($tabla){
		$link = mysqli_connect($this->host, $this->usrBD, $this->passBD, $this->nombreBD);
		$result= mysqli_query($link,"SELECT * FROM $tabla");
		return $result;
	}
	public function obtenerTodosObjetosOrdenados($tabla,$campo,$orden){
		$link = mysqli_connect($this->host, $this->usrBD, $this->passBD, $this->nombreBD);
		$result= mysqli_query($link,"SELECT * FROM $tabla ORDER BY $campo $orden");
		return $result;
	}

	public function obtenerObjetosPorFiltro($tabla,$filtro){
		$link = mysqli_connect($this->host, $this->usrBD, $this->passBD, $this->nombreBD);
		$result= mysqli_query($link,"SELECT * FROM $tabla WHERE $filtro");
		return $result;
	}

	public function obtenerObjetosOrdenadosPorFiltro($tabla,$filtro,$campo,$orden){
		$link = mysqli_connect($this->host, $this->usrBD, $this->passBD, $this->nombreBD);
		$result= mysqli_query($link,"SELECT * FROM $tabla WHERE $filtro ORDER BY $campo $orden");
		return $result;
	}

	public function modificarObjeto($tabla,$datosAct,$filtro){
		$link = mysqli_connect($this->host, $this->usrBD, $this->passBD, $this->nombreBD);
		$result= mysqli_query($link,"UPDATE $tabla SET $datosAct WHERE $filtro");
		return $result;
	}

}

?>