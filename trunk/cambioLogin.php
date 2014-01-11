<html>
<head>
<link href="extras/Estilo.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="extras/Javascripts.js"></script>
<title>Gardien Web - Cabio de Contrase&ntilde;a</title>
</head>
<body>

<?php
require ("controles/ControlUsuarioWeb.php");
require ("funcionesGeneralesPagina.php");
$controlUsrWeb=new ControlUsuarioWeb();
logo();
?>

	<!-- Mostrando Datos -->
	<div class="pagina">
	<?php
	session_start();
	$loginCorr=isset($_SESSION['nombreUsuario']);
	?>
		<div id="contenido">
			<div id="menulateral">
				<ul class="navbar">
  				<li><a href="menu.php">Menu principal</a>
  				<li><a href="nuevoReclamo.php">Nuevo Reclamo</a>
  				<li><a href="verReclamos.php">Ver Reclamos</a>
  				<li><a href="cambioLogin.php">Cambiar Contrase&ntilde;a</a>
	  			<li><a href="index.php?accion=cerrarLogin">Cerrar Sesion</a>
				</ul>
			</div>
			<h1>CAMBIAR CONTRASE&Ntilde;A</h1>
			<?php
			if($loginCorr==true){

				if(isset($_REQUEST['accion'])){
					if($_REQUEST['accion']=="cambiologin"){
						$objUsr=$controlUsrWeb->obtenerUsuarioWeb($_SESSION['nombreUsuario']);
						//$objOldPass=md5($_REQUEST['passOld']);
						$objOldPass=$_REQUEST['passOld'];
						$objNewPass=$_REQUEST['passModif'];
						if($objOldPass==$objUsr->getContrasenia()){ //modif
							$controlUsrWeb->modificarContrasenia($_SESSION['nombreUsuario'],$objNewPass);
							mensajeOK("LA CONTRASEÑA FUE CAMBIADA CON EXITO");
						}else{      //agregar
							mensajeAlerta("LA CONTRASEÑA NO ES CORRECTA, SU CONTRASEÑA NO HA SIDO ACTUALIZADA");
						}
					}
				}

				//	<!-- Mostrando Datos -->
				echo "<br/>        ";
				echo "<form name='cambiarLogin' id='cambiarLogin' method='post' action=\"cambioLogin.php\" > ";
				echo "  <div id='tablaDatos'> ";
				echo "  <table width='500' >  ";
				echo "    <tr>  <th colspan='2'>Datos del Usuario</th>  </tr> ";
				echo "    <input name='accion' id='accion' type='hidden' value='cambiologin'> ";
				echo "    <tr> <th style='text-align:left;'>Contrase&ntilde;a Actual:</th> <td style='text-align:left;'><input name='passOld' id='passOld' type='password' maxlength='10'></td> </tr> ";
				echo "    <tr> <th style='text-align:left;'>Contrase&ntilde;a Nueva:</th> <td style='text-align:left;'><input name='passNew' id='passNew' type='password' maxlength='10'></td> </tr> ";
				echo "    <tr> <th style='text-align:left;'>Repita contrase&ntilde;a Nueva:</th> <td style='text-align:left;'><input name='passModif' id='passModif' type='password' maxlength='10'></td> </tr> ";
					
				echo " <tr> <td colspan='2'><input name='cambiar' id='cambiar' type='button' onclick='VerificarCambioLogin()' value='CAMBIAR'></td>  </tr> ";
				echo " </table> ";
				echo " </div> ";
				echo " </form> ";
					
			}else{    
				sinLoginPagina();   }
			?>

		</div>
	</div>
</body>
</html>
