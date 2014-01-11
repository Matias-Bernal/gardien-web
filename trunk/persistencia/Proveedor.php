<?php

class Proveedor {
   private $id = 0;
   private $nombre = "";

  public function __construct($i,$n){
    $this->id = $i;
    $this->nombre = $n;
  }

  public function getId(){
    return $this->id;
  }
  public function setId($i){
    $this->id=$i;
  }

  public function getNombre(){
    return $this->nombre;
  }
  public function setNombre(){
    $this->nombre = $n;
  }

}

?>