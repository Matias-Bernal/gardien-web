<html>
<head>
<link href="css/Estilo.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="js/Javascripts.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script>
  $(function() {
    var hoy = new Date();
    $( ".datepicker" ).datepicker(
    	{
	    dateFormat: "dd/mm/yy",
        altField: ".date_alternate",
        altFormat: "yy-mm-dd",
        showOtherMonths: true,
    	selectOtherMonths: true,
    	showOn: "button",
    	buttonImage: "images/calendar.png",
    	buttonImageOnly: true

    });
    $.datepicker.regional['es'] = {
       			           closeText: 'Cerrar',
        		           prevText: '<Ant',
        		           nextText: 'Sig>',
        		           currentText: 'Hoy',
        		           monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        		           monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        		           dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado'],
        		           dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sab'],
        		           dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
        		           weekHeader: 'Sm',
        		           firstDay: 1,
        		           isRTL: false,
        		           showMonthAfterYear: false,
        		           yearSuffix: ''
    		};
    $(".datepicker").datepicker("setDate", hoy);
  });
  </script>
<title>Gardien Web - Nuevo Reclamo Tagle</title>
</head>
<body>

<?php
require_once ("funcionesGeneralesPagina.php");
require_once("extras/class.phpmailer.php");
require_once("extras/class.smtp.php");
require_once ("controles/ControlPedidoPieza.php");
require_once ("controles/ControlRegistrante.php");
require_once ("controles/ControlDevolucionPieza.php");

$controlPedidoPieza= new ControlPedidoPieza();
$controlDevolucionPieza = new ControlDevolucionPieza();
$controlRegistrante=new ControlRegistrante();
logo();
menulateral();
?>
	<!-- Mostrando Datos -->
	<div class="pagina">
		<div id="contenido">
			<?php
				session_start();
				$loginCorr=isset($_SESSION['nombreUsuario']);
				if($loginCorr==false){
					echo "<script language=\"JavaScript\">";
					echo "doRedirect(\"index.php\");";
					echo "</script>";
				}else{
					if(isset($_REQUEST['reclamo'])){
					$pedido_pieza = $controlPedidoPieza->obtenerPedidoPiezasPorId($_REQUEST['reclamo'],$_SESSION['idAgente']);
					if($pedido_pieza!=null){
						$idPedidoPieza=$pedido_pieza->getId();
						$numPedido=$pedido_pieza->getNumeroPedido();
						$num_pieza = $pedido_pieza->getPieza()->getNumeroPieza();
					echo "
						<h1>FORMULARIO DE RECLAMO A TAGLE</h1>
						<form name='reclamo' id='reclamo' action='reclamoPedidos.php?enviarFormulario=$idPedidoPieza' method=\"post\" enctype=\"multipart/form-data\">
							<br/>
							<p>FECHA RECLAMO TAGLE: <input type='text' class='datepicker' name='frt' id='frt' readonly /></p><br/>
							<br/>
							<p>ID PEDIDO: <input type='text' value='$idPedidoPieza' name='id_pedido' id='id_pedido' readonly disabled /></p><br/>
							<p>NUMERO PEDIDO: <input type='text' value='$numPedido' name='numero_pedido' id='numero_pedido' readonly disabled/></p><br/>
							<p>NUMERO PIEZA: <input type='text' value='$num_pieza' name='numero_pieza' id='numero_pieza' readonly disabled/></p><br/>
							<br/>
							<p>MOTIVO RECLAMO: <textarea name='motivo' id='motivo' rows=\"6\" cols=\"90\"></textarea></p>
							<br/>
							<p align=\"center\"><input type=\"submit\" value=\"Enviar\"/>
						</form>";
					}
					}elseif(isset($_REQUEST['enviarFormulario'])){
						$pedido_pieza = $controlPedidoPieza->obtenerPedidoPiezasPorId($_REQUEST['enviarFormulario'],$_SESSION['idAgente']);
						if($pedido_pieza!=null){
							$idPedidoPieza=$pedido_pieza->getId();
							$numPedido=$pedido_pieza->getNumeroPedido();
							$num_pieza = $pedido_pieza->getPieza()->getNumeroPieza();
							$agente = $controlRegistrante->obtenerRegistrantePorId($_SESSION['idAgente']);
							$motivo = $_REQUEST['motivo'];
							$fecha_reclamo = $_REQUEST['frt'];
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
							$mail->Subject = "FORMULARIO DE RECLAMO DE AGENTE";
							$mail->AltBody = "INTENTE NUEVAMENTE.";
							$mail->MsgHTML("CENTER><b>FORMULARIO DE RECLAMO A TAGLE</b></CENTER>
											<b>FORMULARIO DE RECLAMO A TAGLE </b>
											<p>FECHA RECLAMO: ".$fecha_reclamo."</p>
											<p>AGENTE: ".$agente->getNombreRegistrante()."[ID:".$agente->getId()."]</p>
											<p>PEDIDO:
												<p>ID PEDIDO-PIEZA: [".$idPedidoPieza."]</p>
												<p>NUMERO PEDIDO: ".$numPedido."</p>
												<p>NUMERO PIEZA: ".$num_pieza."</p>
											</p>
											<p>MOTIVO DEL RECLAMO: ".$motivo."</p>
										  ");
							$mail->AddAddress("pbarrionuevo@taglerenault.com.ar", "Pablo Barrionuevo");
							$mail->AddAddress("pmanchado@taglerenault.com.ar", "Pilar Manchado");
							$mail->IsHTML(true);
							if(!$mail->Send()) {
								echo "Error: " . $mail->ErrorInfo;
							} else {
								echo "<script  language=\"JavaScript\">";
								echo "alert(\"Reclamo Enviado\");";
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
					}
				}
			?>
		</div>
	</div>
</body>
</html>