<?php
require_once('persistencia/Pedido.php');
require_once('persistencia/Pieza.php');

class PedidoPieza {
	private $id = 0;
	private $pedido = null;
	private $pieza = null;
	private $numero_pedido = "";
	private $fecha_solicitud_fabrica = "";
	private $fecha_recepcion_fabrica = "";
	private $fecha_envio_agente = "";	
	private $fecha_recepcion_agente = "";
	private $fecha_recepcion_tagle = "";
	private $devolucion_tagle = null;

	public function __construct($i,Pedido $ped, Pieza $pie,$num_ped,$fsf,$frf,$fea,$fra,$frt,$devolucion){
		$this->id = $i;
		$this->pedido = $ped;
		$this->pieza = $pie;
		$this->numero_pedido = $num_ped;
		$this->fecha_solicitud_fabrica = $fsf;
		$this->fecha_recepcion_fabrica = $frf;
		$this->fecha_envio_agente = $fea;
		$this->fecha_recepcion_agente = $fra;
		$this->fecha_recepcion_tagle = $frt;
		$this->devolucion_tagle= $devolucion;
	}

	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}

	public function getPedido(){
		return $this->pedido;
	}
	public function setPedido(Pedido $ped){
		$this->pedido = $ped;
	}

	public function getPieza(){
		return $this->pieza;
	}
	public function setPieza(Pieza $pie){
		$this->pieza= $pie;
	}

	public function getNumeroPedido(){
		return $this->numero_pedido;
	}
	public function setNumeroPedido($numero_ped){
		$this->numero_pedido = $numero_ped;
	}

	public function getFechaSolicitudFabrica(){
		return $this->fecha_solicitud_fabrica;
	}
	public function setFechaSolicitudFabrica($fsf){
		$this->fecha_solicitud_fabrica = $fsf;
	}

	public function getFechaRecepcionFabrica(){
		return $this->fecha_recepcion_fabrica;
	}
	public function setFechaRecepcionFabrica($frf){
		$this->fecha_recepcion_fabrica = $frf;
	}

	public function getFechaEnvioAgente(){
		return $this->fecha_envio_agente;
	}
	public function setFechaEnvioAgente($f){
		$this->fecha_envio_agente = $f;
	}

	public function getFechaRecepcionAgente(){
		return $this->fecha_recepcion_agente;
	}
	public function setFechaRecepcionAgente($f){
		$this->fecha_recepcion_agente = $f;
	}

	public function getFechaRecepcionTagle(){
		return $this->fecha_recepcion_tagle;
	}
	public function setFechaRecepcionTagle($frt){
		$this->fecha_recepcion_tagle = $frt;
	}

	public function getDevolucionTagle(){
		return $this->devolucion_tagle;
	}
	public function setDevolucionTagle(DevolucionPieza $devolucion){
		$this->devolucion_tagle = $devolucion;
	}

}

?>