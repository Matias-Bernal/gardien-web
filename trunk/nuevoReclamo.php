<html>
<head>
<link href="extras/Estilo.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="extras/Javascripts.js"></script>
<title>Gardien Web - Ver Reclamos</title>
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
			<h1>VER RECLAMOS</h1>
			
		</div>
	</div>
</body>
</html>
