<?php
require_once ("persistencia/UsuarioWeb.php");
require_once ("ManipuladorPersistencia.php");

class ControlUsuarioWeb {

	public function obtenerUsuariosWeb(){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerTodosObjetos("usuarioweb");
		$listado=array();
		if($result !== FALSE) {
			while ($row = mysqli_fetch_array($result)){
				$obj=new UsuarioWeb($row["NOMBRE_USUARIO"],$row["CONTRASENIA"],$row["ID_AGENTE"]);
				$listado[]=$obj;
			}
		}
		return $listado;
	}

	public function obtenerUsuarioWeb($nombre){
		$mp=new ManipuladorPersistencia();
		$result = $mp->obtenerObjetosPorFiltro("usuarioweb","NOMBRE_USUARIO='".$nombre."'");
		if($result===False){
			echo "RESULTADO FALSO";
		}else{
			$row = mysqli_fetch_array($result);
			$obj= new UsuarioWeb($row["NOMBRE_USUARIO"],$row["CONTRASENIA"],$row["ID_AGENTE"]);
			return $obj;
		}
	}
	
    public function modificarContrasenia($nombre,$pass){
		$mp=new ManipuladorPersistencia();
		$contr=md5($pass);
		$result = $mp->modificarObjeto("usuarioweb","CONTRASENIA='".$contr."'","NOMBRE_USUARIO='".$nombre."'");
	}

	public function verificarUsuarioWeb($nombre,$pass){
		$mp=new ManipuladorPersistencia();
		$contr=md5($pass);
		$result2 = $mp->obtenerObjetosPorFiltro("usuarioweb","NOMBRE_USUARIO=\"".$nombre."\"");
		if($result2 == FALSE) {
			return "USUARIO INCORRECTO";
		} else{
			if((count($result2))==1){
				$row = mysqli_fetch_array($result2);
				if ($row["NOMBRE_USUARIO"]!=""){
					if($contr==$row["CONTRASENIA"]){
						$obj= new UsuarioWeb($row["NOMBRE_USUARIO"],$row["CONTRASENIA"],$row["ID_AGENTE"]);
						return $obj;
					}else{
						return "CONTRASEÑA INCORRECTA";
					}
				}else{
					return "USUARIO INCORRECTO";
				}
			}else{
				return "USUARIO INCORRECTO";
			}
		}
	}

}

?>