<?php

class Producto{
    public $id;
    public $codigoBarras;
    public $nombre;
    public $tipo;
    public $stock;
    public $precio;

    public function __construct($id = 0, $codigoBarras, $nombre, $tipo, $stock, $precio)
    {
        $this->id = $id;
        $this->codigoBarras = $codigoBarras;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->stock = $stock;
        $this->precio = $precio;
    }
    /**Propiedades */
    public function setStock($value)
    {
        $this->stock = $value;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getCodigoBarras()
    {
        return $this->codigoBarras;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function getPrecio(){
        return $this->precio;
    }

    /**Metodos */
    public function equals(Producto $producto){
        return $this->codigoBarras == $producto->getCodigoBarras();
    }

    public function toString(){
        return $this->id . ',' . $this->codigoBarras . ',' . $this->nombre . ',' . $this->tipo . ',' . $this->stock . ',' . $this->precio;
    }
}

?>