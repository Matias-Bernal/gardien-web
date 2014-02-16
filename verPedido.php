<html>
<head>
<link href="css/Estilo.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="js/Javascripts.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script>
  $(function() {
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
    		$.datepicker.setDefaults($.datepicker.regional['es']);
  });
  </script>
<title>Gardien Web - Ver Pedido</title>
</head>
<body>

<?php
require_once ("funcionesGeneralesPagina.php");
require_once ("controles/ControlPedidoPieza.php");
require_once ("controles/ControlDevolucionPieza.php");

$controlPedidoPieza= new ControlPedidoPieza();
$controlDevolucionPieza = new ControlDevolucionPieza();
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
					if(isset($_REQUEST['id_pedido'])){
						echo "<h1>VER PEDIDO</h1>";
						$pedido_pieza = $controlPedidoPieza->obtenerPedidoPiezasPorId($_REQUEST['id_pedido'],$_SESSION['idAgente']);
						if($pedido_pieza!=null){
							$idPedidoPieza=$pedido_pieza->getId();
							$numPedido=$pedido_pieza->getNumeroPedido();
							$num_pieza = $pedido_pieza->getPieza()->getNumeroPieza();
							$fsf= "";
							if($pedido_pieza->getFechaSolicitudFabrica()!=null)
								$fsf = convertirFechaDB_Form($pedido_pieza->getFechaSolicitudFabrica());
							$frf = "";
							if($pedido_pieza->getFechaRecepcionFabrica()!=null)
								$frf = convertirFechaDB_Form($pedido_pieza->getFechaRecepcionFabrica());
							$fea = "";
							if($pedido_pieza->getFechaEnvioAgente()!=null)
								$fea = convertirFechaDB_Form($pedido_pieza->getFechaEnvioAgente());
							$fra="";
							if($pedido_pieza->getFechaRecepcionAgente()!=null)
								$fra = convertirFechaDB_Form($pedido_pieza->getFechaRecepcionAgente());
							$frt= "";
							if($pedido_pieza->getFechaRecepcionTagle()!=null)
								$frt = convertirFechaDB_Form($pedido_pieza->getFechaRecepcionTagle());
							$fet ="";
							$transporte = "";
							$num_remito = "";
							$num_retiro = "";
							if($pedido_pieza->getDevolucionTagle()!=null){
								if($pedido_pieza->getDevolucionTagle()->getFechaDevolucion()!=null)
									$fet = convertirFechaDB_Form($pedido_pieza->getDevolucionTagle()->getFechaDevolucion());
								$transporte = $pedido_pieza->getDevolucionTagle()->getTransporte();
								$num_remito = $pedido_pieza->getDevolucionTagle()->getNumeroRemito();
								$num_retiro = $pedido_pieza->getDevolucionTagle()->getNumeroRetiro();
							}
							//reclamante
							$id_reclamante=$pedido_pieza->getPedido()->getReclamo()->getReclamante()->getId();
							$nombre_reclamante = $pedido_pieza->getPedido()->getReclamo()->getReclamante()->getNombreApellido();
							$dni_reclamante = $pedido_pieza->getPedido()->getReclamo()->getReclamante()->getDni();
							//vehiculo
							$email_reclamante = $pedido_pieza->getPedido()->getReclamo()->getReclamante()->getEmail();
							$id_vehiculo = $pedido_pieza->getPedido()->getReclamo()->getVehiculo()->getId();
							$nombre_titular = $pedido_pieza->getPedido()->getReclamo()->getVehiculo()->getNombreTitular();
							$dominio = $pedido_pieza->getPedido()->getReclamo()->getVehiculo()->getDominio();
							$vin = $pedido_pieza->getPedido()->getReclamo()->getVehiculo()->getVin();
							$marca = $pedido_pieza->getPedido()->getReclamo()->getVehiculo()->getMarca()->getNombreMarca();
							$modelo = $pedido_pieza->getPedido()->getReclamo()->getVehiculo() -> getModelo()->getNombreModelo();

							echo "<div>
									<!-- DATOS DEL PEDIDO -->
									<fieldset>
			 				   			<legend align='center'>DATOS DEL PEDIDO</legend>
										<p>ID PEDIDO: <input type='text' value='$idPedidoPieza' name='id_pedido' id='id_pedido' readonly disabled /></p><br/>
										<p>NUMERO PEDIDO: <input type='text' value='$numPedido' name='numero_pedido' id='numero_pedido' readonly disabled/></p><br/>
										<p>NUMERO PIEZA: <input type='text' value='$num_pieza' name='numero_pieza' id='numero_pieza' readonly disabled/></p><br/>
										<p>FECHA DE SOLICITUD DE PIEZA A FABRICA: <input type='text' value='$fsf' name='fsf' id='fsf' readonly disabled/></p><br/>
										<p>FECHA DE RECEPCION DE PIEZA A FABRICA: <input type='text' value='$frf' name='frf' id='frf' readonly disabled/></p><br/>
										<p>FECHA DE ENVIO DE PIEZA A AGENTE: <input type='text' value='$fea' name='fea' id='fea' readonly disabled/></p><br/>
										<p>FECHA DE RECEPCION DE PIEZA DEVUELTA : <input type='text' value='$fra' name='fra' id='fra' readonly disabled/></p><br/>";
							if($fea!=null && $fra==""){
								echo "<fieldset>
			 								<legend align='center'>DATOS A COMPLETAR POR AGENTE</legend>
			 								<form name='datos_agente' id='datos_agente' action='verPedido.php?actualizar=$idPedidoPieza' method='post' target='_self' enctype='multipart/form-data'>
												<p>FECHA DE RECEPCION DE PIEZA DE TAGLE: <input type='text'  class='datepicker' value='$frt' name='frt' id='frt' readonly /></p><br/>
												<p>FECHA DE ENVIO DE PIEZA A TAGLE: <input type='text' class='datepicker' value='$fet' name='fet' id='fet' readonly/></p><br/>
												<p>NUMERO REMITO: <input type='text' value='$num_remito' name='numero_remito' id='numero_remito'/></p><br/>
												<p>TRANSPORTE: <input type='text' value='$transporte' name='transporte' id='transporte'  /></p><br/>
												<p>NUMERO RETIRO: <input type='text' value='$num_retiro' name='numero_retiro' id='numero_retiro' /></p><br/>
												<p align='center'><input type='submit' value='MODIFICAR DATOS'/>
											</form>
										</fieldset>
									</fieldset>";
							}else{
								echo "<fieldset>
			 								<legend align='center'>DATOS A COMPLETAR POR AGENTE</legend>
			 								<form name='datos_agente' id='datos_agente' action='verPedido.php?actualizar=$idPedidoPieza' method='post' target='_self' enctype='multipart/form-data'>
												<p>FECHA RECEPCION TAGLE: <input type='text'  class='datepicker' value='$frt' name='frt' id='frt' readonly disabled /></p><br/>
												<p>FECHA ENVIO TAGLE: <input type='text' class='datepicker' value='$fet' name='fet' id='fet' readonly disabled/></p><br/>
												<p>NUMERO REMITO: <input type='text' value='$num_remito' name='numero_remito' id='numero_remito' disabled/></p><br/>
												<p>TRANSPORTE: <input type='text' value='$transporte' name='transporte' id='transporte' disabled/></p><br/>
												<p>NUMERO RETIRO: <input type='text' value='$num_retiro' name='numero_retiro' id='numero_retiro' disabled /></p><br/>
											</form>
										</fieldset>
									</fieldset>";
							}
							echo "<!-- DATOS DEL RECLAMANTE -->
									<fieldset>
										<legend align='center'>DATOS DEL RECLAMANTE</legend>
										<p>ID: <input type='text' value='$id_reclamante' name='id_reclamante' id='id_reclamante' readonly disabled/></p><br/>
										<p>NOMBRE RECLAMANTE: <input type='text' value='$nombre_reclamante' name='nombre_reclamante' id='nombre_reclamante' readonly disabled/></p><br/>
										<p>DNI/CUIT: <input type='text' value='$dni_reclamante' name='dni_reclamante' id='nombre_reclamante' readonly disabled/></p><br/>
										
										<p>EMAIL: <input type='text' value='$email_reclamante' name='email_reclamante' id='email_reclamante' readonly disabled/></p><br/>
									</fieldset>
									<!-- DATOS DEL VEHICULO -->
									<fieldset>
										<legend align='center'>DATOS DEL VEHICULO</legend>
										<p>ID VEHICULO: <input type='text' value='$id_vehiculo' name='id_vehiculo' id='id_vehiculo' readonly disabled/></p><br/>
										<p>TITULAR VEHICULO: <input type='text' value='$nombre_titular' name='titular_vehiculo' id='titular_vehiculo' readonly disabled/></p><br/>
										<p>DOMINIO: <input type='text' value='$dominio' name='dominio_vehiculo' id='dominio_vehiculo' readonly disabled/></p><br/>
										<p>VIN: <input type='text' value='$vin' name='vin_vehiculo' id='vin_vehiculo' readonly disabled/></p><br/>
										<p>MARCA: <input type='text' value='$marca' name='marca_vehiculo' id='marca_vehiculo' readonly disabled/></p><br/>
										<p>MODELO: <input type='text' value='$modelo ' name='modelo_vehiculo' id='modelo_vehiculo' readonly disabled/></p><br/>
									</fieldset>
									<!-- RECLAMOS -->
									<fieldset>
										<legend align='center'>RECLAMO A TAGLE</legend>
										<p align='center'><a href='reclamoPedidos.php?reclamo=$idPedidoPieza'> FORMULARIO DE RECLAMO A TAGLE </a></p>
									</fieldset>
									<br/>
								</div>";
						}
					}elseif (isset($_REQUEST['actualizar'])) {
						echo "<h1>ACTUALIZANDO PEDIDO...</h1>";
						$pedido_pieza = $controlPedidoPieza->obtenerPedidoPiezasPorId($_REQUEST['actualizar'],$_SESSION['idAgente']);
						if($pedido_pieza!=null){
							if(isset($_REQUEST['frt'])){
								$frt = convertirFechaForm_DB($_REQUEST['frt']);
								$pedido_pieza->setFechaRecepcionTagle($frt);
							}
							if($pedido_pieza->getDevolucionTagle()!=null){
								if(isset($_REQUEST['fet'])){
									$fet = convertirFechaForm_DB($_REQUEST['fet']);
									$pedido_pieza->getDevolucionTagle()->setFechaDevolucion($fet);
								}
								if(isset($_REQUEST['numero_remito'])){
									$num_remito = $_REQUEST['numero_remito'];
									$pedido_pieza->getDevolucionTagle()->setNumeroRemito($num_remito);
								}
								if(isset($_REQUEST['transporte'])){
									$transporte = $_REQUEST['transporte'];
									$pedido_pieza->getDevolucionTagle()->setTransporte($transporte);
								}
								if(isset($_REQUEST['numero_retiro'])){
									$num_retiro = $_REQUEST['numero_retiro'];
									$pedido_pieza->getDevolucionTagle()->setNumeroRetiro($num_retiro);
								}
								$modif = $controlDevolucionPieza->modificarDevolucionPieza($pedido_pieza->getDevolucionTagle()->getId(),$pedido_pieza->getDevolucionTagle());
							}
							else{
								$fet ="";
								$transporte = "";
								$num_remito = "";
								$num_retiro = "";
								if(isset($_REQUEST['fet']))
									$fet = convertirFechaForm_DB($_REQUEST['fet']);
								if(isset($_REQUEST['numero_remito']))
									$num_remito = $_REQUEST['numero_remito'];
								if(isset($_REQUEST['transporte']))
									$transporte = $_REQUEST['transporte'];
								if(isset($_REQUEST['numero_retiro']))
									$num_retiro = $_REQUEST['numero_retiro'];
								$devolucionTagle = new DevolucionPieza(null,$num_remito,$fet,$transporte,$num_retiro);
								$id_nueva_devolucion = $controlDevolucionPieza->agregarDevolucionPieza($devolucionTagle);
								$devolucionTagle->setId($id_nueva_devolucion);
								$pedido_pieza->setDevolucionTagle($devolucionTagle);
							}
							$res = $controlPedidoPieza->modificarPedidoPiezas($_REQUEST['actualizar'],$pedido_pieza);
							echo "<script  language=\"JavaScript\">";
							echo "alert('PEDIDO MODIFICADO');";
							echo "doRedirect(\"verPedidos.php\");";
							echo "</script>";
						}
					}
				}
			?>
		</div>
	</div>		
</body>
</html>
