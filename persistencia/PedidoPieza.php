<?php
require_once('Pedido.php');
require_once('Pieza.php');
require_once('Muleto.php');
require_once('DevolucionPieza.php');
require_once('Bdg.php');
require_once('ManoObra.php');

class PedidoPieza {
	private $id = 0;
	private $pedido = null;
	private $pieza = null;
	private $numero_pedido = "";
	private $fecha_solicitud_fabrica = "";
	private $fecha_recepcion_fabrica = "";
	private $pnc = "";	
	private $muleto = null;
	private $devolucion_pieza = null;
	private $estado_pedido = "";
	private $bdg = null;	
	private $mano_obra = null;	
	private $stock = false;	
	private $propio = false;	
	private $fecha_envio_agente = "";	
	private $fecha_recepcion_agente = "";
	private $pieza_usada = false;	

	public function __construct(Pedido $ped, Pieza $pie){
		$this->pedido = $ped;
		$this->pieza = $pie;
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
	public function setEstadoReclamo($n){
		$this->numero_pedido = $n;
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

	public function getPnc(){
		return $this->pnc;
	}
	public function setPnc($p){
		$this->pnc = $p;
	}

	public function getMuleto(){
		return $this->muleto;
	}
	public function setMuleto(Muleto $m){
		$this->muleto = $m;
	}

	public function getDevolucionPieza(){
		return $this->devolucion_pieza;
	}
	public function setDevolucionPieza(DevolucionPieza $d){
		$this->devolucion_pieza = $d;
	}
	
	public function getEstadoPedido(){
		return $this->estado_pedido;
	}
	public function setEstadoPedido($e){
		$this->estado_pedido = $e;
	}

	public function getBdg(){
		return $this->bdg;
	}
	public function setBdg(Bdg $b){
		$this->bdg = $b;
	}

	public function getManoObra(){
		return $this->mano_obra;
	}
	public function setManoObra(ManoObra $m){
		$this->mano_obra = $m;
	}

	public function getStock(){
		return $this->stock;
	}
	public function setStock($s){
		$this->stock = $s;
	}

	public function getPropio(){
		return $this->propio;
	}
	public function setPropio($p){
		$this->propio = $p;
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

	public function getPiezaUsada(){
		return $this->pieza_usada;
	}
	public function setPiezaUsada($p){
		$this->pieza_usada = $p;
	}
}

?>