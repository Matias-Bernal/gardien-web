<html>
<head>
<script type="text/javascript" src="js/Javascripts.js"></script>
</head>
	<body>
	<?php
	require_once ("funcionesGeneralesPagina.php");
	require_once ("controles/ControlUsuarioWeb.php");
	require_once ("controles/ControlReclamante.php");
	require_once ("controles/ControlRegistrante.php");
	require_once ("controles/ControlVehiculo.php");
	require_once("extras/class.phpmailer.php");
	require_once("extras/class.smtp.php");

	$controlUsrWeb=new ControlUsuarioWeb();
	$controlReclamante= new ControlReclamante();
	$controlRegistrante= new ControlRegistrante();
	$controlVehiculo= new ControlVehiculo();

	session_start();
	$loginCorr=isset($_SESSION['nombreUsuario']);
		if($loginCorr==true){
			$reclamante = $controlReclamante->obtenerReclamantePorId($_COOKIE['id_reclamante']);
			$vehiculo = $controlVehiculo->obtenerVehiculoPorId($_COOKIE['id_vehiculo']);
			$piezas_pedidas = $_COOKIE['piezas_pedidas'];
			$agente = $controlRegistrante->obtenerRegistrantePorId($_SESSION['idAgente']);
			$datos_extras = $_COOKIE['datos_adicionales'];
			//Servidor de Correos
			$mail = new PHPMailer();
			$mail->IsSMTP();
			//$mail->SMTPDebug = 1;
			$mail->SMTPAuth = true;
			//$mail->SMTPSecure = "ssl";
			$mail->Host = "mail.taglerenault.com.ar";
			$mail->Port = 25;
			$mail->Username = "garantiasriv@taglerenault.com.ar";
			$mail->Password = "garantias2013";
			//Email
			$mail->From = "garantiasriv@taglerenault.com.ar";
			$mail->FromName = "TAGLE GARANTIAS";
			$mail->Subject = "SOLICITUD DE PEDIDO DE AGENTE VIA GARDIEN WEB";
			$mail->MsgHTML("<CENTER><b>SOLICITUD DE PEDIDO DE PIEZA PARA AGENTE VIA GARDIEN WEB</b></CENTER>
							<HR align=\"CENTER\" size=\"2\" width=\"400\" color=\"Red\" noshade>
							<br>
						   <p><big><b>AGENTE:</b><i> ".$agente->getNombreRegistrante()."[ID:".$agente->getId()."]</i></big></p>
						   <HR align=\"CENTER\" size=\"2\" width=\"400\" color=\"Red\" noshade>
						   <p><big><b>RECLAMANTE:</b></big>
						   	<p><big><b>ID RECLAMANTE:</b><i> [".$reclamante->getId()."]</i></big></p>
						   	<p><big><b>NOMBRE Y APELLIDO:</b><i> ".$reclamante->getNombreApellido()."</i></big></p>
						   	<p><big><b>DNI/CUIT:</b><i> ".$reclamante->getDni()."</i></big></p>
						   	<p><big><b>EMAIL:</b><i> ".$reclamante->getEmail()."</i></big></p>
						   </p>
   						   <HR align=\"CENTER\" size=\"2\" width=\"400\" color=\"Red\" noshade>
						   <p><big><b>VEHICULO:</b></big>
						   	<p><big><b>ID VEHICULO:</b><i> [".$vehiculo->getId()."]</i></big></p>
						   	<p><big><b>NOMBRE TITULAR:</b><i> ".$vehiculo->getNombreTitular()."</i></big></p>
						   	<p><big><b>DOMINIO:</b><i> ".$vehiculo->getDominio()."</i></big></p>
						   	<p><big><b>VIN:</b><i> ".$vehiculo->getVin()."</i></big></p>
						   	<p><big><b>MARCA:</b><i> ".$vehiculo->getMarca()->getNombreMarca()."</i></big></p>
						   	<p><big><b>MODELO:</b><i> ".$vehiculo -> getModelo()->getNombreModelo()."</i></big></p>
						   </p>
						   <HR align=\"CENTER\" size=\"2\" width=\"400\" color=\"Red\" noshade>
						   <p><big><b>PIEZAS SOLICITADAS:</b><i> ".$piezas_pedidas."</i></big></p>
						   <HR align=\"CENTER\" size=\"2\" width=\"400\" color=\"Red\" noshade>
						   <p><big><b>DATOS ADICIONALES:</b><i> ".$datos_extras."</i></big></p>
							<HR align=\"CENTER\" size=\"2\" width=\"400\" color=\"Red\" noshade>
							<p><big><b>NOTA: SE ADJUNTA EL FORMULARIO DE ACEPTACION DE CARGOS DE NO
							SER ASI COMUNICARSE URGENTEMENTE CON EL AGENTE</b></big></p>
						  ");
			$ruta = dirname(__FILE__)."/formularios/".$_SESSION['nuevonombre'];
			$mail->AddAttachment($ruta, basename($ruta));
			$mail->AddAddress("pbarrionuevo@taglerenault.com.ar", "Pablo Barrionuevo");
			$mail->AddAddress("pmanchado@taglerenault.com.ar", "Pilar Manchado");
			$mail->IsHTML(true);
			if(!$mail->Send()) {
				echo "Error: " . $mail->ErrorInfo;
			} else {
				echo "<script  language=\"JavaScript\">";
				echo "alert(\"Pedido Solicitado\");";
				echo "doRedirect(\"menu.php\");";
				echo "</script>";
				$username = $_SESSION['nombreUsuario'];
				$id_agente = $_SESSION['idAgente'];
				foreach ($_COOKIE as $key => $value) {
 					unset($value);
    				setcookie($key, '', 1);
				}
				$_SESSION = array();
				session_destroy();
				session_start();
				$_SESSION['nombreUsuario'] = $username;
				$_SESSION['idAgente']=$id_agente;
			}
		}
	?>
	</body>
</html>