<html>
<head>
<link href="css/Estilo.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="js/Javascripts.js"></script>
<title>Gardien Web - Cabio de Contrase&ntilde;a</title>
</head>
<body>

<?php
require ("controles/ControlUsuarioWeb.php");
require ("funcionesGeneralesPagina.php");
$controlUsrWeb=new ControlUsuarioWeb();
logo();
menulateral();
?>
	<!-- Mostrando Datos -->
	<div class="pagina">
		<div id="contenido">
			<h1 align="center">CAMBIAR CONTRASE&Ntilde;A</h1>
			<?php
				session_start();
				$loginCorr=isset($_SESSION['nombreUsuario']);
				if($loginCorr==false){
					echo "<script language=\"JavaScript\">";
					echo "doRedirect(\"index.php\");";
					echo "</script>";
				}else{
					if(isset($_REQUEST['accion'])){
						if($_REQUEST['accion']=="cambiologin"){
							$objUsr=$controlUsrWeb->obtenerUsuarioWeb($_SESSION['nombreUsuario']);
							$objOldPass=md5($_REQUEST['passOld']);
							$objNewPass=$_REQUEST['passModif'];
							if($objOldPass==$objUsr->getContrasenia()){ //modif
								$controlUsrWeb->modificarContrasenia($_SESSION['nombreUsuario'],$objNewPass);
								echo "<script  language=\"JavaScript\">";
								echo "alert('LA CONTRASEÑA FUE CAMBIADA CON EXITO');";
								echo "</script>";
							}else{
								echo "<script  language=\"JavaScript\">";
								echo "alert('LA CONTRASEÑA NO ES CORRECTA, SU CONTRASEÑA NO HA SIDO ACTUALIZADA');";
								echo "</script>";
							}
						}
					}

					//	<!-- Mostrando Datos -->
					echo "<br/>";
					echo "<form name='cambiarLogin' id='cambiarLogin' method='post' action=\"cambioContrasenia.php\" > ";
					echo "  <div id='tablaDatos'> ";
					echo "  <table width='500' >  ";
					echo "		<tr>  <th colspan='2'>Datos del Usuario</th>  </tr> ";
					echo "		<input name='accion' id='accion' type='hidden' value='cambiologin'> ";
					echo "		<tr> <th style='text-align:left;'>Contrase&ntilde;a Actual:</th> <td style='text-align:left;'><input name='passOld' id='passOld' type='password' maxlength='10'></td> </tr> ";
					echo "		<tr> <th style='text-align:left;'>Contrase&ntilde;a Nueva:</th> <td style='text-align:left;'><input name='passNew' id='passNew' type='password' maxlength='10'></td> </tr> ";
					echo "		<tr> <th style='text-align:left;'>Repita contrase&ntilde;a Nueva:</th> <td style='text-align:left;'><input name='passModif' id='passModif' type='password' maxlength='10'></td> </tr> ";
					echo " 		<tr align=\"center\"> <td colspan='2'><input name='cambiar' id='cambiar' type='button' onclick='VerificarCambioLogin()' value='CAMBIAR'></td>  </tr> ";
					echo " </table> ";
					echo " </div> ";
					echo " </form> ";
				}
			?>
		</div>
	</div>
</body>
</html>
