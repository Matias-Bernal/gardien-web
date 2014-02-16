<html>
<head>
<link href="css/Estilo.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="js/Javascripts.js"></script>
<title>Gardien Web - Ingreso</title>
</head>
<body>
<?php
require ("controles/ControlUsuarioWeb.php");
require ("funcionesGeneralesPagina.php");
$controlUsrWeb=new ControlUsuarioWeb();
logo();
?>
	<div class="pagina">
		<div id="contenido">
		<?php
		$mostrarInicio="SI";
		if(isset($_REQUEST['accion'])){
			if($_REQUEST['accion']=="login"){
				$usrCorrecto=$controlUsrWeb->verificarUsuarioWeb($_REQUEST['usuario'],$_REQUEST['password']);
				if ($usrCorrecto=="USUARIO INCORRECTO"){
					echo "<script  language=\"JavaScript\">";
					echo "alert('EL USUARIO INGRESADO ES INCORRECTO');";
					echo "</script>";
				}
				else if ($usrCorrecto=="CONTRASEÑA INCORRECTA"){
					echo "<script  language=\"JavaScript\">";
					echo "alert('LA CONTRASEÑA INGRESADA ES INCORRECTA');";
					echo "</script>";
				}
				else {
					$mostrarInicio="NO";
					session_start();
					$_SESSION['nombreUsuario']=$usrCorrecto-> getNombreUsuario();
					$_SESSION['idAgente']=$usrCorrecto-> getIdAgente();
					echo "<script  language=\"JavaScript\">";
					echo "doRedirect(\"menu.php\");";
					echo "</script>";
				}
			} else if($_REQUEST['accion']=="cerrarLogin"){
				session_start();
				$_SESSION = array();
				session_destroy();
				$mostrarInicio="SI";
			}
		}else{
			session_start();
			if(isset($_SESSION['nombreUsuario'])){
				$mostrarInicio="NO";
				echo "<script  language=\"JavaScript\">";
				echo "doRedirect(\"menu.php\");";
				echo "</script>";
			}
		}
		if($mostrarInicio=="SI"){
			echo "<h1>INICIO DE SESION</h1> ";
			echo "<br/>        ";
			echo "<form name='ingresar' id='ingresar' method='post' action='index.php'> ";
			echo "	<div id='tablaDatos'> ";
			echo "	<table width='500' >  ";
			echo "		<tr>  <th colspan='2'>Datos del Usuario</th>  </tr> ";
			echo "		<input name='accion' id='accion' type='hidden' value='login'> ";
			echo "		<tr> <th style='text-align:left;'>Usuario:</th> <td style='text-align:left;'><input name='usuario' id='usuario' type='text'></td> </tr> ";
			echo "		<tr> <th style='text-align:left;'>Contrase&ntilde;a:</th> <td style='text-align:left;'><input name='password' id='password' type='password'></td> </tr> ";
			echo "		<tr align=\"center\"> <td colspan='2'><input name='ingresar' id='ingresar' type='button' onclick='VerificarLogin()' value='INGRESAR'></td></tr> ";
			echo "	</table> ";
			echo " </div> ";
			echo " </form> ";
		}
		?>
		</div>
	</div>
</body>
</html>