<?php

class Marca {
   private $nombre_marca = "";
   private $id = 0;

  public function __construct($i,$n){
    $this->id = $i;
    $this->nombre_marca = $n;
  }

  public function getId(){
    return $this->id;
  }
  public function setId($i){
    $this->id=$i;
  }

  public function getNombreMarca(){
    return $this->nombre_marca;
  }
  public function setNombreMarca(){
    $this->nombre_marca = $n;
  }

}

?>