<html>
<head>
<link href="css/Estilo.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="js/Javascripts.js"></script>
<title>Gardien Web - Ver Pedidos a Tagle</title>
</head>
<body>
<?php
require_once ("funcionesGeneralesPagina.php");
require_once ("controles/ControlUsuarioWeb.php");
require_once ("controles/ControlPedidoPieza.php");

logo();
menulateral();
?>
	<div class="pagina">
		<div id="contenido">
			<h1 align="center">VER PEDIDOS A TAGLE </h1>
			<br>
			<fieldset>
				<legend align='center'>PEDIDOS DEL AGENTE A TAGLE</legend>
				<?php
					session_start();
					$loginCorr=isset($_SESSION['nombreUsuario']);
					if($loginCorr==false){
						echo "<script language=\"JavaScript\">";
						echo "doRedirect(\"index.php\");";
						echo "</script>";
					}else{
				?>	
					<div class='div_tabla_pedidos' id='div_tabla_pedidos' name='div_tabla_pedidos'>
						<!-- tabla con scroll -->
						<table class='tabla_pedidos'>
								<tr class='headers'>
									<th width=50>ID</th>
									<th width=100>#PEDIDO</th>
									<th width=125>RECLAMANTE</th>
									<th width=125>TITULAR</th>
									<th width=70>DOMINIO</th>
									<th width=160>VIN</th>
									<th width=150>#PIEZA</th>
									<th width=150>SOLICITUD FABRICA</th>
									<th width=150>RECEPCION FABRICA</th>
									<th width=150>ENVIO AGENTE</th>
									<th width=150>RECEPCION AGENTE</th>
									<th width=150>RECEPCION TAGLE</th>
									<th width=150>ENVIO TAGLE</th>
								</tr>
								<?php
								$controlUsrWeb=new ControlUsuarioWeb();
								$controlPedidoPieza= new ControlPedidoPieza();
								$pedido_piezas = $controlPedidoPieza->obtenerPedidoPiezas($_SESSION['idAgente']);
								foreach ($pedido_piezas as $pedido_pieza) {
									$idPedidoPieza=$pedido_pieza->getId();
									$numPedido=$pedido_pieza->getNumeroPedido();
									$nombre_reclamante = $pedido_pieza->getPedido()->getReclamo()->getReclamante()->getNombreApellido();
									$nombre_titular = $pedido_pieza->getPedido()->getReclamo()->getVehiculo()->getNombreTitular();
									$dominio = $pedido_pieza->getPedido()->getReclamo()->getVehiculo()->getDominio();
									$vin = $pedido_pieza->getPedido()->getReclamo()->getVehiculo()->getVin();
									$num_pieza = $pedido_pieza->getPieza()->getNumeroPieza();
									$fsf = $pedido_pieza->getFechaSolicitudFabrica();
									$frf = $pedido_pieza->getFechaRecepcionFabrica();
									$fea = $pedido_pieza->getFechaEnvioAgente();
									$fra = $pedido_pieza->getFechaRecepcionAgente();
									$frt = $pedido_pieza->getFechaRecepcionTagle();
									$fet = "";
									if($pedido_pieza->getDevolucionTagle()!=null)
										$fet = $pedido_pieza->getDevolucionTagle()->getFechaDevolucion();

									echo "	<tr class='celda_pedido 'id='pedido_pieza_$idPedidoPieza' onMouseOver=\"ResaltarFila('pedido_pieza_$idPedidoPieza');\" onMouseOut=\"RestablecerFila('pedido_pieza_$idPedidoPieza');\" onClick=\"verPedido($idPedidoPieza);\">
												<td>$idPedidoPieza</td>
												<td>$numPedido</td>
												<td>$nombre_reclamante</td>
												<td>$nombre_titular</td>
												<td>$dominio</td>
												<td>$vin</td>
												<td>$num_pieza</td>
												<td>$fsf</td>
												<td>$frf</td>
												<td>$fea</td>
												<td>$fra</td>
												<td>$frt</td>
												<td>$fet</td>
											</tr>";
								}
								?>
						</table>	
					</div>
				<?php
					}
				?>
			</fieldset>
		</div>
	</div>
</body>
</html>