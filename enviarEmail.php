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
			$mail->SMTPSecure = "ssl";
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465;
			$mail->Username = "payomaty666@gmail.com";
			$mail->Password = "pass011235word";
			//Email
			$mail->From = "payomaty666@gmail.com";
			$mail->FromName = "Matias Bernal";
			$mail->Subject = "SOLICITUD DE PEDIDO DE AGENTE VIA GARDIEN WEB";
			$mail->AltBody = "Este es un mensaje de prueba.";
			$mail->MsgHTML("<b>Este es una solcitud de Pedido de Pieza</b>
						   <p>AGENTE: ".$agente->getNombreRegistrante()."[ID:".$agente->getId()."]</p>
						   <p>RECLAMANTE:
						   	<p>ID RECLAMANTE: [".$reclamante->getId()."]</p>
						   	<p>NOMBRE Y APELLIDO: ".$reclamante->getNombreApellido()."</p>
						   	<p>DNI/CUIT: ".$reclamante->getDni()."</p>
						   	<p>EMAIL: ".$reclamante->getEmail()."</p>
						   </p>
						   <p>VEHICULO:
						   	<p>ID VEHICULO: [".$vehiculo->getId()."]</p>
						   	<p>NOMBRE TITULAR: ".$vehiculo->getNombreTitular()."</p>
						   	<p>DOMINIO: ".$vehiculo->getDominio()."</p>
						   	<p>VIN: ".$vehiculo->getVin()."</p>
						   	<p>MARCA: ".$vehiculo->getMarca()->getNombreMarca()."</p>
						   	<p>MODELO: ".$vehiculo -> getModelo()->getNombreModelo()."</p>
						   </p>
						   <p>PIEZAS SOLICITADAS: ".$piezas_pedidas."
						   </p>
						   <p>DATOS ADICIONALES: ".$datos_extras."
						   </p>
						  ");
			$ruta = dirname(__FILE__)."/formularios/".$_SESSION['nuevonombre'];
			$mail->AddAttachment($ruta, basename($ruta));
			$mail->AddAddress("payomaty666@gmail.com", "matiasbernal.it10@gmail.com");
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